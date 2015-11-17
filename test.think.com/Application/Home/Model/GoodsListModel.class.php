<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/14
 * Time: 21:19
 */

namespace Home\Model;


use Think\Model;

class GoodsListModel extends Model
{
    public function goodsList($goods_status, $num = 5)
    {

        $wheres = array('status' => 1, 'is_on_sale' => 1);

        $goodsList = $this->field('id,logo,name,shop_price')->where($wheres)->where("goods_status&{$goods_status}>0")->limit($num)->select();

        return $goodsList;
    }

    public function goodsId($id)
    {
        //根据id查询值
        $goodsRow = $this->where(array('id' => $id, 'status' => 1))->find();

        //根据id查到商品分类的的id,在根据分类id的左右边界找到它所以的上级分类
        $GoodsCategoryModel=D('GoodsCategory');
        //调用方法
        $goodsRow['goodsCategory']=$GoodsCategoryModel->goodsCategory($goodsRow['goods_category_id']);


        //...................查询相册的图片...................
        $goodsGallerModel=D('GoodsGaller');
        //调用方法
        $goodsGallerList=$goodsGallerModel->goodsGaller($id);

        $path=array_column($goodsGallerList,'path');

        array_unshift($path,$goodsRow['logo']);
        $goodsRow['path']=$path;
        //返回查询出数据
        return $goodsRow;
    }
}