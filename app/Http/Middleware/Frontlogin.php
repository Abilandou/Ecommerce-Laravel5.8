<?php

namespace App\Http\Middleware;

use Session;

use Closure;

class Frontlogin
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
        if(empty(Session::has('frontSession'))){
            return redirect('/login_register');
        }
        return $next($request);
    }
}
