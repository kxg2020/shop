<?php
namespace Home\Controller;

class CartController extends CommonController
{

    public function index(){
        $carts = D('Cart')->getCartInfo($this->isLogin, $this->userInfo['id']);
        $this->assign('carts', $carts);
        $this->display();
    }

    public function add($goods_id){
        if(!M()->autoCheckToken(I('post.'))){
            $this->error('不能重复提交！', U('Goods/detail', ['id' => $goods_id]));
            exit;
        }
        $amount = I('post.amount', 0, 'intval');
        if($amount <= 0){
            $this->error('商品数量不能少于1');
            exit;
        }
        // 通过商品ID查找商品
        $goods = M('Goods')->where([
            'id' => $goods_id,
            'status' => 1
        ])->find();
        if(!$goods){
            $this->error('商品暂未上架！稍等');
            exit;
        }
        // 判断库存
        if($goods['stock'] < $amount){
            $this->error('商品正在路上，稍后再买,当前库存：'.$goods['stock']);
            exit;
        }
        $cookieName = md5('shopCart');
//        cookie($cookieName, null);
        // 已经可以购买 加入购物车
        if($this->isLogin){
            // 已经登录！存到cart表
            $result = $this->cartWithDb($goods, $amount);
        }else{
            // 没有登录 存COOKIE
            $result = $this->cartWithCookie($goods, $amount);
        }
        $this->assign('amount', $amount);
        $this->assign('goods', $goods);
        $this->display();
    }

    /**
     * @param $goods
     * @param $amount
     * 将购物车信息存入COOKIE
     *
     [
        goodsId => [
            'goods_id' => 1,
            'buy_price' => 10.00,
            'amount' => 5,
            'create_time' => 1472954841
        ],
        goodsId => [
            'goods_id' => 1,
            'buy_price' => 10.00,
            'amount' => 5,
            'create_time' => 1472954841
        ]
     ]
     *
     *
     */
    private function cartWithCookie($goods, $amount){
        $cartInfo = [
            'goods_id' => $goods['id'],
            'buy_price' => $goods['shop_price'],
            'amount' => $amount,
            'create_time' => time()
        ];
        $cookieName = md5('shopCart');

        /**
         * oldShopCart应该是一个二维数组，保存多个商品
         * [
         * 1 => [
         *  'goods_id' => $goods['id'],
            'buy_price' => $goods['shop_price'],
            'amount' => $amount,
            'create_time' => time()
         * ],
         * 2=>
         * ]
         */

        // 要重新放入COOKIE中的数据
        $newShopCart = [];
        // 查找以前加入购物车的数据（COOKIE）
        $oldShopCart = json_decode(cookie($cookieName), true);

        // 判断以前是否有加入过购物车
        if($oldShopCart){
            // 如果以前加入过购物车，以前的商品要保留
            $newShopCart = $oldShopCart;
            // 查找当前商品 以前是否加入过购物车在COOKIE里
            if($oldShopCart[$goods['id']]){
                // 购物车里已经有了这个商品，数量直接加上本次加入购物车的数量
                // 更新数量
                $newShopCart[$goods['id']]['amount'] += $amount;
                // 更新时间
                $newShopCart[$goods['id']]['create_time'] = time();
                // 更新价格
                $newShopCart[$goods['id']]['buy_price'] = $goods['shop_price'];
            }else{
                // 以前加入的购物车中没有这个商品，新增这个商品
                $newShopCart[$goods['id']] = $cartInfo;
            }
        }else{
            // 以前就没有加入过购物车。。。
            $newShopCart[$goods['id']] = $cartInfo;
        }
        // 将新数据重新写入到COOKIE当中
        cookie($cookieName, json_encode($newShopCart), 30*86400);
        return true;
    }

    /**
     * @param $goods
     * @param $amount
     * @return mixed
     * 用户已经登录，将购物车信息存储到数据库
     */
    private function cartWithDb($goods, $amount){
        // 查询购物车里，该用户的其他购物信息
        $oldCurrentGoodsInfo = M('Cart')->where([
            'user_id' => $this->userInfo['id'],
            'goods_id' => $goods['id'],
        ])->find();
        if($oldCurrentGoodsInfo){
            // 以前我加入过当前商品..修改数量和时间
            $oldCurrentGoodsInfo['amount'] += $amount;
            $oldCurrentGoodsInfo['create_time'] = time();
            $oldCurrentGoodsInfo['buy_price'] = $goods['shop_price'];
            $result = M('Cart')->save($oldCurrentGoodsInfo);
            return $result;
        }

        // 封装一个数据
        $cartInfo = [
            'user_id' => $this->userInfo['id'],
            'goods_id' => $goods['id'],
            'buy_price' => $goods['shop_price'],
            'amount' => $amount,
            'create_time' => time()
        ];
        // 以前没有加入过这个商品到购物车
        $result = M('Cart')->add($cartInfo);
        return $result;
    }


    public function getCateByIndex(){
        // 获取购物车数据
        // 判断用户是否已经登录
        $carts = D('Cart')->getCartInfo($this->isLogin, $this->userInfo['id']);
        $this->ajaxReturn([
            'data' => $carts,
        ]);
    }

    public function changeNum(){
        if(IS_AJAX){
            // 获取参数
            $goods_id = I('get.goods_id', 0, 'intval');
            $amount = I('get.amount', 0, 'intval');
            if(!$goods_id || !$amount){
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '请求失败！',
                ]);
                exit;
            }
            if($this->isLogin){
                // 登录状态
                $res = M('Cart')->where([
                    'user_id' => $this->userInfo['id'],
                    'goods_id' => $goods_id,
                ])->save([
                    'amount' => $amount,
                ]);
                if(!$res){
                    $this->ajaxReturn([
                        'status' => 0,
                        'msg' => '修改失败！',
                    ]);
                }
            }else{
                // 修改COOKIE里的购物车信息
                $carts = json_decode(cookie(md5('shopCart')), 1);
                foreach ($carts as &$cart){
                    if($cart['goods_id'] == $goods_id){
                        $cart['amount'] = $amount;
                    }
                }
                cookie(md5('shopCart'), json_encode($carts), 86400*30);
            }

            $this->ajaxReturn([
                'status' => 1,
            ]);
        }
    }

    /**
     * @param $goods_id
     */
    public function delete($goods_id){
        if($this->isLogin){
            //
            M('Cart')->where([
                'user_id' => $this->userInfo['id'],
                'goods_id' => $goods_id,
            ])->delete();
        }else{
            // 没有登录，删除COOKIE
            $carts = json_decode(cookie(md5('shopCart')), 1);
            $data = [];
            foreach ($carts as $cart){
                if($cart['goods_id'] == $goods_id){
                    continue;
                }
                $data[] = $cart;
            }
            cookie(md5('shopCart'), json_encode($data), 86400*30);
        }
        $this->redirect('index');
    }
}