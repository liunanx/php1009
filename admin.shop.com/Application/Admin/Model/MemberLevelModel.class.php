<?php
namespace Admin\Model;


use Think\Model;

class MemberLevelModel extends BaseModel
{
//自动验证模板，验证不能为空的字段
protected $_validate = array(
    array('name','require','会员级别名称不能够为空'),
array('low','require','最低积分不能够为空'),
array('high','require','最高积分不能够为空'),
array('discount','require','折扣不能够为空'),
array('status','require','是否显示不能够为空'),
    );
}