<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckPetugasLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('is_logged_in')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }
        return $next($request);
    }
} 