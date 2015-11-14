<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 2:19
 */

namespace Admin\Model;


use Think\Model;

class AdminPermissionModel extends Model
{
    public function adminPermissionID($id)
    {
        return $this->field('permission_id')->where(array('admin_id' => $id))->select();
    }
}