<?php
namespace Admin\Controller;

use Think\Controller;

class MenuController extends BaseController
{
    protected $goods = '菜单';
    public $allPost = true;
    public function goods(){
        $page= $this->model->changPage();
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('lists', $page);
        //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据
        $this->assign('goods', '添加' . $this->goods);
        $this->assign('edit', $this->goods . '列表');
        $this->assign('url', U('add'));
        //返回时都显示到当前的页面 所以把url地址保存的cookie上
        cookie('EDIT_URL', $_SERVER['REQUEST_URI']);
        //......展示商品列表...
        $this->display('goods');
    }
    public function view_before($id){
        //查询菜单的展示树
        $page= $this->model->changPage('id,name,parent_id');
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row', json_encode($page));

        //查询权限树
        $permission=D('Permission');
        $page= $permission->changPage('id,name,parent_id');
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('permission', json_encode($page));

        if(!empty($id)){
            //实例化
            $menuPermissionModel=D('MenuPermission');
            //根据id查询权限
            $permissionId=$menuPermissionModel->MenuPermissionId($id);
            //为页面分配数据(如果是关联数组可以直接写)
            $this->assign('permission_ids', json_encode($permissionId));
        }
    }

}