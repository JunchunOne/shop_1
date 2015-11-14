<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/9
 * Time: 14:37
 */

namespace Admin\Model;


use Think\Model;

class GoodsIntroModel extends Model
{
    public function introRow($id)
    {
        return $this->getFieldByGoods_id($id,'intro');
    }
}