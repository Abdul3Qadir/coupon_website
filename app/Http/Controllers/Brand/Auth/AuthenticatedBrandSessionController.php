<?php

namespace App\Http\Controllers\Brand\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Auth\LoginBrandRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedBrandSessionController extends Controller
{
    public function create(): View
    {
        return view('brand.auth.login');
    }

    public function store(LoginBrandRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('brand.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('brand')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
