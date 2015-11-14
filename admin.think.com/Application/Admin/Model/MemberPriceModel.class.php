<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/10
 * Time: 19:22
 */

namespace Admin\Model;


use Think\Model;

class MemberPriceModel extends Model
{
public function memberPriceAll($id){
  return  $this->where(array('goods_id'=>$id))->select();
}
}