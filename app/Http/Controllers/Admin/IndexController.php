<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $topMenu = ['系统首页','每日书籍','每日会员','每日代理商'];
        return view('admin.index.index',['topMenu'=>$topMenu]);
    }

    public function centos()
    {
        echo '基本统计信息';
    }

    public function test()
    {
        echo 222;
        $input = [
            'username'=>'admin',
            'password'=>'1234561'
        ];
        $data = Auth::guard('admin')->attempt(['username'=>$input['username'],'password'=>$input['password']]);
        var_dump($data);

        echo Auth::guard('admin')->check();

        $admin = Auth::guard('admin')->user();

        Auth::guard('admin')->logout();
        var_dump($admin);
    }

    public function role()
    {
        echo 'role';
    }
}
