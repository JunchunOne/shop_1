<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/13
 * Time: 12:32
 */

namespace Admin\Model;


use Think\Model;

class MenuPermissionModel extends Model
{
    public function MenuPermissionId($id)
    {
        //使用array_cloum取出没有PermissionId;
        $permissionId = $this->where(array('menu_id' => $id))->select();

        return array_column($permissionId, 'permission_id');
    }
}