<?php
namespace Admin\Controller;

use Think\Page;
use Think\Upload;

class BrandController extends CommonController
{
    public function index(){
        // 动态关闭表单令牌
        C('TOKEN_ON', false);
        // 接收搜索传递过来的 name 和 phone
        $name = I('get.name', '', 'strip_tags');

        // 定义一个默认条件
        $where = [];
        // 如果传递了name参数，表示用户在搜索供应商的名字
        if($name){
            // 使用模糊查询
            $where['name'] = ['LIKE', '%'.$name.'%'];
        }

        // 根据指定的条件，查询出数据库中的数据条数
        $count = M('Brand')->where($where)->count();

        // 实例化分页类，每页显示4条
        $pager = new Page($count, 10);

        // 根据条件和分页进行数据的查询
        $lists = M('Brand')->where($where)->order('id')
            ->limit($pager->firstRow, $pager->listRows)
            ->select();
        // 将数据传给模板
        $this->assign('lists', $lists);
        // 将分页的HTML代码传给模板
        $this->assign('pages', $pager->show());
        // 调用视图，显示页面
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $model = D('Brand');
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
                exit;
            }
            if($_FILES['logo']['size']){
                // 上传图片
                $config = [
                    'maxSize'       =>  1024*1024*5, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg', 'png', 'gif', 'jpeg'), //允许上传的文件后缀
                    'rootPath'      =>  './Uploads/', //保存根路径
                ];
                $Upload = new Upload($config);
                $info = $Upload->uploadOne($_FILES['logo']);
                if($info){
                    // 上传成功！
                    $data['logo'] = URL . trim($config['rootPath'], './') . $info['savepath'] . $info['savename'];
//                    $data['logo'] = $config['rootPath'].$info['savepath'] . $info['savename'];
                }else{
                    $this->error($Upload->getError());
                    exit;
                }
            }
            $res = $model->add($data);
            if(!$res){
                $this->error('新增失败！');
                exit;
            }
            $this->redirect('index');
            exit;
        }
        $this->display();
    }

    public function edit(){
        // 获取ID
        $id = I('get.id', 0, 'intval');
        if(!$id){
            // 没有ID，报错
            $this->error('没有找到数据');
            exit;
        }
        // 实例化模型类
        $model = D('Brand');
        // 通过ID主键 查询供应商信息
        $info = $model->find($id);
        if(!$info){
            // 没有在数据库中找到数据，报错
            $this->error('没有找到数据');
            exit;
        }

        // 判断是否是POST请求，如果是，则是用户在提交数据
        if(IS_POST) {
            // 使用create方法，自动验证。自动完成。验证表单凌攀，生成数据
            $data = $model->create();
            if(!$data){
                // 验证失败
                $str = $model->getError(); //join('<br/>', $model->getError());
                $this->error($str);
                exit;
            }
            if(!$data['id'] || $data['id'] != $id){
                // 判断POST过来的ID有没有被用户篡改过
                $this->error('数据不能乱改！小心点！');
                exit;
            }
            if(!$_FILES['logo']['size']){
                unset($data['logo']);
            }else{
                // 上传图片
                $config = [
                    'maxSize'       =>  1024*1024*5, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg', 'png', 'gif', 'jpeg'), //允许上传的文件后缀
                    'rootPath'      =>  './Uploads/', //保存根路径
                ];
                $Upload = new Upload($config);
                $info = $Upload->uploadOne($_FILES['logo']);
                if($info){
                    // 上传成功！
                    $data['logo'] = URL . trim($config['rootPath'], '.') . $info['savepath'] . $info['savename'];
                }else{
                    $this->error($Upload->getError());
                    exit;
                }
            }

            // 执行更新
            $res = $model->save($data);
            if(!$res){
                $this->error('更新失败！');
                exit;
            }
            // 更新成功直接跳转到首页
            $this->redirect('index');
            exit;
        }

        // 如果不是POST请求，则回显供应商信息到模板
        $this->assign('info', $info);
        $this->display();
    }

    /**
     * 删除品牌
     * @param $id
     */
    public function delete($id){
        // 将ID转换成整数类型
        $id = intval($id);
        // 判断是否传了ID
        if(!$id){
            // 没有ID，报错
            $this->error('没有找到数据');
            exit;
        }
        // 实例化模型类
        $model = D('Brand');
        // 通过ID主键 查询供应商信息
        $info = $model->find($id);
        if(!$info){
            // 没有在数据库中找到数据，报错
            $this->error('没有找到数据');
            exit;
        }

        // 执行删除
        $res = $model->delete($id);
        if(!$res){
            $this->error('删除失败！');
            exit;
        }
        // 删除成功直接回到首页
        $this->redirect('index');
    }


    public function upload(){
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
//        print_r($info);
//        exit;
        $img = $info['url'] . '?imageView2/1/w/300/h/300/interlace/0/q/100|watermark/2/text/5rab5ZOl/font/6buR5L2T/fontsize/500/fill/I0Y4MEIwQg==/dissolve/96/gravity/SouthEast/dx/10/dy/10'; //URL . ltrim($config['rootPath'], './') . $info['savepath'] . $info['savename'];

        $this->ajaxReturn([
            'status' => 1,
            'img' => $img,
        ]);
    }
}