<?php
namespace Admin\Controller;

class OrderController extends CommonController
{

    /**
     * 发货
     */
    public function sendGoods($orderid){
        M('Order')->where([
            'id' => $orderid
        ])->save([
            'status' => 3, // 表示已经发货
        ]);
    }
}