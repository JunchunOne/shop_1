<?php
namespace Admin\Controller;

use Think\Controller;

class GoodscategoryController extends BaseController
{
    protected $goods = '商品分类';
    public function goods()
    {
        $page = $this->model->changPage();
        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('lists', $page);


        //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据
        $this->assign('goods', '添加'.$this->goods);
        $this->assign('edit', $this->goods.'列表');
        $this->assign('url', U('add'));
        cookie('EDIT_URL', $_SERVER['REQUEST_URI']);
        //......展示商品列表...
        $this->display('goods');
    }
    public function view_before(){
        $page = $this->model->changPage();

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row',json_encode($page));


    }
}