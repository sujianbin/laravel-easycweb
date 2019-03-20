<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function config(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $input = $request->all();
            $info = Config::where('type','config')->pluck('value','name');
            if(is_array($info)){

            }else{

            }
        }else{
            $info = Config::where('type','config')->pluck('value','name');
            return view('admin.config.config')->with('info',$info);
        }
    }
}
