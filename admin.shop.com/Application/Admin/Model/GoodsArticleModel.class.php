<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/18
 * Time: 19:26
 */

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model
{
    public function getArticle($goods_id){
        //给表定义一个别名
        $this->field('obj.article_id,a.name');
        $this->alias('obj');
        $this->join('__ARTICLE__ as a on obj.article_id = a.id ');
        $this->where(array('obj.goods_id'=>$goods_id));
        return $this->select();
    }
}