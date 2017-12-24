<?php
/**
 * 与搜索有关的业务控制器
 * author: sansheng
 */
namespace Computer\Controller;
class SearchController extends BaseController
{
    /**
     *  首页搜索
     * @param $word
     */
    public function index($word){
        $word = trim($word);
        $page_size = 40;

        try{
            if( !$word )
                E('抱歉，没有搜索到匹配商品');

            $get = I('get.');
            $get['p'] = intval($get['p'])>1?intval($get['p']) - 1:0;

            $sphinx = new \SphinxClient();
            $sphinx->SetServer(C('SPHINX.host'),C('SPHINX.port'));
            $sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
            $sphinx->setFilter('on_sale',array(1));    //上架商品
            $sphinx->setFilter('disabled',array(0));   //过滤删除商品
            $sphinx->SetLimits($get['p']*$page_size,$page_size,1000);

            //排序
            $order = '';
            switch ( $get['order'] ) {
                case 'click':
                    $order .= 'click DESC';
                    break;
                case 'sales':
                    $order .= 'sales DESC';
                    break;
                case 'spup':
                    $order .= 'shop_price ASC';
                    break;
                case 'spdown':
                    $order .= 'shop_price DESC';
                    break;
                default:
                    $order .= '@weight DESC';
                    break;
            }
            $order .= ', rank DESC';
            $sphinx->setSortMode(SPH_SORT_EXTENDED,$order);

            //价格区间
            $get['min_price'] = $get['min_price'] ? intval($get['min_price']) : 0;
            $get['max_price'] = $get['max_price'] ? intval($get['max_price']) : 0;
            if ( ($get['min_price'] && $get['min_price'] > 0) || ($get['max_price'] && $get['max_price'] > 0) ){
                $min_price = 0;
                $max_price = 9999999;

                if ( $get['min_price'] )
                    $min_price = $get['min_price'];

                if ( $get['max_price'] )
                    $max_price = $get['max_price'];

                $sphinx->setFilterFloatRange('shop_price',$min_price,$max_price);
            }

            //排序条件
            $res = $sphinx->query($word,"*");
            if ( empty($res['matches']) )
                E('抱歉，没有搜索到匹配商品');

            $ids = join(',',array_keys($res['matches']));

            $map = array(
                'g.id' => array('IN',$ids),
                );

            //查询商品即可
            $page = $this->page($res['total'],$page_size);
            $page->setConfig('theme'," %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE%");

            $goods = D('Goods')->alias('g')->field('g.id,g.goods_name,g.shop_price,g.market_price,g.goods_thumb')
                ->join('__GOODS_EXTEND__ ge ON g.id=ge.goods_id')
                ->join('LEFT JOIN __USER_FAVOR__ uf ON g.id=uf.goods_id')
                ->where($map)
                ->order("FIND_IN_SET(g.id,'$ids') ASC")
                ->select();
            $this->assign('goods',$goods);
        }catch(\Think\Exception $e){
            $this->assign('error',$e->getMessage());
        }

        $this->assign('page_title','与“'. $word .'”相关的商品 ');
        $this->display();
    }
}