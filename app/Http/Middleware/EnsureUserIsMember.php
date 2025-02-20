<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the role 'member'
        if (!Auth::check() || Auth::user()->role !== 'member') {
            // Redirect them to the login page or some other appropriate page
            return redirect('user_login')->with('error', 'Access restricted to members only.');
        }

        return $next($request);
    }
}
