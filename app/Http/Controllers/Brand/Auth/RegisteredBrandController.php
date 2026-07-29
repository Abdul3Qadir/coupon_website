<?php

namespace App\Http\Controllers\Brand\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Auth\RegisterBrandRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredBrandController extends Controller
{
    public function create(): View
    {
        return view('brand.auth.register', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(RegisterBrandRequest $request, EmailVerificationService $verificationService): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);

        $brand = Brand::create($data);

        Auth::guard('brand')->login($brand);

        $verificationService->generateAndSend($brand);

        return redirect()->route('brand.verify-email.notice');
    }
}
