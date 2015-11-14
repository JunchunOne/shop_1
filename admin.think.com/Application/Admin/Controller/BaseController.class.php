<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 10:14
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Page;

class BaseController extends Controller

{
    protected $model;

    //>>1.由于每个方法方法中都有一个创建模型对象,所以添加一个__construct  但是会把父类的__construct覆盖了 所以要在此调用
    public function _initialize()
    {
        //parent::__construct();

        //创建模型对象
        $this->model = D(CONTROLLER_NAME);
    }


    public function goods()
    {

        $keyword = I("get.keyword");

        $wheres = array();

        if ($keyword) {
            $wheres['name'] = array('like', "%$keyword%");
        }
        //添加分页页面

        $page = $this->model->changPage($wheres);


        if ($page['list']) {
            $this->assign('shuju', $page['list']);
        }

        //为页面分配数据(如果是关联数组可以直接写)
        $this->assign('lists', $page['num']);
        $this->assign('html', $page['htmls']);

        //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据
        $this->assign('goods', '添加' . $this->goods);
        $this->assign('edit', $this->goods . '列表');
        $this->assign('url', U('add'));

        //返回时都显示到当前的页面 所以把url地址保存的cookie上
        cookie('EDIT_URL', $_SERVER['REQUEST_URI']);
        //......展示商品列表...
        $this->display('goods');
    }

    public function edit($id = '')
    {
        //.......编辑商品或者添加商品..........
        //>>1.编辑与添加商品可以通过IS_POST来判断

        if (IS_POST) {
            //接收没有过滤的数据
            $allPost = I('post.', '', false);

            //.......使用create方法收集数据并验证........
            if ($this->model->create() !== false) {
                //更新数据
                $result = $this->model->save($allPost);
                if ($result !== false) {

                    $this->success('更新成功', cookie('EDIT_URL'));
                    return;
                }
            }

            $this->error('操作错误' . showError($this->model));

        } else {

            //..........通过id查询数据.......
            $num = $this->model->find($id);

            //.........为页面分配数据回显在页面上.........
            $this->assign($num);

            //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据........
            $this->assign('goods', '添加新商品');
            $this->assign('edit', '编辑' . $this->goods);

            $this->view_before($id);
            //.......展示编辑页面.........
            $this->display('edit');
        }
    }

    public function view_before($id='')
    {

    }

    public $allPost = false;

    public function add()
    {
        //......添加商品..........

        if (IS_POST) {

            $allPost = $_POST;
            //.......使用create方法收集数据并验证........
            if ($this->model->create() !== false) {
                //更新数据
                $this->model->add($this->allPost?$allPost:'');

                $this->success('更新成功', U("goods", array('p' => cookie('TOTALPAGES'))));
                return;
            }

            $this->error('操作错误' . showError($this->model));

        } else {
            //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据
            $this->assign('url', U('goods'));
            $this->assign('goods', $this->goods . '列表');
            $this->assign('edit', '添加' . $this->goods);
            $this->view_before($id);
            //.......展示页面.......
            $this->display('edit');
        }
    }

    public function changStatus($id, $status = -1)//如果是删除  就是status变成  -1
    {
        //......根据传过来得id值修改status......
        $result = $this->model->changStatus($id, $status);
        if ($result !== false) {
            //..........判断返回值.........
            //....返回成功要返回到当前的页数
            $this->success('操作成功', cookie('EDIT_URL'));
            return;
        }
        $this->error('操作失败');
    }
}