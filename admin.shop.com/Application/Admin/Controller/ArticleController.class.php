<?php
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends BaseController
{
    protected $meta_title = "文章";

    //是否使用post中的所有数据
    protected $usePostParams  = true;

    //钩子方法，准备在编辑添加article展示页面之前加入操作
    public function _editGetTreeList(){
        //创建模型对象
        $articleCategoryModel = D('ArticleCategory');
        $articleCategory = $articleCategoryModel->getList('id,name');
        //分配数据到页面上
        $this->assign('articleCategory',$articleCategory);

        //编辑回显文章内容
        $id = I('get.id');
        if(!empty($id)){
            $articleContentModel = M('ArticleContent');
            $content = $articleContentModel->getFieldByArticle_id($id,'content');
            $this->assign('content',$content);
        }
    }

    public function search($keyword){
        $wheres = array();
        if(!empty($keyword)){
            $wheres['name'] = array('like',"%{$keyword}%");
        }

        $rows = $this->model->getList('id,name',$wheres);
        //该方法会将传递进去的数据变成json发送给浏览器
        $this->ajaxReturn($rows);

    }


}