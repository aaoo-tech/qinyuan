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
                    'http://120.25.218.156:12001/center/100/',
                    json_encode(['token' => session('token'), 'uid' => session('uid'), 'zid' => session('zid'), 'ztype' => '1'])
                );
        if($_result['ok'] === true){
                return $next($request);
        }
        return redirect()->action('AdminController@index');
    }
}
