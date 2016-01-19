<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel
{
//自动验证模板，验证不能为空的字段
protected $_validate_1 = array(
    array('name','require','商品名称不能够为空'),
    array('short_name','require','简称不能够为空'),
    array('sn','require','货号不能够为空'),
    array('goods_category_id','require','商品分类不能够为空'),
    array('brand_id','require','商品品牌不能够为空'),
    array('supplier_id','require','供货商不能够为空'),
    array('shop_price','require','本店价格不能够为空'),
    array('market_price','require','市场价格不能够为空'),
    array('logo','require','商品LOGO不能够为空'),
    array('stock','require','库存不能够为空'),
    array('goods_status','require','商品状态不能够为空'),
    array('status','require','是否显示不能够为空'),
    );


    //连接查询方法
    protected function _setModel(){

        //连接其他表
        $this->join('__GOODS_CATEGORY__ as gc on obj.goods_category_id = gc.id ');
        $this->join('__BRAND__ as b on obj.brand_id = b.id ');
        $this->join('__SUPPLIER__ as s on obj.supplier_id = s.id ');
        //取出其他表中的name
        $this->field('obj.*,gc.name as goods_category_name,b.name as brand_name,s.name as supplier_name');
    }



    public function add($requestData){

        //开启事物
        $this->startTrans();
        //调用handleGoodsStatus计算状态
        $this->handleGoodsStatus();
        //调用父类add方法存储通用数据，并返回id
        $id = parent::add();
        //如果存储失败，则回滚
        if($id===false){
            $this->error = '保存数据失败';
            $this->rollback();
            return false;
        }

        //按照规则生成一个货号，并保存到数据表中
        $sn = date('Ymd').str_pad($id,9,'0',STR_PAD_LEFT);
        $result = parent::save(array('id'=>$id,'sn'=>$sn));
        //存入失败，回滚
        if($result===false){
            $this->error = '保存货号失败';
            $this->rollback();
            return false;
        }


        //将商品描述保存到描述表中
        $goodsIntroModel = M('GoodsIntro');
        $result1 = $goodsIntroModel->add(array('goods_id'=>$id,'intro'=>$requestData['intro']));
        if($result1===false){
            $this->error = '保存商品描述失败';
            $this->rollback();
            return false;
        }

        //将会员价格保存到商品会员表中
        $memberPrice = $this->handMemberPrice($id,$requestData['memberPrices']);
        if($memberPrice===false){
            return false;
        }

        //将照片路径保存到表中
        $goodsPhtot = $this->handleGoodsPhoto($id,$requestData['goods_photo_paths']);
        if($goodsPhtot===false){
            return false;
        }

        //将文章保存到goods_article表中
        $goodsArticle = $this->handleGoodsArticle($id,$requestData['article_ids']);
        if($goodsArticle===false){
            return false;
        }

        //事务提交
        $this->commit();

        return $id;
    }


    //编辑
    public function save($requestData){
        $goods_id = $this->data['id'];
//        dump($requestData);
//        exit;
        //开启事务
        $this->startTrans();
        //调用handleGoodsStatus计算状态
        $this->handleGoodsStatus();
        //调用父类save方法保存数据
        $result = parent::save();
        if($result===false){
            $this->error = '修改数据失败';
            $this->rollback();
            return false;
        }
        //将goods_intro修改到表中
        $goodsIntroModel = M('GoodsIntro');
        $result1 = $goodsIntroModel->save(array('goods_id'=>$goods_id,'intro'=>$requestData['intro']));
        if($result1===false){
            $this->error = '修改数据失败';
            $this->rollback();
            return false;
        }

        //将会员价格修改到goods_member_price表中,先删除，再添加
        $this->handMemberPrice($goods_id,$requestData['memberPrices']);

        //将照片地址修改到表中，新上传的都有隐藏域，直接调用handleGoodsPhoto修改
        $this->handleGoodsPhoto($goods_id,$requestData['goods_photo_paths']);

        //将文章修改到表中，每次修改上传的文章都会更新隐藏域，直接调用handleGoodsArticle修改
        $this->handleGoodsArticle($goods_id,$requestData['article_ids']);


        $this->commit();
        return $result;
    }


    //计算商品状态
    private function handleGoodsStatus(){
        $goods_status = 0;
        foreach($this->data['goods_status'] as $gs){
            $goods_status = $goods_status | $gs;
        }
        //将计算的状态值重新赋给this->data
        $this->data['goods_status'] = $goods_status;
    }

    //处理会员价格，删除和添加
    private function handMemberPrice($goods_id,$memberPrices){
        //先删除goods_member_price表中的响应会员价格数据
        $goodsMemberPriceModel = M('GoodsMemberPrice');
        $result = $goodsMemberPriceModel->where(array('goods_id'=>$goods_id))->delete();
        if($result===false){
            $this->error = '删除会员价格失败';
            $this->rollback();
            return false;
        }

        //再添加数据
        $rows =array();
        foreach($memberPrices as $member_level_id=>$price){
            $rows[] = array('goods_id'=>$goods_id,'member_level_id'=>$member_level_id,'price'=>$price);
        }
        if(!empty($rows)){
            $result1 = $goodsMemberPriceModel->addAll($rows);
            if($result1===false){
                $this->error = '保存会员价格失败';
                $this->rollback();
                return false;
            }
        }
    }

    //处理商品照片
    private function handleGoodsPhoto($goods_id,$goodsPhotoPaths){
        //创建模型对象
        $goodsPhotoModel = M('GoodsPhoto');
        //添加照片路径到数据库goods_photo表
        $rows = array();
        foreach($goodsPhotoPaths as $path){
            $rows[] = array('goods_id'=>$goods_id,'path'=>$path);
        }
        if(!empty($rows)){
            $result1 = $goodsPhotoModel->addAll($rows);
            if($result1===false){
                $this->error = '保存上传图片失败';
                $this->rollback();
                return false;
            }
        }
    }

    //处理文章的方法
    private function handleGoodsArticle($goods_id,$goodsArticleIds){
        //创建模型对象
        $goodsArticleModel = M('GoodsArticle');
        //添加文章到goods_article表中
        $rows = array();
        foreach($goodsArticleIds as $goodsArticleId){
            $rows[] = array('goods_id'=>$goods_id,'article_id'=>$goodsArticleId);
        }
        if(!empty($rows)){
            $result1 = $goodsArticleModel->addAll($rows);
            if($result1===false){
                return false;
            }
        }
    }


    protected function _handleRows(&$rows){
        //循环$rows，改变状态展示方法
        foreach($rows as &$row){
            $row['is_new'] = (($row['goods_status'] & 1));
            $row['is_best'] = (($row['goods_status'] & 2) >> 1);
            $row['is_hot'] = (($row['goods_status'] & 4) >> 2);
        }
        unset($row);
    }




}