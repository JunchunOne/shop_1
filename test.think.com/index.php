<?php
header('Content-type:text/html;charset=utf8');
//........首先要验证版本号是否可用...........
version_compare(PHP_VERSION,'5.3.0','>=') or die('版本太低');
//echo PHP_VERSION;
/**
 * 加载thinkphp文件
 * 1.使用绝对路径加载文件
 */
//..................dirname表示上级路径........................
//...........得到当前所在的根目录..............
define('ROOT_PATH',dirname($_SERVER['SCRIPT_FILENAME']).'/');

//...........定义Applicatio文件的常量..........
define('APP_PATH',ROOT_PATH.'Application'.'/');

//..........定义是否为调试模式......
define('APP_DEBUG',true);

//.....定义绑定模式//加载后就把这个取消.........
//define('BIND_MODULE','Home');

//>>1.通过dername找到thinkphp的文件所在的路径
define('THINK_PHP',dirname(ROOT_PATH).'/');

//........加载thinkphp文件............
require THINK_PHP.'ThinkPHP/ThinkPHP.php';