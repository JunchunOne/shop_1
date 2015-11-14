<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/11
 * Time: 21:16
 */

namespace Admin\Model;


use Think\Model;

class RolePermissionModel extends Model
{
    public function rolePermissionID($id)
    {
        return $this->field('permission_id')->where(array('role_id' => $id))->select();
    }
}