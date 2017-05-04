<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize(){
        // 判断用户是否登录
        if(!session('admin')){
            $this->redirect('Login/index');
            exit;
        }
        // 获取当前请求的控制器和操作
        $str = strtolower(CONTROLLER_NAME .'_'.ACTION_NAME);
        // supplier_index
        $this->assign('urlStr', $str);

        // 查询菜单列表
        $menus = M('Permission')->order('left_key')->select();
        $this->assign('menus', $menus);
    }

    public function add(){
        $modelName = CONTROLLER_NAME;
        if(IS_POST){
            $model = D($modelName);
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
                exit;
            }
            $res = $model->add();
            if(!$res){
                $this->error('新增失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }
        $this->display();
    }

    public function edit($id){
        $modelName = CONTROLLER_NAME;
        $id = intval($id);
        $role = M($modelName)->find($id);
        if(!$role){
            $this->error('未找到！');
            exit;
        }

        if(IS_POST){
            $data = D($modelName)->create();
            if(!$data){
                $this->error(D($modelName)->getError());
                exit;
            }
            if($data['id'] != $id){
                $this->error('ID不能修改！');
                exit;
            }
            $res = D($modelName)->save();
            if(!$res){
                $this->error('编辑失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }

        $this->assign('info', $role);
        $this->display();
    }


    public function delete($id){
        $modelName = CONTROLLER_NAME;
        $id = intval($id);
        $role = M($modelName)->find($id);
        if(!$role){
            $this->error('未找到！');
            exit;
        }
        $res = M($modelName)->where(['id' => $id])->delete();
        if(!$res){
            $this->error('删除失败！');
            exit;
        }
        $this->redirect('index');
    }
}