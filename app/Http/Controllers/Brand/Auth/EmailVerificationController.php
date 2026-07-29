<?php

namespace App\Http\Controllers\Brand\Auth;

use App\Http\Controllers\Controller;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function notice(): View
    {
        return view('brand.auth.verify-email');
    }

    public function verify(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $brand = $request->user('brand');

        if (!$verificationService->verify($brand, $request->string('code'))) {
            return back()->withErrors(['code' => 'This code is invalid or has expired.']);
        }

        return redirect()->route('brand.dashboard');
    }

    public function resend(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $brand = $request->user('brand');

        if (!$verificationService->canResend($brand)) {
            return back()->withErrors(['code' => 'Please wait a moment before requesting another code.']);
        }

        $verificationService->generateAndSend($brand);

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}
