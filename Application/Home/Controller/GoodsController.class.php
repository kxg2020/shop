<?php
namespace Home\Controller;

class GoodsController extends CommonController
{
    /**
     * @param $id
     * 显示商品详情
     */
    public function detail($id){
        // id 是商品的ID
        $smallExt = '?imageView2/1/w/50/h/50/interlace/0/q/100|watermark/2/text/5rab5ZOl/font/6buR5L2T/font';
        $mExt = '?imageView2/2/w/350/h/350/interlace/0/q/100';
        $this->assign([
            'smallExt'=> $smallExt,
            'mExt'=> $mExt,
        ]);
        $goods = M('Goods')->where(['status' => 1])->find($id);
        if(!$goods){
            $this->error('商品已经下架！', U('Index/index'));
        }
        $this->assign('goods', $goods);

        // 查找相册里的图片
        $goodsImages = M('GoodsPics')->where(['goods_id' => $id])->select();
//        $week = ['星期天', '星期一'];
        $this->assign('goodsImages', $goodsImages);
        $this->display();
    }


    /**
     * @param $goods_id
     * 解决每次刷新读取和修改点击数查询数据库的问题
     * 1=>点击量100
     * REDIS和数据库进行同步
     */
    public function getClicks($goods_id){
        // PHP操作REDIS的方法
        $redis = getRedis();
        // 在redis中执行 增加1 并且返回最新的点击量
        $res = $redis->zIncrBy('goods_click', 1, $goods_id);
        $this->ajaxReturn(['click'=>$res]);
    }

    public function redisSynDb(){
        // 从REDIS中把点击量都拿出来
        $redis = getRedis();
        $res = $redis->zRange('goods_click', 0, -1, true);
        if(!$res){
            return ;
        }
        // 返回回来的数据是一个 ['商品ID' => 点击量]
        // 将数据库中，和REDIS中重合的商品点击量删除 再新增进去
        // 根据商品的ID去删除数据表
        $goodsIds = array_keys($res);
        M('GoodsClick')->where(['goods_id' => ['IN', $goodsIds]])->delete();
        // 将新的点击量添加到数据库中
        $data = [];
        $i = 0;
        foreach ($res as $key=>$val){
            $data[$i]['goods_id'] = $key;
            $data[$i]['clicks'] = $val;
            ++$i;
        }
        M('GoodsClick')->addAll($data);
    }


    public function getClicks_old($goods_id){
        // 从数据库中查找点击量
        $click = M('GoodsClick')->where(['goods_id' => $goods_id])->find();
        if(!$click){
            $click = [
                'goods_id' => $goods_id,
                'clicks' => 1,
            ];
            // 没有找到数据
            M('GoodsClick')->add($click);
        }else{
            // 找到有数据
            $click['clicks'] += 1;
            M('GoodsClick')->where(['goods_id'=> $goods_id])->save($click);
        }
        $this->ajaxReturn(['click'=> $click['clicks']]);
    }

    /**
     * @param $goods_id
     * 获取商品详情
     */
    public function getContent($goods_id){
        $content = M('GoodsContent')->where(['goods_id'=>$goods_id])->find();
        $this->ajaxReturn(['content' => htmlspecialchars_decode($content['content'])]);
    }
}