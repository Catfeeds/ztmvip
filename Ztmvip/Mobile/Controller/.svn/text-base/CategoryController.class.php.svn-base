<?php
namespace Mobile\Controller;

use Think\Controller;

class CategoryController extends BaseController
{

    /**
     * 分类商品信息列表
     */
    public function catDetail()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $brand_id = I('brand_id', 0, 'intval');
        $word = I('word');
        if ($cat_id > 0) {
            $this->assign('cat_id', $cat_id);
        }
        if ($brand_id > 0) {
            $this->assign('brand_id', $brand_id);
        }
        if ($word != '') {
            $this->assign('is_search', 'true');
            $this->assign('word', $word);
        }
        $this->assign('page_title', '女性整体美解决方案领导者');
        $this->display();

    }

    /**
     * 分类列表
     */
    public function catAll()
    {
        //全部品牌
        $brands = M('GoodsBrand')->field('id,brand_name,brand_logo')->where(array('display' => 'Y'))->order('rank desc')->select();
        $this->assign('brands', $brands);
        //顶级分类
        $top_category = M('GoodsCategory')->field('id,category_name,category_logo')->where(array('parent_id' => 0, 'disabled' => 'N'))->order('rank asc')->select();
        $this->assign('top_category', $top_category);
        $this->assign('page_title', '女性整体美解决方案领导者');
        $this->display();
    }

    /**
     * 获取顶级分类下的子分类树
     */
    public function getChildTree()
    {
        $id = I('id', 0, 'intval');
        //获取顶级分类下的子分类树
        $categorys = D('GoodsCategory')->getChildTree($id);
        layout(false);
        $this->assign('categorys', $categorys);
        $this->display();
    }

    /**
     * ajax获取分类商品
     */
    public function getCatGoods()
    {
        $params = array(
            'sort_way' => I('sort_way'),
            'orderby' => I('orderby'),
            'cat_id' => I('cat_id', 0, 'intval'),
            'brand_id' => I('brand_id', 0, 'intval'),
            'price_start' => I('price_start', 0.00, 'floatval'),
            'price_end' => I('price_end', 0.00, 'floatval'),
            'page' => I('page', 0, 'intval'),
            'word' => I('word'),
            'is_search'=>I('is_search')
        );

        if ($params['is_search'] == 'true') {
            //如果是搜索，调到搜索的方法里
            $this->search($params);
            exit;
        }

        //组装条件
        $map['g.disabled'] = 'N';
        $map['g.on_sale'] = 'Y';

        $join = '';
        if ($params['cat_id'] > 0) {
            //扩展分类也考虑
            $cat_ids = D('GoodsCategory')->getChildIdsByTreeStruct($params['cat_id']);
            $map['_string'] = 'g.category_id in (' . implode(',', $cat_ids) . ') or gec.category_id=' . $params['cat_id'];
            $join = 'left join __GOODS_EXTEND_CATEGORY__ gec on g.id=gec.goods_id and gec.category_id=' . $params['cat_id'];
        }

        if ($params['brand_id'] > 0) {
            $map['g.brand_id'] = $params['brand_id'];
        }

        if ($params['price_start'] > 0 || $params['price_end'] > 0) {
            $map['g.shop_price'] = array();
            if ($params['price_start'] > 0) {
                $map['g.shop_price'][] = array('egt', $params['price_start']);
            }
            if ($params['price_end'] > 0) {
                $map['g.shop_price'][] = array('elt', $params['price_end']);
            }
        }

        if ($params['sort_way'] == 'sales') {
            //$map['o.payment_state'] = 'payed';
            $goods = M('Goods')
                ->alias('g')
                ->field('g.id,g.shop_price,g.goods_name,g.goods_thumb,SUM(og.goods_number) as sum')
                ->join('left join __ORDER_GOODS__ og on og.goods_id=g.id')
                ->join('left join __ORDER__ o on o.id = og.order_id')
                ->join($join)
                ->where($map)
                ->group('g.id')
                ->order("SUM(og.goods_number) desc,g.date_add desc")
                ->page($params['page'], 10)
                //->distinct('g.id')
                ->select();

        } else {
            switch($params['sort_way']){
                case 'moods':
                    $orderby = 'g.click desc,g.date_add desc';
                    break;
                case 'price':
                    $orderby = "g.shop_price {$params['orderby']},g.date_add desc";
                    break;
                default:
                    $orderby = "g.date_add desc";
            }
            $goods = M('Goods')
                ->alias('g')
                ->field('g.id,g.shop_price,g.goods_name,g.goods_thumb,g.click')
                ->join($join)
                ->where($map)
                ->order($orderby)
                ->page($params['page'], 10)
                //->distinct('g.id')
                ->select();
        }
        if (empty($goods)) {
            $this->ajaxReturn(array('state' => 4));
        }
        $this->assign('goods', $goods);
        layout(false);
        $content = $this->fetch('Category:getCatGoods');
        $this->ajaxReturn(array('state' => 8, 'content' => $content));
    }

    private function search($params)
    {
        if (strlen($params['word']) < 6) {
            $this->ajaxReturn(array('state' => 2));
        }

        $page_size = 10;
        $sphinx = new \SphinxClient();
        $sphinx->SetServer(C('SPHINX.host'), C('SPHINX.port'));
        $sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $sphinx->setFilter('on_sale', array(1));    //上架商品
        $sphinx->setFilter('disabled', array(0));   //过滤删除商品
        $sphinx->SetLimits(($params['page']-1) * $page_size, $page_size, 1000);

		if ( $params['cat_id'] && intval($params['cat_id']) > 0 ){
            $sphinx->setFilter('category_id', D('GoodsCategory')->getChildIdsByTreeStruct($params['cat_id']));   //过滤分类
		}

        if ( $params['brand_id'] && intval($params['brand_id']) > 0 ){
            $sphinx->setFilter('brand_id', array(intval($params['brand_id'])));   //过滤品牌
        }

        //排序
        $order = '';
        switch ( $params['sort_way'] ) {
            case 'moods':
                $order .= ', click DESC';
                break;
            case 'sales':
                $order .= ', sales DESC';
                break;
            case 'price':
                if($params['orderby']=='asc'){
                    $order .= ', shop_price ASC';
                }else{
                    $order .= ', shop_price DESC';
                }
                break;
            default:
                $order .= ', @weight DESC';
                break;
        }
        $order .= ', rank DESC';
        $sphinx->setSortMode(SPH_SORT_EXTENDED,$order);

        //价格区间
        if ( ($params['price_start'] && $params['price_start'] > 0) || ($params['price_end'] && $params['price_end'] > 0) ){
            $min_price = 0;
            $max_price = 9999999;

            if ( $params['price_start'] )
                $min_price = $params['price_start'];

            if ( $params['price_end'] )
                $max_price = $params['price_end'];

            $sphinx->setFilterFloatRange('shop_price',$min_price,$max_price);
        }

        //排序条件
        $res = $sphinx->query($params['word'],'*');
        if ( empty($res['matches']) )
            $this->ajaxReturn(array('state' => 4));

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
            ->order("FIND_IN_SET(g.id,'$ids')")
            ->select();

        if (empty($goods)) {
            $this->ajaxReturn(array('state' => 4));
        }
        $this->assign('goods', $goods);
        layout(false);
        $content = $this->fetch('Category:getCatGoods');
        $this->ajaxReturn(array('state' => 8, 'content' => $content));
    }

    public function getFilter()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $brand_id = I('brand_id', 0, 'intval');
        $cat_list = D('GoodsCategory')->selfAndChild($cat_id);
        $brand_list = M('GoodsBrand')->field('id,brand_name')->where(array('display' => 'Y'))->select();
        $this->ajaxReturn(array('cat_list' => $cat_list, 'brand_list' => $brand_list, 'current_cat' => $cat_id, 'current_brand' => $brand_id));
    }

    public function selfAndChild()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $cat_list = D('GoodsCategory')->selfAndChild($cat_id);
        if (empty($cat_list)) {
            $this->ajaxReturn(array('state' => 4));
        } else {
            $this->ajaxReturn(array('state' => 8, 'cat_list' => $cat_list));
        }
    }

    public function parentAndSiblings()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $cat_list = D('GoodsCategory')->parentAndSiblings($cat_id);
        $parent_id = M('GoodsCategory')->where(array('disabled' => 'N', 'id' => $cat_id))->getField('parent_id');
        if (empty($cat_list)) {
            $this->ajaxReturn(array('state' => 4));
        } else {
            $this->ajaxReturn(array('state' => 8, 'cat_list' => $cat_list, 'parent_id' => $parent_id ?: 0));
        }
    }
}
