<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class cekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('isLogin') !== true) {
            return redirect('/login');
        }

        if (session('role') && session('role') !== 'admin') {
            return abort(403, 'Akses hanya untuk admin');
        }
        return $next($request);
    }
}
