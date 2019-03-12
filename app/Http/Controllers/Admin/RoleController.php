<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
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

    public function store()
    {
        echo '新增方法';
    }

    public function update()
    {
        echo "更新方法";
    }

    public function destory()
    {
        echo '删除方法';
    }
}
