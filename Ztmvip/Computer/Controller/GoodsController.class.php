<?php
namespace Computer\Controller;
class GoodsController extends BaseController
{


    /**
     * 正常商品详情页调用
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function detail($goods_id)
    {
        

        //分页
        if (I('get.p'))
            $this->assign('pagehover', 1);

        //刷新人气

        D('Goods')->addClick($goods_id);

        #浏览历史
        if (cookie('goods_history')) {
            $history = unserialize(cookie('goods_history'));

            #===
            $history_goods = D('Goods')->getHistoryGoods($history);
            $this->assign('history_goods', $history_goods);
            #===
            array_unshift($history, $goods_id);
            $history = array_unique($history);
            while (count($history) > 20) {
                array_pop($history);
            }

            cookie('goods_history', serialize($history), time() + 2592000);


        } else {
            $history = array($goods_id);
            cookie('goods_history', serialize($history), time() + 2592000);
        }
        //售后服务
        $promise = D('Article')->promise();
        $this->assign('promise', $promise);
        //面包屑
        $nav = D('Goods')->getFatherCat($goods_id);
        $this->assign('nav', $nav);
        //商品相册
        $pictures = D('Goods')->getGoodsGallery($goods_id);
        $this->assign('pictures', $pictures);

        //商品总体信息
        $detail = D('Goods')->getGoodsDetail($goods_id);
        $this->assign('detail', $detail);

        #收藏问题
        if (session('user_id')) {
            $exist = D('Goods')->isCollected($goods_id);
            if ($exist > 0)
                $this->assign('flag', 1);
        }


        // 获得该商品具有的规格和属性
        $skus = D('Goods')->getGoodsProperties($goods_id);
        $this->assign('skus', $skus);

        #关联/推荐  商品
        $linked_goods = D('Goods')->getRelatedGoods($goods_id);
        $this->assign('linked_goods', $linked_goods);

        #商品评论
        $count = D('Goods')->getCommentTotal($goods_id);
        $page = $this->page($count, 10);
        $comment_list = D('Goods')->comments($goods_id, $page->firstRow, $page->listRows);
        $this->assign('comment_list', $comment_list);
        //分享

        $share = array(
            'goods_id' => $goods_id,
            'guser' => session('user_id') ? session('user_id') : 0,
        );

        $this->assign('title', '整体美解决方案领导者');
        $this->assign('desc', $detail['goods_name']);
        $this->assign('link', __HOST__ . U('Goods/detail', $share));
        $this->assign('imgUrl', __HOST__ . $detail['goods_thumb'] . '_217x217.jpg');

        $this->assign('goods_id', $goods_id);
        $this->assign('special_goods_id', str_pad($goods_id, 10, '0', STR_PAD_LEFT));

        $this->assign('page_title', $detail['goods_name']);
        $this->assign('service',json_decode($detail['service'],true));
        $this->display();
    }

    /**
     * 添加收藏商品
     * @param [type] $goods_id [description]
     */
    public function addCollection($goods_id)
    {

        $result = array();
        try {
            if (!session('user_id'))
                E('login');

            if (D('Goods')->isCollected($goods_id))
                E('go_delete');

            if (D('Goods')->addCollection($goods_id)) {
                $result['code'] = 'sadd';
            } else {
                $result['code'] = 'fadd';
            }

        } catch (\Think\Exception $e) {

            $error = $e->getMessage();
            switch ($error) {
                case 'login':
                    $result['code'] = 'login';
                    break;
                case 'go_delete':
                    if (D('Goods')->removeCollection($goods_id)) {
                        $result['code'] = 'sdel';
                    } else {
                        $result['code'] = 'fdel';
                    }
                    break;

                default:
                    # code...
                    break;
            }

        }

        $this->ajaxReturn($result);


    }

    private function advertGoodsList($type)
    {
        $params = I('get.');

        $map = array(
            'on_sale' => 'Y',
            'disabled' => 'N',
        );

        switch($type){
            case 'new':
                $map['new'] = 'Y';
                break;
            case 'special':
                $map['hot'] = 'Y';
                break;
            default:
                break;
        }

        if ($params['brand'] > 0) {
            $map['brand_id'] = $params['brand'];
        }

        if ($params['cat'] > 0) {
            $cat_ids = D('GoodsCategory')->getChildIdsByTreeStruct($params['cat']);
            if ($cat_ids) {
                $map['category_id'] = array('in', $cat_ids);
            }
        }

        $count = M('Goods')->where($map)->count();
        $page = $this->page($count, 50);
        $goods_list = M('Goods')->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();
        $advert_title = M('Advert')->where(array('id' => $params['id']))->getField('title');

        $this->assign('goods_list', $goods_list);
        $this->assign('page_title', $advert_title);
        $this->assign('advert_title', $advert_title);
        $this->display('advert_goods_list');
    }

    public function newList()
    {
        $this->advertGoodsList('new');
    }

    public function specialList()
    {
        $this->advertGoodsList('specialList');
    }

}#类尾


?>