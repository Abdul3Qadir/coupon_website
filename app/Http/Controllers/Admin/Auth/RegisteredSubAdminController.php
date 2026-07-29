<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\AdminRole;
use App\Enums\AdminStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\RegisterSubAdminRequest;
use App\Models\Admin;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredSubAdminController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.register');
    }

    public function store(RegisterSubAdminRequest $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $admin = Admin::create($request->validated());
        $admin->forceFill([
            'role' => AdminRole::SubAdmin,
            'status' => AdminStatus::Pending,
        ])->save();

        Auth::guard('admin')->login($admin);

        $verificationService->generateAndSend($admin);

        return redirect()->route('admin.verify-email.notice');
    }
}
