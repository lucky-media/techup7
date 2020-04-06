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

