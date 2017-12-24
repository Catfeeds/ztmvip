<?php
namespace Mobile\Controller;

use     Think\Controller;

class  BrandController extends BaseController
{
    /**
     * 品牌产品信息列表
     */
    public function index($id){
        $arr = D('Goods')->where(array('brand_id'=>$id,'disabled'=>'N'))->select();
        show_bug($arr);
    }
}