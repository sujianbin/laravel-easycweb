<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $input = Input::all();
            $messages = [
                'username.required' => '用户名不能为空',
                'pwd.required' => '密码不能为空',
                'code.required' => '请输入验证码',
                'code.captcha' => '验证码错误'
            ];
            $rules = [
                'username' => 'required',
                'pwd' => 'required',
                'code' => 'required|captcha'
            ];
            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                $info = [
                    'code' => 101,
                    'msg' => $validator->getMessageBag()->first()
                ];
            } else {
                //$admin = Admin::where('username',$input['username'])->first();
                if (Auth::guard('admin')->attempt(['username' => $input['username'], 'password' => $input['pwd']])) {
                    $info = [
                        'code' => 200,
                        'msg' => '验证成功'
                    ];
                } else {
                    $info = [
                        'code' => 101,
                        'msg' => '用户名或者密码错误'
                    ];
                }
            }
            return responseJson($info);
        } else {
            return view('admin.login.login');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
