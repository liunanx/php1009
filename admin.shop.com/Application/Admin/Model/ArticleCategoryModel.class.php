<?php
namespace Admin\Model;


use Think\Model;

class ArticleCategoryModel extends BaseModel
{
//自动验证模板，验证不能为空的字段
protected $_validate = array(
    array('name','require','分类名称不能够为空'),
array('is_help','require','帮助分类不能够为空'),
array('status','require','是否显示不能够为空'),
    );
}