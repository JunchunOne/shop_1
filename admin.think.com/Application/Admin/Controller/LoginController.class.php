<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 2:40
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Session\Driver\Redis;

class LoginController extends Controller
{
    public function checkLogin()
    {
//        session_start();
//        $redis = new \Redis();
//        $redis->connect('127.0.0.1', 6379);
//        $key = $redis->keys('*');
//        du($redis->get($key[1]));
//        exit;
        if (IS_POST) {
            //>>先进行验证码的验证
            /*
             $captcha = I('post.captcha');
             $verify = new Verify();
             if(!$verify->check($captcha)){
                 $this->error('验证码错误');
             }*/
            //>>1.接收请求参数;
            $username = I('post.username');
            $password = I('post.password');
            //>>2.通过用户名查询数据库看是否存在此用户名
            $loginService = D('Login', 'Service');
            //调用方法执行数据库查询
            $result = $loginService->loginData($username, $password);
            if (is_array($result)) {
                //登录成功就保存用户名到session中
                //把session的设置成函数
                login($result);
                //等到url地址保存在session
                $resultUrl = $loginService->userPermisson($result['id']);
                //把保存到session中封装成一个函数
                savePermissionURL(array_column($resultUrl, 'url'));
                savePermissionID(array_column($resultUrl, 'id'));
                //当remember存在的时候就保存
                $remember = I('post.remember');
                if ($remember) {
                    //存在就保存数据到cookie
                    $loginService->saveService($result['id']);
                }

                $this->success('登陆成功!', U('Index/index'));
            } else {
                $this->error($result);
            }

        } else {
            $this->display('login');
        }
    }

    public function loginOut()
    {
        //退出时清除session
        logout();
        savePermissionIDEliminate();
        savePermissionURLEliminate();
        $this->success('退出成功!', U('checkLogin'));
    }
}