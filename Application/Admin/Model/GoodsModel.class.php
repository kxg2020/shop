<?php
namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
    protected $_auto = [
        ['inputtime', 'time', 1, 'function'],
    ];
}