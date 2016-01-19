<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?>列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />
<!--预留css位置-->
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?>列表 </span>
    <div style="clear:both"></div>
</h1>
<!--预留搜索框位置-->
<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>ID <input type="checkbox" class="selectAll"/> </th>
                <!--使用注解中的名称生成了表头-->
                                <th>会员级别名称</th>
                                <th>最低积分</th>
                                <th>最高积分</th>
                                <th>折扣</th>
                                <th>会员级别简介</th>
                                <th>是否显示</th>
                                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                    <td width="30"><?php echo ($row["id"]); ?><input type="checkbox" name="id[]" class="ids" value="<?php echo ($row["id"]); ?>"/></td>
                    <td class="first-cell"><?php echo ($row["name"]); ?></td><td align="center"><?php echo ($row["low"]); ?></td><td align="center"><?php echo ($row["high"]); ?></td><td align="center"><?php echo ($row["discount"]); ?></td><td align="center"><?php echo ($row["intro"]); ?></td><td align="center"><a class="ajax-get" href="<?php echo U('changeStatus',array('id'=>$row['id'],'status'=>(1-$row['status'])));?>"><img src="http://admin.shop.com/Public/Admin/images/<?php echo ($row["status"]); ?>.gif"/></a></td>
                    <td align="center">
                        <a href="<?php echo U('edit',array('id'=>$row['id']));?>" title="编辑">编辑</a> |
                        <a  class="ajax-get" href="<?php echo U('statusChange',array('id'=>$row['id']));?>" title="移除">移除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div id="turn-page" class="page">
            <?php echo ($pageHtml); ?>
        </div>
    </div>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>


<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<!--预留出JavaScript位置-->

</body>
</html>