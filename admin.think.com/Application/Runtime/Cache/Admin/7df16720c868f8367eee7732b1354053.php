<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    
    
    <link href="http://admin.think.com/Application/Public/Admin/css/page.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.think.com/Application/Public/Admin/treegrid/css/jquery.treegrid.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<h1>
    <!--<span class="action-span"><a href="<?php echo U('Index/index');?>">首页</a></span>-->
    <span class="action-span"><a href="<?php echo ($url); ?>"><?php echo ($goods); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> --<?php echo ($edit); ?></span>
    <div style="clear:both"></div>
</h1>

    <div class="list-div" id="listDiv">
        <input type="submit" value=" 删除选中 " class="ajax_post" url="<?php echo U('changStatus');?>"/>
        <table cellpadding="3" cellspacing="1" class="tree">

            <tr>
                <th>名称</th>
                <th>简介</th>
                <th>状态</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <tr>
                <td align="center" colspan="8"><?php echo ($shuju); ?></td>
            </tr>
            <?php if(is_array($lists)): foreach($lists as $key=>$list): ?><tr class="treegrid-<?php echo ($list["id"]); ?> <?php if($list['level']!=1){echo 'treegrid-parent-'.$list['parent_id'];}?>">
                    <td ><?php echo ($list["name"]); ?></td>

                    <td align='center' ><?php echo ($list["intro"]); ?></td>
                    <td align='center'><a class='ajax_get' href="<?php echo U('changStatus',array('id'=>$list['id'],'status'=>1-$list['status']));?>"><img
                            src='http://admin.think.com/Application/Public/Admin/images/<?php echo ($list["status"]); ?>.gif'/></a></td>
                    <td align='center'><?php echo ($list["sort"]); ?></td>
                    <td align="center">
                        <a href="/index.php/Goods/?goods_id=<<?php echo ($val["goods_id"]); ?>>" target="_blank" title="查看"><img
                                src="http://admin.think.com/Application/Public/Admin/images/icon_view.gif" width="16" height="16" border="0"/></a>
                        <a href="<?php echo U('edit',array('id'=>$list['id']));?>" title="编辑"><img
                                src="http://admin.think.com/Application/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0"/></a>
                        <a class="ajax_get" href="<?php echo U('changStatus',array('id'=>$list['id']));?>" onclick=""
                           title="回收站"><img
                                src="http://admin.think.com/Application/Public/Admin/images/icon_trash.gif" width="16" height="16" border="0"/></a></td>
                </tr><?php endforeach; endif; ?>
        </table>

    </div>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/public.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/treegrid/js/jquery.treegrid.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.tree').treegrid();
        })
    </script>
    <!--<script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/treegrid/js/jquery.treegrid.js"></script>-->


<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>