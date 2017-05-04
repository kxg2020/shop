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
                        <li><a href="leftmenu_collapsed_view.html"> 商品分类管理</a></li>
                        <li><a href="horizontal_menu.html"> 商品列表</a></li>

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
                        <li><a href="form_layouts.html"> 网站基本设置</a></li>
                        <li><a href="form_advanced_components.html"> 支付管理</a></li>
                        <li><a href="form_wizard.html"> 活动管理</a></li>
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
        <li> 品牌管理 </li>
        <li class="active"> 编辑品牌 </li>
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
                    编辑品牌
                </header>
                <div class="panel-body">
                    <form role="form" action="<?php echo U('edit', ['id' => $info['id']]);?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                        <div class="form-group">
                            <label for="exampleInputEmail1">品牌名称</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo ($info["name"]); ?>" placeholder="请输入名字">
                        </div>
                        <div class="form-group">
                            <label>简介</label>
                            <textarea class="form-control" name="intro"><?php echo ($info["intro"]); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>品牌LOGO</label>
                            <input type="file" class="form-control" name="logo" placeholder="">
                            <?php if($info['logo']): ?><p class="form-control-static">
                                    <img src="<?php echo ($info["logo"]); ?>" />
                                </p><?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>状态</label>
                            <input type="radio" name="status" value="1" <?php if($info['status'] == 1): ?>checked<?php endif; ?> />正常
                            <input type="radio" name="status" value="0" <?php if($info['status'] == 0): ?>checked<?php endif; ?> />关闭
                        </div>
                        <button type="submit" class="btn btn-primary">提交修改</button>
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

</body>
</html>