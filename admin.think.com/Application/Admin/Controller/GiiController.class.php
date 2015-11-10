<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 16:11
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index()
    {
        if (IS_POST) {


            //定义模板路径
            define('TPL_MODEL', APP_PATH . "Template/");
//            echo TPL_MODEL;
            //获取模板的数据
            $table_name = I('post.table_name');

            //使用thinkphp的函数将表面转化为规范的类目
            $Controller = parse_name($table_name, 1);

            //>>1.2 提供meta_title的值(从information_schame表中查询)
            $sql = "SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_NAME='" . C('DB_PREFIX') . $table_name . "' AND TABLE_SCHEMA='" . C('DB_NAME') . "'";

            $row = M()->query($sql);

            //等到数据
            $meta_title = $row[0]['table_comment'];

            //...............首先生成controller控制器...........................

            //>>1.首先导入模板文件
            //开启ob缓存
            ob_start();
            require TPL_MODEL.'Controller.tpl';
            //保存生成的代码
            $controller_content=ob_get_clean();
            //加上<?php
            $controller_content="<?php\r\n".$controller_content;
            //找到文件要生成的路径
            $controller_path=APP_PATH."Admin/Controller/".$Controller."Controller.class.php";
            //把代码写入文件
            file_put_contents($controller_path,$controller_content);


            //...............首先生成Model模型...........................
            //获取表中每个字段的详细信息
            $sql = "show full columns from ". C('DB_PREFIX') . $table_name ;
            $fields = M()->query($sql);
            dump($fields);

            //>>1.首先导入模板文件
            //开启ob缓存
            ob_start();
            require TPL_MODEL.'Model.tpl';
            //保存生成的代码
            $controller_content=ob_get_clean();
            //加上<?php
            $controller_content="<?php\r\n".$controller_content;
            //找到文件要生成的路径
            $controller_path=APP_PATH."Admin/Model/".$Controller."Model.class.php";
            //把代码写入文件
            file_put_contents($controller_path,$controller_content);



            //................生成视图..................
            //>>1.首先导入模板文件
            //开启ob缓存
            ob_start();
            require TPL_MODEL.'index.tpl';
            //保存生成的html代码
            $view_content=ob_get_clean();
            //找到文件要生成的路径
            $view_dir=APP_PATH."Admin/View/".$Controller;
            if(!is_dir($view_dir)){
                mkdir($view_dir,0777,true);
            }
            //找到文件要生成的路径
            $view_path=$view_dir."/goods.html";
            file_put_contents($view_path,$view_content);

            //................生成视图edit..................
            //>>1.首先导入模板文件
            //开启ob缓存
            ob_start();
            require TPL_MODEL.'edit.tpl';
            //保存生成的html代码
            $view_content=ob_get_clean();
            //找到文件要生成的路径
            $view_dir=APP_PATH."Admin/View/".$Controller;

            if(!is_dir($view_dir)){
                mkdir($view_dir,0777,true);
            }
            //找到文件要生成的路径
            $view_path=$view_dir."/edit.html";

            file_put_contents($view_path,$view_content);



        } else {

            $this->display('index');
        }

    }


}