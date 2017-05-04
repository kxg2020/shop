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
    
    <link rel="stylesheet" href="http://admin.shop.com/Public/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">


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
        <li> 商品分类管理 </li>
        <li class="active"> 编辑商品分类</li>
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
                    编辑商品分类
                </header>
                <div class="panel-body">
                    <form role="form" action="<?php echo U('edit', ['id' => $info['id']]);?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">分类名称</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo ($info["name"]); ?>" placeholder="请输入名字">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">所属上级</label>
                            <input type="text" name="parent_name" value="<?php echo ($info["parent_name"]); ?>" />
                            <input type="hidden" name="parent_id" value="<?php echo ($info["parent_id"]); ?>" />
                            <div class="zTreeDemoBackground left">
                                <ul id="treeDemo" class="ztree"></ul>
                            </div>
                            <!--<select class="form-control" name="parent_id">-->
                                <!--<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>-->
                                    <!--<option value="<?php echo ($c["id"]); ?>" >-->
                                        <!--<?php $__FOR_START_1755__=1;$__FOR_END_1755__=$c['level'];for($i=$__FOR_START_1755__;$i < $__FOR_END_1755__;$i+=1){ ?>-->
                                            <!--&nbsp;&nbsp;-->
                                        <!--<?php } ?>-->
                                        <!--<?php echo ($c["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            <!--</select>-->
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">分类简介</label>
                            <textarea name="intro" class="form-control"></textarea>
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

    <script type="text/javascript" src="http://admin.shop.com/Public/ztree/js/jquery.ztree.core.js"></script>
    <SCRIPT type="text/javascript">
        <!--
        var setting = {
            data: {
                key: {
                    title:"t"
                },
                simpleData: {
                    enable: true
                }
            },
            callback: {
//                beforeClick: beforeClick,
                onClick: onClick
            }
        };
        var _str = '<?php echo ($lists); ?>';

        var zNodes = $.parseJSON(_str);

        var log, className = "dark";
//        function beforeClick(treeId, treeNode, clickFlag) {
//            className = (className === "dark" ? "":"dark");
//            showLog("[ "+getTime()+" beforeClick ]&nbsp;&nbsp;" + treeNode.name );
//            return (treeNode.click != false);
//        }
        function onClick(event, treeId, treeNode, clickFlag) {
            var _obj = $('input[name="parent_name"]');
            _obj.val(treeNode.name);
            if(treeNode.id <= 0){
                $('input[name="parent_id"]').val(0);
            }else {
                $('input[name="parent_id"]').val(treeNode.id);
            }
        }
//        function showLog(str) {
//            if (!log) log = $("#log");
//            log.append("<li class='"+className+"'>"+str+"</li>");
//            if(log.children("li").length > 8) {
//                log.get(0).removeChild(log.children("li")[0]);
//            }
//        }
//        function getTime() {
//            var now= new Date(),
//                    h=now.getHours(),
//                    m=now.getMinutes(),
//                    s=now.getSeconds();
//            return (h+":"+m+":"+s);
//        }

        $(document).ready(function(){
            $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            var treeObj = $.fn.zTree.getZTreeObj("treeDemo")
            var node = treeObj.getNodeByParam("id", '<?php echo ($info["parent_id"]); ?>');
            treeObj.selectNode(node)
        });
        //-->
    </SCRIPT>


</body>
</html>