<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public $isLogin = false;

    public $userInfo = [];

    public function _initialize(){
        $sessionToken = session('token');
        if($sessionToken){
            //
            $userInfo = M('User')->where([
                'session_token' => $sessionToken,
            ])->find();
            if($userInfo){
                $this->isLogin = true;
                $this->assign('userInfo', $userInfo);
                $this->userInfo = $userInfo;
            }
        }
        
        // 读取所有的分类
        if(!$goodsCategories = S('goodsCategories')){
            $goodsCategories = M('GoodsCategory')->order('lft')->select();
            S('goodsCategories', $goodsCategories, 86400);
        }
        $this->assign('gc', $goodsCategories);

    }
}