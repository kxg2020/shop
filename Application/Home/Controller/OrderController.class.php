<?php
namespace Home\Controller;


class OrderController extends CommonController
{
    public function flow2(){
        if(!$this->isLogin){
            session('loginAfterRedirect', 'Order/flow2');
            $this->redirect('Login/index');
            exit;
        }
        // 查询用户的所有收货地址
        $userAddress = M('UserAddress as a')
            ->field('a.*, CONCAT(b.name, c.name, d.name) pca')
            ->join('LEFT JOIN shop_locations as b on b.id=a.p_id')
            ->join('LEFT JOIN shop_locations as c on c.id=a.c_id')
            ->join('LEFT JOIN shop_locations as d on d.id=a.a_id')
            ->where(['user_id' => $this->userInfo['id']])->select();
        $this->assign('userAddress', $userAddress);

        // 显示省份
        if(!$ps = S('ps')) {
            $ps = M('Locations')->where(['level' => 1])->select();
            S('ps', $ps);
        }

        // 查询送货方式
        $deliverys  = M('Delivery')->where(['status' => 1])->order('sort DESC')->select();
        $this->assign('deliverys', $deliverys);

        // 查询支付方式
        $payments  = M('Payment')->where(['status' => 1])->order('sort DESC')->select();
        $this->assign('payments', $payments);

        $this->assign('ps', $ps);

        // 商品列表
        $goods = M('Cart as a')
            ->field('a.*, b.name, b.image, b.shop_price, b.stock, (b.shop_price*a.amount) as allmoney')
            ->join('shop_goods as b on b.id=a.goods_id')
            ->where([
            'a.user_id' => $this->userInfo['id']
        ])->select();
        $this->assign('goods', $goods);


        $this->display();
    }

    /**
     * 接收并处理订单
     */
    public function submit(){
        // 判断是否是AJAX请求 和POST请求
        (!IS_AJAX || !IS_POST) && exit; // 相当于 if(IS_AJAX && IS_POST){......}
        // 获取收货地址
        $addressId = I('post.address_id', 0, 'intval');
        // 获取送货方式
        $delivery = I('post.delivery', 0, 'intval');
        // 获取支付方式
        $pay = I('post.pay', 0, 'intval');
        // 获取发票信息
        $invoice = [
            'name' => I('post.invoiceName'),
            'companyName' => I('post.invoiceCompanyName'),
            'content' => I('post.invoiceContent'),
        ];

        // 处理数据 验证数据
        // ----------------**************---------------------
        // 将基础数据放在data数组里，data保存的是订单表的基础数据，是一个一维数组
        // data里的所有索引，必须是Order表的字段名
        $data = [
            // 用户ID
            'user_id' => $this->userInfo['id'],
            // 创建时间
            'create_time' => time(),
        ];

        // 查询UserAddress表，拿到用户的收货信息

        // 由于这个流程涉及到多个表的新增和修改甚至删除，所以要使用事务
        M()->startTrans();

        // 获取用户的收货地址，通过传递过来的用户地址ID
        // userAddress数组经过处理，刚好是 ORDER表中需要用到的字段
        $userAddress = D('UserAddress')->getUserAddressById($addressId, $this->userInfo['id']);
        // 判断用户是否有这一条收货地址
        if(!$userAddress){
            // 没有就回滚
            M()->rollback();
            // 返回错误信息
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '您选择的收货信息有误！',
            ]);
            exit;
        }
        // 用户有这条收货地址，和data进行合并，得到一个新的数组
        $data = array_merge($data, $userAddress);

        // 获取配送方式 通过配送方式的ID
        if(!$deliveryInfo = D('Delivery')->getDeliveryById($delivery)){
            // 没找到数据，回滚
            M()->rollback();
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '您选择的配送方式不对！',
            ]);
            exit;
        }
        // 合并配送方式，得到一个新的数组
        $data = array_merge($data, $deliveryInfo);

        // 获取支付方式 通过支付方式的ID
        if(!$paymentInfo = D('Payment')->paymentById($pay)){
            // 没有找到，回滚数据
            M()->rollback();
            // 返回错误信息
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '您选择的支付方式不对！',
            ]);
            exit;
        }
        // 合并得到一个新数组
        $data = array_merge($data, $paymentInfo);

        // 获取购物车里的商品 根据我们的逻辑，所有的购物车商品都直接下订单（如果有需求要在购物车中选取一部分商品下订单，......那么在提交订单的时候，就要明确的告诉服务端，购物车中的哪些商品需要下单....）
        $cartGoods = D('Cart')->getCartInfo($this->isLogin, $this->userInfo['id']);

        // 检查商品的库存和计算商品的总价格
        $result = $this->checkCartGoods($cartGoods);
        // 上面的返回值如果 status==0的情况下，表示库存不足，应该报错。。。
        if($result['status'] === 0){
            // 回滚
            M()->rollback();
            // 失败
            $this->ajaxReturn($result);
            exit;
        }
        // 将所有商品的总价格写入到data数组当中
        $data['price'] = $result['allMoney'];

        // 将封装好的data数组，插入到订单表当中，并且获取最新插入的订单ID
        $orderInsertId = M('Order')->add($data);
        // 如果订单插入失败，要执行回滚，和提示错误信息
        if(!$orderInsertId){
            M()->rollback();
            $this->ajaxReturn(['status' => 0, 'msg' => '提交订单失败！']);
            exit;
        }

        // 将商品写入订单的表（订单详情表）；
        $orderItemResult = $this->setOrderItem($orderInsertId, $cartGoods);
        // 商品写入订单详细表的时候，出错了，
        if(!$orderItemResult){
            // 回滚 并且提示错误信息
            M()->rollback();
            $this->ajaxReturn(['status' => 0, 'msg' => '提交订单失败！']);
            exit;
        }

        // 订单表成功，订单商品表也成功了，。。。清除购物车数据。。。减去库存


        // 减去库存
        $subStockResult = D('Goods')->SubtractStock($cartGoods);
        // 减去库存失败~  回滚和提示错误信息
        if(!$subStockResult){
            M()->rollback();
            $this->ajaxReturn(['status' => 0, 'msg' => '提交订单失败！']);
            exit;
        }

        // 清除购物车
        M('Cart')->where(['user_id' => $this->userInfo['id']])->delete();

        // 将发票信息写入数据库
        $invoiceResult = $this->setOrderInvoice($orderInsertId, $invoice);
        // 发票插入数据库失败 回滚 和 提示
        if(!$invoiceResult){
            M()->rollback();
            $this->ajaxReturn(['status' => 0, 'msg' => '提交订单失败！']);
            exit;
        }

        // 我们使用了事务，就必须在最后执行 commit
        M()->commit();
        // 返回成功信息，并且带上需要跳转的URL地址
        $this->ajaxReturn([
            'status' => 1,
            'url' => U('Order/ok', ['orderid'=> $orderInsertId]),
        ]);
    }

    // 计算商品价格 和 库存
    private function checkCartGoods($cartGoods){
        // 检查库存并且计算价格
        $allMoney = 0;
        foreach ($cartGoods as $cg){
            // 判断库存
            if($cg['amount'] > $cg['stock']){
                // 库存不足不能买
                return ['status' => 0, 'msg' => '库存不足！请重新选择数量'];
            }
            $allMoney += $cg['amount'] * $cg['shop_price'];
        }
        // 返回商品的总价
        return ['status' => 1, 'allMoney' => $allMoney];
    }


    /**
     * @param $orderId
     * @param $cartGoods
     * @return mixed
     * 将订单商品写入到订单商品表（shop_order_item）
     */
    private function setOrderItem($orderId, $cartGoods){
        // 查询出购物车的商品;
        $data = [];
        foreach ($cartGoods as $key=>$cg){
            $data[$key]['order_id'] = $orderId;
            $data[$key]['goods_id'] = $cg['goods_id'];
            $data[$key]['goods_name'] = $cg['name'];
            $data[$key]['goods_image'] = $cg['image'];
            $data[$key]['goods_price'] = $cg['shop_price'];
            $data[$key]['amount'] = $cg['amount'];
            $data[$key]['total_price'] = $cg['amount'] * $cg['shop_price'];
        }
        // 得到数据，往　shop_order_item 插入
        return M('OrderItem')->addAll($data);

    }


    /**
     * @param $orderId
     * @param $invoice
     * @return mixed
     * 将发票信息写入到商品发票表 （shop_order_invoice）....
     */
    private function setOrderInvoice($orderId, $invoice){
        $data = [
            'order_id' => $orderId,
            'type' => $invoice['name'],
            'company_name' => $invoice['companyName'],
            'content' => $invoice['content']
        ];
        return M('OrderInvoice')->add($data);
    }

    public function ok($orderid){
        $order = M('Order')->where([
            'user_id' => $this->userInfo['id'],
            'status' => 1,
            'id' => $orderid,
        ])->find();
        if(!$order){
            $this->error('未找到订单', U('Index/index'));
            exit;
        }
        // 找到了订单，
        $this->assign('order', $order);
        $this->display();
    }

    public function pay($orderid){
        $order = M('Order')->where([
            'user_id' => $this->userInfo['id'],
            'status' => 1,
            'id' => $orderid,
        ])->find();
        if(!$order){
            $this->error('未找到订单', U('Index/index'));
            exit;
        }

        // 封装ALIpay需要的数据
        $this->aliPay($order);
    }

    private function aliPay($order){
        // 查询订单中有多少件商品
        $orderItemCount = M('OrderItem')->field('SUM(amount) a')->where(['order_id' => $order['id']])->find();
        $orderItemCount = $orderItemCount['a'];

        //支付类型
        $payment_type = "1";//必填，不能修改

        //服务器异步通知页面路径
        $notify_url = URL . U('Order/notifyUrl');

        //页面跳转同步通知页面路径
        $return_url = URL . U('Order/returnUrl');

        //商户订单号(保证唯一)
        $out_trade_no = 'SN' . sprintf("%07d", $order['id']);

        //订单名称
        $subject = "京西商城购物订单";

        //付款金额(商品总价 不需要加物流费)
        $price = 0.01;//$order['price'];

        //商品数量  商品的数量，会和价格相乘....
        $quantity = 1; // $orderItemCount;

        //物流费用
        $logistics_fee = $order['delivery_price'];

        //物流类型
        $logistics_type = "EXPRESS";//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）

        //物流支付方式
        $logistics_payment = "SELLER_PAY";//必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）

        //订单描述
        $body = "京西商城的购物订单";

        //商品展示地址 (可以定位到订单详情页面)
        $show_url = URL . U('User/order', ['id' => $order['id']]);

        //收货人姓名
        $receive_name = $order['name'];

        //收货人地址
        $receive_address = $order['province_name'] . $order['city_name'] . $order['area_name'] . $order['detail_address'];

        //收货人邮编(非必填)
        $receive_zip = '610000';

        //收货人电话号码 非必填
        $receive_phone = '';//$_POST['WIDreceive_phone'];

        //收货人手机号码
        $receive_mobile = $order['phone'];


//构造要请求的参数数组，无需改动
        $alipay_config = C('ALIPAY_CONFIG');
        $parameter = array(
            "service" => "create_partner_trade_by_buyer",
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "price"	=> $price,
            "quantity"	=> $quantity,
            "logistics_fee"	=> $logistics_fee,
            "logistics_type"	=> $logistics_type,
            "logistics_payment"	=> $logistics_payment,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "receive_name"	=> $receive_name,
            "receive_address"	=> $receive_address,
            "receive_zip"	=> $receive_zip,
            "receive_phone"	=> $receive_phone,
            "receive_mobile"	=> $receive_mobile,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        vendor('Alipay.Submit');
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }

    // 异步通知的控制器--操作
    public function notifyUrl(){
        //计算得出通知验证结果
        vendor('Alipay.Notify');
        $alipay_config = C('ALIPAY_CONFIG');
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {
            ///验证成功

            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            $orderId = ltrim($out_trade_no, 'SN') * 1;
            $order = M('Order')->where(['user_id' => $this->userInfo['id'], 'id' => $orderId])->find();

            //支付宝交易号
            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
                // 没有付款不能修改状态
                echo "success";		//请不要修改或删除
            }
            else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
                $data = [
                    'status' => 2,
                    'trade_no' => $trade_no,
                    'pay_time' => time(),
                ];
                M('Order')->where(['id' => $orderId, 'user_id' => $this->userInfo['id']])->save($data);
                //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
                echo "success";		//请不要修改或删除;
            }
            else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
                //该判断表示卖家已经发了货，但买家还没有做确认收货的操作
                $data = [
                    'status' => 3,
//                    'trade_no' => $trade_no,
//                    'pay_time' => time(),
                ];
                M('Order')->where(['id' => $orderId, 'user_id' => $this->userInfo['id']])->save($data);
                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //该判断表示买家已经确认收货，这笔交易完成
                $data = [
                    'status' => 4,
//                    'trade_no' => $trade_no,
//                    'pay_time' => time(),
                ];
                M('Order')->where(['id' => $orderId, 'user_id' => $this->userInfo['id']])->save($data);

                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else {
                //其他状态判断
                echo "success";
                $data = [
                    'status' => 2,
                    'trade_no' => $trade_no,
                    'pay_time' => time(),
                ];
                M('Order')->where(['id' => $orderId, 'user_id' => $this->userInfo['id']])->save($data);
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }else {
            //验证失败
            echo "fail";
        }
    }

    // 同步通知的控制器--操作
    public function returnUrl(){
        //
        //计算得出通知验证结果
        vendor('Alipay.Notify');
        $alipay_config = C('ALIPAY_CONFIG');
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //验证成功
            //商户订单号  SN00000007.....
            $out_trade_no = $_GET['out_trade_no'];

            $orderId = ltrim($out_trade_no, 'SN') * 1;
            $order = M('Order')->where(['user_id' => $this->userInfo['id'], 'id' => $orderId])->find();

            dump($order);
            exit;
            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];

            // 显示付款成功页面
            $this->show('<p>付款成功了！</p>');

//            if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
//                // 这笔订单已经在支付宝付过款了，，之前付款的
//
//            }else {
//                echo "trade_status=".$_GET['trade_status'];
//            }

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }
}