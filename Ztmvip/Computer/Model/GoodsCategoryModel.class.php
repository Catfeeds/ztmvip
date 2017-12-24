<?php
/**
 * 商品分类模型
 * author: sansheng
 */
namespace Computer\Model;
class GoodsCategoryModel extends BaseModel
{
    
    /**
     * 以cat_id获取category_name
     * @param  [type] $cat_id [description]
     * @return [type]         [description]
     */
    public function getCategoryName($cat_id)
    {
       return $this->where(array('id'=>$cat_id))->getField('category_name');
    }


  /**
   * 获取某个节点下的子孙后代(不包含节点本身)
   * @param int $tree_id
   * @return array
   */
  function getChildTree($tree_id=0){
        
      $category = $this->where( array(
                          'parent_id' => $tree_id,
                          'disabled' => 'N',
                          'display' => 'Y'))
                        ->select();

       $tree_arr = array();
      if ( $category ){
          foreach ( $category as $value ){
              $tree_arr[$value['id']] = array(
                  'cat_id' => $value['id'],
                  'category_name' => $value['category_name'],
                  'category_logo' => $value['category_logo'],
                  'son' => $this->getChildTree($value['id'])
              );
          }
      }

      return $tree_arr;
  }


    /**
     * 获取分类子孙后代(包含本身)
     * @param int $tree_id 分类id
     * @return array() 如：array(本身分类,分类一,分类二,...),每个分类都是一个数组
     */
    public function getChildByTreeStruct($tree_id=0)
    {
        $tree_struct = $this->where(array('id' => $tree_id,'disabled'=>'N','display'=>'Y'))->getField('tree_struct');
        $map['_string'] = "id = {$tree_id} or INSTR(tree_struct,'{$tree_struct}{$tree_id}.')>0";
        $map['disabled'] = 'N';
        $map['display'] = 'Y';
        return $this->where($map)->select();
    }

    /**
     * 获取分类子孙后代ids(包含本身)
     * @param int $tree_id 分类id
     * @return array 如：array(本身id,31,41,55)
     */
    public function getChildIdsByTreeStruct($tree_id=0)
    {
        $tree_struct = $this->where(array('id' => $tree_id,'disabled'=>'N','display'=>'Y'))->getField('tree_struct');
        $map['_string'] = "id = {$tree_id} or INSTR(tree_struct,'{$tree_struct}{$tree_id}.')>0";
        $map['disabled'] = 'N';
        $map['display'] = 'Y';
        return $this->where($map)->getField('id',true);
    }


/**
 * 获取活跃类
 * @return [type] [description]
 */
  public function getHotCategory($limit='6')
  {
    
    return $this->field('id,category_name')
         ->order('rank desc')
         ->limit($limit)
         ->where(array(
             'display'=>'Y',
             'hot'=>'Y',
             'disabled'=>'N',
           ))->select();
  }

}#类尾巴