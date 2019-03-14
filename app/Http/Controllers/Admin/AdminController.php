<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAdmin;
use App\Http\Requests\Admin\UpdateAdmin;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $lists = Admin::paginate();
        return view('admin.admin.index',['lists'=>$lists]);
    }

    public function create()
    {
        $roles = AdminRole::get();
        return view('admin.admin.create',['roles'=>$roles]);
    }

    public function edit($id)
    {
        $info = Admin::findOrFail($id);
        $roles = AdminRole::get();
        return view('admin.admin.edit',['info'=>$info,'roles'=>$roles]);
    }

    public function store(StoreAdmin $request)
    {
        $admin = new Admin;
        $admin->username = $request['username'];
        $admin->realname = $request['realname'];
        $admin->role_id = $request['role_id'];
        $admin->password = $request['password'] ? bcrypt($request['password']) : bcrypt(123456);
        $data = $admin->save();
        return response()->json($data);
    }

    public function update(UpdateAdmin $request,$id)
    {
        $admin = Admin::find($id);
        $admin->username = $request['username'];
        $admin->realname = $request['realname'];
        $admin->role_id = $request['role_id'];
        $request['password'] && $admin->password = bcrypt($request['password']);
        $data = $admin->save();
        return response()->json($data);
    }

    public function editPwd(Request $request)
    {
        if($request->getMethod() == 'POST') {
            $input = $request->all();
            $rules = [
                'password' => 'required',
                'password1' => 'required',
            ];
            $messages = [
                'password.required' => '密码不能为空',
                'password1.required' => '确认密码不能为空',
            ];
            $validator = Validator::make($input, $rules, $messages);
            if($validator->fails()){
                $info = [
                    'code' => 101,
                    'msg' => $validator->getMessageBag()->first()
                ];
            }else{
                if($input['password'] != $input['password1']){
                    $info = [
                        'code' => 101,
                        'msg' => '两次密码不一致'
                    ];
                }else{
                    $admin = Admin::find(Auth::guard('admin')->user()->id);
                    $admin->password = bcrypt($input['password']);
                    $admin->save();
                    $info = [
                        'code' => 200,
                        'msg' => '更新成功'
                    ];
                }
            }
            return response()->json($info);
        }else{
            return view('admin.admin.editpwd');
        }
    }

    public function destory()
    {
        echo '删除方法';
    }
}

