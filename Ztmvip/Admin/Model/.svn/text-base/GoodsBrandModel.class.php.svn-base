<?php
/**
 * 商品品牌模型
 * author: Tom
 */
namespace Admin\Model;
class GoodsBrandModel extends BaseModel
{
    /**
     * 获取品牌列表
     * @return mixed
     */
    public function brand_list(){
        return $this->where(array('display'=>'Y'))->order('rank DESC')->select();
    }
}