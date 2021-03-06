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
                <li><a href="/"><i class="fa fa-home"></i> <span>管理首页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>商品管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Supplier/index');?>"> 供应商管理</a></li>
                        <li><a href="<?php echo U('Brand/index');?>"> 品牌管理</a></li>
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

                <li class="menu-list"><a href=""><i class="fa fa-envelope"></i> <span>文章管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('ArticleCategory/index');?>"> 文章分类管理</a></li>
                        <li><a href="<?php echo U('Article/index');?>"> 文章列表</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-tasks"></i> <span>系统设置</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Admin/index');?>"> 管理员列表</a></li>
                        <li><a href="<?php echo U('Role/index');?>"> 角色列表</a></li>
                        <li><a href="<?php echo U('Permission/index');?>"> 权限列表</a></li>
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
                            <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        <!-- page heading start-->
        

    <!-- page heading start-->
    <div class="page-heading">
        <h3>
            管理首页
        </h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">管理后台</a>
            </li>
            <li class="active"> 管理员列表 </li>
        </ul>
    </div>
    <!-- page heading end-->

    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        管理员列表
                            <span class="tools pull-right">
                                <a href="<?php echo U('add');?>" class="btn btn-success btn-link">新增</a>
                            </span>
                    </header>
                    <div class="panel-body">
                        <form class="form-inline" action="<?php echo U();?>">
                            <div class="form-group">
                                <label for="exampleInputName2">管理员</label>
                                <input type="text" class="form-control" id="exampleInputName2" name="name" value="<?php echo I('get.name');?>">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                        <hr/>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>编号ID</th>
                                    <th>账号</th>
                                    <th>密码</th>
                                    <th>真实姓名</th>
                                    <th>电话</th>
                                    <th>创建时间</th>
                                    <th>最后登录IP</th>
                                    <th>最后登录时间</th>
                                    <th class="hidden-phone">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="gradeX">
                                        <td><?php echo ($list["id"]); ?></td>
                                        <td><?php echo ($list["username"]); ?></td>
                                        <td></td>
                                        <td><?php echo ($list["truename"]); ?></td>
                                        <td><?php echo ($list["phone"]); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', $list['create_time']);?></td>
                                        <td><?php echo ($list["last_login_ip"]); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', $list['last_login_time']);?></td>
                                        <td>
                                            <a href="<?php echo U('edit', array('id' => $list['id']));?>" class="btn btn-xs btn-success">编辑</a>
                                            <a href="<?php echo U('role', array('id' => $list['id']));?>" data-toggle="modal" data-id="<?php echo ($list['id']); ?>" data-target="#myRole" class="btn btn-xs btn-info" onclick="getAdminRole($(this))">所属角色</a>
                                            <a data-href="<?php echo U('delete', array('id' => $list['id']));?>" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-xs deleteBtn">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <?php echo ($pages); ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示：Notice!</h4>
                </div>
                <div class="modal-body">
                    亲！你确认要删除吗？删除了没有办法恢复哟~么么哒！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">好的，我不删除了</button>
                    <a href="" id="deleteTrue" class="btn btn-primary">滚！狠心删除</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">修改管理员所属角色</h4>
                </div>
                <div class="modal-body" id="box">
                    角色列表：
                    <?php if(is_array($roles)): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><input type="checkbox" class="roleName" value="<?php echo ($r["id"]); ?>" /> <?php echo ($r["role_name"]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">不改了</button>
                    <a href="javascript:;" onclick="setRole()" class="btn btn-primary">执行修改</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('.deleteBtn').click(function(){
                var _link = $(this).attr('data-href');
                $('#deleteTrue').attr('href', _link);
            })
        });

        function getAdminRole(obj){
            $('.roleName').prop('checked', false);
            var _id = obj.attr('data-id');
            $('#box').attr('data-id', _id);
            $.getJSON('<?php echo U("Admin/getadminrole");?>', "id="+_id, function(res){
                for(var i in res){
                    $('.roleName[value="'+res[i]+'"]').prop('checked', true);
                }
            });
        }

        function setRole(){
            var _roles = new Array;
            var _id = $('#box').attr('data-id');
            $('.roleName:checked').val(function(index, value){
                _roles.push(value);
                return value;
            });
            _roles = _roles.join(',');
            $.getJSON('<?php echo U("Admin/setrole");?>', 'id='+_id+'&roles='+_roles, function(res){
                $('.closeBtn').click();
            })
        }
    </script>

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