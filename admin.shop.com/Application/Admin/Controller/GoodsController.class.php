<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsController extends BaseController
{
    protected $meta_title = "商品";

    //告诉父类中的add和edit方法通过I('post.')接收到请求中的所有数据.并且传递给模型类
    protected $usePostParams  = true;

    protected function _editGetTreeList(){
        $model = D('GoodsCategory');
        //为视图页面准备数据
        $zNodes = $model->getTreeList(true,'id,name,parent_id');
        //将数据分配到页面上
        $this->assign('zNodes',$zNodes);


        //查询能够显示的品牌数据
        $brandModel = D('Brand');
        $brand = $brandModel->getList('*',array('status'=>array('gt',-1)));
        //分配到页面上
        $this->assign('brand',$brand);


        //查询能够显示的供应商数据
        $supplierModel = D('Supplier');
        $supplier = $supplierModel->getList('*',array('status'=>array('gt',-1)));
        //数据分配到页面上
        $this->assign('supplier',$supplier);

        //展示会员级别数据
        $memberLevelModel = D('MemberLevel');
        $memberLevels = $memberLevelModel->getList('*',array('status'=>array('gt',-1)));
        $this->assign('memberLevels',$memberLevels);

        //查询intro数据
        $id = I('get.id');
        if(!empty($id)){
            $goodsIntoModel = M('GoodsIntro');
            $intro = $goodsIntoModel->getFieldByGoods_id($id,'intro');
            //数据分配到页面上
            $this->assign('intro',$intro);

            //回显会员价格数据
            $goodsMemberPriceModel = D('GoodsMemberPrice');
            $memberPrices = $goodsMemberPriceModel->getMemberPrice($id);
            $this->assign('memberPrices',$memberPrices);

            //回显商品照片
            $goodsPhotoModel = M('GoodsPhoto');
            $goodsPaths = $goodsPhotoModel->where(array('goods_id'=>$id))->select();
            $this->assign('goodsPaths',$goodsPaths);

            //回显文章标题
            $goodsArticleModel = D('GoodsArticle');
            $goodsArticles = $goodsArticleModel->getArticle($id);
            $this->assign('goodsArticles',$goodsArticles);
        }
    }

    protected function _indexViewBefore(){
        //查询供货商数据，分配到goods页面
        $supplierModel = D('Supplier');
        $suppliers = $supplierModel->getList('id,name');
        $this->assign('suppliers',$suppliers);
        //查询品牌数据，分配到goods页面
        $brandModel = D('Brand');
        $brands = $brandModel->getList('id,name');
        $this->assign('brands',$brands);

        //查询分类数据，分配到页面上
        $goodsCategoryModel = D('GoodsCategory');
        $zNodes = $goodsCategoryModel->getTreeList(true,'id,name,parent_id');
        $this->assign('zNodes',$zNodes);
    }

    protected function _setWheres(&$wheres){
        //根据供应商查询
        $supplier_id = I('get.supplier_id');
        if(!empty($supplier_id)){
            $wheres['obj.supplier_id']=$supplier_id;
        }

        //根据品牌查询
        $brand_id = I('get.brand_id');
        if(!empty($brand_id)){
            $wheres['obj.brand_id']=$brand_id;
        }

        //根据分类查询
        $goods_category_id = I('get.goods_category_id');
        $goodsCategoryModel = D('GoodsCategory');
        if(!empty($goods_category_id)){
            $leafIds = $goodsCategoryModel->getLeaf($goods_category_id) ;
            $wheres['obj.goods_category_id'] = array('in',$leafIds);
        }
    }

}