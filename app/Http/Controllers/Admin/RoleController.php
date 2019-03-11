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

    public function add()
    {
        return view('admin.role.add');
    }

    public function edit($id)
    {
        $info = AdminRole::findOrFail($id);
        return view('admin.role.edit',['info'=>$info]);
    }

    public function destory()
    {
        echo '删除方法';
    }
}
