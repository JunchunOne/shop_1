<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    
    
    <link href="http://admin.think.com/Application/Public/Admin/css/page.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<h1>
    <!--<span class="action-span"><a href="<?php echo U('Index/index');?>">首页</a></span>-->
    <span class="action-span"><a href="<?php echo ($url); ?>"><?php echo ($goods); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> --<?php echo ($edit); ?></span>
    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="<?php echo U('goods');?>" name="searchForm" method="get">
            <img src="http://admin.think.com/Application/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
            <!-- 分类 -->
            <select name="cat_id">
                <option value="0">所有分类</option>
                <?php if(is_array($cat_list)): foreach($cat_list as $key=>$val): ?><option value="<<?php echo ($val["cat_id"]); ?>>"><<?php echo (str_repeat('&nbsp;&nbsp;',$val["lev"])); ?>><<?php echo ($val["cat_name"]); ?>></option><?php endforeach; endif; ?>
            </select>
            <!-- 品牌 -->
            <select name="brand_id">
                <option value="0">所有品牌</option>
                <?php if(is_array($brand_list)): foreach($brand_list as $key=>$val): ?><option value="<<?php echo ($val["brand_id"]); ?>>"><<?php echo ($val["brand_name"]); ?>></option><?php endforeach; endif; ?>
            </select>
            <!-- 推荐 -->
            <select name="intro_type">
                <option value="0">全部</option>
                <option value="is_best">精品</option>
                <option value="is_new">新品</option>
                <option value="is_hot">热销</option>
            </select>
            <!-- 上架 -->
            <select name="is_on_sale">
                <option value=''>全部</option>
                <option value="1">上架</option>
                <option value="0">下架</option>
            </select>
            <!-- 关键字 -->
            关键字 <input type="text" name="keyword" class="keyword" size="15"/>
            <input type="submit" value=" 搜索 " class="button search"/>
            <a href="<?php echo U('goods');?>"><input type="button" value=" 返回 " class="button goods"/></a>
        </form>
    </div>
    <div class="list-div" id="listDiv">
        <input type="submit" value=" 删除选中 " class="ajax_post" url="<?php echo U('changStatus');?>"/>
        <table cellpadding="3" cellspacing="1">

            <tr>
                <th width="50px">序号<input type="checkbox" class="show"/></th>
                <th>用户名</th>
                <th>密码</th>
                <th>Email</th>
                <th>加入时间</th>
                <th>最后登录时间</th>
                <th>盐</th>
                <th>简介</th>
                <th>状态</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <tr>
                <td align="center" colspan="8"><?php echo ($shuju); ?></td>
            </tr>
            <?php if(is_array($lists)): foreach($lists as $key=>$list): ?><tr>
                    <td align="center"><input type="checkbox" name="id[]" class="id" value="<?php echo ($list["id"]); ?>"/></td>
                    <td align='center'><?php echo ($list["username"]); ?></td>
                    <td align='center'><?php echo ($list["password"]); ?></td>
                    <td align='center'><?php echo ($list["email"]); ?></td>
                    <td align='center'><?php echo date('Y-m-d H:i:s',$list['add_time']);?></td>
                    <td align='center'><?php echo ($list["last_login_time"]); ?></td>
                    <td align='center'><?php echo ($list["salt"]); ?></td>
                    <td align='center'><?php echo ($list["intro"]); ?></td>
                    <td align='center'><a class='ajax_get' href='<?php echo U(' changStatus',array('id'=>$list['id'],'status'=>1-$list['status']));?>'><img
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
        <div class="black">
            <?php echo ($html); ?>
        </div>
    </div>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/public.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/common.js"></script>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>