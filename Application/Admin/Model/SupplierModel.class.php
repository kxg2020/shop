<?php
namespace Admin\Model;

use Think\Model;

class SupplierModel extends Model
{
    /**
     * 批处理
     * @var bool
     */
//    protected $patchValidate    =   true;

    /**
     * 自动验证
     * @var array
     */
    protected $_validate = [
        ['name', 'require', '供应商名称必须填写', 1],
        ['intro', 'require', '供应商简介必须填写', 1],
        ['address', 'require', '供应商地址必须填写', 1],
        ['connecter', 'require', '供应商联系人必须填写', 1],
        ['phone', 'require', '供应商联系电话必须填写', 1],
        ['phone', '/^1[34578]\d{9}$/', '电话号码的格式不正确', 1],
    ];

    /**
     * 自动完成 创建时间 取当前时间戳
     * @var array
     */
    protected $_auto = [
        ['create_time', 'time', 1, 'function'],
    ];
}