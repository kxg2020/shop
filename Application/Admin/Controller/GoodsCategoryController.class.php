<?php
namespace Admin\Controller;

use Admin\Logic\DbMysqlLogic;
use Admin\Service\NestedSets;

class GoodsCategoryController extends CommonController
{

    public function index(){
        $lists = M('GoodsCategory')->where(['status' => 1])->order('lft')->select();
        $this->assign('lists', $lists);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $db = new DbMysqlLogic();
            $ns = new NestedSets($db, 'shop_goods_category', 'lft', 'rght', 'parent_id', 'id', 'level');
            $parent_id = I('post.parent_id', 0, 'intval');
            $data = [
                'name' => I('post.name'),
                'intro' => I('post.intro'),
                'status' => I('post.status', 0)
            ];
            $res = $ns->insert($parent_id, $data, 'bottom');
            if($res){
                $this->redirect('index');
            }else{
                $this->error('插入失败！');
            }
            exit;
        }
        $lists = M('GoodsCategory')->where(['status' => 1])->order('lft')->select();
        $data = ['id' => -1, 'name' => '一级分类', 't' => '', 'pId' => 0];
        array_unshift($lists, $data);
        foreach ($lists as &$v){
            $v['pId'] = $v['parent_id'];
            $v['t'] = $v['intro'];
            $v['open'] = true;
        }
        $lists = json_encode($lists);
        $this->assign('lists', $lists);

        $this->display();
    }

    public function edit($id){
        $id = intval($id);
        $info = M('GoodsCategory as a')
            ->field('a.*, b.name parent_name')
            ->join('left join shop_goods_category as b on b.id=a.parent_id')
            ->where(['a.id' => $id])
            ->find();
        $this->assign('info', $info);

        if(IS_POST){
            $parent_id = I('post.parent_id');
            $db = new DbMysqlLogic();
            $ns = new NestedSets($db, 'shop_goods_category', 'lft', 'rght', 'parent_id', 'id', 'level');

            if($parent_id != $info['parent_id']){
                $res = $ns->moveUnder($id, $parent_id);
            }
            $data['name'] = I('post.name');
            $data['intro'] = I('post.intro');
            $data['status'] = I('post.status', 0);
            $data['id'] = $id;
            M('GoodsCategory')->save($data);
            if(!$res){
                $this->error('编辑失败！');
                exit;
            }
            $this->redirect('index');
        }


        $lists = M('GoodsCategory')->order('lft')->select();
        $data = ['id' => -1, 'name' => '一级分类', 't' => '', 'pId' => 0];
        array_unshift($lists, $data);
        foreach ($lists as &$v){
            $v['pId'] = $v['parent_id'];
            $v['t'] = $v['intro'];
            $v['open'] = true;
            if($v['id'] == $info['parent_id']){
                $v['checked'] = true;
            }
        }
        $lists = json_encode($lists);
        $this->assign('lists', $lists);

        $this->display();
    }

    public function delete($id){
        $id = intval($id);
//
//        $db = new DbMysqlLogic();
//        $ns = new NestedSets($db, 'shop_goods_category', 'lft', 'rght', 'parent_id', 'id', 'level');
//        $res = $ns->delete($id);

        //
        $info = M('GoodsCategory')->find($id);
        // 执行修改将 status字段修改成 0
        $res = M('GoodsCategory')->where([
            'lft' => ['EGT', $info['lft']],
            'rght' => ['ELT', $info['rght']]
        ])->save(['status' => 0]);

        if(!$res){
            $this->error('删除失败！');
            exit;
        }
        $this->redirect('index');
    }
}