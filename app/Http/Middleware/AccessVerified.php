<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
use App\Models\Role;

class AccessVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()
                && (Auth::user()->status != User::STATUS_VERIFIED)
                && Auth::user()->hasRole(Role::ROLE_SUPER_ADMIN)) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your Account is suspended, please contact the Admin.');
        }

        return $next($request);
    }
}