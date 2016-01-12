<?php
namespace Admin\Model;


use Think\Model;

class BrandModel extends BaseModel
{
//自动验证模板，验证不能为空的字段
protected $_validate = array(
    array('name','require','品牌名称不能够为空'),
array('url','require','品牌网址不能够为空'),
array('logo','require','品牌LOGO@file不能够为空'),
array('sort','require','排序不能够为空'),
array('status','require','状态@radio|1=是&0=否不能够为空'),
    );
}