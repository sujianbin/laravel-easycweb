<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$admin = auth('admin')->user();
        //var_dump($admin);
//        $currentAction = Route::currentRouteAction();
//        echo $currentAction;
//        dd($request);
        return $next($request);
    }
}
