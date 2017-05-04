<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/Public/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/footer.css" type="text/css">

	<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/js/cart2.js"></script>

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
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="<?php echo u('Index/index');?>"><img src="/Public/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
				<div class="address_info">
				<p>
					<?php if(is_array($userAddress)): $i = 0; $__LIST__ = $userAddress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ua): $mod = ($i % 2 );++$i;?><input type="radio" <?php if($ua['status'] == 1): ?>checked<?php endif; ?> value="<?php echo ($ua["id"]); ?>" name="address_id"/><?php echo ($ua["name"]); ?>  <?php echo ($ua["phone"]); ?> <?php echo ($ua["pca"]); ?> <?php echo ($ua["address"]); ?> </p><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

				<div class="address_select none">
					<ul>
						<?php if(is_array($userAddress)): $i = 0; $__LIST__ = $userAddress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ua): $mod = ($i % 2 );++$i;?><li class="cur">
							<input type="radio" name="address" <?php if($ua['status'] == 1): ?>checked<?php endif; ?> /><?php echo ($ua["name"]); ?> <?php echo ($ua["pca"]); ?> <?php echo ($ua["address"]); ?> <?php echo ($ua["phone"]); ?>
							<?php if($ua['status'] != 1): ?><a href="<?php echo U('User/changeStatus', ['id' => $ua['id']]);?>">设为默认地址</a><?php endif; ?>
							<a href="javascript:;" class="editAddress" data-id="<?php echo ($ua["id"]); ?>">编辑</a>
							<a href="">删除</a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li><input type="radio" name="address" class="new_address"  />使用新地址</li>
					</ul>	
					<form id="addAddress" method="post" action="<?php echo U('User/addAddress');?>" class="none" name="address_form">
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="name" class="txt" />
							</li>
							<li>
								<label for=""><span>*</span>所在地区：</label>
								<select name="p_id" id="pcheck">
									<option value="">请选择</option>
									<?php if(is_array($ps)): $i = 0; $__LIST__ = $ps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>

								<select name="c_id" id="ccheck">
									<option value="">请选择</option>
								</select>

								<select name="a_id" id="acheck">
									<option value="">请选择</option>
								</select>
							</li>
							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="address" class="txt address"  />
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="phone" class="txt" />
							</li>
						</ul>
					</form>
					<a href="javascript:;" class="confirm_btn saveAddress"><span>保存收货人信息</span></a>
				</div>
			</div>
			<!-- 收货人信息  end-->

			<!-- 配送方式 start -->
			<div class="delivery">
				<h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
				<div class="delivery_info">
					<?php if(is_array($deliverys)): $i = 0; $__LIST__ = $deliverys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i; if($d['is_default'] == 1): ?><p id="delivery"><?php echo ($d["name"]); ?></p><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<!--<p>送货时间不限</p>-->
				</div>

				<div class="delivery_select none">
					<table>
						<thead>
							<tr>
								<th class="col1">送货方式</th>
								<th class="col2">运费</th>
								<th class="col3">运费标准</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($deliverys)): $i = 0; $__LIST__ = $deliverys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><tr <?php if($d['is_default'] == 1): ?>class="cur"<?php endif; ?>>
								<td>
									<input data-name="<?php echo ($d["name"]); ?>" value="<?php echo ($d["id"]); ?>" type="radio" data-price="<?php echo ($d["price"]); ?>" name="delivery" <?php if($d['is_default'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo ($d["name"]); ?>
								</td>
								<td>￥<?php echo ($d["price"]); ?></td>
								<td><?php echo ($d["intro"]); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<a href="javascript:;" onclick="editDelivery()" class="confirm_btn"><span>确认送货方式</span></a>
				</div>
			</div> 
			<!-- 配送方式 end --> 

			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
				<div class="pay_info">
					<?php if(is_array($payments)): $i = 0; $__LIST__ = $payments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if($p['is_default'] == 1): ?><p id="paymentName"><?php echo ($p["name"]); ?></p><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>

				<div class="pay_select none">
					<table>
						<?php if(is_array($payments)): $i = 0; $__LIST__ = $payments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><tr <?php if($p['is_default'] == 1): ?>class="cur"<?php endif; ?>>
								<td class="col1"><input data-name="<?php echo ($p["name"]); ?>" value="<?php echo ($p["id"]); ?>" <?php if($p['is_default'] == 1): ?>checked<?php endif; ?> type="radio" name="pay" /><?php echo ($p["name"]); ?></td>
								<td class="col2"><?php echo ($p["intro"]); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</table>
					<a href="javascript:;" onclick="editPayment()" class="confirm_btn"><span>确认支付方式</span></a>
				</div>
			</div>
			<!-- 支付方式  end-->

			<!-- 发票信息 start-->
			<div class="receipt">
				<h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
				<div class="receipt_info">
					<p id="invoiceName">个人发票</p>
					<p id="invoiceContent">内容：明细</p>
				</div>

				<div class="receipt_select none">
					<form action="">
						<ul>
							<li>
								<label for="">发票抬头：</label>
								<input type="radio" name="invoiceType" checked="checked" value="个人" class="personal" />个人
								<input type="radio" value="单位" name="invoiceType" class="company"/>单位
								<input type="text" name="invoiceName" class="txt company_input" disabled="disabled" />
							</li>
							<li>
								<label for="">发票内容：</label>
								<input type="radio" value="明细" name="content" checked="checked" />明细
								<input type="radio" value="办公用品" name="content" />办公用品
								<input type="radio" value="体育休闲" name="content" />体育休闲
								<input type="radio" value="耗材" name="content" />耗材
							</li>
						</ul>						
					</form>
					<a href="javascript:;" onclick="editInvoice()" class="confirm_btn"><span>确认发票信息</span></a>
				</div>
			</div>
			<!-- 发票信息 end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>
					<?php $allCount=0;?>
					<?php $allMoney=0;?>
						<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><tr>
								<td class="col1"><a href=""><img src="<?php echo ($g["image"]); ?>" alt="" /></a> <strong><a href=""><?php echo ($g["name"]); ?></a></strong></td>
								<td class="col3">￥<?php echo ($g["shop_price"]); ?></td>
								<td class="col4"><?php echo ($g["amount"]); if($g['stock'] < $g['amount']): ?>[库存不足]<?php endif; ?></td>
								<td class="col5"><span>￥<?php echo ($g['allmoney']); ?></span></td>
							</tr>
							<?php $allCount += $g['amount'];?>
							<?php $allMoney += $g['allmoney']; endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li>
										<span><?php echo ($allCount); ?> 件商品，总商品金额：</span>
										<em id="orderAllMoney" data-price="<?php echo ($allMoney); ?>">￥<?php echo ($allMoney); ?></em>
									</li>
									<!--<li>-->
										<!--<span>返现：</span>-->
										<!--<em>-￥240.00</em>-->
									<!--</li>-->
									<li>
										<span>运费：</span>
										<em class="d_price">￥10.00</em>
									</li>
									<li>
										<span>应付总额：</span>
										<em class="orderMoney">￥5076.00</em>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 商品清单 end -->
		
		</div>

		<div class="fillin_ft">
			<a href="javascript:;" onclick="submitOrder()"><span>提交订单</span></a>
			<p>应付总额：<strong class="orderMoney">￥5076.00元</strong></p>
			
		</div>
	</div>
	<!-- 主体部分 end -->

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
<script type="text/javascript" src="/Public/js/selectPca.js"></script>
</body>
</html>