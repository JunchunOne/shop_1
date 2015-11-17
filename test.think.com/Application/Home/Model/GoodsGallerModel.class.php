<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/16
 * Time: 11:37
 */

namespace Home\Model;


use Think\Model;

class GoodsGallerModel extends Model
{
    public function goodsGaller($id)
    {
        $goodsGaller = $this->field('path,goods_id')->where(array('goods_id' => $id))->select();

        return $goodsGaller;
    }
}