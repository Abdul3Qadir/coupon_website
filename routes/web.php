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
use App\Http\Controllers\Admin\SubAdminManagementController;
use App\Http\Controllers\Admin\CategoryManagementController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\Admin\OfferManagementController;
use App\Http\Controllers\Brand\OfferController;
use App\Http\Controllers\Admin\BlogCategoryManagementController;
use App\Http\Controllers\Admin\BlogManagementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StorePageController;
use App\Http\Controllers\StoreListingController;
use App\Http\Controllers\DealPageController;
use App\Http\Controllers\HomePageController;


// Public Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/stores', [StoreListingController::class, 'index'])->name('stores.index');
Route::get('/categories', [CategoryPageController::class, 'index'])->name('categories.index');
Route::get('/coupons/{category:slug}', [CategoryPageController::class, 'byCategory'])->name('coupons.category');
Route::get('/deals', [DealPageController::class, 'index'])->name('deals');
Route::get('/stores/{brand:slug}', [StorePageController::class, 'show'])->name('stores.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/offers/{offer}', [OfferController::class, 'redirect'])->name('offers.redirect');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Brand Routes
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

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Brand\NotificationController::class, 'index'])->name('index');
            Route::post('{id}/read', [\App\Http\Controllers\Brand\NotificationController::class, 'markRead'])->name('read');
            Route::post('mark-all-read', [\App\Http\Controllers\Brand\NotificationController::class, 'markAllRead'])->name('mark-all-read');
        });

        Route::middleware('brand.verified')->group(function () {
            Route::get('dashboard', [BrandDashboardController::class, 'index'])->name('dashboard');

            Route::prefix('offers')->name('offers.')->group(function () {
                Route::get('/', [OfferController::class, 'index'])->name('index');
                Route::get('create', [OfferController::class, 'create'])->name('create');
                Route::post('/', [OfferController::class, 'store'])->name('store');
                Route::get('{offer}/edit', [OfferController::class, 'edit'])->name('edit');
                Route::put('{offer}', [OfferController::class, 'update'])->name('update');
                Route::delete('{offer}', [OfferController::class, 'destroy'])->name('destroy');
            });

            Route::get('settings', [\App\Http\Controllers\Brand\ProfileController::class, 'edit'])->name('settings.edit');
            Route::put('settings/profile', [\App\Http\Controllers\Brand\ProfileController::class, 'update'])->name('settings.profile.update');
            Route::put('settings/password', [\App\Http\Controllers\Brand\ProfileController::class, 'updatePassword'])->name('settings.password.update');
        });
    });
});

// Admin Routes
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

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('index');
            Route::post('{id}/read', [\App\Http\Controllers\Admin\NotificationController::class, 'markRead'])->name('read');
            Route::post('mark-all-read', [\App\Http\Controllers\Admin\NotificationController::class, 'markAllRead'])->name('mark-all-read');
        });

        Route::middleware('admin.verified')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::prefix('categories')->name('categories.')->group(function () {
                Route::get('/', [CategoryManagementController::class, 'index'])->name('index');
                Route::get('create', [CategoryManagementController::class, 'create'])->name('create');
                Route::post('/', [CategoryManagementController::class, 'store'])->name('store');
                Route::get('{category}/edit', [CategoryManagementController::class, 'edit'])->name('edit');
                Route::put('{category}', [CategoryManagementController::class, 'update'])->name('update');
                Route::delete('{category}', [CategoryManagementController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('blog-categories')->name('blog-categories.')->group(function () {
                Route::get('/', [BlogCategoryManagementController::class, 'index'])->name('index');
                Route::get('create', [BlogCategoryManagementController::class, 'create'])->name('create');
                Route::post('/', [BlogCategoryManagementController::class, 'store'])->name('store');
                Route::get('{blogCategory}/edit', [BlogCategoryManagementController::class, 'edit'])->name('edit');
                Route::put('{blogCategory}', [BlogCategoryManagementController::class, 'update'])->name('update');
                Route::delete('{blogCategory}', [BlogCategoryManagementController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('blogs')->name('blogs.')->group(function () {
                Route::get('/', [BlogManagementController::class, 'index'])->name('index');
                Route::get('create', [BlogManagementController::class, 'create'])->name('create');
                Route::post('/', [BlogManagementController::class, 'store'])->name('store');
                Route::get('{blog}/edit', [BlogManagementController::class, 'edit'])->name('edit');
                Route::put('{blog}', [BlogManagementController::class, 'update'])->name('update');
                Route::delete('{blog}', [BlogManagementController::class, 'destroy'])->name('destroy');
            });
            
            Route::post('blogs/upload-image', [App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('blogs.upload-image');

            Route::prefix('offers')->name('offers.')->group(function () {
                Route::get('/', [OfferManagementController::class, 'index'])->name('index');
                Route::get('create', [OfferManagementController::class, 'create'])->name('create');
                Route::post('/', [OfferManagementController::class, 'store'])->name('store');
                Route::get('{offer}', [OfferManagementController::class, 'show'])->name('show');
                Route::get('{offer}/edit', [OfferManagementController::class, 'edit'])->name('edit');
                Route::put('{offer}', [OfferManagementController::class, 'update'])->name('update');
                Route::delete('{offer}', [OfferManagementController::class, 'destroy'])->name('destroy');

                // Approve/Reject — Super Admin Only
                Route::post('{offer}/approve', [OfferManagementController::class, 'approve'])->name('approve')->middleware('admin.super-admin');
                Route::post('{offer}/reject', [OfferManagementController::class, 'reject'])->name('reject')->middleware('admin.super-admin');
            });

            // Super Admin Only
            Route::middleware('admin.super-admin')->group(function () {
                // Brands
                Route::prefix('brands')->name('brands.')->group(function () {
                    Route::get('/', [BrandManagementController::class, 'index'])->name('index');
                    Route::get('{brand}', [BrandManagementController::class, 'show'])->name('show');
                    Route::post('{brand}/verify', [BrandManagementController::class, 'verify'])->name('verify');
                    Route::post('{brand}/reject', [BrandManagementController::class, 'reject'])->name('reject');
                    Route::post('{brand}/suspend', [BrandManagementController::class, 'suspend'])->name('suspend');
                    Route::post('{brand}/reinstate', [BrandManagementController::class, 'reinstate'])->name('reinstate');
                    Route::post('{brand}/toggle-auto-publish', [BrandManagementController::class, 'toggleAutoPublish'])->name('toggle-auto-publish');
                    Route::post('{brand}/toggle-featured', [BrandManagementController::class, 'toggleFeatured'])->name('toggle-featured');
                });

                // Sub-Admins
                Route::prefix('sub-admins')->name('sub-admins.')->group(function () {
                    Route::get('/', [SubAdminManagementController::class, 'index'])->name('index');
                    Route::get('{subAdmin}', [SubAdminManagementController::class, 'show'])->name('show');
                    Route::post('{subAdmin}/approve', [SubAdminManagementController::class, 'approve'])->name('approve');
                    Route::post('{subAdmin}/reject', [SubAdminManagementController::class, 'reject'])->name('reject');
                    Route::post('{subAdmin}/toggle-auto-publish', [SubAdminManagementController::class, 'toggleAutoPublish'])->name('toggle-auto-publish');
                    Route::delete('{subAdmin}', [SubAdminManagementController::class, 'destroy'])->name('destroy');
                });
            });
        });
    });
});