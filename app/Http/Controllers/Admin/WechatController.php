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

    public function info()
    {
        return view('admin.wechat.info');
    }

    public function create()
    {
        return view('admin.wechat.menu_create');
    }

    public function edit($id)
    {
        $info = WechatMenu::findOrFail($id);
        $menu['menu']['button'] = json_decode($info['data']);
        return view('admin.wechat.menu_edit', ['info' => $info,'menu'=>json_encode($menu)]);
    }

    public function store(Request $request)
    {
        $menu = $request['menu'];
        $menu = array_filter(json_decode($menu,true));
        $buttons = $menu['menu']['button'];
        $app = \EasyWeChat::officialAccount();
        $results = $app->menu->create($buttons);
        if($results['errcode'] == 0){
            WechatMenu::where('id','>=',1)->update(['status'=>0]);
            $wechatMenu = new WechatMenu();
            $wechatMenu->name = $request['name'];
            $wechatMenu->data = json_encode($buttons);
            $wechatMenu->status = 1;
            $wechatMenu->save();
        }
        return responseJson($results);
    }

    public function update(Request $request,$id)
    {
        $menu = $request['menu'];
        $menu = array_filter(json_decode($menu,true));
        $buttons = $menu['menu']['button'];
        $app = \EasyWeChat::officialAccount();
        $results = $app->menu->create($buttons);
        if($results['errcode'] == 0){
            WechatMenu::where('id','<>',$id)->update(['status'=>0]);
            $wechatMenu = WechatMenu::find($id);
            $wechatMenu->name = $request['name'];
            $wechatMenu->data = json_encode($buttons);
            $wechatMenu->status = 1;
            $wechatMenu->save();
        }
        return responseJson($results);
    }

    public function menuEffective($id)
    {
        $info = WechatMenu::findOrFail($id);
        $buttons = json_decode($info['data'],true);
        $app = \EasyWeChat::officialAccount();
        $results = $app->menu->create($buttons);
        if($results['errcode'] == 0){
            WechatMenu::where('id','<>',$id)->update(['status'=>0]);
            WechatMenu::where('id',$id)->update(['status'=>1]);
        }
        return responseJson($results);
    }

    public function detroy($id)
    {
        $info = WechatMenu::destroy($id);
        return responseJson($info);
    }

}
