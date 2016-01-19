<?php
namespace Admin\Model;

use Admin\Service\NestedSetsService;
use Think\Model;

class GoodsCategoryModel extends BaseModel
{
    //自动验证模板，验证不能为空的字段
    protected $_validate = array(
        array('name', 'require', '分类名称不能够为空'),
        array('parent_id', 'require', '父分类不能够为空'),
        array('lft', 'require', '左边界不能够为空'),
        array('rgt', 'require', '右边界不能够为空'),
        array('level', 'require', '层级不能够为空'),
        array('status', 'require', '是否显示不能够为空'),
    );

    //获取商品分类的树状结构
    public function getTreeList($isJson=false,$field='*'){
        $row = $this->field($field)->where(array('status'=>array('egt',0)))->order('lft')->select();
        if($isJson){
            return json_encode($row);
        }
        return $row;
    }

    //重构添加数据方法
    public function add(){
        //创建一个能够执行sql的对象
        $dbMysql = new DbMysqlInterfaceImplModel();
        //计算左右边界，生成sql
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //添加的数据放到哪个位置，并返回该节点对应的id
        return $nestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    public function save(){
        //创建一个能够执行sql的对象
        $dbMysql = new DbMysqlInterfaceImplModel();
        //计算左右边界，生成sql
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //将分类移动到其他分类下
        $nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);
        //保存修改内容到数据库
        parent::save();
    }

    /**
     * 不仅把自己的状态修改了,还需要修改子孙节点select id as goods_category_id,name as goods_category_name from goods_category as gc where lft<24 and rgt>25 ORDER BY lft ;
     * @param $id
     * @param int $status
     * @return bool
     */
    public function statusChange($id, $status = -1)
    {

        //根据自己的id找到自己以及子孙节点的id
        $sql = "select child.id from  goods_category as child,goods_category as parent where  parent.id = {$id}  and child.lft>=parent.lft  and child.rgt<=parent.rgt";
        $rows = $this->query($sql);
        $id  = array_column($rows,'id');
        $data = array('id' => array('in', $id), 'status' => $status);
        if ($status == -1) {
            $data['name'] = array('exp', "concat(name,'_del')");  //update supplier set name = concat(name,'_del'),status = -1    where id in (1,2,3);
        }
        return parent::save($data);
    }

    public function getLeaf($goods_category_id){
        $sql = "select child.id from goods_category as  parent,goods_category as child where  parent.id = {$goods_category_id} and child.lft>=parent.lft and child.rgt<=parent.rgt and child.lft+1 =child.rgt";
        $rows = $this->query($sql);
        //从二维数组中得到id的值
        $ids = array_column($rows,'id');
        return $ids;
    }
}