<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function _initialize()
    {

        // ...........查询数据库的商品分类..............
        $goodsCategoryModel = D('GoodsCategory');
        //调用方法得到数据
        $goodsCategory = $goodsCategoryModel->getList();
        //分配数据到页面
        $this->assign('goodslist', $goodsCategory);


        //....................查询文章分类.........................

        //实例化对象
        $articleCategoryModel = D('ArticleCategory');
        //调用方法得到数据
        $articleCategory = $articleCategoryModel->articleCategory();
        //分配数据到页面
        $this->assign('articleCategory', $articleCategory);

        //........................查询文章...............................
        $article=$this->articleFunction(1);

        $this->assign('article_1', $article);
    }

       //..........查询文章的...........
    public function articleFunction($is_help){

        //实例化对象
        $articleModel = D('Article');
        //调用方法得到数据
        $article = $articleModel->article($is_help);
        //分配数据到页面
       return $article;
    }
    public function index()
    {
        //........................查询商品...............................
        //实例化对象
        $goodsListModel = D('GoodsList');
        //调用方法得到数据
        $goodsList_1s = $goodsListModel->goodsList(1);
        //调用方法得到数据
        $goodsList_2s = $goodsListModel->goodsList(2);
        //调用方法得到数据
        $goodsList_4s = $goodsListModel->goodsList(4);
        //调用方法得到数据
        $goodsList_8s = $goodsListModel->goodsList(8);
        //调用方法得到数据
        $goodsList_16s = $goodsListModel->goodsList(16);

        //..................查询网站快讯.......................
        $article=$this->articleFunction(0);

        //分配数据到页面
        $this->assign(array(
            'isHiddenMenu' => false,
            'meta_title' => '京西商城首页',
            'goodsList_1s' => $goodsList_1s,
            'goodsList_2s' => $goodsList_2s,
            'goodsList_4s' => $goodsList_4s,
            'goodsList_8s' => $goodsList_8s,
            'goodsList_16s' => $goodsList_16s,
            'article_0' => $article,

        ));
        $this->display('index');
    }

    public function lst()
    {
        $this->assign('isHiddenMenu', true);
        $this->assign('meta_title', '商品列表');
        $this->display('lst');
    }

    public function show()
    {
        //根据商品id查询数据库,得到id对应的相册图片
        $id=I('get.id');
        //........................查询商品...............................
        //实例化对象
        $goodsListModel = D('GoodsList');
        $goodsRow=$goodsListModel->goodsId($id);

        $this->assign($goodsRow);
        $this->assign('isHiddenMenu', true);
        $this->assign('meta_title', '京西商城---'.$goodsRow["name"]);
        $this->display('show');
    }
}