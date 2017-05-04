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
        <li> 供应商管理 </li>
        <li class="active"> 新增文章分类 </li>
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
                    新增文章分类
                </header>
                <div class="panel-body">
                    <form role="form" action="<?php echo U();?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">分类名称</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="请输入名字">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" value="1" checked /> 开启
                            </label>
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


</body>
</html>