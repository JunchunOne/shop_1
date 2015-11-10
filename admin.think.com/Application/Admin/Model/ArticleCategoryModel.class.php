<?php
namespace Admin\Model;


use Think\Model;

class ArticleCategoryModel extends BaseModel
{

    protected $_validate = array(
       array("name", 'require', '分类名称不能为空！'),
    array("is_help", 'require', '是否帮助不能为空！'),
    array("status", 'require', '状态不能为空！'),
    array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

}