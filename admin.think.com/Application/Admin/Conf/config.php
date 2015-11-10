<?php
defined('WEB_URL') or define('WEB_URL','http://admin.think.com');


return array(
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'/Application/Public/Admin/css', // 更改默认的/Public 替换规则
        '__JS__'     => WEB_URL.'/Application/Public/Admin/js', // 增加新的JS类库路径替换规则
        '__IMG__' => WEB_URL.'/Application/Public/Admin/images', // 增加新的上传路径替换规则
        '__LAYER__' => WEB_URL.'/Application/Public/Admin/layer', // 增加新的上传路径替换规则
        '__UPLOADIFY__' => WEB_URL.'/Application/Public/Admin/uploadify',
        '__UPLOADS__' => WEB_URL.'/Application/Uploads',
        '__BRAND__' => "http://itsource-brand.b0.upaiyun.com", // brand又拍云空间中的地址
        '__TREEGRID__' => WEB_URL.'/Application/Public/Admin/treegrid', // brand又拍云空间中的地址
        '__ZTREE__' => WEB_URL.'/Application/Public/Admin/zTree',
        '__UEDITOR__' => WEB_URL.'/Application/Public/Admin/ueditor',//定义ueditor编辑器路径
    ),
    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'shop', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '123456', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'shop_', // 数据库表前缀


    'Page_SIZE'              =>10,//每页显示多少条数据
);