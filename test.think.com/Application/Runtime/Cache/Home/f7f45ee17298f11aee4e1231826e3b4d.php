<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="http://test.think.com/Application/Public/Home/css/base.css" type="text/css">
	<link rel="stylesheet" href="http://test.think.com/Application/Public/Home/css/global.css" type="text/css">
	<link rel="stylesheet" href="http://test.think.com/Application/Public/Home/css/header.css" type="text/css">
	<link rel="stylesheet" href="http://test.think.com/Application/Public/Home/css/login.css" type="text/css">
	<link rel="stylesheet" href="http://test.think.com/Application/Public/Home/css/footer.css" type="text/css">
	<style type="text/css">
		.error {
			border: 1px dotted red!important;
		}
		.textError{
			color: red!important;
		}
	</style>
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="http://test.think.com/Application/Public/Home/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U();?>" method="post" id="signupForm">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" /><img src="" alt=""/>
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">邮箱：</label>
							<input type="text" class="txt" name="emails" /><img src="" alt=""/>
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" id="password"/><img src="" alt=""/>
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="repassword" /><img src="" alt=""/>
							<p>请再次输入密码</p>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode" />
							<img src="http://test.think.com/Application/Public/Home/images/checkcode1.jpg" alt="" />
							<span>看不清？<a href="">换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				
			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="http://test.think.com/Application/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="http://test.think.com/Application/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="http://test.think.com/Application/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="http://test.think.com/Application/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 endpublic.js -->
	<script type="text/javascript" src="http://test.think.com/Application/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="http://test.think.com/Application/Public/Home/js/jquery.validate.js"></script>
	<script type="text/javascript" src="http://test.think.com/Application/Public/Home/js/public.js"></script>
    <script type="text/javascript">
		//页面加载完成执行
		$(function(){
			$("#signupForm").validate({
				rules:{
					username:{
						required:true,
						rangelength:[3,20],
						remote:'<?php echo U("checks");?>'
					},
					emails:{
						required:true,
						email:true,
						remote:'<?php echo U("checks");?>'
					},
					password:{
						required:true,
						rangelength:[6,20],
					},
					repassword:{
						required:true,
						rangelength:[6,20],
						equalTo:"#password"
					},
				},

                //自定义把错误放在那里
				errorPlacement:function(error,element) {
					element.addClass('error');
					element.nextAll('p').text(error.text()).addClass('textError');
					element.nextAll('img').attr('src','http://test.think.com/Application/Public/Home/images/0.gif');
				},
				//>>2.验证出错的时候的提示信息
				messages: {
					username: {
						remote: '用户名已经存在,请更换!',
						required: '3-20位字符，可由中文、字母、数字和下划线组成',
						rangelength: '3-20位字符，可由中文、字母、数字和下划线组成'
					},
					emails: {
						required: '可由中文、字母、数字和下划线组成',
						remote: '用户名已经存在,请更换!',
						email:'请输入正确的邮箱地址',
					},
					repassword: {
						required:'请再次输入密码',
						equalTo:"密码不一致",
					},
					password: {
						required: '6-20位字符，可由中文、字母、数字和下划线组成',
						rangelength:'6-20位字符，可由中文、字母、数字和下划线组成',
					},
				},
				//验证成功时执行下面命令
				success:function(error,element){
					d(error);
					$(element).nextAll('p').removeClass('textError').text('3-20位字符，可由中文、字母、数字和下划线组成');
					$(element).nextAll('img').attr('src','http://test.think.com/Application/Public/Home/images/1.gif');
				}
			})

		})
	</script>
</body>
</html>