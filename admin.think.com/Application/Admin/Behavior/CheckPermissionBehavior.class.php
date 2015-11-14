<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 21:41
 */

namespace Admin\Behavior;


use Think\Behavior;

class CheckPermissionBehavior extends Behavior
{
    public function run(&$params)
    {
        //Behavior的行为是在加载控制器之前,也包含了登录页面的控制器和验证码,所以要先排除掉;
        //>>1.定义不验证的控制器和方法
        $notInclude = array('Login/checkLogin', 'Verify/index');
        //定义当前访问的控制器和方法
        $ongoing = CONTROLLER_NAME . '/' . ACTION_NAME;
        if (in_array($ongoing, $notInclude)) {
            return false;
        }

        //判断用户是否登录
        if (!isLogin()) {
            $LoginService = D('Login', 'Service');

            //判断用户是否自动登录
            if (!$LoginService->autoLogin()) {
                redirect(U('Login/checkLogin'), 1, '请登录');
            }
        }
        if (superUser()) {
            return false;
        }
        //得到当前用户的权限
        $userUrl = savePermissionURL();
        if (!in_array($ongoing, $userUrl)) {
            echo "权限不足";
            exit;
        }
    }
}