<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">

	
	<script src="/Public/Home/js/jquery-1.8.3.min.js" charset="utf-8"></script>
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
			<h2 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
  <hr/>

  



	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="password" />
							<p> <span>请再次输入密码</p>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode" />
							<img id="captcha" src="/index.php/Home/User/captcha" alt="" />
							<span>看不清？<a id="refresh" href="javascript:;">换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="button" value="" class="login_btn" />
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
	<script type="text/javascript">
		$(function(){
			//页面就绪
			//为 换一张 a标签绑定点击事件
			$("#refresh").click(function(){
				//为图片更新一个src属性地址 就能重新请求
				$("#captcha").attr('src','/index.php/Home/User/captcha/_/'+Math.random());
			});

			//为输入验证码的文本框绑定 失去焦点事件 异步校验验证码
			$("[name=checkcode]").blur(function(){
				//1、获取用户填写的验证码
				var captcha = $(this).val();
				//2、验证码存储在session中,到服务器验证
				$.get("<?php echo U('user/check');?>",'captcha='+captcha,function(msg){
					// console.log(msg);
					if(msg == 0){
						//提示用户,验证码填写错误
						alert('验证码错误,请重新填写!');
						//更换一个验证码图,手动触发事件
						$("#refresh").trigger('click');
					}
				},'text')
			})

			$('.login_btn').click(function(){
				//1、获取用户填写的验证码
				var captcha = $("[name=checkcode]").val();
				//2、验证码存储在session中,到服务器验证
				$.get("<?php echo U('user/check');?>",'captcha='+captcha,function(msg){
					if(msg == 1){
						//验证码正确,提交表单
						$('form').submit();
					}else{
						//提示用户,验证码填写错误
						alert('验证码错误,请重新填写!');
						//更换一个验证码图,手动触发事件
						$("#refresh").trigger('click');
					}
				},'text')
			})
		});
	</script>

	<div style="clear:both;"></div>


  <hr/>

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
      <a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
      <a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
      <a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
      <a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
    </p>
  </div>
  <!-- 底部版权 end -->

</body>
</html>