<?php
namespace Home\Controller;

class UserController extends CommonController
{

    public function _initialize(){
        parent::_initialize();
        // 检测用户是否登录，没有登录不能继续执行
        if(!$this->isLogin){
            $this->redirect('Login/index');
            exit;
        }
    }

    public function addAddress(){
        C('TOKEN_ON', false);
        !IS_POST && exit;
        $model = D('UserAddress');
        if(!$data = $model->create()){
            $this->error($model->getError());
            exit;
        }
        if($data['id']){
            if(!$model->where(['id' => $data['id'], 'user_id' => $this->userInfo['id']])->save()){
                $this->error('修改失败！');
                exit;
            }
        }else {
            $data['user_id'] = $this->userInfo['id'];
            // 执行添加
            if (!$model->add($data)) {
                $this->error('添加失败！');
                exit;
            }
        }
        $this->redirect('Order/flow2');
    }


    public function getChildLocations(){
        $id = I('get.id', 0, 'intval');
        if($id < 1){
            $this->ajaxReturn([
                'status' => 0,
            ]);
            exit;
        }
        if(!$data = S('location_'.$id)) {
            $data = M('Locations')->where(['parent_id' => $id])->select();
            S('location_'.$id, $data);
        }
        $this->ajaxReturn([
            'status' => 1,
            'data' => $data,
        ]);
    }

    public function changeStatus($id){
        $res = M('UserAddress')->where([
            'user_id' => $this->userInfo['id'],
        ])->save([
            'status' => 0,
        ]);

        // 将id 这一条变成1
        $res1 = M('UserAddress')->where([
            'id' => $id,
            'user_id' => $this->userInfo['id'],
        ])->save(['status' => 1]);
//        if($res && $res1){
        $this->redirect('Order/flow2');
//        }
    }

    public function getLocationInfo($id){
        // 通过ID查找地址
        $addressInfo = M('UserAddress')->where([
            'id' => $id,
            'user_id' => $this->userInfo['id']
        ])->find();

        // 查找当前省份下的所有城市
        if($c = S('location_'.$addressInfo['p_id'])){
            $c = M('Locations')->where(['parent_id' => $addressInfo['p_id']])->select();
            S('location_'.$addressInfo['p_id'], $c);
        }

        // 城市下的所有区/县
        if($a = S('location_'.$addressInfo['c_id'])){
            $a = M('Locations')->where(['parent_id' => $addressInfo['c_id']])->select();
            S('location_'.$addressInfo['c_id'], $a);
        }
        $this->ajaxReturn([
            'status' => 1,
            'addressInfo' => $addressInfo,
            'c' => $c,
            'a' => $a,
        ]);
    }

    /**
     * 确认收货
     */
    public function receiptGoods($orderid){
        $order = M('Order')->where([
            'id' => $orderid,
            'user_id' => $this->userInfo['id'],
            'status' => 3,
        ])->find();
        if(!$order){
            $this->error('别闹！不是你的订单....');
            exit;
        }
        M('Order')->where([
            'id' => $orderid,
            'user_id' => $this->userInfo['id'],
        ])->save([
            'status' => 4, // 表示已经发货
        ]);
    }
}