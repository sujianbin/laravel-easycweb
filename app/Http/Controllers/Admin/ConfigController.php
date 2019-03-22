<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ConfigController extends Controller
{
    public function config(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $input = $request->all();
            $info = Config::where('type','config')->pluck('value','name');
            $info = $info->toArray();
            if(is_array($info)){
                foreach ($input as $k=>$v){
                    Config::updateOrCreate(['name'=>$k,'type'=>'config'],['value'=>$v]);
                }
            }else{
                foreach ($input as $k=>$v){
                    $newData[] = ['name'=>$k,'value'=>$v,'type'=>'config'];
                }
                $config = new Config();
                $config->insert($newData);
            }
            Cache::forget('config');
            $data = Config::where('type','config')->pluck('value','name')->toArray();
            Cache::forever('config', $data);
            return responseJson(true);
        }else{
            $info = Config::where('type','config')->pluck('value','name');
            return view('admin.config.config')->with('info',$info);
        }
    }
}
