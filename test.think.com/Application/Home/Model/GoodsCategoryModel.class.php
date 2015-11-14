<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/14
 * Time: 15:36
 */

namespace Home\Model;


use Think\Model;

class GoodsCategoryModel extends Model
{
    public function getList()
    {
        //从redis中得到数据
        $goodsList = S('GoodsCategory');
        if (empty($goodsList)) {
            //如果redis中不存在就从数据库中查找
            $goodsList = $this->field('id,name,parent_id,level')->where(array('status' => 1))->order('lft')->select();
            //保存到redis中
            S('GoodsCategory', $goodsList);
        }

        return $goodsList;
    }
}