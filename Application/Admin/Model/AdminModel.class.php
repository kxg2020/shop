<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
    protected $_validate = [
        ['username', 'require', '用户名必填', 1, 'regex'],
        ['username', '', '用户名已经存在', 1, 'unique', 1],
        ['password', 'require', '密码必填', 1, 'regex', 1],
        ['password', 'tpassword', '两次密码不一样', 1, 'confirm', 1],
        ['phone', '/^1[34578]\d{9}$/', '手机号码格式不正确', 1, 'regex', 1],
        ['username', '/^[a-zA-Z][a-zA-Z0-9_]{4,11}$/', '用户名不符合规则', 1, 'regex', 4],
        ['password', '6,12', '密码必须是6-12位', 1, 'length', 4],
    ];

    protected $_auto = [
        ['password', 'md5', 1, 'function'],
        ['create_time', 'time', 1, 'function'],
    ];
}