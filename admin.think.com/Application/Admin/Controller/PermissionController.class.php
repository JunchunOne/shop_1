<?php
namespace Admin\Controller;

use Think\Controller;

class PermissionController extends BaseController
{
    protected $goods = '权限';

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
        //......展示商品列表...
        $this->display('goods');
    }
    public function view_before(){

        //查询权限的展示树
        $page= $this->model->changPage('id,name,parent_id');
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row', json_encode($page));
    }

}