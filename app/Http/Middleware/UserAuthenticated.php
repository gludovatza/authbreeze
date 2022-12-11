<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if( auth()->check() )
        {
            /** @var User $user */
            $user = auth()->user();

            if ( $user->hasRole('admin') ) {
                return redirect(route('admin_dashboard'));
            }
            else if ( $user->hasRole('user') ) {
                return $next($request);
            }
        }

        abort(403);  // permission denied error
    }
}
