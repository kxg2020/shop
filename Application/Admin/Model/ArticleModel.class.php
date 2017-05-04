<?php
namespace Admin\Model;

use Think\Model;

class ArticleModel extends Model
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
        ['title', 'require', '文章标题必须填写', 1],
        ['intro', 'require', '文章简介必须填写', 1],
        ['content', 'require', '文章内容必须填写', 1],
        ['category_id', 'require', '文章所属分类必须填写', 1],
    ];

    /**
     * 自动完成 创建时间 取当前时间戳
     * @var array
     */
    protected $_auto = [
        ['create_time', 'time', 1, 'function'],
    ];
}