<?php
defined('WEB_URL') or define('WEB_URL','http://admin.shop.com');

return array(
	//'配置项'=>'配置值'
    //配置字符串替换
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>WEB_URL.'/Public/Admin/css',
        '__JS__'=>WEB_URL.'/Public/Admin/js',
        '__IMG__'=>WEB_URL.'/Public/Admin/images',
        '__LAYER__'=>WEB_URL.'/Public/Admin/layer',
        '__UPLOADIFY__'=>WEB_URL.'/Public/Admin/uploadify',
        '__TREEGRID__'=>WEB_URL.'/Public/Admin/treegrid',
        '__ZTREE__'=>WEB_URL.'/Public/Admin/zTree',
        '__UPLOAD__'=>WEB_URL.'/Uploads',
        '__UEDITOR__'=>WEB_URL.'/Public/Admin/ueditor'
    )
);