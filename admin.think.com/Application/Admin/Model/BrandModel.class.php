<?php
namespace Admin\Model;


use Think\Model;

class BrandModel extends BaseModel
{

    protected $_validate = array(
       array("name", 'require', '品牌名称不能为空！'),
    array("urll", 'require', '品牌网址不能为空！'),
    array("logo", 'require', '品牌LOGO不能为空！'),
    array("status", 'require', '状态不能为空！'),
    array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

}