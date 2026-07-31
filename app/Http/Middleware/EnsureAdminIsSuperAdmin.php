<?php

namespace App\Http\Middleware;

use App\Enums\AdminRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = $request->user('admin');

        if (!$admin || $admin->role !== AdminRole::SuperAdmin) {
            abort(403);
        }

        return $next($request);
    }
}