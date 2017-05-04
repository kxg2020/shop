<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index(){
        $rememberToken = cookie(md5('admin_remember_token'));
        if($rememberToken){
            // 直接查找用户
            $user = M('Admin')->where([
                'remember_token' => $rememberToken,
            ])->find();
            if($user){
                // 存入sesison 并且跳转
                session('admin', $user);
                $this->redirect('Index/index');
            }
        }
        if(IS_POST){
//            if(!M()->autoCheckToken(I('post.'))){
//                $this->error('表单令牌错误！');
//                exit;
//            }
            // 验证规则
//            $rule = [
//                ['username', '/^[a-zA-Z][a-zA-Z0-9_]{4,11}$/', '用户名不符合规则', 1],
//                ['password', '6,12', '密码必须是6-12位', 1, 'length'],
//            ];

            $data = D('Admin')->create(I('post.'), 4);
            if(!$data){
                $this->error(D('Admin')->getError());
                exit;
            }

            // 查找用户 通过 username
            $user = M('Admin')->where([
                'username' => I('post.username'),
            ])->find();
            if(!$user){
                $this->error('用户名或密码错误！');
                exit;
            }

            // 匹配密码
            $password = md5(I('post.password'));
            if($password != $user['password']){
                $this->error('用户名或密码错误！');
                exit;
            }

            // 成功

            // 查询我拥有的权限
            // 1. 查询我的角色
            $myRoles = M('AdminRole')->where([
                'admin_id' => $user['id']
            ])->select();

            // 查询我拥有的权限列表
            $allMyPermission = [];
            foreach ($myRoles as $rl){
                $myPermission = M('RolePermission')->where([
                    'role_id' => $rl['role_id']
                ])->select();
                foreach ($myPermission as $m){
                    $urlInfo = explode('_', $m['url']);
                    $allMyPermission[] = $urlInfo[0];
                }
            }
            $allMyPermission = array_unique($allMyPermission);
            session('mypermission', $allMyPermission);
            session('admin', $user);

            // 是否记住我！
            if(I('post.rememberMe', 0) == 1){
                // 勾选了记住我！ 生成TOKEN
                $token = md5(microtime() .'@!#$%^&*('. rand(0, 1000000));
                M('Admin')->save([
                    'id' => $user['id'],
                    'remember_token' => $token,
                ]);
                // 在COOKIE中也保存一个TOKEN
                cookie(md5('admin_remember_token'), $token, 7*24*3600);
            }

            $this->redirect('Index/index');
            exit;
        }
        $this->display();
    }

    public function logout(){
        session('admin', null);
        cookie(md5('admin_remember_token'), null);
        $this->redirect('index');
    }
}