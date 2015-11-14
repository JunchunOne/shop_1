<?php
namespace Admin\Model;


use Think\Model;

class RoleModel extends BaseModel
{

    protected $_validate = array(
        array("name", 'require', '角色名称不能为空！'),
        array("status", 'require', '状态不能为空！'),
        array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;

    public function permissionList($field = '*')
    {
        //....返回一个数组........
        return $this->field($field)->where('status>=0')->order('lft')->select();
    }

    public function roleAdmin($field = '*')
    {
        //....返回一个数组........
        return $this->field($field)->select();
    }


//添加数据
    public function add($allPost)
    {

        //先判断数据库中有没有这个名称
        $nameRow = $this->where(array('name' => $this->data['name']))->select();
        if (!empty($nameRow)) {
            $this->error = '名称已经存在';
            return false;
        }
        //再调用父类的add方法添加
        $id = parent::add();
        if ($id === false) {
            $this->error = '添加失败';
            return false;
        }
        $result = $this->rolePermissionFunction($id, $allPost['permission_id']);
        if ($result === false) {
            return false;
        }
        return $id;
    }

    /**
     * @param $id
     * @param $permission_id
     * @return bool
     */
//封装上传和更新
    public
    function rolePermissionFunction($id, $permission_id)
    {
        //实例化对象
        $rolePermissionModel = D('RolePermission');
        //因为得到是一个数组就是使用addAll方法一次添加
        $permissionID = array();
        //因为更新数据时也要使用这个方法 所以更新时要先把id对应的数据删除
        $rolePermissionModel->where(array('role_id' => $id))->delete();
        foreach ($permission_id as $Val) {
            $permissionID[] = array('role_id' => $id, 'permission_id' => $Val);
        }
        $result = $rolePermissionModel->addAll($permissionID);
        if ($result === false) {
            $this->error = '添加失败';
            return false;
        }
    }

    public function save($allPost)
    {
        $resultRole = $this->rolePermissionFunction($this->data['id'], $allPost['permission_id']);
        if ($resultRole === false) {
            return false;
        }
        //调用父类的方法添加
        $result = parent::save();
        if ($result === false) {
            $this->error = '添加失败';
            return false;
        }
        return $result;
    }

}