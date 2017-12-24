<?php
namespace Mobile\Model;
class GoodsCategoryModel extends BaseModel
{
    /**
     * 获取父分类和兄弟分类
     * @param int $cat_id 分类id
     * @return array
     */
    public function parentAndSiblings($cat_id=NULL){
        $parent_id = $this->where(array('disabled'=>'N','id'=>$cat_id?:0))->getField('parent_id');
        if($parent_id){
            $prantCategory = $this->field('id,category_name')->where(array('disabled'=>'N','id'=>$parent_id))->find();
        }
        $list = $this->field('id,category_name')->where(array('disabled'=>'N','parent_id'=>$parent_id?:0))->order('parent_id ASC,rank ASC')->select();
        if($prantCategory){
            array_unshift($list, $prantCategory);
        }
        return $list;
    }

    /**
     * 获取某个节点下的分类
     * @param int $cat_id 分类id
     * @return array
     */
    public function selfAndChild($cat_id=NULL){
        $self = $this->field('id,category_name')->where(array('disabled'=>'N','id'=>$cat_id?:0))->find();
        $list = $this->field('id,category_name')->where(array('disabled'=>'N','parent_id'=>$cat_id?:0))->order('parent_id ASC,rank ASC')->select();
        if(!$self) return $list;
        
        if($list){           
            array_unshift($list, $self);
        }else{
            $list = array($self);
        }
        return $list;
    }

    /**
     * 获取某个节点下的子孙后代(不包含节点本身)
     * @param int $tree_id
     * @return array
     */
    function getChildTree($tree_id=0){
        #递归调用方法的时候，方法中的变量不会被重新初始化的，类似静态变量了
        $tree_arr = array();

        $map = array(
            'parent_id' => $tree_id,
            'disabled' => 'N',
            'display' => 'Y'
        );
        $category = $this->where($map)->select();

        if ( $category ){
            #这个是获得自己与自己在同一根节点上的兄弟，最差情况就是自己一个人喽
            foreach ( $category as $val ){
                $tree_arr[$val['id']] = array(
                    'id' => $val['id'],
                    'cat_name' => $val['category_name'],
                    'cat_logo' => $val['category_logo'],
                    'cat_id' => $this->getChildTree($val['id'])
                );
            }
        }

        return $tree_arr;
    }

    /**
     * 获取某个节点下的子孙后代的分类id(包含节点本身)
     * @param int $tree_id
     * @return array
     */
    function _getCatTreeIds($tree_id){
        #递归调用方法的时候，方法中的变量不会被重新初始化的，类似静态变量了
        $tree_ids = array();

        $map = array(
            'parent_id' => $tree_id,
            'disabled' => 'N',
            'display' => 'Y',
        );
        $category = $this->where($map)->field('id')->select();
        if ( $category ){
            #这个是获得自己与自己在同一根节点上的兄弟，最差情况就是自己一个人喽
            foreach ( $category as $val ){
                $tree_ids[$val['id']] = array(
                    'id' => $val['id'],
                    'cat_id' => $this->_getCatTreeIds($val['id'])
                );
            }
        }
        return $tree_ids;
        
    }

    function getCatTreeIds($tree_id){
        $tress_ids = $this->_getCatTreeIds($tree_id);
        $cat_ids=array();
        foreach ($tress_ids as $key => $value) {
           $cat_ids[]=$value['id'];
           if($value['cat_id'])
           {
               foreach ($value['cat_id'] as $key2 => $value2) {
                  $cat_ids[]=$value2['id'];
               }
           }
        }
        #将自己加进来
        $cat_ids[]=$tree_id;
        $cat_ids = implode(',', $cat_ids);
        return $cat_ids;
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
}