<?php

namespace App\Http\Middleware;

use App\Enums\AdminStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = $request->user('admin');

        if (!$admin || !$admin->email_verified_at) {
            return redirect()->route('admin.verify-email.notice');
        }

        if ($admin->status !== AdminStatus::Approved) {
            return response()->view('admin.pending', [], 200);
        }

        return $next($request);
    }
}
