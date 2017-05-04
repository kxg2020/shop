<?php
namespace Home\Controller;

use Org\Net\IpLocation;
use Think\Controller;
use Think\Verify;

/**
 * Class LoginController
 * @package Home\Controller\
 * 整个注册的流程
 * 1.   填写表单（短信）注册成功（状态为 未激活）
 * 2.   发送激活邮件给用户
 *      a.  TOKEN 十分钟失效
 *      b.  激活之后，TOKEN失效
 * 3.   用户点击链接 激活账户
 * 4.   激活之后，跳转到登录页面
 */

class LoginController extends CommonController
{
    /**
     * 用户登录
     */
    public function index(){
        if($this->isLogin){
            $this->error('你已经登录过了！',U('Index/index'));
            exit;
        }
        if(IS_POST){
            // 使用create方法完成自动验证
            $data = D('User')->create(i('post.'), 4);
            if(!$data){
                $this->error(D('User')->getError());
                exit;
            }
            // 验证用户 通过用户名查询用户数据
            $user = D('User')->where(['username' => $data['username']])->find();
            if(!$user){
                // 没有查询到用户，表示用户名不存在
                $this->error('用户名或密码错误');
                exit;
            }

            // 验证用户是否已经激活
            if($user['status'] != 1){
                // 直接发送邮件也可以。。。。。
                $this->error('用户还没有激活！请去激活');
                exit;
            }

            // 验证密码  调用模型中的方法 验证用户输入的密码
            if(!D('User')->checkLoginPassword($data['password'], $user['password'])){
                // 密码错误
                $this->error('用户名或密码错误');
                exit;
            }
            // 验证成功
            D('User')->loginSuccess($user);

            // 将COOKIE中的购物车信息 存入到 DB当中
            $this->cookie2db($user['id']);

            $url = session('loginAfterRedirect') ? session('loginAfterRedirect') : 'Index/index';
            $this->success('登录成功！', U($url));
            exit;
        }
        $this->display();
    }

    private function cookie2db($userId){
        // 取出COOKIE中的购物车信息
        $cookieName = md5('shopCart');
        // 通过cookie方法 将存储到COOKIE中的购物车信息，拿出来。JSON格式
        $carts = json_decode(cookie($cookieName), 1);
        // 把COOKIE中的购物车信息全部清空
        cookie($cookieName, null);
        // 购物车里没有信息，，，直接退出
        if(!$carts){
            return ;
        }
        // 封装二维数据，为了使用addAll方法
        $data = [];
        // 作为二维数组的KEY （$data）
        $i = 0;

        // 循环cookie内的数组，
        foreach ($carts as $cart){
            // 查询数据库 看是否之前添加过此商品
            $oldCartInfo = M('Cart')->where([
                'goods_id' => $cart['goods_id'],
                'user_id' => $userId,
            ])->find();

            // 如果说数据库存在数据， 修改商品数量和事件
            if($oldCartInfo){
                // 加上COOKIE里的商品数量
                $oldCartInfo['amount'] += $cart['amount'];
                $oldCartInfo['create_time'] = $cart['create_time'];
                // 执行保存
                M('Cart')->save($oldCartInfo);
                // 继续下一次循环....
                continue;
            }

            // 封装二维数组，为了保存到数据库
            $data[$i]['user_id'] = $userId;
            $data[$i]['goods_id'] = $cart['goods_id'];
            $data[$i]['amount'] = $cart['amount'];
            $data[$i]['buy_price'] = $cart['buy_price'];
            $data[$i]['create_time'] = $cart['create_time'];
            ++$i;
        }
        // 判断是否存在DATA
        if($data) {
            // 保存到数据库当中
            M('Cart')->addAll($data);
        }
    }

    /**
     * 用户注册
     */
    public function regist(){
        if(IS_POST){
            // 调用自动验证
            $data = D('User')->create();
            if(!$data){
                $this->error(D('User')->getError());
                exit;
            }
            $res = D('User')->add();
            if($res === false){
                // 注册失败！
                $this->error('注册失败！');
                exit;
            }
            // 注册成功！
            $this->redirect('Login/sendemail', [
                'user_id' => $res,
            ]);
            exit;
        }
        $this->display();
    }

    public function sendemail($user_id){
        $user_id = intval($user_id);
        $user = M('User')->find($user_id);
        if(!$user){
            $this->error('没有找到用户！', U('regist'));
            exit;
        }
        if($user['status'] == 1){
            // 已经激活，
            $this->error('已经激活，不要再来了！', U('index'));
            exit;
        }
        $this->assign('user', $user);
        // 发送激活邮件
        // http://ashdioashdias.com/#$%^gaisudfs89adhsoaidas89dhoasidfasdo0isdnuisadioasdhasiudgoidguiag

        /**
         * 发送激活邮件有几个原则：
         * 1. 不能让用户看懂你写的是什么
         * 2. 用户点击之后，要能够关联到是哪一个用户点了，
         * 3. 在点击后的页面要处理业务逻辑
         */
        // 生成一个看不懂的TOKEN  md5(123).md5(1365).sha1(123).md5(123);
        $token = md5(rand(0, 999)) . md5(rand(1000, 10000)) . sha1(rand(10000, 100000));
        $url = URL . U('Login/activation', ['token' => $token, 'uid' => $user_id]);
        S('email_token_'.$user_id, $token, 600);
        // 发邮件......
        $body = '<p>请点击激活：</p><p><a href="' . $url . '">' . $url . '</a> </p>';
        $sendResponse = D('User')->sendEmail($user['email'], '注册激活邮件', $body);
        if(!$sendResponse){
            $this->assign('error', 1);
        }
        $this->display();
    }

    public function verify(){
        $config = [
            'codeSet' => '1'
        ];
        $Verify = new Verify($config);
        $Verify->entry();
    }

    public function sendsms(){
        if(IS_AJAX && IS_POST){
            $phone = I('post.phone');
            // 验证手机号码是否符合规则
            // 发短信
            vendor('Alidayu.TopSdk');
            $c = new \TopClient;
            $c->appkey = '23440600';
            $c->secretKey = '398958d2125f07303f701686eae929d1';
            $req = new \AlibabaAliqinFcSmsNumSendRequest;
            $req->setExtend("123456");
            $req->setSmsType("normal");
            $req->setSmsFreeSignName("涛哥博客");

            // 生成验证码
            $code = rand(1000, 9999);

            $req->setSmsParam("{\"name\":\"亲\",\"number\":\"".$code."\"}");
            $req->setRecNum($phone);
            $req->setSmsTemplateCode("SMS_13345017");
            $resp = $c->execute($req);
            // 将code缓存到 code_phone 里 存储300秒
            S('code_'.$phone, $code, 300);
            $this->ajaxReturn($resp);
        }

    }

    public function activation($token, $uid){
        $uid = intval($uid);
        // 从缓存中拿TOKEN
        $cacheName = 'email_token_' . $uid;
        $cacheToken = S($cacheName);
        $hasErr = 0;
        if(!$cacheToken){
            // 要重新发送邮件！
            $hasErr = 1;
            $this->assign('error', 1);
        }
        // 找到了TOKEN
        if($cacheToken != $token){
            $hasErr = 1;
            $this->assign('error', 1);
        }

        //
        $user = M('User')->where(['id' => $uid])->find();
        if(!$user){
            $this->error('激活失败！重新注册！', U('regist'));
            exit;
        }
        if($user['status'] == 1){
            $this->error('用户已经激活！不需要激活', U('index'));
            exit;
        }

        // 这里是验证成功要执行的事情！
        if($hasErr != 1){
            // 所有的验证都已经正确， 修改用户的激活状态
            $user['status'] = 1;
            $res = M('User')->save($user);
            if(!$res){
                $this->assign('error', 1);
            }
        }
        $this->assign('user', $user);
        S($cacheName, null);
        $this->display();
    }


    public function logout(){
        // 清除session
        session('token', null);
        $this->success('退出成功！', U('Login/index'));
    }
}