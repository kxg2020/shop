<?php
return array(
	//'配置项'=>'配置值'
    'SEND_EMAIL_HOST' => 'smtp.163.com',
    'SEND_EMAIL_USER' => 'toulen3171@163.com',
    'SEND_EMAIL_PWD' => '1989042588',
    'SEND_EMAIL_SECURE' => 'ssl',
    'SEND_EMAIL_PORT' => 465,
    'SEND_EMAIL_SENDER' => '京西商城官方',

    // 默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR' => 'Public:error',
    // 默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public:success',

    // 支付宝的配置信息
    'ALIPAY_CONFIG' => [
        'partner' => '2088002155956432',
        'seller_email' => 'guoguanzhao520@163.com',
        'key' => 'a0csaesgzhpmiiguif2j6elkyhlvf4t9',
        'sign_type' => 'MD5',
        'input_charset' => 'utf-8',
        'cacert' => getcwd().'\\cacert.pem',
        'transport' => 'http',
    ],
);