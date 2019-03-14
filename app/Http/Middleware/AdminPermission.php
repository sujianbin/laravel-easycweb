<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\SystemRight;
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
        $admin = Admin::find(auth('admin')->user()->id);
        $rights = $admin->role->right;
        if($rights == 0){
            return $next($request);
        }else{
            $currentAction = Route::currentRouteAction();
            $rightsAction = SystemRight::whereIn('id',explode(',',$rights))->pluck('right');
            if($rightsAction){
                $allRights = '';
                foreach ($rightsAction as $vo){
                    $allRights .= $vo.';';
                }
                if(strpos(";$allRights;",";{$currentAction};") !== false){
                    return $next($request);
                }
            }
            if($request->ajax() || $request->wantsJson()){
                return response()->json(['code'=>101,'msg'=>'暂无权限']);
            }else{
                return response()->view('admin.public.noview');
            }
        }
    }
}
