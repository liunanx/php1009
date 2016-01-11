<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/6
 * Time: 18:54
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;

    //分页的制作
    public function getPageResult($wheres = array()){
        //过滤掉不显示出来的数据
        $wheres['status'] = array('gt',-1);
        //准备分页工具条数据
        $pageHtml = '';
        $pageSize = 3;
        $totalRows = $this->where($wheres)->count(); //显示的总条数
        $page = new Page($totalRows,$pageSize);
        $pageHtml = $page->show();//生成分页的html

        //当输入的页码过大无数据时，停留在最后一页
        if($page->firstRow>=$totalRows){
            $page->firstRow = $totalRows-$page->listRows;
        }
        if($totalRows<3){
            $page->firstRow = 0;
        }
        //准备分页列表数据
        $rows = $this->where($wheres)->limit($page->firstRow,$page->listRows)->select();
        //返回数据
        return array('rows'=>$rows,'pageHtml'=>$pageHtml);
    }

    //状态改变方法
    public function statusChange($id,$status=-1){
        //准备要修改的数据
        $data = array('id'=>array('in',$id),'status'=>$status);
        //状态值为-1时，为名字加上后缀，防止添加时名字重复验证不同过
        if($status == -1){
            $data['name'] = array('exp',"concat(name,'_del')");
        }
        parent::save($data);
    }


    //重写delete方法
//    public function delete($id){
//        return parent::save(array('status'=>-1,'id'=>$id));
//    }

    //查询出状态大于-1的数据 状态为-1时不显示
//    public function getList(){
//        return $this->where(array('status'=>array('gt',-1)))->select();
//    }
}