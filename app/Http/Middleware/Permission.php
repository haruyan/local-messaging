<?php

namespace App\Http\Middleware;

use Closure;

class Permission
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
        // $user = \App\Models\User::where('username', $request->username)->get();
        // return response()->json($request);
        // dd($request);
        // if($user->role == 'admin') {
            return $next($request);
        // }

        // return redirect($user);
    }
}
