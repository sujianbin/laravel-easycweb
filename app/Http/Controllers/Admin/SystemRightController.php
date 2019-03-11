<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemRight;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Response;

class SystemRightController extends Controller
{
    public function index()
    {
        $lists = SystemRight::paginate();
        return view('admin.right.index',['lists'=>$lists]);
    }

    public function add()
    {
        return view('admin.right.add');
    }

    public function edit($id)
    {
        $info = SystemRight::findOrFail($id);
        return view('admin.right.edit',['info'=>$info]);
    }

    /**
     * 获取全部控制器
     * @return json
     */
    public function getAllController()
    {
        $controllers = Cache::remember('adminControllerList', 600, function () {
            $getAllController = function ($path = '') use (&$controllerList,&$getAllController){
                $controllerPath = app_path().'/Http/Controllers/Admin'.($path ? '/'.$path : '');
                $namespace = 'App\Http\Controllers\Admin\\'.($path ? $path.'\\':'');
                $dirRes   = opendir($controllerPath);
                while($dir = readdir($dirRes)){
                    if(!in_array($dir,['.','..'])){
                        if(is_dir($controllerPath.'/'.$dir)){
                            $controllerList = $getAllController($dir);
                        }else{
                            $controllerList[] = $namespace.basename($dir,'.php');
                        }
                    }
                }
                return $controllerList;
            };
            return $getAllController();
        });
        return Response::json($controllers);
    }

    /**
     * 获取控制器下的所有方法
     * @return json
     */
    public function getControllerMethod()
    {
        $controller = request()->input('controller');
        $methods = Cache::remember('admin'.$controller.'Methods',600, function () use ($controller) {
            $method = get_class_methods($controller);
            $allMethod = [];
            foreach ($method as $v){
                if($v == 'middleware') break;
                $allMethod[] = $v;
            }
            return $allMethod;
        });
        return Response::json($methods);
    }

    public function update()
    {
        echo '更新方法';
    }

    public function destory()
    {
        echo '删除方法';
    }
}
