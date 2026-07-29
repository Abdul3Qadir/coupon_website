<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function notice(): View
    {
        return view('admin.auth.verify-email');
    }

    public function verify(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $admin = $request->user('admin');

        if (!$verificationService->verify($admin, $request->string('code'))) {
            return back()->withErrors(['code' => 'This code is invalid or has expired.']);
        }

        return redirect()->route('admin.dashboard');
    }

    public function resend(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $admin = $request->user('admin');

        if (!$verificationService->canResend($admin)) {
            return back()->withErrors(['code' => 'Please wait a moment before requesting another code.']);
        }

        $verificationService->generateAndSend($admin);

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}