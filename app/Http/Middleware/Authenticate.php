<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Check if the user is authenticated using the 'web' guard
        if (Auth::guard('web')->check()) {
            // Validate impersonate action if session has 'impersonate'
            if (Session::has('impersonate')) {
                $selectedGuard = $request->session()->get('impersonate_guard');

                // If guards are provided
                if (!empty($guards)) {
                    // Bypass if the selectedGuard is valid
                    if (in_array($selectedGuard, $guards)) {
                        return $next($request);
                    }

                    // Redirect to dashboard with a warning message
                    return redirect()->route('admin.dashboard')->with([
                        'status' => 'warning',
                        'message' => 'Invalid impersonation session!'
                    ]);
                }
            }
        }

        // Authenticate the user based on the provided guards
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        // If no guards are specified, use the default guard
        if (empty($guards)) {
            $guards = [null];
        }

        // Check each guard to see if the user is authenticated
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        // If no authentication is found, throw an unauthenticated exception
        $this->unauthenticated($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request does not expect a JSON response
        if (!$request->expectsJson()) {
            // Redirect based on the route name
            if (str_contains($request->route()->getName(), 'customer')) {
                // Redirect to Employee Login Form
                return route('customer.auth.login');
            } elseif (str_contains($request->route()->getName(), 'admin')) {
                // Redirect to Admin Login Form
                return route('admin.auth.login');
            } elseif (str_contains($request->route()->getName(), 'merchant')) {
                // Redirect to Admin Login Form
                return route('merchant.auth.login');
            }
        }
    }
}