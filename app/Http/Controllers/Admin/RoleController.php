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
        //dd(right_group_rights());
        $lists = AdminRole::paginate();
        return view('admin.role.index',['lists'=>$lists]);
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function edit($id)
    {
        $info = AdminRole::findOrFail($id);
        return view('admin.role.edit',['info'=>$info]);
    }

    public function store(StoreRole $request)
    {
        $role = new AdminRole;
        $role->role_name = $request['role_name'];
        $role->role_description = $request['role_description'];
        $role->right = implode(',',$request['right']);
        $data = $role->save();
        return response()->json($data);
    }

    public function update(UpdateRole $request,$id)
    {
        $input = $request->all();
        $role = AdminRole::find($id);
        $role->role_name = $request['role_name'];
        $role->role_description = $request['role_description'];
        if($id == 1){//超级管理员的权限为0
            $role->right = 0;
        }else{
            $role->right = implode(',',$request['right']);
        }
        $data = $role->save();
        return response()->json($data);
    }

    public function destory()
    {
        echo '删除方法';
    }
}
