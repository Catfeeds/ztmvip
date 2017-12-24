<?php
/**
 * 商品模型
 * author: Tom
 */
namespace Admin\Model;
use Think\Model;

class GoodsModel extends BaseModel
{
    /**
     * 商品主图
     * @param $file
     */
    public function image_thumb($file){
        $source_file = $file;
        $image = new \Think\Image(\Think\Image::IMAGE_IMAGICK);
        //243*300
        $image->open($source_file);
        $image->thumb(243,300,$image::IMAGE_THUMB_FILLED)->save($file.'_243x300.jpg',null,97);
        //360*440
        $image->open($source_file);
        $image->thumb(360,440,$image::IMAGE_THUMB_FILLED)->save($file.'_360x440.jpg',null,80);
        //710*700
        $image->open($source_file);
        $image->thumb(710,700,$image::IMAGE_THUMB_FILLED)->save($file.'_710x700.jpg',null,80);
        //217*217
        $image->open($source_file);
        $image->thumb(217,217,$image::IMAGE_THUMB_FILLED)->save($file.'_217x217.jpg',null,97);
        //710*700
        $image->open($source_file);
        $image->thumb(206,250,$image::IMAGE_THUMB_FILLED)->save($file.'_206x250.jpg',null,97);
        //710*700
        $image->open($source_file);
        $image->thumb(250,250,$image::IMAGE_THUMB_FILLED)->save($file.'_250x250.jpg',null,97);
    }

    /**
     * 商品橱窗图
     * @param $file
     * @return string
     */
    public function gallery_thumb($file){
        $source_file = $file;
        $image = new \Think\Image(\Think\Image::IMAGE_IMAGICK);
        //710*700
        $image->open($source_file);
        $image->thumb(710,700,$image::IMAGE_THUMB_FILLED)->save($file.'_710x700.jpg',null,80);
        return substr($file.'_710x700.jpg',1);
    }

    /**
     * 商品属性加入mongodb
     * @param $sku_id sku id
     * @param $skus sku值
     * @param null $goods_id 商品id
     */
    public function skus_mongo($sku_id,$skus,$goods_id=null){
        $mongo_goods = new \Think\Model\MongoModel('goods',C('DB_PREFIX'),C('MONGO'));

        $data = array(
            'id' => $goods_id,
            'sku_id' => $sku_id,
            'skus' => $skus,
        );
        //print_r($mongo_goods->where(array('skus'=>array('$elemMatch'=>array('value'=>'黑色'))))->find());exit;
        if ( $goods = $mongo_goods->where(array('id'=>$goods_id))->find() ){
            $mongo_goods->where(array('id'=>$goods_id))->save($data);
        }else{
            $mongo_goods->add($data);
        }
    }
}