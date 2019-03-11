<?php

namespace App\Http\Controllers\Home;

use App\selector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $str = "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";
        $key = "uzofHYrnBbpJhZDt";
        $data = openssl_decrypt($str,'aes-128-ecb',$key);
        $content = base64_decode($data);
        //echo "解密前字符串：".$str.PHP_EOL;
        //echo "解密后字符串：".$content.PHP_EOL;

        $content = preg_replace(['/&#13;/','/<\/p><p>/'], ['',PHP_EOL.PHP_EOL], $content);
        echo $content;
        $content = strip_tags(preg_replace('/<h2(.*)>.*<\/h2>/','',$content));
        echo $content;
    }
}
