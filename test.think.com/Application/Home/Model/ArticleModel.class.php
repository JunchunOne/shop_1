<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/14
 * Time: 19:48
 */

namespace Home\Model;


use Think\Model;

class ArticleModel extends Model
{
    public function article()
    {
        //从redis中得到数据
        $articleList = S('article');
        if (empty($articleList)) {
            //如果redis中不存在就从数据库中查找
//            $articleList = $this->field('id,name,article_category_id')->where(array('status' => 1))->select();
            $articleList=$this->field('a.id,a.name,a.article_category_id')->alias('a')->join('__ARTICLE_CATEGORY__ as ac ON a.article_category_id=ac.id')->where(array('ac.is_help'=>1,'a.status'=>1))->select();
            //保存到redis中
            S('article', $articleList);
        }

        return $articleList;
    }

}