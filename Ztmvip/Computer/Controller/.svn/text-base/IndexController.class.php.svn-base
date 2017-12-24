<?php
/**
 * 首页控制器
 * author: Tom
 */
namespace Computer\Controller;
class IndexController extends BaseController
{
    //首页
    public function index()
    {
        //健康减重方案
        $health = D('Goods')->where(array('category_id' => 12, 'on_sale' => 'Y', 'disabled' => 'N'))->order('rank desc')->limit(4)->select();
        $this->assign('health_goods', $health);

        //热点分享
        $hot_share_left = D('Advert')->where(array('topic' => 'indexShare', 'disabled' => 'N'))->order('rank desc')->limit(5)->select();
        $this->assign('hot_share_left', $hot_share_left);
        $hot_share_right = D('Article')->where(array('topic_id' => 13, 'best' => 'Y', 'hot' => 'Y'))->order('rank desc')->limit(9)->select();
        $this->assign('hot_share_right', $hot_share_right);

        //潮流趋势
        $fashion_left = D('Advert')->where(array('topic' => 'indexFashion', 'disabled' => 'N'))->order('rank desc')->limit(3)->select();
        foreach ($fashion_left as &$val) {
            $val['link'] = parse_url($val['link']);
            $val['link'] = $val['link']['path'];
        }
        unset($val);
        $this->assign('fashion_left', $fashion_left);
        $fashion_right = D('Article')->where(array('topic_id' => 14, 'best' => 'Y', 'hot' => 'Y'))->order('rank desc')->limit(9)->select();
        $this->assign('fashion_right', $fashion_right);

        //女装馆
        $women_ids = array(203, 1162, 1149, 1189, 447);
        $women_clothing_best = D('Goods')->singleProductBest($women_ids);
        $this->assign('women_clothing_best', $women_clothing_best);

        //鞋包配饰
        $shoe_ids = array(1149, 1159, 1168, 1191, 1176);
        $shoe_bag_best = D('Goods')->singleProductBest($shoe_ids);
        $this->assign('shoe_bag_best', $shoe_bag_best);
        $time_goods = D('Goods')->where(array('id'=>array('in',array(2769,2245))))->select();
        $this->assign('time_goods',$time_goods);

        //美妆馆
        $beauty_ids = array(448, 449, 450, 451);
        $beauty_makeup_best = D('Goods')->singleProductBest($beauty_ids);
        $this->assign('beauty_makeup_best', $beauty_makeup_best);

        //养生馆
        $good_health_ids = array(12);
        $good_health_best = D('Goods')->singleProductBest($good_health_ids);
        $this->assign('good_health_best', $good_health_best);

        //品牌馆
        //$cat_ids = array_unique(array_merge($women_ids, $shoe_ids, $beauty_ids, $good_health_ids));
        $brand_best = D('Goods')->brandGoodsBest(array(184, 190, 203, 208, 182, 201, 207));
        $this->assign('brand_best', $brand_best);

        $this->assign('page_title', '女性整体美解决方案领导者');
        $this->display();

//        $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
//        if($index_html = $mem->get('pc_index_html')){
//            echo $index_html;
//            exit;
//        }
//        $content = $this->fetch('Index/index');
//        $mem->set('pc_index_html',$content,24*3600);
//        echo $content;
    }


    /**
     * 某个类(含扩展类)下的商品
     * @param  [type] $cat_id [description]
     * @return [type]         [description]
     */
    public function catGoodsList()
    {
        $get = I('get.');
        $category_name = D('GoodsCategory')->getCategoryName($get['cat_id']);
        $this->assign('category_name', $category_name);
        $count = D('Goods')->getCatGoodsCount($get['cat_id']);

        $page = $this->page($count, 50);

        //  $memcache=new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
        //  $pagenum=$get['p']?$get['p']:1;
        //  $key=md5('catgoods'.$get['cat_id'].$pagenum);
        // if($back=$memcache->get($key))
        // {
        //     $goods_list=unserialize($back);
        // }else{
        //   $goods_list=D('Goods')->categoryGetGoods($get['cat_id'],$page->firstRow,$page->listRows);
        //   $memcache->set($key,serialize($goods_list));
        // }

        $goods_list = D('Goods')->categoryGetGoods($get['cat_id'], $page->firstRow, $page->listRows);

        $this->assign('page_title', '分类商品');
        $this->assign('goods_list', $goods_list);
        $this->display('goods_list');


    }


    public function newGoodsList()
    {
        $count = M('Advert')->where(array('topic' => 'newStarting', 'disabled' => 'N'))->order('rank desc')->count();
        $new_starts = M('Advert')->where(array('topic' => 'newStarting', 'disabled' => 'N'))->order('rank desc')->select();
        $hot_goods = M('Goods')->where(array('hot' => 'Y', 'on_sale' => 'Y', 'disabled' => 'N'))->order('click desc,rank desc')->limit($count)->select();
        $this->assign('new_starts', $new_starts);
        $this->assign('hot_goods', $hot_goods);
        $this->assign('page_title', '新品首发');
        $this->display('new_start');
    }

    public function specialBuy()
    {
        $count = M('Advert')->where(array('topic' => 'specialBuy', 'disabled' => 'N'))->order('rank desc')->count();
        $special_buy = M('Advert')->where(array('topic' => 'specialBuy', 'disabled' => 'N'))->order('rank desc')->select();
        $goods_brand = M('GoodsBrand')->where(array('display' => 'Y'))->order('rank desc')->limit($count)->select();
        $this->assign('special_buy', $special_buy);
        $this->assign('goods_brand', $goods_brand);
        $this->assign('page_title', '特卖专场');
        $this->display('special_buy');
    }


    //购物车
    public function cart()
    {
        #取得购物车商品列表，计算合计(
        $cart_goods = D('Cart')->getCartList();
        $this->assign('cart_list', $cart_goods ['cart_list']);
        $this->assign('total', $cart_goods ['total']);

        #判断是否是全选
        $count = D('Cart')->existUnSelected();
        if (!$count) {
            $this->assign('all_flag', 1);
        }
        $this->assign('page_title', '女性整体美解决方案领导者');
        $cart = $this->fetch('Index:cart');
        $this->ajaxReturn(array('cart' => $cart));
    }

    public function brandGoodsList()
    {
        $brand_id = I('brand_id', 0, 'intval');
        $map = array(
            'brand_id' => $brand_id,
            'on_sale' => 'Y',
            'disabled' => 'N',
        );

        $count = D('Goods')->where($map)->count();
        $page = $this->page($count, 50);
        $goods_list = D('Goods')->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();

        $brand_name = M('GoodsBrand')->where(array('id' => $brand_id))->getField('brand_name');

        $this->assign('brand_name', $brand_name);
        $this->assign('goods_list', $goods_list);
        $this->assign('page_title', '品牌商品列表');
        $this->display();
    }
}