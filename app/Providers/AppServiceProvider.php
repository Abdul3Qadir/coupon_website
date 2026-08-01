<?php

namespace App\Providers;

use App\View\Composers\BrandSidebarComposer;
use App\View\Composers\AdminSidebarComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.admin', AdminSidebarComposer::class);
        View::composer('components.layouts.brand', BrandSidebarComposer::class);
    }
}
