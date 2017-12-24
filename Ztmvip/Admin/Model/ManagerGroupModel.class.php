<?php
/**
 * 管理组模型
 * author: Tom
 */
namespace Admin\Model;
class ManagerGroupModel extends BaseModel
{
    public $rights = array(
        'goods' => '商品管理',
        'goods_category' => '商品分类',
        'goods_sku' => '商品类型',
        'goods_brand' => '商品品牌',
        'goods_express' => '商品运费',
        'seckill' => '秒杀活动',
        'bargain' => '砍价活动',
        'order' => '订单管理',
        'user' => '会员管理',
        'affiliate' => '分佣记录',
        'bonus' => '红包管理',
        'coupon' => '优惠券管理',
        'prepaid' => '储值卡管理',
        'account' => '财务管理',
        'advert' => '广告管理',
        'article' => '文章管理',
        'article_topic' => '文章分类',
    );
}