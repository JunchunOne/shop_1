<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/9
 * Time: 18:11
 */

namespace Admin\Model;


use Think\Model;

class GoodsGallerModel extends Model
{
public function gallerAll($id){

    return  $this->field('id,path')->where(array('goods_id'=>$id))->select();
}
}