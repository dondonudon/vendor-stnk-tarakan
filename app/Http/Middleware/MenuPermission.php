<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class MenuPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $url = Request::segment(1).'/'.Request::segment(2);
//        if ($url == 'master/dealer') {
//            return redirect('/');
//        } else {
//            return $next($request);
//        }

        return $next($request);
    }
}
