<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Brand\Auth\RegisteredBrandController;
use App\Http\Controllers\Brand\Auth\AuthenticatedBrandSessionController;
use App\Http\Controllers\Brand\Auth\EmailVerificationController as BrandEmailVerificationController;
use App\Http\Controllers\Admin\Auth\RegisteredSubAdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationController as AdminEmailVerificationController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/stores', function () {
    return view('stores');
});

Route::get('/categories', function () {
    return view('categories');
});

Route::get('/deals', function () {
    return view('deals');
});

Route::get('/stores/brand', function () {
    return view('brand-details');
});

Route::get('/coupons/category', function () {
    return view('coupons-category');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog/article', function () {
    return view('blog-article');
});


Route::prefix('brand')->name('brand.')->group(function () {
    Route::middleware('guest:brand')->group(function () {
        Route::get('register', [RegisteredBrandController::class, 'create'])->name('register');
        Route::post('register', [RegisteredBrandController::class, 'store']);
        Route::get('login', [AuthenticatedBrandSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedBrandSessionController::class, 'store']);
    });

    Route::middleware('auth:brand')->group(function () {
        Route::get('verify-email', [BrandEmailVerificationController::class, 'notice'])->name('verify-email.notice');
        Route::post('verify-email', [BrandEmailVerificationController::class, 'verify'])->name('verify-email.verify');
        Route::post('verify-email/resend', [BrandEmailVerificationController::class, 'resend'])->name('verify-email.resend');
        Route::post('logout', [AuthenticatedBrandSessionController::class, 'destroy'])->name('logout');

        Route::middleware('brand.verified')->group(function () {
            Route::get('dashboard', fn () => view('brand.dashboard'))->name('dashboard');
        });
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('register', [RegisteredSubAdminController::class, 'create'])->name('register');
        Route::post('register', [RegisteredSubAdminController::class, 'store']);
        Route::get('login', [AuthenticatedAdminSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedAdminSessionController::class, 'store']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('verify-email', [AdminEmailVerificationController::class, 'notice'])->name('verify-email.notice');
        Route::post('verify-email', [AdminEmailVerificationController::class, 'verify'])->name('verify-email.verify');
        Route::post('verify-email/resend', [AdminEmailVerificationController::class, 'resend'])->name('verify-email.resend');
        Route::post('logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('logout');

        Route::middleware('admin.verified')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
    });
});