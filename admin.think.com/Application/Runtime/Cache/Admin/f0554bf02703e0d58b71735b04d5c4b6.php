<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    <link href="http://admin.think.com/Application/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css" />

    

    
</head>
<body>
<h1>
    <!--<span class="action-span"><a href="<?php echo U('Index/index');?>">首页</a></span>-->
    <span class="action-span"><a href="<?php echo ($url); ?>"><?php echo ($goods); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> --<?php echo ($edit); ?></span>
    <div style="clear:both"></div>
</h1>

    <form method="post" action="<?php echo U();?>" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌网址</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <input type="text" name="urll" maxlength="60" value="<?php echo ($urll); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <input type="file" name="upload-logo" id="upload-logo"/>
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">

                    <div class="upload-img-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <img src="http://admin.think.com/Application/Uploads/<?php echo ($logo); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <input type="radio" class="status" value="1" name="status"/>是<input type="radio" class="status" value="0" name="status"/>否                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <!---
                      //目的: 根据每个字段的注解中指定的表单元素的类型,生成不同的表单元素
                       1. 获取每个注解中的表单元素类型
                    -->
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden"  name="id" value="<?php echo ($id); ?>" />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/public.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript">
        $("#upload-logo").uploadify({
            height        : 25,    //指定删除插件的高和宽
            width         : 145,
            swf           : 'http://admin.think.com/Application/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
            uploader      : '<?php echo U("Upload/index");?>',   //在服务器上处理上传的代码
            'buttonText' : '选择图片',   //上传按钮上面的文字
            'fileSizeLimit' : '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
            'formData'      : {'dir' : 'brand'},   //通过post方式传递的额外参数
            'multi'    : true,   //是否支持多文件上传
            'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
                $('.logo').val(data);
                $('.upload-img-box').show();
                $('.upload-img-box img').attr('src',"http://admin.think.com/Application/Uploads/"+data);
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                alert('该文件上传失败!错误信息为:' + errorString);
            }


        });
    </script>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>