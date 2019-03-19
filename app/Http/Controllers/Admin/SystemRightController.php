<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SystemRight\StoreSystemRight;
use App\Http\Requests\SystemRight\UpdateSystemRight;
use App\Models\SystemRight;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemRightController extends Controller
{
    public function index(Request $request)
    {
        $group = $request->input('groups');
        $name = $request->input('name');
        $lists = SystemRight
            ::when($group, function ($query, $group) {
                return $query->where("group", "like", $group . '@%');
            })
            ->when($name, function ($query, $name) {
                return $query->where("name", "like", "%{$name}%");
            })
            ->paginate();
        return view('admin.right.index', ['lists' => $lists]);
    }

    public function create()
    {
        return view('admin.right.create');
    }

    public function edit($id)
    {
        $info = SystemRight::findOrFail($id);
        return view('admin.right.edit', ['info' => $info]);
    }

    public function store(StoreSystemRight $request)
    {
        $systemRight = new SystemRight;
        $systemRight->name = $request['name'];
        $systemRight->group = $request['group'];
        $systemRight->right = implode(';', $request['right']);
        $systemRight->order_id = $request['order_id'];
        $data = $systemRight->save();
        return response()->json($data);
    }

    public function update(UpdateSystemRight $request, $id)
    {
        $input = $request->all();
        $systemRight = SystemRight::find($id);
        $systemRight->name = $input['name'];
        $systemRight->group = $input['group'];
        $systemRight->right = implode(';', $input['right']);
        $systemRight->order_id = $input['order_id'];
        $data = $systemRight->save();
        return response()->json($data);
    }

    public function destroy($ids)
    {
        $ids = request()->has('ids') ? request()->get('ids') : $ids;
        $info = SystemRight::destroy($ids);
        return response()->json($info);
    }

    /**
     * 获取全部控制器
     * @return json
     */
    public function getAllController()
    {
        $controllers = Cache::remember('adminControllerList', 600, function () {
            $getAllController = function ($path = null) use (&$controllerList, &$getAllController) {
                $controllerPath = app_path() . '/Http/Controllers/Admin' . ($path ? '/' . $path : '');
                $namespace = 'App\Http\Controllers\Admin\\' . ($path ? $path . '\\' : '');
                $dirRes = opendir($controllerPath);
                while ($dir = readdir($dirRes)) {
                    if (!in_array($dir, ['.', '..'])) {
                        if (is_dir($controllerPath . '/' . $dir)) {
                            $controllerList = $getAllController($dir);
                        } else {
                            $controllerList[] = $namespace . basename($dir, '.php');
                        }
                    }
                }
                return $controllerList;
            };
            return $getAllController();
        });
        return response()->json($controllers);
    }

    /**
     * 获取控制器下的所有方法
     * @return json
     */
    public function getControllerMethod()
    {
        $controller = request()->input('controller');
        $methods = Cache::remember('admin' . $controller . 'Methods', 600, function () use ($controller) {
            $method = get_class_methods($controller);
            $allMethod = [];
            foreach ($method as $v) {
                if ($v == 'middleware') break;
                $allMethod[] = $v;
            }
            return $allMethod;
        });
        return response()->json($methods);
    }
}
