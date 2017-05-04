<?php
namespace Admin\Controller;

use Think\Model;
use Think\Page;
use Think\Upload;

class GoodsController extends CommonController
{
    public function index(){
        // 查询出总条数
        C('TOKEN_ON', false);
        $where = [];
        if(!empty($_GET)) {
            if($name = I('get.name')){
                $where['a.name'] = ['LIKE', "%$name%"];
            }
            if($category_id = I('get.category_id', 0, 'intval')){
//                $cate = M('GoodsCategory')->find($category_id);
//                $where['b.lft'] = ['EGT', $cate['lft']];
//                $where['b.rght'] = ['ELT', $cate['rght']];
                $where['a.goods_category_id'] = $category_id;
            }
            if($brand = I('get.brand_id', 0, 'intval')){
                $where['a.brand_id'] = $brand;
            }
            // 获取价格区间的值
            $min = I('get.min', 0, 'strip_tags');
            $max = I('get.max', 0, 'strip_tags');
            if(($min && $max) && $min>$max){
                list($min, $max) = [$max, $min];
            }
            if($min){
                $where['a.shop_price'][] = ['EGT', $min];
            }
            if($max){
                $where['a.shop_price'][] = ['ELT', $max];
            }

            // 将传递过来的商品状态转换成二进制的值
            $status = 0;
            $goodsStatus = I('get.goods_status');
            if($goodsStatus){
                foreach ($goodsStatus as $gs){
                    $status = $status | $gs;
                }

                if($status){
                    // 000000001
                    // 000000110
                    $where[] = 'a.goods_status&'.$status;
                    // 将位运算作为表达式传入where条件，可以运行表达式
                }
            }
        }
        $count = M('Goods as a')
            ->join('LEFT JOIN shop_goods_category as b ON b.id=a.goods_category_id')
            ->where($where)
            ->count();
        $page = new Page($count, 10);
        $lists = M('Goods as a')
            ->field('a.*, b.name as category_name, c.name as brand_name, d.name as s_name')
            ->join('LEFT JOIN shop_goods_category as b ON b.id=a.goods_category_id')
            ->join('LEFT JOIN shop_brand as c ON c.id=a.brand_id')
            ->join('LEFT JOIN shop_supplier as d ON d.id=a.supplier_id')
            ->where($where)
            ->limit($page->firstRow, $page->listRows)
            ->select();

        // 所有的分类列表
        $categories = M('GoodsCategory')->order('lft')->select();
        // 所有的品牌
        $brands = M('Brand')->select();
        $this->assign([
            'lists' => $lists,
            'show' => $page->show(),
            'categories' => $categories,
            'brands' => $brands
        ]);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $model = D('Goods');
            $data = $model->create();
            $goodsStatus = $data['goods_status'];
            // 00000000001
            // 00000000100
            // ==>
            // 00000000101
            $status = 0;
            foreach ($goodsStatus as $g){
                $status = $status | $g;
            }
            $data['goods_status'] = $status;
//            $m = new Model();
            $model->startTrans();
            $res = $model->add($data);
            if(!$res){
                $model->rollback();
                $this->error('商品发布失败！');
                exit;
            }
            // 计算SN
            $sn = date('Ymd'); // 获取YYYYmmddHH
            // 201608250000001
//            $ling = '000000';
            // substr($ling, 0, 7-strlen($res));
            $sn .=  sprintf("%07d", $res);
            $updateRes = $model->save([
                'sn' => $sn,
                'id' => $res
            ]);
            if(!$updateRes){
                $model->rollback();
                $this->error('保存失败！');
                exit;
            }

            $model->commit();
            $this->redirect('index');
            exit;
        }
        $categories = M('GoodsCategory')->where(['status' => 1])->order('lft')->select();
        $this->assign('categories', $categories);

        // 品牌列表
        $brands = M('Brand')->select();
        $this->assign('brands', $brands);

        // 品牌列表
        $suppliers = M('Supplier')->select();
        $this->assign('suppliers', $suppliers);
        $this->display();
    }

    public function detail($id){
        $id = intval($id);
        $info = M('Goods')->find($id);
        if(!$info){
            $this->error('没找到商品');
            exit;
        }
        $content = M('GoodsContent')->where(['goods_id' => $info['id']])->find();

        if(IS_POST){
            //
            $data = D('GoodsContent')->create();
            if($content){
                // 修改
                $data['id'] = $content['id'];
                $res = D('GoodsContent')->save($data);
            }else{
                // 新增
                $res = D('GoodsContent')->add();
            }
            if(!$res){
                $this->error('保存失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }


        $this->assign('goods', $info);
        $this->assign('goodsContent', $content);
        $this->display();
    }

    public function pics($id){
        $id = intval($id);
        $info = M('Goods')->find($id);
        if(!$info){
            $this->error('没找到商品');
            exit;
        }
        $this->assign('goods', $info);

        // 读取数据库中原有的图片列表
        $images = M('GoodsPics')->where(['goods_id' => $id])->select();
        $this->assign('images', $images);
        $this->display();
    }

    public function upload(){
//        dump(I('post.'));
//        exit;
        $config = [
            'maxSize'       =>  1024*1024*5, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg', 'png', 'gif', 'jpeg'), //允许上传的文件后缀
            'rootPath'      =>  './Uploads/', //保存根路径
        ];
        $upload = new Upload($config);
        $arr = array_shift($_FILES); // $_FILES['Filedata'];
        $info = $upload->uploadOne($arr);
        if(!$info){
            // 上传失败！
            $this->ajaxReturn([
                'status' => 0,
                'msg' => $upload->getError(),
            ]);
            exit;
        }
        $img = $info['url'] . '?imageView2/1/w/300/h/300/interlace/0/q/100|watermark/2/text/5rab5ZOl/font/6buR5L2T/fontsize/500/fill/I0Y4MEIwQg==/dissolve/96/gravity/SouthEast/dx/10/dy/10'; //URL . ltrim($config['rootPath'], './') . $info['savepath'] . $info['savename'];

        // 保存到数据库中
        $data = [
            'goods_id' => I('post.goods_id'),
            'path' => $img,
        ];
        $res = M('GoodsPics')->add($data);
        if(!$res){
            $this->ajaxReturn(['status' => 0, 'msg' => '上传失败！']);
            exit;
        }
        $this->ajaxReturn([
            'status' => 1,
            'img' => $img,
            'imgId' => $res,
        ]);
    }

    public function deleteimg(){
        if(IS_POST && IS_AJAX) {
            $imgid = I('post.imgid', 0);
            // 执行数据库中的删除
            $res = M('GoodsPics')->where(['id' => $imgid])->delete();
            $this->ajaxReturn([
                'status' => $res
            ]);
        }
    }
}