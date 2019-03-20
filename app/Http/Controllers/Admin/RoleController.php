<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Role\StoreRole;
use App\Http\Requests\Role\UpdateRole;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $lists = AdminRole::paginate();
        return view('admin.role.index', ['lists' => $lists]);
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function edit($id)
    {
        $info = AdminRole::findOrFail($id);
        return view('admin.role.edit', ['info' => $info]);
    }

    public function store(StoreRole $request)
    {
        $role = new AdminRole;
        $role->role_name = $request['role_name'];
        $role->role_description = $request['role_description'];
        $role->right = implode(',', $request['right']);
        $data = $role->save();
        return responseJson($data);
    }

    public function update(UpdateRole $request, $id)
    {
        $role = AdminRole::find($id);
        $role->role_name = $request['role_name'];
        $role->role_description = $request['role_description'];
        if ($id == 1) {//超级管理员的权限为0
            $role->right = 0;
        } else {
            $role->right = implode(',', $request['right']);
        }
        $data = $role->save();
        return responseJson($data);
    }

    public function destroy($id)
    {
        //超级管理员不可删除
        if ($id == 1) return false;
        //当前角色对应了管理员则不能删除
        $admin = AdminRole::find($id)->admin;
        if(count($admin) > 0){
            $info = [
                'code'=>201,
                'msg'=>"当前角色拥有".count($admin).'个管理员，请先删除对应的管理员'
            ];
            return responseJson($info);
        }else{
            $info = AdminRole::destroy($id);
            return responseJson($info);
        }
    }
}
