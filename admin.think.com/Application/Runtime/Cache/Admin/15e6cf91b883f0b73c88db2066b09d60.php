<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="http://admin.think.com/Application/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

    

    
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
                    <td class="label">菜单名称</td>
                    <td>
                        <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">菜单URL</td>
                    <td>
                        <input type="text" name="url" maxlength="60" value="<?php if(!empty($id)): echo ($url); endif; ?>"/>
                    </td>

                </tr>

                <tr>
                    <td class="label">父菜单</td>
                    <td>
                        <input type="text" name="parent_id" class="parent" disabled="disabled" />
                        <input type="hidden" name="parent_id" class="parent_id"  value="<?php echo ($parent_id?$parent_id:0); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <ul id="treeDemo" class="ztree">
                        </ul>

                    </td>
                <tr>
                <tr>
                    <td class="label">额外权限</td>
                    <td>
                        <div id="permission_ids"></div>
                        <ul id="treeDemo1" class="ztree"></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">简介</td>
                    <td>
                        <input type="text" name="intro" maxlength="60" value="<?php echo ($intro); ?>"/>
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
                        <input type="submit" class="button" value=" 确定 "/>
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
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/zTree/js/jquery.ztree.excheck-3.5.js"></script>
    <script type="text/javascript">
        $(function () {
//            $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);

///////////////////////////////////商品分类树  开始///////////////////////////////////////////
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },

                callback: {
                    onClick: function (event, treeId, treeNode) {
                        $(".parent_id").val(treeNode.id);
                        $(".parent").val(treeNode.name);
                    }
                }
            };
            var zNodes = <?php echo ($row); ?>;
            //获得对象
            var zTreeobj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);

            //id存在就执行下面的代码
            <?php if(!empty($id)): ?>var parent_id=<?php echo ($parent_id); ?>
            //根据当前回显数据的parent_id找到父类的id节点
            var parentNode =  zTreeobj.getNodeByParam('id',parent_id);

            if(parentNode){   //如果没有找到父分类,就不再选中
                //选中该节点
                zTreeobj.selectNode(parentNode);
                //将父节点的name和id赋值给
                $('.parent_id').val(parentNode.id);
                $('.parent').val(parentNode.name);
            }
            <?php else: ?>
            //全部展开
            zTreeobj.expandAll(true)<?php endif; ?>
            ///////////////////////////////////商品分类树  开始///////////////////////////////////////////
            var setting = {
                check: {
                    enable: true
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },

                callback: {
                    onCheck: function (event, treeId, treeNode) {
                        //获取到所有选中的节点
                        var nodes =zTreeobj.getCheckedNodes(true);
                        //把获得的节点循环得每个节点的id
                        var html='';
                        $('#permission_ids').empty()
                        $(nodes).each(function(){
                            html+='<input type="hidden" name="permission_id[]" value="'+this.id+'">';
                            //把隐藏域添加到页面中
                        })
                        $('#permission_ids').append($(html));
                    }
                }
            };
            var zNodes = <?php echo ($permission); ?>
            //获得对象
            var zTreeobj = $.fn.zTree.init($("#treeDemo1"), setting, zNodes);
            zTreeobj.expandAll(true);
            //id存在就执行下面的代码
            <?php if(!empty($id)): ?>//编辑时:
            var permission_ids = <?php echo ($permission_ids); ?>;
            $(permission_ids).each(function(){
                //根据每一个权限id,找到每一个权限然后打钩
                var node = zTreeobj.getNodeByParam('id',this);
                zTreeobj.checkNode(node,true,false,true);  //node:需要选中的节点, 第一个true: 表示选中,  第二个false:表示不关联, 第三true: 表示选中时激活事件
            });<?php endif; ?>
        });
    </script>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>