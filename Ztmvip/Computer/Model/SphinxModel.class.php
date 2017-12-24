<?php
/**
 * 与sphinx有关的业务控制器
 * author: sansheng
 */
namespace Computer\Model;
class SphinxModel
{
    private $sphinx;

    public function __construct(){
        $this->sphinx = new \SphinxClient();
        $this->sphinx->SetServer(C('SPHINX.host'),C('SPHINX.port'));
        $this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
    }

    /**
     * 搜索匹配的商品
     * @param $word
     * @return array
     */
    public function getLikeGoods($word){
        $ret = $this->sphinx->query($word,"*");

        if ( !empty($ret['matches']) ){
            return  array_keys($ret['matches']);
        }else{
            return false;
        }
    }

    /**
     * 让关键字高亮显示
     * @param $goods
     * @param $word
     * @param string $opts
     * @return array
     */
    public function getHighWorlds($goods,$word,$opts=''){
        if ( !$opts )
            $opts = array(
                'before_match'=>"<font style='font-weight:bold;color:red;'>",
                'after_match'=>"</font>",
            );

        $new_goods = array();

        foreach ( $goods as $key => $val ) {
            $new_goods[] = $this->sphinx->buildExcerpts($val,'ztm_goods',$word,$opts);
        }

        return $new_goods;
    }
}