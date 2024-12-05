<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on the guard
                switch ($guard) {
                    case 'merchant':
                        return redirect()->route('merchant.dashboard'); // Redirect to the merchant dashboard
                        case 'web': // Default guard for users
                    default:
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
