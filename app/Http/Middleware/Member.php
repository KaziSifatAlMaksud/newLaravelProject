<?php

namespace App\Http\Middleware;

use App\Models\ChildUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    /**
     * Handle an incoming request.
     * Redirect authenticated users to a specific route.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('member')->check()) {
            return $next($request);
        }
        return redirect('login')->with('error', 'You must be logged in as a member.');
    }
}
