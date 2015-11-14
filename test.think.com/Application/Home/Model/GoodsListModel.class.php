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
    public function goodsList($goods_status,$num=5)
    {

            $wheres = array('status'=>1,'is_on_sale'=>1);

            $goodsList = $this->field('id,logo,name,shop_price')->where($wheres)->where("goods_status&{$goods_status}>0")->limit($num)->select();

        return $goodsList;
    }
}