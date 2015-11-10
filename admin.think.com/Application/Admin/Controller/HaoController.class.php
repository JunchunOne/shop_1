<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/2
 * Time: 17:05
 */

namespace Admin\Controller;


use Think\Controller;

class HaoController extends Controller
{
    public function index()
    {
        ////////////////////////验证//////////////////////////////
//        $name = "品牌@feil";
////        $name = "品牌@rodi|a好";
//        preg_match("/@([a-z]*)\|/", $name."|", $retul);
//        dump($retul);
//       $url='1=是&0=否';``
////        $urlInfo = parse_url($url);
////        dump($urlInfo);
//        parse_str($url, $query);
//        dump($query);
////        $args = array_merge($query, $params);
////截取字符串
////        dump(chop('品牌LOGO@file','@file'));
////        echo strstr("Hello world!","world");
////        echo strpos("Hello world!","wo");
        $this->display('index');

    }


}