<?php
namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{
    protected $_validate = [
        ['role_name', 'require', '角色名必填', 1],
        ['role_name', '', '角色名不能重复', 1, 'unique'],
    ];
}