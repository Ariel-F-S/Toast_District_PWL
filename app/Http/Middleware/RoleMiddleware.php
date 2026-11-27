<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses ditolak. Halaman ini tidak sesuai dengan hak akses akunmu.');
        }

        return $next($request);
    }
}