<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    private $disk;
    private $driver;

    public function __construct()
    {
        $this->disk = config('filesystems.default');
        $this->driver = config('filesystems.disks.' . $this->disk . '.driver');
    }

    public function upload(Request $request)
    {
        $num = $request['num'] ? $request['num'] : 1;
        $elementId = $request['elementId'];
        $path = $request['path'];
        $callback = $request['callback'];
        $info = [
            'num' => $num,
            'input' => $elementId,
            'path' => $path,
            'callback' => empty($callback) ? 'undefined' : $callback,
            'uploadUrl' => url('admin/upload/uploadPicture', ['path' => $path]),
            'deleteUrl' => url('admin/upload/delPicture')
        ];
        return view('admin.upload.picture')->with('info', $info);
    }

    public function uploadPicture(Request $request, $path)
    {
        $file = $request->file('file');
        if ($request->hasFile('file') && $file->isValid()) {
            //获取文件相关信息
            //$originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            //$type = $file->getClientMimeType();     // image/jpeg
            //上传文件
            $filename = $path . '/' . date('YmdHis') . uniqid() . '.' . $ext;
            $bool = Storage::disk($this->disk)->put($filename, file_get_contents($realPath));
            if ($bool === true) {
                if ($this->driver == 'qiniu') {
                    $url = Storage::disk('qiniu')->getUrl($filename);
                } else {
                    $url = '/storage/' . $filename;
                }
                $data = ['code' => 200, 'url' => $url];
            } else {
                $data = ['code' => 201, 'msg' => $bool];
            }
        } else {
            $data = ['code' => 201, 'msg' => '文件不存在或不符合要求'];
        }
        return responseJson($data);
    }

    public function delPicture(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            if ($this->driver == 'local') {
                $filename = preg_replace('/^\\/storage\\//', '', $request['filename'], 1);
                $exists = Storage::disk('public')->exists($filename);
                if (!$exists) {
                    $data = ['code' => 201, 'desc' => '要删除的图片文件不存在' . $filename];
                } else {
                    Storage::delete($filename);
                    $data = ['code' => 200, 'desc' => '删除成功'];
                }
            } else {
                $data = ['code' => 200, 'desc' => '无需删除'];
            }
            return responseJson($data);
        }
    }
}
