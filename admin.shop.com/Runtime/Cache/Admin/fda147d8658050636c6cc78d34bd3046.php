<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加<?php echo ($meta_title); ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<!--为css预留位置-->
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo ($meta_title); ?>列表</a>
    </span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加<?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>

            
    <div id="tabbody-div">
        <form action="<?php echo U();?>" method="post">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">品牌名称：</td>
                    <td><input type="text" name="name" value="<?php echo ($name); ?>" size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">品牌网址： </td>
                    <td>
                        <input type="text" name="url" value="<?php echo ($url); ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr class="label">
                    <td class="label">品牌logo： </td>
                    <td>
                        <input type="file" name="logo">
                    </td>
                </tr>
                <tr>
                    <td class="label">排序： </td>
                    <td>
                        <input type="text" name="sort" value="<?php echo ($sort); ?>" size="20"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">品牌简介：</td>
                    <td>
                        <textarea  name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否显示：</td>
                    <td>
                        <input type="radio" name="status" value="1" class="status"/> 是
                        <input type="radio" name="status" value="0" class="status"/> 否
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                <input class="ajax-post button" type="submit" value=" 确定 "/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>


</div>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>
<!--为javascript预留位置-->
<script type="text/javascript">
    $(function (){
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>
</body>
</html>