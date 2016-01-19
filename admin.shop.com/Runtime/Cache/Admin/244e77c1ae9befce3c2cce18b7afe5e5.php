<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加<?php echo ($meta_title); ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/common.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

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
                    <td class="label">分类名称</td>
                    <td>
                        <input type='text' name='name' value='<?php echo ($name); ?>' size='30'/></td>
                </tr>
                <tr>
                    <td class="label">父分类</td>
                    <td>
                        <input type="hidden"  class="parent_id" name="parent_id" value="0">
                        <input type='text' name='parent_name' class="parent_name" value='默认为顶级分类' disabled="disabled" size='30'/></td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <style type="text/css">
                            .ztree{
                                margin-top: 10px;
                                border: 1px solid #617775;
                                background: #f0f6e4;
                                width: 220px;
                                height: auto;
                                overflow-y: scroll;
                                overflow-x: auto;
                            }
                        </style>
                        <ul id="treeDemo" class="ztree"></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">分类简介</td>
                    <td>
                        <textarea name='intro' cols='60' rows='4'><?php echo ($intro); ?></textarea></td>
                </tr>
                <tr>
                    <td class="label">是否显示</td>
                    <td>
                        <input type='radio' name='status' value='1' class='status'/> 是<input type='radio' name='status'
                                                                                             value='0' class='status'/>
                        否
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                <input class="ajax-post button" type="submit" value=" 确定 "/>
                <input type="reset" value=" 重置 " class="button"/>
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

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript">

        $(function(){
            //树状结构设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id"
                    }
                },
                callback:{
                    /**
                     * event： js event 对象 标准的 js event 对象
                     * treeId： String对应 zTree 的 treeId，便于用户操控
                     * treeNode： JSON 被点击的节点 JSON 数据对象
                     */
                    onClick:function(event, treeId, treeNode){
                        console.debug(treeNode);
                        $('.parent_name').val(treeNode.name);
                        $('.parent_id').val(treeNode.id);
                    }
                }
            };

            //树状数据设置
            var zNodes = <?php echo ($zNodes); ?>;


            //将ul编程树结构
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(empty($id)): ?>treeObj.expandAll(true);
            <?php else: ?>
                var parent_id = <?php echo ($parent_id); ?>
            //根据parent_id找到要选中的节点id
                var node = treeObj.getNodeByParam('id',parent_id);
                treeObj.selectNode(node);
            //将name和id放入text表单中
                $('.parent_name').val(node.name);
                $('.parent_id').val(node.id);<?php endif; ?>
        });

    </script>

<script type="text/javascript">
    $(function (){
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>
</body>
</html>