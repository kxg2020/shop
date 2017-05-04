<?php
namespace Admin\Controller;

use Admin\Logic\DbMysqlLogic;
use Admin\Service\NestedSets;
use Think\Controller;

class CliController extends Controller
{
    public function index(){
        $db = new DbMysqlLogic();
        $ns = new NestedSets($db, 'shop_permission', 'left_key', 'right_key', 'parent_id', 'id', 'level');
        $res = $ns->moveNear(2, 11, 'before');
        print_r($res);
    }
}