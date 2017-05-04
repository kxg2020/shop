<?php
namespace Home\Model;

use Think\Model;

class CartModel extends Model
{
    public function getCartInfo($isLogin, $userId){
        if($isLogin){
            // 已经登录了
            $carts = M('Cart as a')
                ->field('a.*, b.name, b.image, b.sn, b.shop_price, b.stock')
                ->join('LEFT JOIN shop_goods as b on b.id=a.goods_id')
                ->where([
                    'a.user_id' => $userId,
                ])->select();
        }else{
            $carts = cookie(md5('shopCart'));
            $carts = json_decode($carts, true);
            foreach ($carts as &$cart){
                // 查询商品数据
                $goods = M('Goods')->find($cart['goods_id']);
                $cart['name'] = $goods['name'];
                $cart['image'] = $goods['image'];
                $cart['sn'] = $goods['sn'];
            }
        }
        return $carts;
    }
}