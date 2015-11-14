<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 13:11
 */

namespace Admin\Service;


use Org\Util\String;

class LoginService
{

    public function loginData($usrname, $password)
    {
        //实例化对象
        $adminModel = D('Admin');
        //查询数据判断用户名是否存在
        $row = $adminModel->getNameOne($usrname);
        //如果$isUsrname存在则用户名存在
        if ($row) {
            //再进行密码加盐机密与数据库的密码进行比较
            $password_salt = md5($password . $row['salt']);
            if ($password_salt == $row['password']) {
                return $row;
            } else {
                return '密码错误';
            }
        } else {
            return '用户名不存在';
        }
    }
    //通过用户的id查到用户所属角色的id再通过角色id找到角色所属的权限id 最后通过权限id等到url地址
    //再加上额外权限的id,得到url
    public function userPermisson($userId)
    {
        $sql = "select  distinct  id,url from shop_permission  where id in
(select  distinct rp.permission_id from  shop_admin_role as ar  join shop_role_permission as rp on ar.role_id = rp.role_id  where ar.admin_id = $userId)
or id in(select  ap.permission_id from shop_admin_permission as ap where ap.admin_id = $userId)";
        $urlModel = M();
        return $urlModel->query($sql);
    }

    public function saveService($id)
    {
        //生成字符串
        $auto_key = String::randString();

        $adminModel = M('Admin');
        $result = $adminModel->save(array('atuo_key' => $auto_key, 'id' => $id));
        if ($result) {
            //把$auto_key加密后和$id保存到cookie
            $salt = $adminModel->getFieldById($id, 'salt');
            $auto_key = md5($auto_key . $salt);
            //让cookie的值在浏览器中保存一个星期
            cookie('admin_id', $id, 60 * 60 * 24 * 7);
            cookie('auto_key', $auto_key, 60 * 60 * 24 * 7);
        }

    }

    public function autoLogin()
    {
        //得到cookie的值
        $admin_id = cookie('admin_id');
        $auto_key = cookie('auto_key');
        if (empty($admin_id) || empty($auto_key)) {
            return false;
        }
        //根据admin_id的值来判断的
        $adminModel = D('Admin');
        $row=$adminModel->getById($admin_id);
        if($row===false){
            return false;
        }
        $key=md5($row['atuo_key'].$row['salt']);

       if($auto_key==$key){
           //存在就保存就根据当前的id把url和权限的id保存到seesion
           login($row);
           //等到url地址保存在session
           $resultUrl = $this->userPermisson($admin_id);
           //把保存到session中封装成一个函数
           savePermissionURL(array_column($resultUrl, 'url'));
           savePermissionID(array_column($resultUrl, 'id'));
           return true;
       }else{
           return false;
       }

    }
}