<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/25
 * Time: 16:16
 */

namespace Home\Controller;


use Home\Model\UserModel;
use Think\Controller;

class UserController extends Controller
{
    public function index()
    {//创建模型对象
        $Model = new UserModel();
        //调用select方法查询数据库的数据
        $row = $Model->select();
        //必须为视图的html执行这个方法
        $this->assign('rows', $row);
        //最后调用视图,每个控制器的视图都在控制器前缀的文件下面,所以要建一个文件
        $this->display('index');
    }

    //删除数据
    public function dele()
    {
        //创建模型对象
        $Model = new UserModel();
        //调用delete方法删除数据
        $result = $Model->delete(I('get.id'));
        if ($result !== false) {
//            echo '删除成功';
//            header('Location: index.php?m=Home&c=User&a=index');
            $this->success('删除成功', U('index'));
        } else {
            echo '删除失败' . $Model->getError();
        }

    }

    //创建显示表单页面
    public function add()
    {
        $this->display('add');

    }

    //表单提交处理数据
    public function save()
    {
//        //创建模型对象
        $Model = new UserModel();
//        //调用delete方法删除数据
        $result = $Model->add($_POST);
        if ($result) {
//            header('Location:index.php?m=Home&c=User&a=index');
            $this->success('添加成功', U('index'));
//            $this->redirect('index');
        } else {
            echo '添加失败' . $Model->getError();
        }
    }
    public function url(){
        dump(U('index'));
        dump(U(''));
    }
}