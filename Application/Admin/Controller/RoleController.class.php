<?php
namespace Admin\Controller;

use Admin\Curd\Common;

class RoleController extends CommonController
{
    public function index(){
        $where = [];
        $name = I('get.name', '');
        if($name){
            $where = ['like', "%$name%"];
        }
        $curd = new Common();
        $lists = $curd->showLists('Role', $where);
        $this->assign('lists', $lists);
        $this->display();
    }

    public function permission(){
        // 获取角色ID
        $id = I('get.id', 0, 'intval');
        // 查询角色信息
        $info = M('Role')->find($id);
        $this->assign('info', $info);

        if(IS_POST){
            // 获取传递过来的勾选的权限。是一个数组[1,2,3,4,5]
            $p = I('post.p');
            // 要存放插入数据库中的数据，他是一个二维数组；
            $data = [];
            //　循环拿出每一个被勾选的权限，并且找到他的上级
            foreach ($p as $key=>$xp){
                // 通过权限ID 查询到权限的信息
                $permission = M('Permission')->find($xp);
                if(!$permission){
                    continue;
                }
                // 查找所有上级信息
//                $parent_permission = M('Permission')->where([
//                    'left_key' => ['LT', $permission['left_key']],
//                    'right_key' => ['GT', $permission['right_key']],
//                ])->select();
//                if(!$parent_permission){
//                    continue;
//                }
                // 往二维数组内添加信息，为了使用addAll()
                $data[$key]['role_id'] = $id;
                $data[$key]['permission_id'] = $xp;
                $data[$key]['url'] = $permission['url'];
            }
            //
            M('RolePermission')->where([
                'role_id' => $id
            ])->delete();
            $res = M('RolePermission')->addAll($data);
            if(!$res){
                $this->error('失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }
        // 权限列表
        $pers = M('Permission')->order('left_key')->select();
        $this->assign('pers', $pers);

        // 查询我有些什么权限
        $permissions = M('RolePermission')->where(['role_id' => $id])->select();
        foreach ($permissions as &$p){
            $p = $p['permission_id'];
        }
        $this->assign('permissions', $permissions);

        $this->display();
    }
}