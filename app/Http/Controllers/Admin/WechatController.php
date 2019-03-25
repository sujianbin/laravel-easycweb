<?php

namespace App\Http\Controllers\Admin;

use App\Models\WechatMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function index()
    {
        $lists = WechatMenu::paginate();
        return view('admin.wechat.menu', ['lists' => $lists]);
    }

    public function show()
    {
        echo '详情';
    }

    public function create()
    {
        return view('admin.wechat.menu_create');
    }

    public function edit($id)
    {
        $info = WechatMenu::findOrFail($id);
        return view('admin.wechat.menu_edit', ['info' => $info]);
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function detroy()
    {

    }

}
