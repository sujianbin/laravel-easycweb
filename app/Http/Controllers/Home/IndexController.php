<?php

namespace App\Http\Controllers\Home;

use App\selector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $config = Cache::get('config');
        var_dump($config);
        echo "<br />";
        echo $config['seo_title'];
        echo "<br />";
        echo Cache::get('config')['seo_title'];
        echo cache('config')['seo_title'];
        exit;
        echo config('filesystems.disks.'.config('filesystems.default').'.driver');
        die;
        $filename = preg_replace('/^\\/storage\\//','','/storage/goods/2222.png',1);
        echo $filename;
        die;
        echo asset('storage/201903210306255c92ffb1c94f2.jpg');
        echo storage_path('app/public');
        die;
        $data = true;
        $data = ['code'=>200,'msg'=>'true'];
        dd(responseJson($data));
        $url = 'http://m.baixtao.cn';
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
        $content = curl_exec($ch);
        echo selector::select($content, '@<title>(.*?)</title>@', "regex");
        exit;
        $descriptorspec = array(
            0 => array("pipe", "r"),  // 标准输入，子进程从此管道中读取数据
            1 => array("pipe", "w"),  // 标准输出，子进程向此管道中写入数据
            2 => array("file", "/www/wwwroot/novel-laravel/popen.txt", "a") // 标准错误，写入到一个文件
        );
        $cwd = base_path();
        //cache:clear config:clear
        $process = proc_open('php artisan view:clear', $descriptorspec, $pipes,$cwd);
        if (is_resource($process)) {
            // $pipes 现在看起来是这样的：
            // 0 => 可以向子进程标准输入写入的句柄
            // 1 => 可以从子进程标准输出读取的句柄
            // 错误输出将被追加到文件 /tmp/error-output.txt

            echo "输出第一句：<br />";
            fwrite($pipes[0], '<?php phpversion() ?>');
            fclose($pipes[0]);

            echo "输出第二句：<br />";
            echo stream_get_contents($pipes[1])."<br />";
            fclose($pipes[1]);


            // 切记：在调用 proc_close 之前关闭所有的管道以避免死锁。
            $return_value = proc_close($process);
            echo "输出第三句：<br />";
            echo "command returned $return_value\n";
        }

        exit;
        $str = "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";
        $key = "AbJtAJPHqqSfiQJV";
        $data = openssl_decrypt($str,'aes-128-ecb',$key);
        $content = base64_decode($data);
        //echo "解密前字符串：".$str.PHP_EOL;
        //echo "解密后字符串：".$content.PHP_EOL;

//        $content = preg_replace(['/&#13;/','/<\/p><p>/'], ['',PHP_EOL.PHP_EOL], $content);
//        //echo $content;
//        $content = strip_tags(preg_replace('/<h2(.*)>.*<\/h2>/','',$content));

        //$content = selector::select($content, "//div[@class='m-content']");
        //$content = preg_replace(['/&#13;/','/<\/p><p>/'], ['',PHP_EOL.PHP_EOL], $content);
        //$content = strip_tags(preg_replace('/<h1>.*<\/h1>/','',$content));
        echo $content;
    }
}
