<?php
namespace Admin\Behavior;

use Think\Behavior;

class RbacBehavior extends Behavior
{

    protected $allowUrl = [
        'index_index', 'login_index', 'login_logout', 'cli_index'
    ];

    public function run(&$params){
        // 让所有人都访问首页。首页不用进行权限检测！ Index_index
        $controller = strtolower(CONTROLLER_NAME);
        $action = strtolower(ACTION_NAME);
        $con_action = $controller . '_' . $action;

        if(in_array($con_action, $this->allowUrl)){
            // 不用进行控制
            return ;
        }

        // 让用户名为 admin 的人为超级管理员，不用验证权限
        $user = session('admin');
        // 查询用户所属的角色是否为 1
//        $adminRole = M('AdminRole')->where([
//            'admin_id' => $user['id'],
//            'role_id' => 1
//        ])->find();
//        if($adminRole){
//            return ;
//        }
        if($user['username'] == 'admin'){
            // 假设名字为admin的人，就是超级管理员
            return ;
        }

        // 检查当前用户是否有权限操作当前控制器-操作
        $myPermission = session('mypermission');
        if(!$myPermission){
            // 没有权限
            redirect(U('Index/index'), 2, '你没有权限');
            exit;
        }

        // 判断是否有权限访问当前控制器和操作

        if(!in_array($controller, $myPermission)){
            // 没有权限
            redirect(U('Index/index'), 2, '你没有权限');
            exit;
        }
    }
}