<?php
define('SRC_URL', 'http//:test.think.com');
return array(
    //'配置项'=>'配置值'
    //定义字符串替换
    'TMPL_PARSE_STRING' => array(
        '_IMG_' => SRC_URL . 'Public/Images',
        '_CSS_' => SRC_URL . 'Public/Css',
        '_JS_' => SRC_URL . 'Public/Js',
    )
);