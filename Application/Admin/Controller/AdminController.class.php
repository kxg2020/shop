<?php
namespace Admin\Controller;

class AdminController extends CommonController
{

    public function index(){
//        echo 'index';
        $lists = M('Admin')->select();
        $this->assign('lists', $lists);

        // 获取所有的角色列表
        $roles = M('Role')->select();
        $this->assign('roles', $roles);
        $this->display();
    }

    public function getadminrole(){
        if(IS_AJAX){
            $admin_id = I('get.id');
            $lists = M('AdminRole')->where(['admin_id' => $admin_id])->select();
            $roles = [];
            foreach ($lists as $l){
                $roles[] = $l['role_id'];
            }
            $this->ajaxReturn($roles);
        }
    }
    
    public function setrole(){
        if(IS_AJAX){
            $id = I('get.id');
            $roles = I('get.roles'); // 1,2,3,4,5
            $roles = explode(',', $roles);
            $data = [];
            foreach ($roles as $key=>$r){
                $data[$key]['admin_id'] = $id;
                $data[$key]['role_id'] = $r;
            }
            // 新增之前删除
            M('AdminRole')->where(['admin_id' => $id])->delete();

            M('AdminRole')->addAll($data);

            $this->ajaxReturn(['status' => 1]);
        }
    }
}