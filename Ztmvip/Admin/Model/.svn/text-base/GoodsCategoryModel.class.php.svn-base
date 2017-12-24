<?php
/**
 * 商品分类模型
 * author: Tom
 */
namespace Admin\Model;
class GoodsCategoryModel extends BaseModel
{
    /**
     * 获取商品分类
     * @param int $parent_id 父分类id
     * @param bool|false $merge
     * @return array
     */
    public function category_list($parent_id=NULL,&$merge=false){
        $list = $this->where(array('disabled'=>'N','parent_id'=>$parent_id?:0))->order('parent_id ASC,rank ASC')->select();

        if ( is_null($parent_id) ){
            $ret = array();

            foreach ( $list as $val ){
                $ret[] = $val;
                $this->category_list($val['id'],$ret);
            }

            return $ret;
        }elseif( $merge && $list ){
            foreach ( $list as $val ){
                $val['category_name'] = str_repeat('——',count(explode('.',$val['tree_struct']))) . $val['category_name'];
                $merge[] = $val;
                $this->category_list($val['id'],$merge);
            }
        }else{
            return $list;
        }
    }
}