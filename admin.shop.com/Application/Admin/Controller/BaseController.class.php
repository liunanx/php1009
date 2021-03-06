<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 12:34
 */

namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    //创建模型对象
    protected $model;

    //是否使用post中的所有数据
    protected $usePostParams  = false;

    public function _initialize()
    {
        $this->model = D(CONTROLLER_NAME);
    }

    //展示列表
    public function index(){

        //搜索功能，用到模糊查询，用get传输（索引）
        $wheres = array();
        $search = I('get.keyword','');
        $this->assign('search',$search);
        if(!empty($search)){
            $wheres['obj.name']=array('like','%'.$search.'%');
        }
        //重新设置查询条件
        $this->_setWheres($wheres);
        //查询数据
        $pageResult = $this->model->getPageResult($wheres);
        //分配数据
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title);
        //将url地址保存到cookie中
        cookie('__PAGEURL__',$_SERVER['REQUEST_URI']);
        //查询数据
        $this->_editGetTreeList();
        //对数据进一步处理
        $this->_indexViewBefore();
        //将数据展示到视图页面
        $this->display('index');
    }

    //添加
    public function add(){
        if(IS_POST){
            //使用create方法收集数据并验证
            if($this->model->create()!==false){
//                echo 'xxx';
//                exit;
                //添加数据到数据库中
                if($this->model->add($this->usePostParams?I('post.'):'')!==false){
                    $this->success('添加成功',U('index'));
                    return;
                }
            }
            $this->error('操作失败'.show_model_error($this->model));
        }else{
            //分配数据
            $this->assign('meta_title',$this->meta_title);
            //查询数据
            $this->_editGetTreeList(true,'id,name,parent_id');
            //以get方式访问，展示视图页面
            $this->display('edit');

        }
    }

    /**
     * 编辑
     * @param $id 编辑id
     */
    public function edit($id){
        if(IS_POST){
            //收集验证数据
            if($this->model->create()!==false){
                //修改数据并保存到数据库
                if($this->model->save($this->usePostParams?I('post.'):'')!==false){
                    $this->success('修改成功',U('index'));
                    return;
                }
            }
            $this->error('操作失败'.show_model_error($this->model));
        }else{
            //>>回显
            //通过find查询出要编辑的一行
            $rows = $this->model->find($id);
            //将数据分配到页面上
            $this->assign($rows);
            $this->assign('meta_title',$this->meta_title);

            //查询数据
            $this->_editGetTreeList(true,'id,name,parent_id');
            //展示视图页面
            $this->display('edit');
        }
    }

    //修改状态status的方法
    public function statusChange($id,$status=-1){
        //调用statusChange修改数据库中的状态status字段值
        if($this->model->statusChange($id,$status)!==false){
            $this->success('操作成功',cookie('__PAGEURL__'));
        }else{
            $this->error('操作失败'.show_model_error($this->model));
        }
    }


    protected function _editGetTreeList(){

    }

    //此方法被子类覆盖，用于展示视图页面之前对数据处理
    protected function _indexViewBefore(){

    }


    //删除某一行
//    public function remove($id){
//        //创建模型对象
//        $model = D('Supplier');
//        //调用模型中重写的delete方法删除数据
//        if($model->delete($id)!==false){
//            $this->success('删除成功','__PAGEURL__');
//        }else{
//            $this->error('操作失败'.show_model_error($model));
//        }
//    }
}