<?php

namespace App\Http\Middleware;

use Closure;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     * Checks the role of the user before returning the request
     */
    public function handle($request, Closure $next, ...$role)
    {
        foreach($role as $roles){
            if ($request->user()->hasRole($roles)){
                return $next($request); 
            }
        }
        return redirect('/');
    }
}

