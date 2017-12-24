<?php
namespace Mobile\Controller;
class GoodsController extends BaseController
{


    /**
     * 正常商品详情页调用
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function detail($goods_id)
    {
        # 商品相册
        $pictures = D('Goods')->getGoodsGallery($goods_id);
        $this->assign('pictures', $pictures);

        #商品总体信息
        $details = D('Goods')->alias('g')
            ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=g.id')
            ->where(array('g.id'=>$goods_id))->find();

        $final_price = D('Goods')->getFinalPrice($goods_id);
        $details['final_price'] = $final_price;
        $details['service'] = json_decode($details['service'],true);
        $this->assign('details', $details);

        //打入秒杀标志
        if ($final_price < $details['shop_price']) {
            $this->assign('is_kill', 1);
        }


        #收藏问题

        if (session('user_id')) {
            $where = array(
                'user_id' => session('user_id'),
                'goods_id' => $goods_id,
            );
            if ( D('UserFavor')->where($where)->count() > 0 ) {

                $this->assign('flag', 1);

            }
        }

        #该商品的销售量问题(goods表中没有的，需要去订单表中获取的)
        $salecount = D('Goods')->getSaleCount($goods_id) + $details['sales'];
        $this->assign('sale_count', $salecount);

        #获得该商品具有的规格和属性
        $properties = D('Goods')->getGoodsProperties($goods_id);


        $this->assign('properties', $properties);


        #关联/推荐  商品
        $linked_goods = D('Goods')->getRelatedGoods($goods_id);


        $this->assign('linked_goods', $linked_goods);


        #看看该商品是否是整体美礼包中一份子
        #如果是，呈现给用户，既然想买该商品，是否有意买超值礼包呢，反正礼包中也有该商品
        // $package_goods_list = D('Goods')->packageList($goods_id);


        // $this->assign('package_goods_list', $package_goods_list);


        ###################记录浏览历史###########################################################


        if (cookie('goods_history')) {
            #按照逗号分割字符串返回值是数组
            $history = explode(',', cookie('goods_history'));
            #array_unshift() 函数在数组开头插入一个或多个元素
            #直接影响原来的数组，看来是地址操作
            array_unshift($history, $goods_id);
            #移除数组中的重复的值，并返回结果数组。则重复浏览的商品，只认为是一次喽。
            $history = array_unique($history);
            #当超过规定保存的历史记录  为5个，则移动即可
            while (count($history) > 5) {
                #删除数组中的最后一个元素。
                #先进先出，公平合理，保证呆在被窝子里面的时间都是相当的。
                #本质就是队列机制而已
                array_pop($history);
            }
            #按逗号拼接成字符串保存即可。
            cookie('goods_history', implode(',', $history), time() + 3600 * 24 * 30);
        } else {
            cookie('goods_history', $goods_id, time() + 3600 * 24 * 30);
        }


        #商品评论的总体信息
        $total_comments = D('Goods')->getCommentInfo($goods_id);
        $this->assign('total_comments', $total_comments);


        $commentlist = D('Goods')->commentList($goods_id, 1, 0, 3);
        $clist = array();
        foreach ($commentlist as $key => $value) {
            $value['add_time'] = date('Y-m-d H:i:s', $value['date_add']);
            $clist[] = $value;
        }


        $this->assign('commentlist', $clist);

        #=============商品分享==============================================
        $true = is_wechat_browser();
        if ($true) {
            $share = array(
                'goods_id' => $goods_id,
                'guser' => session('user_id') ? session('user_id') : 0,
            );
            $url = __HOST__ . U('Goods/detail', $share);

            $weObj = new \Common\Vendor\Wechat();
            #签名地址必须和当前地址一样
            $signPackage = $weObj->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
            $this->assign('signPackage', $signPackage);
            #对分享的商品进行描述
            $this->assign('title', '整体美解决方案领导者');
            $this->assign('desc', $details['goods_name']);
            $this->assign('link', $url);
            $this->assign('imgUrl', __HOST__ . $details['goods_thumb'] . '_217x217.jpg');
        }


        #======================================================

        #方便js传参
        $this->assign('page_title', '女性整体美解决方案领导者');
        $this->assign('goods_id', $goods_id);
        #方便跳转
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $this->assign('go_out', $_SERVER['HTTP_REFERER']);
        } else {
            $this->assign('go_out', U('Index/index'));

        }

        //===============七天无理由退货屏蔽=================================
        // 生鲜  进口零食 坚果 中外酒饮 中外粮油 保健品/酵素 
        
          if(!empty($details['category_id']))
          {
              $stop=array(703,1104,1139,696,702,1108);

              $parent_category_id=M('Goods_category')->where('id='.$details['category_id'])->getField('parent_id');


              if($parent_category_id)
              {
                  foreach ($stop as $key => $value) {
                       if($value==$parent_category_id){
                              $this->assign('noseven',1);
                              break;
                       }
                  }   
              }
          }
        //==================================================
        $this->display();
    }


    /**
     * 改变属性、数量时重新计算商品价格(属性2.0版本未开通)
     */
    public function price()
    {
        #file_put_contents('hln.log', $_POST['attr'],FILE_APPEND);

        #获取参数

        $attr_id = I('post.attr'); #(由于属性价格未考虑在内，这个可不用传过来)
        $attr_id = explode(',', $attr_id); #分割成数组了


        $number = I('post.number');
        $goods_id = I('post.goods_id');

        #查询
        $where = array(
            'goods_id' => $goods_id,
        );
        $goods = M()->table('ecs_goods')->where($where)->field('goods_number')->find();


        $last_price = D('Goods')->getFinalPrice($goods_id);


        $res ['error_no'] = 0;
        $res ['result'] = $last_price * $number;
        $this->ajaxReturn($res);


    }

    /**
     * 添加收藏商品
     * @param [type] $goods_id [description]
     */
    public function addCollection($goods_id)
    {

        if (!session('user_id')) {

            $data['status'] = 2;
            $this->ajaxReturn($data);
        } else {
            $where = array(
                'user_id' => session('user_id'),
                'goods_id' => $goods_id,
            );
            $res = M()->table('ztm_user_favor')
                ->where($where)
                ->count();


            #有就是删除
            if ($res > 0) {
                $rs = M()->table('ztm_user_favor')
                    ->where($where)
                    ->delete();
                #============================
                if ($rs) {

                    $data['status'] = 8;
                    $data['action'] = 'del';
                    $data['content'] = '取消收藏成功';
                    $this->ajaxReturn($data);
                }
                #===================================

                #没有就是添加
            } else {
                $add['user_id'] = session('user_id');
                $add['goods_id'] = $goods_id;
                $add['date_add'] = time();

                #add方法返回值是新增记录的主键id
                $rs = M()->table('ztm_user_favor')
                    ->add($add);

                #==============================
                if ($rs) {
                    $data['status'] = 8;
                    $data['action'] = 'add';
                    $data['content'] = '添加收藏成功';
                    $this->ajaxReturn($data);
                }
                #====================================
            }
        }
    }#函数尾


    /**
     * 全部评论列表页
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function allComment($goods_id)
    {

        $total_comments = D('Goods')->getCommentInfo($goods_id);

        $this->assign('total_comments', $total_comments);


#全部评论
        $back = D('Goods')->commentList($goods_id, 1);
        $all = array();
        foreach ($back as $key => $value) {
            $value['add_time'] = date('Y-m-d H:i:s', $value['date_add']);
            $all[] = $value;
        }
        $this->assign('all', $all);
#好评

        $good = array();
        foreach ($all as $key => $value) {
            if ($value['level'] >= 4) {
                $good[] = $value;
            }
        }

        $this->assign('good', $good);

#中评
        $medium = array();
        foreach ($all as $key => $value) {
            if ($value['level'] >= 2 && $value['level'] <= 4) {
                $medium[] = $value;
            }
        }

        $this->assign('medium', $medium);
#差评

        $bad = array();

        foreach ($all as $key => $value) {
            if ($value['level'] == 1) {
                $bad[] = $value;
            }
        }

        $this->assign('bad', $bad);


        $this->display('comments');


    }

    /**
     * 礼包详情页面
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function packageList($goods_id)
    {


        $package_list = D('Goods')->packageGoodsList($goods_id);


        $this->assign('package_list', $package_list);
        $this->display('package');

    }

    /**
     * 礼包详情页选择商品属性
     * @return [type] [description]
     */
    public function chooseAttr()
    {
        $goods_id = I('post.goods_id');

        $choose_attr = D('Goods')->getGoodsProperties($goods_id);
        $this->assign('choose_attr', $choose_attr);
        $content = $this->fetch('Public/choose_attr');


        if ($content) {
            $result['error'] = 8;
            $result['content'] = $content;
            $this->ajaxReturn($result);
        }


    }


    public function newList()
    {
        $new_id = I('id',0,'intval');
        $cat_id = I('cat', 0, 'intval');
        $brand_id = I('brand', 0, 'intval');
        $newStarting = M('Advert')->field('image,title')->where(array('id'=>$new_id,'disabled'=>'N'))->find();
        $this->assign('cat_id', $cat_id);
        $this->assign('brand_id', $brand_id);
        $this->assign('newStarting', $newStarting);
        $this->assign('page_title', C('WEBSITE.TITLE'));
        $this->display();
    }

    public function moreNewGoods()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $brand_id = I('brand_id', 0, 'intval');
        $page = I('page', 1, 'intval');
        $pageSize = I('pageSize', 10, 'intval');
        $goods_list = D('Goods')->newGoodsList($cat_id, $brand_id, $page, $pageSize);
        $this->assign('goods_list', $goods_list);
        $goods_list = $this->fetch('Public:moreGoods');
        if (empty($goods_list)) {
            $this->ajaxReturn(array('state' => 4));
        }
        $this->ajaxReturn(array('state' => 8, 'content' => $goods_list));
    }

    public function specialList()
    {
        $special_id = I('id',0,'intval');
        $cat_id = I('cat', 0, 'intval');
        $brand_id = I('brand', 0, 'intval');
        $special = M('Advert')->field('image,title')->where(array('id'=>$special_id,'disabled'=>'N'))->find();
        $this->assign('cat_id', $cat_id);
        $this->assign('brand_id', $brand_id);
        $this->assign('special', $special);
        $this->assign('page_title', C('WEBSITE.TITLE'));
        $this->display();
    }


    public function moreSpecialGoods()
    {
        $cat_id = I('cat_id', 0, 'intval');
        $brand_id = I('brand_id', 0, 'intval');
        $page = I('page', 1, 'intval');
        $pageSize = I('pageSize', 10, 'intval');
        //获取特卖专区列表
        $goods_list = D('Goods')->getSpecialList($cat_id, $brand_id, $page, $pageSize);
        $this->assign('goods_list', $goods_list);
        $goods_list = $this->fetch('Public:moreGoods');
        if (empty($goods_list)) {
            $this->ajaxReturn(array('state' => 4));
        }
        $this->ajaxReturn(array('state' => 8, 'content' => $goods_list));
    }

    //品牌馆
    public function brandList()
    {
        $advert_id = I('id',0,'intval');
        $brand_id = I('brand', 0, 'intval');
        $advert = M('Advert')->field('image,title')->where(array('id'=>$advert_id,'disabled'=>'N'))->find();
        $this->assign('brand_id', $brand_id);
        $this->assign('advert', $advert);
        $this->assign('page_title', C('WEBSITE.TITLE'));
        $this->display();
    }


    public function moreBrandGoods()
    {
        $brand_id = I('brand_id', 0, 'intval');
        $page = I('page', 1, 'intval');
        $pageSize = I('pageSize', 10, 'intval');
        //获取特卖专区列表
        $goods_list = D('Goods')->getBrandList($brand_id, $page, $pageSize);
        $this->assign('goods_list', $goods_list);
        $goods_list = $this->fetch('Public:moreGoods');
        if (empty($goods_list)) {
            $this->ajaxReturn(array('state' => 4));
        }
        $this->ajaxReturn(array('state' => 8, 'content' => $goods_list));
    }
}


?>