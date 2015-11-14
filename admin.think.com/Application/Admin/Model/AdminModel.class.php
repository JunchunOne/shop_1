<?php
namespace Admin\Model;


use Think\Model;

class AdminModel extends BaseModel
{

    protected $_validate = array(
        array("username", 'require', '用户名不能为空！'),
        array("username", '', '用户名已经存在', '', 'unique'),
        array("password", 'require', '密码不能为空！'),
        array("email", 'require', 'Email不能为空！'),
        array("email", '', 'Email已经存在','','unique'),
        array("add_time", 'require', '加入时间不能为空！'),
        array("last_login_time", 'require', '最后登录时间不能为空！'),
        array("salt", 'require', '盐不能为空！'),
        array("status", 'require', '状态不能为空！'),
        array("sort", 'require', '排序不能为空！'),
    );

    protected $patchValidate = true;
    public function getNameOne($usrname){
        return $this->getByUsername($usrname);
    }

    protected $_auto = array(
        array("add_time",NOW_TIME),
        array('salt','\Org\Util\String::randString','','function'),
    );

    //添加商品
    public function add($uesrData){
        //把密码进行加盐机密

        $this->data['password']=md5($this->data['password'].$this->data['salt']);
        //调用父类的方法添加的数据返回当前的id
        $id=parent::add();
        if($id===false){
            $this->error='添加失败';
            return false;
        }
        //添加用户角色
        $result=$this->adminRoleFunction($id,$uesrData['role_ids']);
        if($result===false){
            $this->error='添加失败';
            return false;
        }
        //添加额外权限
        $resultAdminPermission=$this->adminPermissionFunction($id,$uesrData['permission_id']);
        if($resultAdminPermission===false){
            $this->error='添加失败';
            return false;
        }
    }
    //更新数据
    public function save($uesrData){
       //调用父类的save
        $result=parent::save();
        if($result===false){
            $this->error='更新失败';
            return false;
        }

        //添加额外权限
        $resultAdminPermission=$this->adminPermissionFunction($uesrData['id'],$uesrData['permission_id']);
        if($resultAdminPermission===false){
            $this->error='添加失败';
            return false;
        }
        //添加
        $result=$this->adminRoleFunction($uesrData['id'],$uesrData['role_ids']);
        if($result===false){
            $this->error='添加失败';
            return false;
        }
       return $result;
    }
    public function adminPermissionFunction($id,$admin_permission){
        //实例化对象
        $adminPermissionModel = D('AdminPermission');
        //因为得到是一个数组就是使用addAll方法一次添加
        $adminPermissionID = array();
        //因为更新数据时也要使用这个方法 所以更新时要先把id对应的数据删除
        $adminPermissionModel->where(array('admin_id' => $id))->delete();
        foreach ($admin_permission as $Val) {
            $adminPermissionID[] = array('admin_id' => $id, 'permission_id' => $Val);
        }
        $result = $adminPermissionModel->addAll($adminPermissionID);
        if ($result === false) {
            $this->error = '添加失败';
            return false;
        }
    }
    public function adminRoleFunction($id,$role_id){
        //实例化对象
        $adminRoleModel = D('AdminRole');
        //因为得到是一个数组就是使用addAll方法一次添加
        $adminRoleID = array();
        //因为更新数据时也要使用这个方法 所以更新时要先把id对应的数据删除
        $adminRoleModel->where(array('admin_id' => $id))->delete();
        foreach ($role_id as $Val) {
            $adminRoleID[] = array('admin_id' => $id, 'role_id' => $Val);
        }
        $result = $adminRoleModel->addAll($adminRoleID);
        if ($result === false) {
            $this->error = '添加失败';
            return false;
        }
    }
}