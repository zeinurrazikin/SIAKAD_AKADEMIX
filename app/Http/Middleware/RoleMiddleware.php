<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login & apakah role-nya sesuai
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request); // Silakan lewat
        }

        // Kalau tidak sesuai, tendang keluar atau kasih error
        abort(403, 'Anda tidak punya akses ke halaman ini!');
    }
}