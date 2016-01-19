<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/17
 * Time: 23:20
 */

namespace Admin\Controller;


use Think\Controller;

class GoodsPhotoController extends Controller
{
    public function remove($id){
        //创建模型对象
        $goodsPhotoModel = M('GoodsPhoto');
        //删除数据库中的数据
        $result = $goodsPhotoModel->delete($id);
        if($result!==false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}