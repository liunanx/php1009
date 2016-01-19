<?php
namespace Admin\Model;


use Think\Model;

class ArticleModel extends BaseModel
{
    protected $_auto = array(
        array('inputtime',NOW_TIME)
    );
    //自动验证模板，验证不能为空的字段
    protected $_validate_1 = array(
    array('name','require','文章名称不能够为空'),
    array('article_category_id','require','文章分类ID不能够为空'),
    array('inputtime','require','录入时间不能够为空'),
    array('status','require','是否显示不能够为空'),
    );

    //连接查询方法
    protected function _setModel(){
        //连接另外一个表
        $this->join('__ARTICLE_CATEGORY__ as ac on obj.article_category_id = ac.id');
        //指定查询出表中的字段
        $this->field('obj.*,ac.name as article_category_name');
    }

    public function add($requestData){
        //调用父类基础add，将基本内容储存到article表中
        $id = parent::add();
        if($id===false){
            $this->error = '保存失败';
            return false;
        }
        //将文章内容保存到article_content表中
        $articleContentModel = M('articleContent');
        $result = $articleContentModel->add(array('article_id'=>$id,'content'=>$requestData['content']));
        if($result===false){
            $this->error = '保存内容失败';
            return false;
        }
        return $id;
    }

    //重写修改文章内容
    public function save($requestData){
        //调用父类的save方法,将基本内容修改
        $result = parent::save();
        if($result===false){
            return false;
        }
        $id = $requestData['id'];
//        dump($id);
//        exit;
        //将修改后的文章内容保存到数据表中
        $articleContentModel = M('articleContent');
        $result1 = $articleContentModel->save(array('article_id'=>$id,'content'=>$requestData['content']));
        if($result1===false){
            $this->error = '修改失败';
            return false;
        }
    }
}