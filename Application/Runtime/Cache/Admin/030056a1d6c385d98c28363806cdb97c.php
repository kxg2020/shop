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
                <li <?php if($urlStr == 'index_index'): ?>class="active"<?php endif; ?> ><a href="/"><i class="fa fa-home"></i> <span>管理首页</span></a></li>
                <li class="menu-list <?php if(in_array($urlStr,['supplier_index', 'brand_index', 'supplier_add','supplier_edit', 'brand_add', 'brand_edit'])): ?>active<?php endif; ?>"><a href=""><i class="fa fa-laptop"></i> <span>商品管理</span></a>
                    <ul class="sub-menu-list">
                        <li <?php if(in_array($urlStr,['supplier_index', 'supplier_add','supplier_edit'])): ?>class="active"<?php endif; ?>><a href="<?php echo U('Supplier/index');?>"> 供应商管理</a></li>
                        <li <?php if(in_array($urlStr,['brand_index', 'brand_add','brand_edit'])): ?>class="active"<?php endif; ?>><a href="<?php echo U('Brand/index');?>"> 品牌管理</a></li>
                        <li><a href="<?php echo U('GoodsCategory/index');?>"> 商品分类管理</a></li>
                        <li><a href="<?php echo U('Goods/index');?>"> 商品列表</a></li>

                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>订单管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="general.html"> 订单列表</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>会员管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="grids.html"> 会员列表</a></li>

                    </ul>
                </li>

                <li class="menu-list <?php if(in_array($urlStr,['articlecategory_index', 'articlecategory_add','articlecategory_edit', 'article_index', 'article_add','article_edit'])): ?>active<?php endif; ?>"><a href=""><i class="fa fa-envelope"></i> <span>文章管理</span></a>
                    <ul class="sub-menu-list">
                        <li <?php if(in_array($urlStr,['articlecategory_index', 'articlecategory_add','articlecategory_edit'])): ?>class="active"<?php endif; ?>><a href="<?php echo U('ArticleCategory/index');?>"> 文章分类管理</a></li>
                        <li <?php if(in_array($urlStr,['article_index', 'article_add','article_edit'])): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/index');?>"> 文章列表</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-tasks"></i> <span>系统设置</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('');?>"> 管理员列表</a></li>
                        <li><a href="form_advanced_components.html"> 角色列表</a></li>
                        <li><a href="form_wizard.html"> 权限列表</a></li>
                    </ul>
                </li>

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
                            <li><a href="#"><i class="fa fa-sign-out"></i> 退出</a></li>
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
        <li class="active"> 商品相册 </li>
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
                    商品相册
                </header>
                <div class="panel-body">
                    <div class="">
                        <button id="file_upload_1"></button>
                        <!--<input type="file" class="form-control" name="logo" placeholder="">-->
                        <input type="hidden" name="image" />
                    </div>
                    <div class="row imgBox">
                        <?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><div class="col-xs-2 col-md-2 thumbnail">
                                <img src="<?php echo ($img["path"]); ?>" alt="..." width="100%">
                                <div class="caption">
                                    <p><a href="javascript:;" class="btn btn-danger btn-xs" data-id="<?php echo ($img["id"]); ?>" onclick="abc($(this))" role="button">删除</a></p>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
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
            var _id = '<?php echo ($goods["id"]); ?>';
            $("#file_upload_1").uploadify({
                width: 100,
                height: 100,
                // 加载FLASH文件
                swf           : '/Public/uploadify/uploadify.swf',
                // 指定处理文件上传的后台地址
                uploader      : '<?php echo U("Goods/upload");?>',
                // 按钮样式
                buttonClass: 'shangchuanBtn',
                // 按钮文本内容
                buttonText: '+',
                // 最大允许上传的文件大小，单位： KB
                fileSizeLimit: 2048,
                // 允许上传的文件后缀
                fileTypeExts: '*.jpg;*.png;*.gif',
                // 在上传的同时传递给后台的参数（POST）
                formData: {'goods_id': _id}, // REQUEST                // 关闭多文件上传 默认为true
                multi: true,
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
                        var _html = $('<div class="col-xs-2 col-md-2 thumbnail"><img src="'+ _img +'" alt="..." width="100%"> <div class="caption"> <p><a href="javascript:;" class="btn btn-danger btn-xs" data-id="'+ data.imgId +'" onclick="abc($(this))" role="button">删除</a></p></div></div>');
                        $('.imgBox').append(_html);
                    }
                }
            });
        });

        function abc(obj){
            var _id = obj.attr('data-id');
            $.ajax({
                type: 'POST',
                dataType: 'Json',
                url: '<?php echo U("Goods/deleteimg");?>',
                data: {"imgid": _id},
                success: function(response){
                    //
                    console.log(response);
                    if(response.status){
                        // 移除DOM结构
                        obj.closest('.thumbnail').remove();
                    }
                }
            });
        }
    </script>


</body>
</html>