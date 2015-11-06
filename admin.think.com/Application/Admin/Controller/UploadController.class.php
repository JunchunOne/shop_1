<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/5
 * Time: 0:29
 */

namespace Admin\Controller;


class UploadController
{
public function index(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 3145728;// 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath = './Application/Uploads/'; // 设置附件上传目录'savePath'     => '', //保存路径
    $upload->savePath = 'Brand/';
    $info = $upload->uploadOne($_FILES['logoOne']);
    if (!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    } else {
        echo $info['savepath'] . $info['savename'];
    }
}
}