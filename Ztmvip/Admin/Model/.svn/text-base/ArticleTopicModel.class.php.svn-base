<?php
/**
 * 文章分类模型
 * author: Tom
 */
namespace Admin\Model;
class ArticleTopicModel extends BaseModel
{
    /**
     * 获取文章分类
     * @param int $parent_id 父分类id
     * @param bool|false $merge
     * @return array
     */
    public function topic_list($parent_id=NULL,&$merge=false,$deep=0){
        $list = $this->where(array('parent_id'=>$parent_id?:0))->order('parent_id ASC,rank ASC')->select();

        if ( is_null($parent_id) ){
            $ret = array();

            foreach ( $list as $val ){
                $ret[] = $val;
                $this->topic_list($val['id'],$ret,1);
            }

            return $ret;
        }elseif( $merge && $list ){
            foreach ( $list as $val ){
                $val['topic_name'] = str_repeat('——',$deep + 1) . $val['topic_name'];
                $merge[] = $val;
                $this->topic_list($val['id'],$merge,$deep + 1);
            }
        }else{
            return $list;
        }
    }
}