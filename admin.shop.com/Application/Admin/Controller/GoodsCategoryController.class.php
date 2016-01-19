<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title = "商品分类";

    //重构分类列表展示首页
    public function index(){

        //搜索功能，用到模糊查询，用get传输（索引）
        $wheres = array();
        $search = I('get.keyword','');
        $search = urldecode($search);
        $this->assign('search',$search);
        if(!empty($search)){
            $wheres['name']=array('like',$search.'%');
        }
        //查询数据,商品分类不需要分页
        $this->_editGetTreeList();
        $this->assign('meta_title',$this->meta_title);
        //将url地址保存到cookie中
        cookie('__PAGEURL__',$_SERVER['REQUEST_URI']);
        //将数据展示到视图页面
        $this->display('index');
    }


    protected function _editGetTreeList(){
        //为视图页面准备数据
        $zNodes = $this->model->getTreeList(true,'id,name,parent_id');
        //将数据分配到页面上
        $this->assign('zNodes',$zNodes);
    }
}