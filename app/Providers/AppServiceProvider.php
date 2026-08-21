<?php

namespace App\Providers;

use App\View\Composers\BrandSidebarComposer;
use App\View\Composers\AdminSidebarComposer;
use App\View\Composers\FooterComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.layouts.admin', AdminSidebarComposer::class);
        View::composer('components.layouts.brand', BrandSidebarComposer::class);
        View::composer('pages-components.footer', FooterComposer::class);
    }
}