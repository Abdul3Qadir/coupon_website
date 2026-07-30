<?php

namespace App\Http\Controllers\Brand\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Auth\ResetBrandPasswordRequest;
use App\Models\Brand;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    public function forgotPasswordForm(): View
    {
        return view('brand.auth.forgot-password');
    }

    public function sendResetCode(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $brand = Brand::where('email', $request->input('email'))->first();

        if ($brand) {
            if (!$verificationService->canResend($brand)) {
                return back()->withErrors(['email' => 'Please wait a moment before requesting another code.']);
            }

            $verificationService->generateAndSend($brand);

            session([
                'password_reset_brand_id' => $brand->id,
                'password_reset_started_at' => now(),
            ]);
        }

        return redirect()->route('brand.password.verify.form')
            ->with('status', 'If an account exists for that email, a verification code has been sent.');
    }

    public function verifyForm(): View|RedirectResponse
    {
        if (!session()->has('password_reset_brand_id')) {
            return redirect()->route('brand.password.request');
        }

        return view('brand.auth.verify-reset-code');
    }

    public function resendResetCode(EmailVerificationService $verificationService): RedirectResponse
    {
        $brand = Brand::find(session('password_reset_brand_id'));

        if (!$brand) {
            return redirect()->route('brand.password.request');
        }

        if (!$verificationService->canResend($brand)) {
            return back()->withErrors(['code' => 'Please wait a moment before requesting another code.']);
        }

        $verificationService->generateAndSend($brand);

        return back()->with('status', 'A new verification code has been sent to your email.');
    }

    public function verifyCode(Request $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $request->validate(['code' => ['required', 'digits:6']]);

        $brand = Brand::find(session('password_reset_brand_id'));

        if (!$brand || !$verificationService->verifyCodeOnly($brand, $request->string('code'))) {
            return back()->withErrors(['code' => 'This code is invalid or has expired.']);
        }

        session([
            'password_reset_verified_brand_id' => $brand->id,
            'password_reset_verified_at' => now(),
        ]);

        session()->forget(['password_reset_brand_id', 'password_reset_started_at']);

        return redirect()->route('brand.password.reset.form');
    }

    public function resetForm(): View|RedirectResponse
    {
        if (!$this->hasValidResetSession()) {
            return redirect()->route('brand.password.request');
        }

        return view('brand.auth.reset-password');
    }

    public function resetPassword(ResetBrandPasswordRequest $request): RedirectResponse
    {
        if (!$this->hasValidResetSession()) {
            return redirect()->route('brand.password.request');
        }

        $brand = Brand::find(session('password_reset_verified_brand_id'));

        if (!$brand) {
            return redirect()->route('brand.password.request');
        }

        $brand->forceFill(['password' => $request->validated()['password']])->save();

        session()->forget(['password_reset_verified_brand_id', 'password_reset_verified_at']);

        return redirect()->route('brand.login')->with('status', 'Your password has been reset. You can now log in.');
    }

    private function hasValidResetSession(): bool
    {
        $verifiedAt = session('password_reset_verified_at');

        return session()->has('password_reset_verified_brand_id')
            && $verifiedAt
            && now()->diffInMinutes($verifiedAt) <= 10;
    }
}