<?php
namespace Admin\Model;

use Think\Model;

class GoodsContentModel extends Model
{
    protected $_auto = [
        ['create_time', 'time', 1, 'function'],
    ];
}