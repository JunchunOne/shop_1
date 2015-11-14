<?php
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends BaseController
{
    protected $goods = '文章分类';


    public function view_before()
    {
        //实例化对象
        $atricleCategoryModel = D('ArticleCategory');
        //得到所有数据
        $atrice = $atricleCategoryModel->goodsList();
        //为页面分配数据
        $this->assign('atrice',$atrice);

    }
    public function search(){
        $searchName=I('get.keyword');
        $articleModel = D('Article');
        if($searchName){
            $search['name']=array('like','%'.$searchName.'%');
        }
        $rseult=$articleModel->goodsList($search);

        $this->ajaxReturn($rseult);
    }
}