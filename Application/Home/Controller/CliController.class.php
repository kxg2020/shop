<?php
namespace Home\Controller;

use Think\Controller;

class CliController extends Controller
{
    // 将超过2小时没有付款的订单取消，并且释放库存
    /**
     * 需要放到crontab / 定时计划任务...
     *     *\/10 * * * *
     */
    public function checkOverOrder(){
        $time = time();
        // 查询两小时以前的订单并且没有付款的
        $orders = M('Order')->where([
            'create_time' => ['LT', $time-7200],
            'status' => 1,
        ])->select();

        foreach ($orders as $order){
            // 找到每一个订单  将订单的状态改为0（已取消）
            $order['status'] = 0;
            M('Order')->save($order);

            // 将订单的商品库存释放
            $orderItems = M('OrderItem')->where([
                'order_id' => $order['id']
            ])->select();
            foreach ($orderItems as $oi){
                // oi 指的是 订单里的每天一个商品信息
                M('Goods')->where([
                    'id' => $oi['goods_id']
                ])->save([
                    'stock' => array('exp','stock+'.$oi['amount'])
                ]);
            }
        }
    }
}