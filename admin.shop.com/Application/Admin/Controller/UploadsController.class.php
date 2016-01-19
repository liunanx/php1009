<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/12
 * Time: 23:34
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadsController extends Controller
{
    public function index(){
        $dir = I('post.dir');
        //上传配置信息
        $config = array(
            'maxSize'      => 0, //上传的文件大小限制 (0-不做限制)
            'exts'         => array(), //允许上传的文件后缀
            'autoSub'      => true, //自动子目录保存文件
            'subName'      => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'     => './Uploads/', //保存根路径
            'savePath'     => $dir.'/', //保存路径
            'saveExt'      => '', //文件保存后缀，空则使用原后缀
            'replace'      => false, //存在同名是否覆盖
            'callback'     => false, //检测文件是否存在回调，如果存在返回文件信息数组
            'driver'       => '', // 文件上传驱动
            'driverConfig' => array(), // 上传驱动配置
        );
        $upload = new Upload($config);
        $result = $upload->uploadOne($_FILES['Filedata']);
        if($result!==false){
            //将上传后的路径发送给浏览器
            echo $result['savepath'].$result['savename']; //保存到的地址
        }else{
            echo $upload->getError();
        }
    }
}