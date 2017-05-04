<?php
namespace Admin\Controller;


use Think\Page;

class ArticleCategoryController extends CommonController
{
    /**
     * 显示列表
     */
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
        $count = M('ArticleCategory')->where($where)->count();

        // 实例化分页类，每页显示4条
        $pager = new Page($count, 4);

        // 根据条件和分页进行数据的查询
        $lists = M('ArticleCategory')->where($where)->order('id')
            ->limit($pager->firstRow, $pager->listRows)
            ->select();
        // 将数据传给模板
        $this->assign('lists', $lists);
        // 将分页的HTML代码传给模板
        $this->assign('pages', $pager->show());
        // 调用视图，显示页面
        $this->display();
    }

    /**
     * 新增文章分类
     */
    public function add(){
        // 判断是否是POST请求，如果是，一定是用户在提交数据
        if(IS_POST){
            // 实例化Supplier模型类
            $model = D('ArticleCategory');

            // 做三件事情，自动验证，自动完成，生成数组
            $data = $model->create();

            // 验证还失败
            if(!$data) {
                $str = $model->getError(); //join('<br/>', $model->getError());
                $this->error($str);
                exit;
            }
            // 执行新增
            $res = $model->add();
            if(!$res){
                // 新增失败
                $this->error('添加失败');
                exit;
            }
            // 新增成功，跳转到首页
            $this->redirect('index');
            exit;
        }

        // 当不是POST请求，则显示新增的视图模板
        $this->display();
    }

    /**
     * 编辑文章分类
     */
    public function edit(){
        // 获取供应商ID
        $id = I('get.id', 0, 'intval');
        if(!$id){
            // 没有ID，报错
            $this->error('没有找到数据');
            exit;
        }
        // 实例化模型类
        $model = D('ArticleCategory');
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
            if(!$data['status']) $data['status'] = 0;

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
     * 删除文章分类
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
        $model = D('ArticleCategory');
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
}