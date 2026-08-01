<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Brand\Auth\RegisteredBrandController;
use App\Http\Controllers\Brand\Auth\AuthenticatedBrandSessionController;
use App\Http\Controllers\Brand\Auth\EmailVerificationController as BrandEmailVerificationController;
use App\Http\Controllers\Admin\Auth\RegisteredSubAdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationController as AdminEmailVerificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Brand\Auth\PasswordResetController;
use App\Http\Controllers\Admin\BrandManagementController;
use App\Http\Controllers\Brand\DashboardController as BrandDashboardController;

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

        Route::get('forgot-password', [PasswordResetController::class, 'forgotPasswordForm'])->name('password.request');
        Route::post('forgot-password', [PasswordResetController::class, 'sendResetCode'])->name('password.email');
        Route::get('forgot-password/verify', [PasswordResetController::class, 'verifyForm'])->name('password.verify.form');
        Route::post('forgot-password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify');
        Route::post('forgot-password/resend', [PasswordResetController::class, 'resendResetCode'])->name('password.resend');
        Route::get('forgot-password/reset', [PasswordResetController::class, 'resetForm'])->name('password.reset.form');
        Route::post('forgot-password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
    });

    Route::middleware('auth:brand')->group(function () {
        Route::get('verify-email', [BrandEmailVerificationController::class, 'notice'])->name('verify-email.notice');
        Route::post('verify-email', [BrandEmailVerificationController::class, 'verify'])->name('verify-email.verify');
        Route::post('verify-email/resend', [BrandEmailVerificationController::class, 'resend'])->name('verify-email.resend');
        Route::post('logout', [AuthenticatedBrandSessionController::class, 'destroy'])->name('logout');

        Route::middleware('brand.verified')->group(function () {
           Route::get('dashboard', [BrandDashboardController::class, 'index'])->name('dashboard');
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

            Route::middleware('admin.super-admin')->group(function () {
                Route::prefix('brands')->name('brands.')->group(function () {
                    Route::get('/', [BrandManagementController::class, 'index'])->name('index');
                    Route::get('{brand}', [BrandManagementController::class, 'show'])->name('show');
                    Route::post('{brand}/verify', [BrandManagementController::class, 'verify'])->name('verify');
                    Route::post('{brand}/reject', [BrandManagementController::class, 'reject'])->name('reject');
                    Route::post('{brand}/suspend', [BrandManagementController::class, 'suspend'])->name('suspend');
                    Route::post('{brand}/reinstate', [BrandManagementController::class, 'reinstate'])->name('reinstate');
                    Route::post('{brand}/toggle-auto-publish', [BrandManagementController::class, 'toggleAutoPublish'])->name('toggle-auto-publish');
                });
    });

        });
    });
});

