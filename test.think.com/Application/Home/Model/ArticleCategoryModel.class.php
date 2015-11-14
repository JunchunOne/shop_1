<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/14
 * Time: 19:23
 */

namespace Home\Model;


use Think\Model;

class ArticleCategoryModel extends Model
{
    public function articleCategory(){
        //从redis中获取数据
        $articleCategory=S('articleCategory');
        if(empty($articleCategory)){
            //如果没有就从数据库查
            $articleCategory= $this->field('id,name')->where(array('is_help'=>1,'status'=>1))->select();
            //保存到redis中
            S('articleCategory',$articleCategory);
        }
        return $articleCategory;
    }
}