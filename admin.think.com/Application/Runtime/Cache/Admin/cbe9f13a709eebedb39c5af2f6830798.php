<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    
    

    
</head>
<body>
<h1>
    <!--<span class="action-span"><a href="<?php echo U('Index/index');?>">首页</a></span>-->
    <span class="action-span"><a href="<?php echo ($url); ?>"><?php echo ($goods); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> --<?php echo ($edit); ?></span>
    <div style="clear:both"></div>
</h1>

    <div class="main-div">
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%">
                                                <tr>
                    <td class="label">标题</td>
                    <td>
                        <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"/>
                    </td>

                </tr>
                                                                <tr>
                    <td class="label">文章分类</td>
                    <td>

                         <?php echo arrSelect('article_category_id',$atrice,$article_category_id);?>

                    </td>

                </tr>
                                                                <tr>
                    <td class="label">内容</td>
                    <td>
                        <input type="textarea" name="content" maxlength="60" value="<?php echo ($content); ?>"/>
                    </td>

                </tr>
                                                                <tr>
                    <td class="label">浏览次数</td>
                    <td>
                        <input type="text" name="times" maxlength="60" value="<?php echo ($times); ?>"/>
                    </td>

                </tr>
                                                                <tr>
                    <td class="label">录入时间</td>
                    <td>
                        <input type="text" name="inputtime" maxlength="60" value="<?php echo ($inputtime); ?>"/>
                    </td>

                </tr>
                                                                <tr>
                    <td class="label">摘要</td>
                    <td>
                        <input type="textarea" name="intro" maxlength="60" value="<?php echo ($intro); ?>"/>
                    </td>

                </tr>
                                                                <tr>
                    <td class="label">状态</td>
                    <td>
                    <input type='radio' name='status' class='status' value='1'/> 是
                    <input type='radio' name='status' class='status' value='0'/> 否
                                        </td>
                </tr>
                                                                <tr>
                    <td class="label">排序</td>
                    <td>
                        <input type="text" name="sort" maxlength="60" value="<?php echo ($sort); ?>"/>
                    </td>

                </tr>
                                                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                        <input type="submit" class="button ajax_post1" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/public.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);

        });
    </script>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>