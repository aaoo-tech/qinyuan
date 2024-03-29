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
        $_result = curlPost(
                    'http://120.25.218.156:12001/user/108/',
                    json_encode(['token' => session('token'), 'uid' => session('uid')])
                );
        if($_result['ok'] === true){
                return $next($request);
        }
        $request->session()->flush();
        return redirect()->action('AdminController@index');
    }
}
