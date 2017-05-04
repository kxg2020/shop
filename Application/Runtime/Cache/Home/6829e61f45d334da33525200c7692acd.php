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
		.error{color: red; padding: 0 10px;}
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

<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl"><a href="<?php echo u('Index/index');?>"><img src="/Public/images/logo.png" alt="京西商城"></a></h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl">
                    <input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">D-Link无线路由</a>
                <a href="">休闲男鞋</a>
                <a href="">TCL空调</a>
                <a href="">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        您好，请<a href="">登录</a>
                    </div>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="">用户信息></a></li>
                            <li><a href="">我的订单></a></li>
                            <li><a href="">收货地址></a></li>
                            <li><a href="">我的收藏></a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="">我的留言></a></li>
                            <li><a href="">我的红包></a></li>
                            <li><a href="">我的评论></a></li>
                            <li><a href="">资金管理></a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href=""><img src="/Public/images/view_list1.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/Public/images/view_list2.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/Public/images/view_list3.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt id="cartBtn" onmouseover="loadCartInfo()" onmouseout="return false;">
                    <a href="<?php echo u('Cart/index');?>">去购物车结算</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt" style="height: auto; line-height: 50px; padding: 20px;">
                        <table id="cartTopTable" width="100%">
                        </table>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->

    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <?php $u=CONTROLLER_NAME.'_'.ACTION_NAME;?>
        <!--  商品分类部分 start-->
        <?php if($u != 'Index_index'): $status='off';?>
            <?php $cname='cat1';?>
            <?php $cname1='none'; endif; ?>
        <div class="category fl <?php echo ($cname); ?>"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd <?php echo ($status); ?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>

            <div class="cat_bd <?php echo ($cname1); ?>">
                <?php if(is_array($gc)): $i = 0; $__LIST__ = $gc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i; if($g['level'] == 1): ?><div class="cat">
                            <h3><a href=""><?php echo ($g["name"]); ?></a><b></b></h3>
                            <div class="cat_detail none">
                                <?php if(is_array($gc)): $i = 0; $__LIST__ = $gc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g2): $mod = ($i % 2 );++$i; if($g2['parent_id'] == $g['id']): ?><dl>
                                            <dt><a href=""><?php echo ($g2['name']); ?></a></dt>
                                            <dd>
                                                <?php if(is_array($gc)): $i = 0; $__LIST__ = $gc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g3): $mod = ($i % 2 );++$i; if($g3['parent_id'] == $g2['id']): ?><a href=""><?php echo ($g3["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                            </dd>
                                        </dl><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
        <!--  商品分类部分 end-->

        <div class="navitems fl">
            <ul class="fl">
                <li class="current"><a href="">首页</a></li>
                <li><a href="">电脑频道</a></li>
                <li><a href="">家用电器</a></li>
                <li><a href="">品牌大全</a></li>
                <li><a href="">团购</a></li>
                <li><a href="">积分商城</a></li>
                <li><a href="">夺宝奇兵</a></li>
            </ul>
            <div class="right_corner fl"></div>
        </div>
    </div>
    <!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>


	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/Public/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10">
		<div class="login_hd">
			<h2>用户登录</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U();?>" id="loginForm" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<a href="">忘记密码?</a>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode" />
							<img src="<?php echo U('verify');?>" alt="" />
							<span>看不清？<a href="">换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb"  /> 保存登录信息
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				<div class="coagent mt15">
					<dl>
						<dt>使用合作网站登录商城：</dt>
						<dd class="qq"><a href=""><span></span>QQ</a></dd>
						<dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
						<dd class="yi"><a href=""><span></span>网易</a></dd>
						<dd class="renren"><a href=""><span></span>人人</a></dd>
						<dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
						<dd class=""><a href=""><span></span>百度</a></dd>
						<dd class="douban"><a href=""><span></span>豆瓣</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="guide fl">
				<h3>还不是商城用户</h3>
				<p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

				<a href="regist.html" class="reg_btn">免费注册 >></a>
			</div>

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

	<script>
		jQuery.validator.addMethod("userNameRegex", function(value, element) {
			var _reg = /^[\u4E00-\u9FA5\w]{3,20}$/;
			return _reg.test(value);
		}, "用户名必须是中文/字母、数字、下划线（3-20位）");
		jQuery.validator.addMethod('verifyCheck', function(value, element){
			var _reg = /^[a-zA-Z0-9]{5}$/;
			return _reg.test(value);
		}, '验证码错误');
//		$.validator.setDefaults({
//			submitHandler: function(form) {
				// 检测到数据验证成功，执行提交
//			}
//		});
		$('#loginForm').validate({
			rules: {
				username: {
					required: true,
					userNameRegex: true
				},
				password: {
					required: true,
					minlength: 6,
					maxlength: 20
				},
				checkcode: {
					required: true,
					verifyCheck: true
				}
			},
			messages: {
				username: {
					required: '用户名必须填写'
				},
				password: {
					required: '密码必须填写',
					minlength: '密码长度不能小于6位',
					maxlength: '密码长度不能大于20位'
				},
				checkcode: {
					required: '验证码必须填写'
				}
			},
			errorElement: "span",
//			submitHandler: function(form){
//				$(form).ajaxSubmit();
//			}
		});
	</script>

<script type="text/javascript">
    function loadCartInfo(){
        if($('#cartBtn').attr('data-o')){
            return false;
        }
        $('#cartBtn').attr('data-o', 1);
        // 发送AJAX请求，获取购物车信息
        var _url = '<?php echo U("Cart/getCateByIndex");?>';
        $.getJSON(_url, '', function(data){
            var _carts = data.data;
            var _html = '';
            $.each(_carts, function(index, value){
                _html += '<tr>' +
                        '<td width="40">' +
                        '<img src="'+ value.image +'" width="40" height="40"/>' +
                        '</td>' +
                        '<td>' +
                        '<a href="#">'+  value.name +'</a>' +
                        '</td>' +
                        '<td width="60">数量:'+ value.amount +'</td>' +
                        '</tr>';
            });
            $('#cartTopTable').html(_html);
        });
    }
</script>
</body>
</html>