<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 17:23
 */

namespace Admin\Model;


use Admin\Controller\BaseController;
use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '名字不能为空！'), // 在新增的时候验证name字段是否唯一
        array('intro', 'require', '请填写描述信息！'), // 当值不为空的时候判断是否在一个范围内
        array('name', '', '名称不能重复!', '', 'unique')//通过数据库验证name的唯一性
    );
    //开启批量设置
    // 是否批处理验证
    protected $patchValidate = true;

}