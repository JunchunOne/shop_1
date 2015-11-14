<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.think.com/Application/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.think.com/Application/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    
    <link href="http://admin.think.com/Application/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.think.com/Application/Public/Admin/treegrid/css/jquery.treegrid.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://admin.think.com/Application/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

    <style type="text/css">
        .upload-pre-item{
            position: relative;
        }
        .upload-pre-item a{
            position: absolute;
            top: 0px;
            right: 20px;
            display: block;
            background-color: red;
        }
    </style>

    

    
</head>
<body>
<h1>
    <!--<span class="action-span"><a href="<?php echo U('Index/index');?>">首页</a></span>-->
    <span class="action-span"><a href="<?php echo ($url); ?>"><?php echo ($goods); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> --<?php echo ($edit); ?></span>
    <div style="clear:both"></div>
</h1>

        <div id="tabbar-div">
            <p>
                <span class="tab-front">通用信息</span>
                <span class="tab-back">商品描述</span>
                <span class="tab-back">会员价格</span>
                <span class="tab-back">商品属性</span>
                <span class="tab-back">商品相册</span>
                <span class="tab-back">关联文章</span>
            </p>
        </div>
        <form method="post" action="<?php echo U();?>" class="forms" enctype="multipart/form-data">
            <table cellspacing="1" cellpadding="3" width="100%" style="display: block">
                <tr>
                    <td class="label">名称</td>
                    <td>
                        <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">货号</td>
                    <td>
                        <input type="text" name="sn" maxlength="60" value="<?php echo ($sn); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">父分类</td>
                    <td>
                        <input type="text" name="goods_category_id" maxlength="60" value="默认为顶级分类" disabled class="parent"/>
                        <input type="hidden" name="goods_category_id" maxlength="60" class="parent_id" value="0"/>
                    </td>

                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <ul id="treeDemo" class="ztree">
                        </ul>

                    </td>

                </tr>
                <tr>
                    <td class="label">品牌</td>
                    <td>
                        <?php echo arrSelect('brand_id',$brand,$brand_id);?>
                    </td>

                </tr>
                <tr>
                    <td class="label">供货商</td>
                    <td>
                       <?php echo arrSelect('supplier_id',$supplier,$supplier_id);?>
                    </td>

                </tr>
                <tr>
                    <td class="label">本店价格</td>
                    <td>
                        <input type="text" name="shop_price" maxlength="60" value="<?php echo ($shop_price); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">市场价格</td>
                    <td>
                        <input type="text" name="market_price" maxlength="60" value="<?php echo ($market_price); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">库存</td>
                    <td>
                        <input type="text" name="stock" maxlength="60" value="<?php echo ($stock); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">是否上架</td>
                    <td>
                        <input type="radio"  cLass="is_on_sale" name="is_on_sale" maxlength="60" value="1"/>是
                        <input type="radio" cLass="is_on_sale" name="is_on_sale" maxlength="60" value="0"/>否
                    </td>

                </tr>
                <tr>
                    <td class="label">商品状态</td>
                    <td>
                        <input type="checkbox" class="goods_status" name="goods_status[]" maxlength="60" value='1' >疯狂抢购
                        <input type="checkbox" class="goods_status" name="goods_status[]" maxlength="60" value='2'>热卖商品
                        <input type="checkbox" class="goods_status" name="goods_status[]" maxlength="60" value='4'>推荐商品
                        <input type="checkbox" class="goods_status" name="goods_status[]" maxlength="60" value='8'>新品上架
                        <input type="checkbox" class="goods_status" name="goods_status[]" maxlength="60" value='16'>猜您喜欢


                    </td>

                </tr>
                <tr>
                    <td class="label">关键字</td>
                    <td>
                        <input type="text" name="keyword" maxlength="60" value="<?php echo ($keyword); ?>"/>
                    </td>

                </tr>
                <tr>
                    <td class="label">LOGO</td>
                    <td>
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

            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>

                    <td rowspan="2">

                        <textarea id="editor" type="text/plain" name="intro" ><?php echo ($intro); ?></textarea>
                    </td>
                </tr>

            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <?php if(is_array($memberLevel)): foreach($memberLevel as $k=>$Val): ?><tr>
                    <td class="label"><?php echo ($Val["name"]); ?></td>
                    <td>
                        <input type="text" name="memberprice[<?php echo ($k); ?>]" maxlength="60" value="<?php echo ($memberPrice[$k]); ?>">
                        <input type="hidden" name="member_level_id[]" value="<?php echo ($Val["id"]); ?>">
                    </td>
                </tr><?php endforeach; endif; ?>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td class="label">商品属性</td>
                    <td>
                        <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">

                <tr>

                    <td>
                        <div class="upload-img-box upload-galler-box">
                            <?php if(is_array($galler)): foreach($galler as $key=>$path): ?><div class="upload-pre-item">
                                    <img src="http://admin.think.com/Application/Uploads/<?php echo ($path["path"]); ?>">
                                    <a dbid="<?php echo ($path["id"]); ?>" href="javascript:;">X</a>
                                </div><?php endforeach; endif; ?>
                        </div>
                    </td>

                    <td>
                        <input type="file" name="upload-galler" id="upload-galler"/>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td style="text-align: left">搜索文章：<input type="text" name="keyword" class="keyword"/><input class="search_article" type="button" value="搜索"/></td>
</tr>
                <tr>
                    <td style="text-align: left;width: 50%">
                        <select multiple="multiple" class="left_select" style="width: 80%;height: 300px">
                        </select>
</td>
<td>
                        <div class="selectedOption">
                            <?php if(is_array($article)): foreach($article as $key=>$articleVal): ?><input type="hidden" name="article_id" value="<?php echo ($articleVal["id"]); ?>"/><?php endforeach; endif; ?>
                        </div>
                        <select multiple="multiple" class="right_select" style="width: 80%;height: 300px">
                            <?php if(is_array($article)): foreach($article as $key=>$articleVal): ?><option value="<?php echo ($articleVal["id"]); ?>"><?php echo ($articleVal["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div style="text-align: center">
                <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                <input type="submit" class="button ajax_post1" value=" 确定 "/>
                <input type="reset" class="button" value=" 重置 "/>
            </div>
        </form>

    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/public.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/treegrid/js/jquery.treegrid.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="http://admin.think.com/Application/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function () {
             $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 0); ?>]);
        $('.is_on_sale').val([<?php echo ((isset($is_on_sale ) && ($is_on_sale !== ""))?($is_on_sale ): 1); ?>]);

            /////////////////////切换选项 -- 开始/////////////////////////////
            //首先找到span标签
            $("#tabbar-div span").click(function(){
                //找到所有的span通过点击来删除前一个的class 后再给前一个添加上
                $("#tabbar-div span").removeClass('tab-front').addClass('tab-back');
                //给当前点击的class赋值为tab-front
                $(this).removeClass('tab-back').addClass('tab-front');
                //找到所有的table 全部隐藏 在通过点击来显示
                $('form>table').hide();
                //通过index找当前点击是第几个sqan
                var index=$(this).index();
                $('form>table').eq(index).show();
            });


            /////////////////////切换选项 -- 结束/////////////////////////////



            /////////////////////上传图片-- 开始/////////////////////////////
            $("#upload-logo").uploadify({
                height: 25,    //指定删除插件的高和宽
                width: 145,
                swf: 'http://admin.think.com/Application/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                uploader: '<?php echo U("Upload/index");?>',   //在服务器上处理上传的代码
                'buttonText': '选择图片',   //上传按钮上面的文字
                'fileSizeLimit': '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                'formData': {'dir': 'goods'},   //通过post方式传递的额外参数
                'multi': true,   //是否支持多文件上传
                'onUploadSuccess': function (file, data, response) {   //上传成功时执行的方法
                    $('.logo').val(data);
                    $('.upload-img-box').show();
                    $('.upload-img-box img').attr('src', "http://admin.think.com/Application/Uploads/" + data);
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                    alert('该文件上传失败!错误信息为:' + errorString);
                }


            });
            /////////////////////上传图片-- 结束/////////////////////////////

            ///////////////////////////////////商品分类树  开始///////////////////////////////////////////
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },

                callback: {
                    beforeClick: function (treeId, treeNode, clickFlag) {
                        if (treeNode.isParent) {
                            layer.msg('必须选择最小分类', {
                                offset: 0,
                                icon: 0,
                            });
                        }

                        return !treeNode.isParent;  //如果该分类有子节点, 就返回false, false表示不选中
                    },
                    onClick: function (event, treeId, treeNode) {
                        $(".parent_id").val(treeNode.id);
                        $(".parent").val(treeNode.name);
                    }
                }
            };
            var zNodes = <?php echo ($row); ?>;
            //该
            var zTreeobj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //全部展开

            <?php if(!empty($_GET['id'])): ?>var goods_status = <?php echo ($goods_status); ?>;
            //该值是一个整数
            var goods_status_values = new Array();
            if((goods_status & 1) > 0){
                goods_status_values.push(1);
            }

            if((goods_status & 2) > 0){
                goods_status_values.push(2);
            }
            if((goods_status & 4) > 0){
                goods_status_values.push(4);
            }

        if((goods_status & 8) > 0){
            goods_status_values.push(8);
        }
        if((goods_status & 16) > 0){
            goods_status_values.push(16);
        }
            $('.goods_status').val(goods_status_values);
             var  goods_prante_id=<?php echo ($goods_category_id); ?>;
            var parentNode =  zTreeobj.getNodeByParam('id',goods_prante_id);
            if(!parentNode){   //如果没有找到父分类,就不再选中
                return;
            }
            //选中该节点
            zTreeobj.selectNode(parentNode);
            //将父节点的name和id赋值给
            $('.parent_id').val(parentNode.id);
            $('.parent').val(parentNode.name);
             <?php else: ?>
            zTreeobj.expandAll(true);<?php endif; ?>
            ///////////////////////////////////商品分类树  结束///////////////////////////////////////////
           //////////////////////////////////////加载ueditor编辑器//////////////////////////////////////////////
//           var ue = UE.getEditor('editor');
        var ue = UE.getEditor('editor', {
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo', 'bold']
            ],
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            initialFrameHeight:300,
            initialFrameWidth:1180
        });



        ///////////////////////////////////////上传相册  开始////////////////////////////////////////////////

        $("#upload-galler").uploadify({
            height: 25,    //指定删除插件的高和宽
            width: 145,
            swf: 'http://admin.think.com/Application/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
            uploader: '<?php echo U("Upload/index");?>',   //在服务器上处理上传的代码
            'buttonText': '选择图片',   //上传按钮上面的文字
            'fileSizeLimit': '100KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
            'formData': {'dir': 'goods'},   //通过post方式传递的额外参数
            'multi': true,   //是否支持多文件上传
            'onUploadSuccess': function (file, data, response) {   //上传成功时执行的方法
              var galler=' <div class="upload-pre-item">\
                                 <img src="http://admin.think.com/Application/Uploads/'+data+'">\
                                 <input type="hidden"  name="path[]" value="'+data+'">\
                                 <a href="javascript:;">X</a>\
                          </div>';
                $('.upload-galler-box').append($(galler));
            },
            'onUploadError': function (file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                alert('该文件上传失败!错误信息为:' + errorString);
            }

        });
        ///////////////////////////////////////上传相册  结束////////////////////////////////////////////////
       ////////////////////////////////上传相册   点击删除  开始/////////////////////////////////////////////
       //首先找到点击的节点
        $(".upload-galler-box").on('click','a',function(){
            //找到要删除的id
            var id= $(this).attr('dbid');
            var tath=$(this);
            //因为页面上展示的有回显的图片和新添加的图片,通过a标签上的属性dbid的值来判断
            if(id){
            $.post("<?php echo U('deleteGaller');?>",{id:id},function(row){
                //把返回的json字符串转化为json对象
                eval("var rowa="+row);
                if(rowa.success){
                    tath.closest('div').remove();
                }
            })
            }else{
                $(this).closest('div').remove();
            }
        })

      ////////////////////////////////////上传相册   点击删除  结束///////////////////////////////////////////

        ////////////////////////////////////上传关联文章  结束///////////////////////////////////////////
        //取消键盘事件
        $('.keyword').keypress(function(e){
            if(e.keyCode==13){
                listRow();
                return false;
            }
        })
        //封装成函数
        function listRow(){
            //得到搜索的值
            var keyVal=$('.keyword').val();
            if(!keyVal){
                return;
            }
            $('.left_select option').empty();
            //通过搜索的值查询数据
            $.getJSON('<?php echo U("Article/search");?>',{keyword:keyVal},function(getAll){
                var  html="";
                $(getAll).each(function(){
                    html+="<option value='"+this.id+"'>"+this.name+"</option>";
                })
                $('.left_select').append($(html));
            })
        }
        //找到点击的事件对象
        $('.search_article').click(function(){
            listRow()
        })
      //双击文件移动到右边 在把文章的id添加到一个隐藏域中在提交的数据库
        $('.left_select').on('dblclick','option',function(){
            //点击移动
         var vla= $(this).val();
            $('.right_select option').each(function(){
                if(vla==this.value){
                   alert('文章已经存在');
                    $(this).remove();
                }
            })
            $('.right_select').append($(this));
            //得到左边所以的option
            moveOption();
        })
        //双击文件移动到左边
        $('.right_select').on('dblclick','option',function(){
            $('.left_select').append($(this));
            moveOption();
        })
       function moveOption(){
           var html='';
           $('.right_select option').each(function(){

                   html += "<input type='hidden' name='article_id[]' value='" + this.value + "'>"
           })
           $('.selectedOption').empty();
           $('.selectedOption').append($(html));
       }
        });
    </script>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>