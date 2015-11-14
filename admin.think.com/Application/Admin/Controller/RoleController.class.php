<?php
namespace Admin\Controller;

use Think\Controller;

class RoleController extends BaseController
{
    protected $goods = '角色';
    public $allPost=true;


    public function view_before($id)
    {
        $permissionModel=D('Permission');
        //查询权限的数据
        $permission = $permissionModel->changPage('id,name,parent_id');
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row', json_encode($permission));
        //编辑回显当id存在的时候
      if(!empty($id)){
          //查询角色对应的表中数据
          $rolePermissionModel=D('RolePermission');
          //所以id查询出数据
          $permission_id=$rolePermissionModel->rolePermissionID($id);
//          $all=array_column($permission_id,'permission_id');
          //为页面分配数据由于要在js中使用数据 所以要把数据转化为json
          $this->assign('permission_ids', json_encode($permission_id));
      }
    }

}