<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 15:24
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{

    public function changPage($wheres = array())
    {
        //.........设置查询的where条件...........
        $wheres['status'] = array('NEQ', -1);

        //.....查询总条数........
        $rows = $this->where($wheres)->count();

        //.......每页显示几条.....
        $page_size = C("Page_SIZE");


        //....创建分页的实例化分页类......;
        $page = new Page($rows, $page_size);

        //等到总的页数
        $totalPages = ceil($rows / $page_size);

        //保存的cookie中
        cookie('TOTALPAGES', $totalPages);

        //.....查询数据.....
        $nums = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();
        if ($nums == null) {
            return array('list' => '没有数据');
        }

        //.....得到分页显示html代码......
        $html = $page->show();

        //....返回一个数组........
        return array('num' => $nums, 'htmls' => $html);
    }

    public function goodsList($where=array())
    {
        $where['status']=array('EGT',0);
      return  $this->where($where)->select();

    }

    public function changStatus($id, $status)
    {
        //>通过点击来来变换status的值1或者0 就要等到他当前的status

        $data['status'] = $status;

        //删除用户是在用户名后面加上"_del"
        if ($status == -1) {
            //.....exp  支持sql的表达式....
            $data['name'] = array('exp', "concat(name,'_del')");
        }

        //使用id删除数据
        $this->where(array('id' => array('in', $id), 'status<>-1'));

        //因为子类中覆盖了save方法,所以要调用父类中的;
        $result = parent::save($data);
        return $result;

    }
}