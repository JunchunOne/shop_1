<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class PermissionModel extends BaseModel
{

    protected $_validate = array(
       array("name", 'require', '权限名称不能为空！'),
//    array("url", 'require', '权限的URL不能为空！'),
    array("parent_id", 'require', '父权限不能为空！'),
    array("lft", 'require', '左边界不能为空！'),
    array("rght", 'require', '右边界不能为空！'),
    array("level", 'require', '级别不能为空！'),
    array("status", 'require', '状态不能为空！'),
    array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

    public function changPage($field='')
    {
        //....返回一个数组........
        return $this->field($field)->where('status>=0')->order('lft')->select();
    }

    public function add()
    {
        //覆盖add方法 完成业务逻辑
        $dbMysqlInterfaceImpModel = new DbMysqlInterfaceImpModel();

        $nestedSetsService = new NestedSetsService($dbMysqlInterfaceImpModel,'shop_permission','lft','rght','parent_id','id','level');

        return  $nestedSetsService->insert($this->data['parent_id'], $this->data,'bottom');

    }
    //由于model里的save方法不能满足数据要求,所以要覆盖他
    public function save(){
        //实例化对象
        $dbMysqlInterfaceImpModel = new DbMysqlInterfaceImpModel();
        //实例化对象并传入继承接口的对象
        $nestedSetsService = new NestedSetsService($dbMysqlInterfaceImpModel,'shop_permission','lft','rght','parent_id','id','level');

        //使用移动数据的方法
        $reslut=$nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($reslut===false){
            $this->error='不能够将父分类作为自己的子分类';
            return false;
        }

        //修改请求中的数据
        return parent::save();

    }
}