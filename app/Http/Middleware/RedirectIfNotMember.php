<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'member')
    {
        

        if (!auth()->guard($guard)->check()) {
            // $request->session()->flash('error', 'You must to see this page');
            // return redirect(route('member.auth.showlogin'));
            return response()->json([
                'is_loggedin'   => false,
                'access_token'  => null,
                'token_type'    =>  null,
                'expires_in'    =>  null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
        return $next($request);
    }
}
