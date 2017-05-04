<?php
namespace Admin\Controller;

use Admin\Logic\DbMysqlLogic;
use Admin\Service\NestedSets;

class PermissionController extends CommonController
{
    public function index(){
        $name = I('get.name', '');
        $where = [];
        if($name){
            $where['name'] = ['LIKE', "%$name%"];
        }
        $lists = M('Permission')->where($where)->order('left_key')->select();
        $this->assign('lists', $lists);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $dbLogic = new DbMysqlLogic();
            $nestedSets = new NestedSets($dbLogic, 'shop_permission', 'left_key', 'right_key', 'parent_id', 'id', 'level');
            $model = D('Permission');
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
                exit;
            }
            $parent_id = $data['parent_id'];
            unset($data['parent_id']);
            $res = $nestedSets->insert($parent_id, $data, 'bottom');
            if(!$res){
                $this->error('新增失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }
        $lists = M('Permission')->order('left_key')->select();
        $this->assign('lists', $lists);
        $this->display();
    }

    public function edit($id){
        $model = D('Permission');
        $id = intval($id);
        $info = $model->find($id);
        if(!$info){
            $this->error('未找到！');
            exit;
        }
        if(IS_POST){
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
                exit;
            }
            if($data['parent_id'] != $info['parent_id']){
                $dbLogic = new DbMysqlLogic();
                $nestedSets = new NestedSets($dbLogic, 'shop_permission', 'left_key', 'right_key', 'parent_id', 'id', 'level');
                $res = $nestedSets->moveUnder($id, $data['parent_id']);
                if(!$res){
                    $this->error('编辑失败！');
                    exit;
                }
            }
            $res = $model->where(['id' => $id])->save($data);
            if($res === false){
                $this->error('编辑失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }
        $this->assign('info', $info);
        $lists = M('Permission')->order('left_key')->select();
        $this->assign('lists', $lists);
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

        $dbLogic = new DbMysqlLogic();
        $nestedSets = new NestedSets($dbLogic, 'shop_permission', 'left_key', 'right_key', 'parent_id', 'id', 'level');

        $res = $nestedSets->delete($id);
        if(!$res){
            $this->error('删除失败！');
            exit;
        }
        $this->redirect('index');
    }
}