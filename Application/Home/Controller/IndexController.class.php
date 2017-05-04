<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

        // 获取快报的文章
        if(!$articles = S('articles')){
            $articles = M('Article')->where([
                'category_id' => 3,
                'status' => 1,
            ])->order('create_time DESC')->limit(8)->select();
            S('articles', $articles, 86400);
        }
        $this->assign('articles', $articles);


        // 获取所有的新品
        if(!$newGoods = S('newGoods')) {
            $newGoods = M('Goods')->where([
                0 => 'goods_status&2',
            ])->select();
            S('newGoods', $newGoods, 86400);
        }
        $this->assign('newGoods', $newGoods);

        $this->display();
    }
}