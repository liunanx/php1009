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
            <span class="tab-front">通用信息</span>
            <span class="tab-back">详细描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form action="<?php echo U();?>" method="post">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">商品名称</td>
                    <td>
                        <input type='text' name='name' value='<?php echo ($name); ?>' size='30'/></td>
                </tr>
                <tr>
                    <td class="label">简称</td>
                    <td>
                        <input type='text' name='short_name' value='<?php echo ($short_name); ?>' size='30'/></td>
                </tr>

                <tr>
                    <td class="label">商品分类</td>
                    <td>
                        <input type="text" class="goods_category_name" name="goods_category_name" value='必须选择最子分类' disabled="disabled"/>
                        <input type='hidden' class="goods_category_id" name='goods_category_id' value='<?php echo ($goods_category_id); ?>' size='30' />
                    </td>
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
                    <td class="label">商品品牌</td>
                    <td>
                        <?php echo arr2select('brand_id',$brand,$brand_id);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">供货商</td>
                    <td>
                        <?php echo arr2select('supplier_id',$supplier,$supplier_id);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店价格</td>
                    <td>
                        <input type='text' name='shop_price' value='<?php echo ($shop_price); ?>' size='30'/></td>
                </tr>
                <tr>
                    <td class="label">市场价格</td>
                    <td>
                        <input type='text' name='market_price' value='<?php echo ($market_price); ?>' size='30'/></td>
                </tr>
                <tr>
                    <td class="label">商品LOGO</td>
                    <td>
                        <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">
                        <input type='file' name='goods_logo' id="goods_logo_upload">
                        <div class="upload-img-box" <?php if(empty($logo)): ?>style="display:none"<?php endif; ?> >
                            <div class="upload-pre-item">
                                <img src="http://admin.shop.com/Uploads/<?php echo ($logo); ?>"/>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="label">库存</td>
                    <td>
                        <input type='text' name='stock' value='<?php echo ($stock); ?>' size='30'/></td>
                </tr>
                <tr>
                    <td class="label">商品状态</td>
                    <td>
                        <input type='checkbox' class="goods_status" name='goods_status[]' value='1' class='status'/> 精品
                        <input type='checkbox' class="goods_status" name='goods_status[]' value='2' class='status'/> 新品
                        <input type='checkbox' class="goods_status" name='goods_status[]' value='4' class='status'/> 热销
                    </td>
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
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td class="label">详细描述</td>
                    <td colspan="2">
                        <textarea id="intro" name="intro"><?php echo ($intro); ?></textarea>
                    </td>
                </tr>
            </table>

            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <?php if(is_array($memberLevels)): $i = 0; $__LIST__ = $memberLevels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$memberLevel): $mod = ($i % 2 );++$i;?><tr>
                        <td class="label"><?php echo ($memberLevel["name"]); ?></td>
                        <td>
                            <input type='text' name='memberPrices[<?php echo ($memberLevel["id"]); ?>]' maxlength='60' value='<?php echo ($memberPrices[$memberLevel["id"]]); ?>'/>
                            <span class="require-field">*</span>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>

            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td class="label">商品属性</td>
                    <td>
                        <input type='text' name='name2' maxlength='60' value=''/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
    <style type="text/css">
        .upload-pre-item{
            display: block;
            float: left;
            margin: 5px;
            position: relative;
        }
        .upload-pre-item a{
            position: absolute;
            right: 0px;
            top: 0px;
        }
    </style>

            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td >
                        <div id="upload-img-box" class="upload-img-box">
                            <?php if(is_array($goodsPaths)): $i = 0; $__LIST__ = $goodsPaths;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsPath): $mod = ($i % 2 );++$i;?><div class="upload-pre-item">
                                    <img src="http://admin.shop.com/Uploads/<?php echo ($goodsPath['path']); ?>"/>
                                    <a href="javascript:;" dbId="<?php echo ($goodsPath["id"]); ?>">X</a>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" id="upload-photo"/>
                    </td>
                </tr>
            </table>

        <table cellspacing="1" cellpadding="3" width="100%" style="display:none">
            <tr>
                <td colspan="3">
                    文章标题: <input type="text" name="keyword" class="keyword">
                    <input class="button searchArticle" type="button" value="搜索">
                    <div class="article_hidden">
                        <?php if(is_array($goodsArticles)): $i = 0; $__LIST__ = $goodsArticles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsArticle): $mod = ($i % 2 );++$i;?><input type="hidden" name="article_ids[]" value="<?php echo ($goodsArticle["article_id"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 500px"><select class="left" size="10" multiple="multiple" style="width: 500px"></select></td>
                <td>
                    操作<br/><br/>
                    <input class="left_all_right" type="button" value=">>"><br/><br/>
                    <input  class="left_2_right"  type="button" value=">"><br/><br/>
                    <input   class="right_2_left"   type="button" value="<"><br/><br/>
                    <input class="right_all_left"  type="button" value="<<"><br/>
                </td>
                <td>
                    <select  class="right" size="10" multiple="multiple" style="width: 500px">
                        <?php if(is_array($goodsArticles)): $i = 0; $__LIST__ = $goodsArticles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsArticle): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goodsArticle["article_id"]); ?>">
                                <?php echo ($goodsArticle["name"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
        </table>
            <div class="button-div">
                <input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                <input class="button" type="submit" value=" 确定 "/>
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
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/Admin/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript">
        /********************分类树状结构开始********************************/
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

                    beforeClick: function(treeId, treeNode) {
                        if (treeNode.isParent) {
                            //显示出一个提示框
                            layer.msg('必须选中最子分类!', {
                                time: 1000,  //等待时间后关闭
                                offset: 0,  //设置位置
                                icon: 2,  //设置提示框中的图标
                            });
                        }

                        //返回true,不让用户选中
                        return !treeNode.isParent;
                    },
                    /**
                     * event： js event 对象 标准的 js event 对象
                     * treeId： String对应 zTree 的 treeId，便于用户操控
                     * treeNode： JSON 被点击的节点 JSON 数据对象
                     */
                    onClick:function(event, treeId, treeNode){
                        console.debug(treeNode);
                        $('.goods_category_name').val(treeNode.name);
                        $('.goods_category_id').val(treeNode.id);
                    }
                }
            };

            //树状数据设置
            var zNodes = <?php echo ($zNodes); ?>;


            //将ul编程树结构
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(empty($id)): ?>treeObj.expandAll(true);
            <?php else: ?>
            var goods_category_id = <?php echo ($goods_category_id); ?>;
            //根据parent_id找到要选中的节点id
            var node = treeObj.getNodeByParam('id',goods_category_id);
            treeObj.selectNode(node);
            //将name和id放入text表单中
            $('.goods_category_name').val(node.name);
            $('.goods_category_id').val(node.id);<?php endif; ?>

            /*************************分类树状结构结束************************************/

            /**************************上传插件开始******************************************/
            $("#goods_logo_upload").uploadify({
                height        : 30,
                width         : 120,
                buttonText    : '上传图片',
                debug         : true,
                formData      : {'dir':'goods'},
                fileTypeExts : '*.gif; *.jpg; *.png',  //允许上传的文件
                // 'fileObjName': 'xxx', //上传该文件时,以什么名字上传..   $_FIELS['Filedata']
                swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',
                uploader      : '<?php echo U("Uploads/index");?>',
                //data是响应的上传后的地址
                'onUploadSuccess' : function(file, data, response) {  //data就是响应的 上传后的地址
                    $('.upload-img-box').show(); //显示出div
                    $('.upload-img-box .upload-pre-item img').attr('src','http://admin.shop.com/Uploads/'+data);
                    $('.logo').val(data);  //将上传后的路径同时也放到隐藏域中.. 一起提交给服务器.
                },
                'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                }
            });

            /**************************上传插件结束******************************************/

            /**************************tab的切换效果开始**************************************/
            //改变导航栏的状态
            $('#tabbar-div span').click(function(){
                $('#tabbar-div span').attr('class','tab-back');
                $(this).attr('class','tab-front');
                //索引点击的span
                var index = $(this).index();
                //现将所有的table隐藏
                $('#tabbody-div form table').hide();
                //再将点击索引到的table显示出来
                $('#tabbody-div form>table').eq(index).show();
            });
            /**************************tab的切换效果结束**************************************/

            /**************************编辑器页面开始*****************************************/
            //第一个参数是表单元素的id   第二个参数是关于在线编辑器的配置
            var ue = UE.getEditor('intro',{
                initialFrameHeight :400
            });
            /**************************编辑器页面结束*****************************************/

            /**************************回显商品状态 开始*****************************************/
            <?php if(!empty($id)): ?>var selectedGoodsStatus = [];
                var goodStatus = <?php echo ($goods_status); ?>;
                if(goodStatus & 1){
                    selectedGoodsStatus.push(1);
                }

                if(goodStatus & 2){
                    selectedGoodsStatus.push(2);
                }

                if(goodStatus & 4){
                    selectedGoodsStatus.push(4);
                }

                $('.goods_status').val(selectedGoodsStatus);<?php endif; ?>
            /**************************回显商品状态 结束*****************************************/

            /**************************上传相册开始******************************************/
            $("#upload-photo").uploadify({
                height        : 30,
                width         : 120,
                buttonText    : '上传图片',
                debug         : true,
                formData      : {'dir':'photo'},
                fileTypeExts : '*.gif; *.jpg; *.png',  //允许上传的文件
                // 'fileObjName': 'xxx', //上传该文件时,以什么名字上传..   $_FIELS['Filedata']
                swf           : 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',
                uploader      : '<?php echo U("Uploads/index");?>',
                //data是响应的上传后的地址
                'onUploadSuccess' : function(file, data, response) {  //data就是响应的 上传后的地址
                   //上传成功后生成一个div里面放照片
                    var photoHtml = '<div class="upload-pre-item">\
                                    <img src="http://admin.shop.com/Uploads/'+data+'" />\
                                    <input type="hidden" name="goods_photo_paths[]" value="'+data+'"/>\
                                   <a href="javascript:;">X</a>\
                                   </div>';
                    $('#upload-img-box').append(photoHtml);
                },
                'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                }
            });


            //点击事件，删除图片，采用事件委派的方式，使后添加的图片也有点击事件
            $('#upload-img-box').on('click','a',function(){

                var dbid = $(this).attr('dbid');
                var that = $(this);
                if(dbid){
                    $.post('<?php echo U("GoodsPhoto/remove");?>',{id:dbid},function(data){

                        if(data.status==0){
                            //删除失败时, 提示错误信息
                            layer.msg(data.info,{
                                icon: 2
                            });
                        }else{
                            //删除数据库中数据成功时,删除页面上的div
                            that.closest('div').remove();
                        }
                    })
                }else{
                    //直接删除div
                    that.closest('div').remove();
                }
            });
            /**************************上传相册结束******************************************/

            /**************************搜索文章开始******************************************/
            $('.searchArticle').click(function(){
                var kw = $('.keyword').val();
                $('.left').empty();
                $.getJSON('<?php echo U("Article/search");?>',{keyword:kw},function(rows){
                    //将rows中的数据变成option放到 class='left'的下拉框中
                    if(rows){
                        $(rows).each(function(){
                            $('<option value="'+this.id+'">'+this.name+'</option>').appendTo('.left');
                        });
                    }
                });

            })

            //将搜索到的文章在两个盒子内转换
            $('.left_all_right').click(function(){
                $('.left option').appendTo('.right');
                select2Hidden();
            });
            $('.right_all_left').click(function(){
                $('.right option').appendTo('.left');
                select2Hidden();
            });
            $('.left_2_right').click(function(){
                $('.left option:selected').appendTo('.right');
                select2Hidden();
            });
            $('.right_2_left').click(function(){
                $('.right option:selected').appendTo('.left');
                select2Hidden();
            });

            //生成隐藏域，存储文章id
            function select2Hidden(){
                //先清空隐藏域盒子下的内容
                $('.article_hidden').empty();
                //将右边下拉框中的内容放到隐藏域中
                $('.right>option').each(function(){
                    $('<input type="hidden" name="article_ids[]" value="'+this.value+'" />').appendTo('.article_hidden');
                })

            }
            /**************************搜索文章结束******************************************/
        });
    </script>

<script type="text/javascript">
    $(function (){
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>
</body>
</html>