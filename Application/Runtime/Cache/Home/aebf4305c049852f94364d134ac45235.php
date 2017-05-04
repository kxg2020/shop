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
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U();?>" method="post">
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
							<input type="password" class="txt" name="repassword" />
							<p> <span>请再次输入密码</p>
						</li>
						<li>
							<label for="">邮箱：</label>
							<input type="text" class="txt" name="email" />
							<p>邮箱必须合法</p>
						</li>
						<li>
							<label for="">手机号码：</label>
							<input type="text" class="txt" value="" name="phone" id="phone" placeholder=""/>
						</li>
						<li>
							<label for="">验证码：</label>
							<input type="text" class="txt" value="" placeholder="请输入短信验证码" name="captcha" disabled="disabled" id="captcha"/> <input type="button" onclick="bindPhoneNum($(this))" id="get_captcha" value="获取验证码" style="height: 25px;padding:3px 8px"/>
							
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode" />
							<img class="verifyCodeImg" src="<?php echo U('Login/verify');?>" alt="" />
							<span>看不清？<a href="javascript:;" onclick="changeVerify('<?php echo U("Login/verify");?>')">换一张</a></span>
						</li>
						
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" name="xieyi" value="1" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
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

	<script type="text/javascript" src="http://admin.shop.com/Public/layer/layer.js"></script>
	<!-- 底部版权 end -->
	<script type="text/javascript">

		function changeVerify(url){
			var _newUrl = url + '?verifyMath='+Math.random();
			$('.verifyCodeImg').attr('src', _newUrl);
		}

		function bindPhoneNum(){
			//启用输入框
			$('#captcha').prop('disabled',false);

			// 发送短信
			var _url = '<?php echo U("Login/sendsms");?>';
			var _phone = $('#phone').val();
			if(!_phone){
				layer.alert('请填写手机号码！');
				return false;
			}
			var _phoneReg = /^1[34578]\d{9}$/;
			if(!_phoneReg.test(_phone)){
				layer.alert('手机号码格式不对！');
				return false;
			}

			$.ajax({
				url: _url,
				type: 'POST',
				dataType: 'json',
				data: 'phone='+_phone,
				success: function(res){
					console.log(res);
				}
			});

			var time=30;
			var interval = setInterval(function(){
				time--;
				if(time<=0){
					clearInterval(interval);
					var html = '获取验证码';
					$('#get_captcha').prop('disabled',false);
				} else{
					var html = time + ' 秒后再次获取';
					$('#get_captcha').prop('disabled',true);
				}
				
				$('#get_captcha').val(html);
			},1000);
		}		
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