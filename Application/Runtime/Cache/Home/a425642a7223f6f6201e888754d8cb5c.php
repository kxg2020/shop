<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>登录商城</title>
    <link rel="stylesheet" href="/Public/style/base.css" type="text/css">
    <link rel="stylesheet" href="/Public/style/global.css" type="text/css">
    <link rel="stylesheet" href="/Public/style/header.css" type="text/css">
    <link rel="stylesheet" href="/Public/style/index.css" type="text/css">
    <link rel="stylesheet" href="/Public/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="/Public/style/footer.css" type="text/css">
    
	<link rel="stylesheet" href="/Public/style/login.css" type="text/css">
	<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/validate/dist/jquery.validate.js"></script>
	<style>
		.ArticleBox{width: 1200px; margin: 0 auto;}

		h1{font-size: 20px; font-weight: bold; text-align: center;}
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
                <li>您好，欢迎来到京西！[
                    <?php if($userInfo): echo ($userInfo['username']); ?> <a href="<?php echo U('Login/logout');?>">退出</a> <?php else: ?><a href="<?php echo U('Login/index');?>">登录</a>] [<a href="<?php echo U('Login/regist');?>">免费注册</a><?php endif; ?>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>


	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/Public/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->

	<!-- 登录主体部分start -->
	<div class="ArticleBox">
		<h1><?php echo ($article["title"]); ?></h1>
		<p style="text-align: center;">发布时间：<?php echo date('Y-m-d H:i', $article['create_time']);?> 点击量：<?php echo ($article["hits"]); ?></p>
		<div class="articleContent">
			<?php echo htmlspecialchars_decode($article['content']);?>
		</div>
	</div>
	<!-- 登录主体部分end -->

	<div style="clear:both;"></div>


<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
    <div class="bnav1">
        <h3><b></b> <em>购物指南</em></h3>
        <ul>
            <li><a href="">购物流程</a></li>
            <li><a href="">会员介绍</a></li>
            <li><a href="">团购/机票/充值/点卡</a></li>
            <li><a href="">常见问题</a></li>
            <li><a href="">大家电</a></li>
            <li><a href="">联系客服</a></li>
        </ul>
    </div>

    <div class="bnav2">
        <h3><b></b> <em>配送方式</em></h3>
        <ul>
            <li><a href="">上门自提</a></li>
            <li><a href="">快速运输</a></li>
            <li><a href="">特快专递（EMS）</a></li>
            <li><a href="">如何送礼</a></li>
            <li><a href="">海外购物</a></li>
        </ul>
    </div>


    <div class="bnav3">
        <h3><b></b> <em>支付方式</em></h3>
        <ul>
            <li><a href="">货到付款</a></li>
            <li><a href="">在线支付</a></li>
            <li><a href="">分期付款</a></li>
            <li><a href="">邮局汇款</a></li>
            <li><a href="">公司转账</a></li>
        </ul>
    </div>

    <div class="bnav4">
        <h3><b></b> <em>售后服务</em></h3>
        <ul>
            <li><a href="">退换货政策</a></li>
            <li><a href="">退换货流程</a></li>
            <li><a href="">价格保护</a></li>
            <li><a href="">退款说明</a></li>
            <li><a href="">返修/退换货</a></li>
            <li><a href="">退款申请</a></li>
        </ul>
    </div>

    <div class="bnav5">
        <h3><b></b> <em>特色服务</em></h3>
        <ul>
            <li><a href="">夺宝岛</a></li>
            <li><a href="">DIY装机</a></li>
            <li><a href="">延保服务</a></li>
            <li><a href="">家电下乡</a></li>
            <li><a href="">京东礼品卡</a></li>
            <li><a href="">能效补贴</a></li>
        </ul>
    </div>
</div>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
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

</body>
</html>