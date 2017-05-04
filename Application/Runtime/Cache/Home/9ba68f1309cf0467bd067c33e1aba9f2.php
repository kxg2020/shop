<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>成功提示</title>
	<link rel="stylesheet" href="/Public/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/footer.css" type="text/css">
	<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
	<style type="text/css">
		.sendBox{margin: 50px auto; font-family: "微软雅黑"}
		.sendBox h3{font-size: 25px; font-weight: bold; text-align: center;}
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
		<h2 class="fl"><a href="index.html"><img src="/Public/images/logo.png" alt="京西商城"></a></h2>
	</div>
</div>
<!-- 页面头部 end -->

<!-- 登录主体部分start -->
<div class="sendBox">
	<h3>成功了！</h3>
	<!--<?php echo ($error); ?>-->
	<p style="text-align: center; font-size: 18px;"><?php echo ($message); ?> <a href="<?php echo ($jumpUrl); ?>" id="href">跳转</a> 等待时间： <b id="wait"><?php echo ($waitSecond); ?></b></p>
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
		<a href=""><img src="/Public/images/xin.png" alt="" /></a>
		<a href=""><img src="/Public/images/kexin.jpg" alt="" /></a>
		<a href=""><img src="/Public/images/police.jpg" alt="" /></a>
		<a href=""><img src="/Public/images/beian.gif" alt="" /></a>
	</p>
</div>
<!-- 底部版权 end -->
<script type="text/javascript">
	$(function(){
		var wait = $('#wait').html();
		var href = $('#href').attr('href');
		var interval = setInterval(function(){
			var time = --wait;
			$('#wait').html(time);
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	});
</script>
</body>
</html>