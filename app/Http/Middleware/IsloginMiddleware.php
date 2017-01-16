<?php

namespace App\Http\Middleware;

use Closure;

use App\Model\Customer;

class IsLoginMiddleware
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
        if(!empty(session('uid')) && !empty(session('token')) === true && session('uid') > 0){
                return $next($request);
        }
        return redirect()->action('AdminController@index');
    }
}
