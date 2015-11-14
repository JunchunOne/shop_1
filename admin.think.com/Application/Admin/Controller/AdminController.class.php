<?php
namespace Admin\Controller;

use Think\Controller;

class AdminController extends BaseController
{
    protected $goods = '管理员';
    public $allPost=true;

    public function view_before($id){
        //实例化对象
        $roleModel=D('Role');
        //查询数据
        $roleData=$roleModel->roleAdmin('id,name');
        //为页面分配数据
        $this->assign('role',$roleData);

        $permissionModel=D('Permission');
        //查询权限的数据
        $permission = $permissionModel->changPage('id,name,parent_id');
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row', json_encode($permission));
        //当编辑回显的时候执行下面的代码
        if(isset($id)){
            //实例化对象
            $adminRoleModel = D('AdminRole');
            //根据id查询数据
            $rolerID=$adminRoleModel->adminRoleList($id);
           //为页面分配数据由于是在js使用要转化为json
            $all=array_column($rolerID,'role_id');
            $this->assign('roler_id',json_encode($all));

            //查询权限的数据
            //查询角色对应的表中数据
            $adminPermissionModel=D('AdminPermission');
            //所以id查询出数据
            $permission_id=$adminPermissionModel->adminPermissionID($id);
            $all=array_column($permission_id,'permission_id');
            //为页面分配数据由于要在js中使用数据 所以要把数据转化为json
            $this->assign('permission_ids', json_encode($all));
        }

    }
}