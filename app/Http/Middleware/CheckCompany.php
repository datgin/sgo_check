<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();

        // Slug công ty trong DB
        $company = Str::slug($user->company);

        // Lấy slug đầu tiên trên URL
        $currentSlug = $request->segment(1);

        // Nếu không có slug hoặc slug không khớp → 404
        if (!$currentSlug || $currentSlug !== $company) {
            abort(404);
        }

        return $next($request);
    }
}
