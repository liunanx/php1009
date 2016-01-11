<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/6
 * Time: 18:54
 */

namespace Admin\Model;


use Think\Model;


class SupplierModel extends BaseModel
{
    // 自动验证定义
    protected $_validate = array(
        array('name','require','名字不能够为空'),
        array('name','','名字已经存在','','unique'),
        array('intro','require','描述不能够为空'),
    );
}