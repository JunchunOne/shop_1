<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class MenuModel extends BaseModel
{

    protected $_validate = array(
        array("name", 'require', '菜单名称不能为空！'),
        array("status", 'require', '状态不能为空！'),
        array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

    public function changPage($field = '')
    {
        //....返回一个数组........
        return $this->field($field)->where('status>=0')->order('lft')->select();
    }

    public function add($allPOST)
    {
        //覆盖add方法 完成业务逻辑
        $dbMysqlInterfaceImpModel = new DbMysqlInterfaceImpModel();

        $nestedSetsService = new NestedSetsService($dbMysqlInterfaceImpModel, 'shop_menu', 'lft', 'rght', 'parent_id', 'id', 'level');

        $id = $nestedSetsService->insert($this->data['parent_id'], $this->data, 'bottom');
        //菜单和权限的
        $result = $this->menuPermissionFunction($id, $allPOST['permission_id']);
        if ($result === false) {
            return false;
        }
        return $id;
    }

    //封装添加菜单和权限的方法
    public function menuPermissionFunction($id, $permissionId)
    {
        //实例化
        $menuPermissionModel = D('MenuPermission');
        //添加之前要把这个id对应的数据先删除,因为更新的时候也是使用的这个方法
        $menuPermissionModel->where(array('menu_id' => $id))->delete();
        //定义一个空数组来接收添加的数据
        $menuPermission = array();
        //得到的$permissionId是个数组
        foreach ($permissionId as $Vla) {
            $menuPermission[] = array('menu_id' => $id, 'permission_id' => $Vla);
        }
        if (!empty($menuPermission)) {

        //把数据添加到数据库中
        $result = $menuPermissionModel->addAll($menuPermission);
        if ($result === false) {
            $this->error = '添加权限失败';
            return false;
        }
    }
}

//由于model里的save方法不能满足数据要求,所以要覆盖他
public
function save($allPOST)
{
    //实例化对象
    $dbMysqlInterfaceImpModel = new DbMysqlInterfaceImpModel();
    //实例化对象并传入继承接口的对象
    $nestedSetsService = new NestedSetsService($dbMysqlInterfaceImpModel, 'shop_menu', 'lft', 'rght', 'parent_id', 'id', 'level');

    //使用移动数据的方法
    $reslut = $nestedSetsService->moveUnder($this->data['id'], $this->data['parent_id']);
    if ($reslut === false) {
        $this->error = '不能够将父分类作为自己的子分类';
        return false;
    }
    //菜单和权限的
    $result = $this->menuPermissionFunction($this->data['id'], $allPOST['permission_id']);
    if ($result === false) {
        return false;
    }

    //修改请求中的数据
    return parent::save();

}

}