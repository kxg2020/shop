<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">
    <link rel="shortcut icon" href="http://admin.shop.com/Public/images/logo.ico" />
    <title>AdminX</title>

    <!--common-->
    <link rel="stylesheet" type="text/css" href="http://admin.shop.com/Public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="http://admin.shop.com/Public/css/style-responsive.css" />
    
    <link rel="stylesheet" type="text/css" href="/Public/uploadify/uploadify.css" />
    <style>
        #file_upload_1{height: 100px!important;}
        .shangchuanBtn{width: 100px!important; height: 100px!important; line-height: 100px!important; background: white; border: 1px dashed #aaa; border-radius: 0; font-size: 30px; font-weight: bold; color: #666;}
        .shangchuanBtn:hover{background: #f5f5f5!important;}
    </style>


    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery-1.10.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/html5shiv.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="http://admin.shop.com/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="http://admin.shop.com/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu['level'] == 1): ?><!--判断是否有下级分类-->
                        <?php $hasChild = checkHasChild($menu['id'], $menus);?>
                    <li <?php if($hasChild): ?>class="menu-list"<?php endif; ?> ><a href="<?php echo U(str_replace('_', '/',$menu['url']));?>"><i class="fa fa-home"></i> <span><?php echo ($menu["name"]); ?></span></a>
                        <?php if($hasChild): ?><ul class="sub-menu-list">
                                <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$men): $mod = ($i % 2 );++$i; if($men['parent_id'] == $menu['id']): ?><li><a href="<?php echo U(str_replace('_', '/',$men['url']));?>"> <?php echo ($men["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul><?php endif; ?>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <!--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>商品管理</span></a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li><a href="<?php echo U('Supplier/index');?>"> 供应商管理</a></li>-->
                        <!--<li><a href="<?php echo U('Brand/index');?>"> 品牌管理</a></li>-->
                        <!--<li><a href="<?php echo U('GoodsCategory/index');?>"> 商品分类管理</a></li>-->
                        <!--<li><a href="<?php echo U('Goods/index');?>"> 商品列表</a></li>-->
                    <!--</ul>-->
                <!--</li>-->
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="搜索" />
            </form>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="http://admin.shop.com/Public/images/photos/user-avatar.png" alt="" />
                            涛哥
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  个人资料</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  修改密码</a></li>
                            <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        <!-- page heading start-->
        
<div class="page-heading">
    <h3>
        管理首页
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">管理后台</a>
        </li>
        <li> 商品管理 </li>
        <li class="active"> 新增商品 </li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<section class="wrapper">
    <!-- page start-->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    新增商品
                </header>
                <div class="panel-body">
                    <form role="form" action="<?php echo U();?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">商品名称</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="请输入名字">
                        </div>
                        <div class="form-group">
                            <label>分类</label>
                            <select name="goods_category_id" class="form-control">
                                <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>所属品牌</label>
                            <select name="brand_id" class="form-control">
                                <?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brand["id"]); ?>"><?php echo ($brand["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>所属供应商</label>
                            <select name="supplier_id" class="form-control">
                                <?php if(is_array($suppliers)): $i = 0; $__LIST__ = $suppliers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><option value="<?php echo ($s["id"]); ?>"><?php echo ($s["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>商品市场价</label>
                            <input type="text" class="form-control" name="market_price">
                        </div>
                        <div class="form-group">
                            <label>商品本店价</label>
                            <input type="text" class="form-control" name="shop_price">
                        </div>
                        <div class="form-group">
                            <label>商品库存</label>
                            <input type="text" class="form-control" name="stock">
                        </div>
                        <div class="form-group">
                            <label>商品状态</label>
                            <input type="checkbox" name="goods_status[]" value="1">精品
                            <input type="checkbox" name="goods_status[]" value="2">新品
                            <input type="checkbox" name="goods_status[]" value="4">热销
                        </div>
                        <div class="form-group">
                            <label>是否上架</label>
                            <input type="radio" name="is_on_sale" value="0">下架
                            <input type="radio" name="is_on_sale" value="1" checked>上架
                        </div>
                        <div class="form-group">
                            <label>商品图片</label>
                            <button id="file_upload_1"></button>
                            <!--<input type="file" class="form-control" name="logo" placeholder="">-->          <div class="imgBox">

                            </div>
                            <input type="hidden" name="image" />
                        </div>

                        <div class="form-group">
                            <label>状态</label>
                            <input type="radio" name="status" value="1" checked />正常
                            <input type="radio" name="status" value="0" />关闭
                        </div>
                        <div class="form-group">
                            <label>自定义排序</label>
                            <input type="text" class="form-control" name="sort">
                        </div>
                        <button type="submit" class="btn btn-primary">提交新增</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
</section>

        <!-- page heading end-->


        <!--footer section start-->
        <footer>
            2014 &copy; AdminEx by ThemeBucket
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script type="text/javascript" src="http://admin.shop.com/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/js/scripts.js"></script>

    <!--引入uploadify-->
    <script type="text/javascript" src="/Public/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="/Public/layer/layer.js"></script>
    <script>
        $(function() {
            $("#file_upload_1").uploadify({
                width: 100,
                height: 100,
                // 加载FLASH文件
                swf           : '/Public/uploadify/uploadify.swf',
                // 指定处理文件上传的后台地址
                uploader      : '<?php echo U("Brand/upload");?>',
                // 按钮样式
                buttonClass: 'shangchuanBtn',
                // 按钮文本内容
                buttonText: '+',
                // 最大允许上传的文件大小，单位： KB
                fileSizeLimit: 2048,
                // 允许上传的文件后缀
                fileTypeExts: '*.jpg;*.png;*.gif',
                // 在上传的同时传递给后台的参数（POST）
                formData: {'abc': "TEXT"}, // REQUEST                // 关闭多文件上传 默认为true
                multi: false,
//                onQueueComplete: function(queueData){
//                    // 队列上传完成触发的事件
//                    console.log(queueData);
//                }
//                onSelectError: function(file, errorCode, errorMsg){
//                    console.log(file)
//                    console.log(errorCode)
//                    console.log(errorMsg)
//                    errorMsg = '出错了';
//                    alert('出错了！');
//                    return false;
//                },
//                onUploadComplete: function(file){
//                    console.log(file.name);
//                }
                // 上传成功！
                onUploadSuccess: function(file, data, response) {
                    // file 指的是本地的文件信息
                    // data 服务器返回的数据
                    // response 响应信息
                    data = $.parseJSON(data); // 将JSON字符串转换成JSON格式 JS里的对象
                    if(data.status == 0){
                        // 上传失败！
                        layer.msg(data.msg, {
                            time: 10000
                        });
                    }else{
                        // 上传成功
                        var _img = data.img;
                        var _html = "<img src='"+ _img +"' width='100' height='100' />";
                        $('.imgBox').html(_html);
                        $('input[name="image"]').val(_img);
                    }
                    console.log(data);
                }
            });
        });
    </script>


</body>
</html>