<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/11
 * Time: 23:41
 */

namespace Admin\Model;


use Think\Model;

class AdminRoleModel extends Model
{
public function adminRoleList($id){
    return $this->where(array('admin_id'=>$id))->select();
}
}