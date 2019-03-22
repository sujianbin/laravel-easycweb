<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function centos()
    {
        echo '基本统计信息';
    }

    public function clearCache()
    {
        $descriptorspec = array(
            0 => array("pipe", "r"),  // 标准输入，子进程从此管道中读取数据
            1 => array("pipe", "w"),  // 标准输出，子进程向此管道中写入数据
            2 => array("file", base_path() . "/cli.log", "a") // 标准错误，写入到一个文件
        );
        $cwd = base_path();
        //cache:clear config:clear
        $process = proc_open('php artisan view:clear', $descriptorspec, $pipes, $cwd);
        if (is_resource($process)) {
            fwrite($pipes[0], 'start');
            fclose($pipes[0]);
            $content = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            // 切记：在调用 proc_close 之前关闭所有的管道以避免死锁。
            proc_close($process);
            return $content;
        }
    }

    public function test()
    {
        echo 222;
        $input = [
            'username' => 'admin',
            'password' => '1234561'
        ];
        $data = Auth::guard('admin')->attempt(['username' => $input['username'], 'password' => $input['password']]);
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
