<?php

namespace App\Http\Middleware;

use App\Enums\BrandStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBrandEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $brand = $request->user('brand');

        if (!$brand || !$brand->email_verified_at) {
            return redirect()->route('brand.verify-email.notice');
        }

        if ($brand->status !== BrandStatus::Verified) {
            return response()->view('brand.pending', [], 200);
        }

        return $next($request);
    }
}
