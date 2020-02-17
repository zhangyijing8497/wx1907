<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function curlPost1()
    {
        // echo __METHOD__;
        $userInfo = [
            "username" => "张三",
            "password" => "123456"
        ];
        $url = "http://api.1906.com/test/post1";

        // 初始化
        $ch = curl_init($url);

        $str = "username=zhangsan&password=123456abc";   //urlencoded格式

        // 设置参数
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$userInfo); //form-data
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);  //x-www-form-urlencoded

        // 开启会话
        $response = curl_exec($ch);
        var_dump($response);

        // 捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        if($errno > 0){
            echo "错误码:" .$errno;echo "<br>";
            echo "错误信息:" .$error;die; 
        }

        //关闭会话
        curl_close($ch);
    }

    /**
     * 向接口 post  json 字符串
     */
    public function curlPost3()
    {
        $userInfo = [
            "username" => "李四",
            "password" => "12345600"
        ];

        $json = json_encode($userInfo);
        $url = "http://api.1906.com/test/post3";

        // 初始化
        $ch = curl_init($url);

        $str = "username=zhangsan&password=123456abc";   //urlencoded格式

        // 设置参数
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$userInfo); //form-data
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$str);  //x-www-form-urlencoded
        curl_setopt($ch,CURLOPT_POSTFIELDS,$json);  //raw


        // 开启会话
        $response = curl_exec($ch);
        var_dump($response);

        // 捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        if($errno > 0){
            echo "错误码:" .$errno;echo "<br>";
            echo "错误信息:" .$error;die; 
        }

        //关闭会话
        curl_close($ch);
    }

    public function curlPost2()
    {
        echo __METHOD__;
    }

    /**
     * 访问接口  上传文件
     */
    public function curlUpload()
    {
        $img = [
            "username" => "smile",
            "email"=>"smile@qq.com",
            "img" =>new \CURLFile(storage_path('imgs/1.jpeg'))
            // "img" =>new \CURLFile('zhan.jpg')
        ];

        $url = "http://api.1906.com/test/upload";

        // 初始化
        $ch = curl_init($url);

        $str = "username=zhangsan&password=123456abc";   //urlencoded格式

        // 设置参数
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$userInfo); //form-data
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$str);  //x-www-form-urlencoded
        curl_setopt($ch,CURLOPT_POSTFIELDS,$img);  //raw


        // 开启会话
        $response = curl_exec($ch);
        var_dump($response);

        // 捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        if($errno > 0){
            echo "错误码:" .$errno;echo "<br>";
            echo "错误信息:" .$error;die; 
        }

        //关闭会话
        curl_close($ch);
    }

    public function guzzleGet()
    {
        $client = new Client();
        $url = "http://api.1906.com/test/get1";
        $response = $client->request('GET',$url,[
            'query' => [
                'username' => "lucky",
                'password' => 'abc123'
            ]
        ]);
        // 接收服务器响应
        echo $response->getBody();
    }

    public function guzzlePost()
    {
        $client = new Client();
        $url = "http://api.1906.com/test/post1";
        $response = $client->request('POST',$url,[
            'form_params' => [
                'username' => "post",
                'password' => 'post'
            ]
        ]);
        // 接收服务器响应
        echo $response->getBody();
    }

    // x-www-from-urlencoded
    public function guzzlePost2()
    {
        $client = new Client();
        $url = "http://api.1906.com/test/post1";

        $response = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name' => 'username',
                    'contents' => 'zhangsan'
                ],
                [
                    'name' => 'logo',
                    'contents' => fopen('zhan.jpg', 'r')
                ]
            ]
        ]);
        echo $response->getBody();
    }
}
