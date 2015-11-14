<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsListController extends BaseController
{
    protected $goods = '商品';
    public $allPost=true;

    //覆盖父类方法

    public function view_before($id)
    {

        //商品树查询
        $goods = D('GoodsCategory')->changPage();

        //品牌查询
        $brand = D('Brand')->goodsList();

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('brand', $brand);

        //供应商查询
        $supplier = D('goods')->goodsList();

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('supplier', $supplier);

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('row', json_encode($goods));

        //查询会员价格
        $memberLevelModel=D('MemberLevel');

        $All=$memberLevelModel->goodsList($where=array(),$field='id,name');

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('memberLevel', $All);

        if (!empty($id)) {

            //查询商品描述数据库的数据回显编辑
            $introModel = D('GoodsIntro');
            //根据id查询商品描述信息
            $row = $introModel->introRow($id);
            //为页面上的商品描述信息分配数据
            $this->assign('intro', $row);

            //查询上传相册的数据(回显)
            $gallerModel = D('GoodsGaller');
            //根据id查询相册的信息
            $All = $gallerModel->gallerAll($id);
            //为页面上的相册信息分配数据
            $this->assign('galler', $All);

            //查询文章数据(回显)
            $articleModel = D('GoodsArticle');
            //根据id查询相册的信息
            $All = $articleModel->articleAll($id);
            //为页面上的相册信息分配数据
            $this->assign('article', $All);

            //查询回显的会员信息
            $memberPriceModel=D('MemberPrice');
            //根据id查询相册的信息
            $All = $memberPriceModel->memberPriceAll($id);

            $row=array_column($All,'price');

            //为页面上的相册信息分配数据
            $this->assign('memberPrice', $row);


        }

    }

    public function deleteGaller()
    {
        $id = I('post.id');
        //得到相册的数据
        $gallerModel = D('GoodsGaller');
        //删除数据
        $result = $gallerModel->delete($id);
        $resultData = array('success' => true);
        if ($result === false) {
            $resultData['success'] = false;
            //把数据转化为json字符串
          echo  json_encode($resultData);
        } else {
            echo  json_encode($resultData);
        }

    }

}