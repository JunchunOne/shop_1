<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 20:50
 */
/**1.错误信息的html拼接
 * @param $model
 * @return string
 */
function showError($model)
{
    $msg = $model->getError();
    //拼凑html语句
    $html = '<ul>';
    if (is_array($msg)) {
        foreach ($msg as $val) {
            $html .= "<li>$val</li>";
        }
    } else {
        $html .= "<li>$msg</li>";
    }
    $html .= '</ul>';
    return $html;
}

function du($num)
{
    return dump($num);
}

//把二维数组中的id分解一个维数组
//首先要判断是否有没有这个函数
if (!function_exists(array_column)) {
    function array_column($rows, $key)
    {
        //保存所有的id
        $ids = array();
        foreach ($rows as $row) {
            $ids[] = $row[$key];
        }
        return $ids;

    }
}

function arrSelect($name, $rows, $defaultValue, $fieldValue = 'id', $fieldName = 'name')
{
    $html = "<select name='{$name}' class='{$name}'>
            <option value=''>--请选择--</option>";
    foreach ($rows as $val) {
        $selected = '';

        if ($val[$fieldValue] == $defaultValue) {

            $selected = "selected='selected'";
        }
        $html .= "<option value='{$val[$fieldValue]}'{$selected}>{$val[$fieldName]}</option>";
    }
    $html .= "</select>";

    echo $html;
}

/**
 * 如果传递的有用户信息, 将用户信息保存到session,
 * 如果没有用户信息,  是从session获取用户信息
 * @param $userinfo
 */
function login($userinfo = null)
{

    if ($userinfo) {
        session('USERINFO', $userinfo);
    } else {
        return session('USERINFO');
    }
}

/**
 * @return bool
 */
function superUser()
{
    //得到登录的用户的信息
    $user = login();
    $userName = $user['username'];
    if ($userName == C('SUPER_USER')) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判定用户是否登陆
 * @return bool
 */
function isLogin()
{
    return login() !== null;
}

/**
 * 将session中的用户信息请求
 */
function logout()
{
    session('USERINFO', null);
}


/**把权限的url地址保存到seesion
 * @param null $urls
 * @return mixed
 */
function savePermissionURL($urls = null)
{
    if ($urls) {
        session('PERMISSIONURL', $urls);
    } else {
        return session('PERMISSIONURL');
    }
}

/**
 * 把session清除
 */
function savePermissionURLEliminate(){
    session('PERMISSIONURL', null);
}
/**把权限的id地址保存到seesion
 * @param null $ids
 * @return mixed
 */
function savePermissionID($ids = null)
{
    if ($ids) {
        session('PERMISSIONID', $ids);
    } else {
        return session('PERMISSIONID');
    }
}
/**
 * 把session清除
 */
function savePermissionIDEliminate(){
    session('PERMISSIONID', null);
}