<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/10
 * Time: 2:04
 */

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model
{
public function articleAll($id){
    $sql = "SELECT  a.id,a.name  FROM shop_goods_article as ga  join shop_article as a on ga.article_id = a.id  where  ga.goods_id = $id;";
    return $this->query($sql);
}
}