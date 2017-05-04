<?php
namespace Home\Controller;

class ArticleController extends CommonController
{
    public function detail($id){
        session('a', 1);
        exit;
        $article = M('Article')->find($id);
        if(!$article){
            $this->error('你要看的文章不合法');
            exit;
        }
        $this->assign('article', $article);
        $this->display();
    }
}