<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirect unauthenticated users to the admin login page.
 */
class EnsureAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! Auth::user()->isActiveAdmin()) {
            Auth::logout();

            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Please login with an active admin account.']);
        }

        return $next($request);
    }
}
