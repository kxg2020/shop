<?php
namespace Home\Model;

use Think\Model;
use Think\Verify;

class UserModel extends Model
{
    protected $_validate = [
        // 验证用户是否勾选《协议》  判断值是否为1
        ['xieyi', '1', '请先阅读并同意《用户注册协议》', 1, 'equal', 1],
        // 验证用户名的长度是否在 3-20 位之间
        ['username', '3,20', '用户名必须是3-20位', 1, 'length'],
        // 使用回调函数验证用户名（只能是中文字母数字下划线）
        ['username', 'checkUsername', '用户名格式错误', 1, 'callback'],
        // 验证密码的长度是否在 6 - 20 位之间
        ['password', '6,20', '密码的长度应该是6-20位', 1, 'length'],
        // 密码不能是纯数字（通过一个回调函数）
        ['password', 'checkPassword', '密码不能是纯数字', 1, 'callback'],
        // 验证两次输入的密码是否一致
        ['password', 'repassword', '两次密码输入不一致', 1, 'confirm', 1],
        // 验证邮箱是否符合邮箱的规则， email规则是预定义的规则（正则）
        ['email', 'email', '邮箱格式不正确', 1, 'regex', 1],
        // 验证手机号码的格式
        ['phone', '/^1[34578]\d{9}$/', '手机号码不正确', 1, 'regex', 1],
//        // 这里提交的字段名不是数据表中的字段名，而是表单提交的字段
        ['checkcode', 'checkVerify', '验证码错误', 1, 'callback'],
        // 验证短信验证码（回调函数）
        ['captcha', 'checkPhoneCode', '短信验证码错误', 1, 'callback', 1],

        ['username', '', '用户名已经存在', 1, 'unique', 1],
        ['phone', '', '手机已经存在', 1, 'unique', 1],
        ['email', '', '邮箱已经存在', 1, 'unique', 1],
    ];

    protected $_auto = [
        // 通过回调函数 将密码进行加密
        ['password', 'autoPassword', 1, 'callback'],
        // 获取系统的时间戳
        ['regist_time', 'time', 1, 'function'],
        // 将status字段，设置默认值为0
        ['status', 0, 1],
    ];

    /**
     * @param $password
     * @return string
     * 加密密码
     */
    public function autoPassword($password){
        // 生成一个5位数的随机数字
        $rand = rand(10000, 99999);
        // 通过三重加密 md5 sha1 crypt  crypt(字符串，颜值);
        $password = md5(sha1(crypt($password, $rand)));
        // 拼接密码字符串，为了将随机数字也存储起来
        $password .= '_'.$rand;
        // AHIOSFHIOAS78A578ADY089U4230_12345;
        // 返回加密后的密码
        return $password;
    }

    /**
     * @param $password
     * @param $dbPassword
     * @return bool
     */
    public function checkLoginPassword($password, $dbPassword){
        // 使用list方法取出密码中的两个部分（加密密码_随机数字（颜值））
        list($dbPassword, $randCode) = explode('_', $dbPassword);

        // 通过我们自己的加密方式，对用户输入的密码进行加密
        $password = md5(sha1(crypt($password, $randCode)));

        // 将用户输入的密码 和数据库中的密码进行比对
        if($password != $dbPassword){
            return false;
        }
        return true;
    }

    public function loginSuccess($user){
        // 将IP 和 登录时间 回写到数据库中
        $sessionToken = md5($user['id'] . '_' .microtime());
        $this->save([
            'id' => $user['id'],
            'last_login_ip' => get_client_ip(),
            'last_login_time' => time(),
            'session_token' => $sessionToken,
        ]);

        // 将用户信息存储到SESSION当中
        session('token', $sessionToken);
    }

    /**
     * @param $captcha
     * @return bool
     * 验证短信验证码
     */
    public function checkPhoneCode($captcha){
        // 获取手机号码
        $phone = I('post.phone');
        // 获取到缓存里的验证码
        $phoneCode = S('code_'.$phone);
        // 检查是否有验证码
        if(!$phoneCode){
            // 没有找到缓存里的验证码
            return false;
        }
        // 对比
        if($phoneCode != $captcha){
            // 输入的验证码不正确
            return false;
        }
        // 清除缓存
        S('code_'.$phone, null);
        return true;
    }

    /**
     * @param $verify
     * @return bool
     * 验证验证码
     */
    public function checkVerify($verify){
        $v = new Verify();
        if($v->check($verify)){
            return true;
        }
        return false;
    }


    /**
     * @param $username
     * @return bool
     * 使用正则验证用户名
     */
    public function checkUsername($username){
        // 验证用户名由中文字母数字下划线组成
        $reg = '/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u';
        preg_match($reg, $username, $returnArr);
        return empty($returnArr) ? false : true;
    }

    /**
     * @param $password
     * @return bool
     * 使用正则验证密码
     */
    public function checkPassword($password){
        $reg = '/^\d{6,20}$/';
        preg_match($reg, $password, $returnArr);
        if($returnArr){
            return false;
        }
        return true;
    }

    public function sendEmail($toEmail, $subject, $body){
        vendor('PHPMailer.PHPMailerAutoload');
        $mail = new \PHPMailer;

        $mail->isSMTP(); // 设置使用SMTP服务器发送邮件
        $mail->Host = C('SEND_EMAIL_HOST');  // 设置SMTP服务器地址
        $mail->SMTPAuth = true;  // 使用SMTP的授权规则
        $mail->Username = C('SEND_EMAIL_USER'); // 要使用哪一个邮箱发邮件
        $mail->Password = C('SEND_EMAIL_PWD'); //
        $mail->SMTPSecure = C('SEND_EMAIL_SECURE');  // 设置使用SMTP的协议
        $mail->Port = C('SEND_EMAIL_PORT'); // SMTP ssl协议的端口

        $mail->setFrom(C('SEND_EMAIL_USER'), C('SEND_EMAIL_SENDER'));
        $mail->addAddress($toEmail);

        $mail->isHTML(true); // 表示发送的邮件内容以html的形式发送

        $mail->Subject = $subject;
        $mail->Body    = $body;
        return $mail->send();

    }
}