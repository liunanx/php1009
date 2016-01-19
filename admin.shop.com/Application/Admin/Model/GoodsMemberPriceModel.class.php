<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/17
 * Time: 19:19
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel extends Model
{
    //获取会员价格构成数组
    public function getMemberPrice($goods_id){
        //查询出$goods_id对应的值
        $rows = $this->field('member_level_id,price')->where(array('goods_id'=>$goods_id))->select();
        //取出rows中的member_level_id
        $member_level_ids = array_column($rows,'member_level_id');

        //取出rows中的price
        $prices = array_column($rows,'price');

        //将member_level_ids作为键,  prices作为值
        $row = array_combine($member_level_ids,$prices);

        //返回数组
        return $row;
    }
}