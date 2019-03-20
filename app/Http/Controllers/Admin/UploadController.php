<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $num = $request['num'] ? $request['num'] : 1;
        $elementId = $request['elementId'];
        $path = $request['path'];
        $callback = $request['callback'];
        $info = [
            'num'       =>$num,
            'input'     =>$elementId,
            'path'      =>$path,
            'callback'  =>empty($callback) ? 'undefined' : $callback,
            'uploadUrl' =>url('admin/upload/uploadPicture',['path'=>$path]),
            'deleteUrl' =>url('admin/upload/delPicture')
        ];
        return view('admin.upload.picture')->with('info',$info);
    }

    public function uploadPicture($path)
    {
        return $path;
    }
}
