<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class BrandController extends BaseController
{
    protected $goods = '品牌';

    public function add()
    {

        //......添加商品..........

        if (IS_POST) {
                //.......使用create方法收集数据并验证........
                if ($this->model->create() !== false) {
                    //更新数据
                    $this->model->add();

                    $this->success('更新成功', U("goods", array('p' => cookie('TOTALPAGES'))));
                    return;
                }

                $this->error('操作错误' . showError($this->model));

            }
        else {
                //.....由于页面使用了模板继承,所以为页面不同的部分再次分配数据
                $this->assign('url', U('goods'));
                $this->assign('goods', $this->goods . '列表');
                $this->assign('edit', '添加' . $this->goods);

                //.......展示页面.......
                $this->display('edit');
            }
        }

    }