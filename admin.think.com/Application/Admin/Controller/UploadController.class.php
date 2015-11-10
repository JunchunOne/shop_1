<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 14:19
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{

    //接收到上传插件上传上来的文件保存到指定的位置
    public function index(){
        //>>1.接收上传的目录参数
        $dir = I('post.dir');  //brand
        if(!is_dir(APP_PATH.'Uploads/'.$dir)){  //如果Uploads下的目录不存在就创建
            mkdir(APP_PATH.'Uploads/'.$dir,0777,true);
        }

        //>>2. 接收上传上来的文件保存到上面指定的目录中
        $config = array(
            'exts'         => array(), //允许上传的文件后缀
            'savePath'     => $dir."/", //保存路径
            'subName'      => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'     => './Application/Uploads/', //  ./代表又拍云的每个空间的根目录, 必须是./
//            'savePath'     => $dir.'/', //保存路径
//            'driver'       => 'Upyun', // 文件上传驱动
//            'driverConfig' =>  array(   // 上传驱动配置
//                'host'     => 'v0.api.upyun.com', //又拍云服务器
//                'username' => 'junchun', //又拍云操作员用户
//                'password' => 'jiangjun19871123', //又拍云操作员密码
//                'bucket'   => 'brand', //空间名称   //itsource-brand
//                'timeout'  => 90, //超时时间
//            )
        );
        $uploader = new Upload($config);
        //>>3.将上传后的路径放到$_POST
        $info = $uploader->uploadOne($_FILES['Filedata']);
        if($info!==false){
            echo $info['savepath'].$info['savename'];
        }else{
            echo $uploader->getError();
        }
    }
}

