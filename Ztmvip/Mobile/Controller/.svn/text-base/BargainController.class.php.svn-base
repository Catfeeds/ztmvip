<?php
/**
 * 砍价活动控制器
 * author: Tom
 */
namespace Mobile\Controller;
class BargainController extends UserBaseController
{
    protected $bargain_id,$bargain_model,$log_model;

    public function _initialize(){
        parent::_initialize();

        C('layout_on',false);

        $this->bargain_id = I('get.id',0,'intval');
        if ( !$this->bargain_id )
            $this->_empty();
        $this->assign('bargain_id',$this->bargain_id);

        $this->bargain_model = D('Bargain');
        $this->log_model = D('BargainLog');

        $wechat = new \Common\Vendor\Wechat();
        $signPackage = $wechat->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
        $this->assign('signPackage',$signPackage);
    }

    //购买商品
    public function buy(){
        $order_model = D('Order');
        $order_extend_model = D('OrderExtend');
        $order_goods_model = D('OrderGoods');

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，抢购成功，马上去付款~~',
            );
            $post = I('post.');

            try{
                //第一次提交购买
                $bargain = $this->bargain_model->alias('b')->field('b.*,g.goods_name,g.market_price,g.shop_price,ge.skus')
                    ->join('__GOODS__ AS g ON g.id=b.goods_id')
                    ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=b.goods_id')
                    ->where(array('b.id'=>$this->bargain_id))->find();
                if ( !$bargain )
                    E('非法请求');

                if ( $bargain['bargain_start'] > time() || $bargain['bargain_end'] < time() || $bargain['on_sale'] == 'N' )
                    E('该活动已结束，感谢你的关注');

                $bargain['middle_price'] = round($bargain['middle_price'],2);
                $bargain['min_price'] = round($bargain['min_price'],2);

                $order = $order_goods_model->alias('og')
                    ->join('__ORDER__ AS o ON o.id=og.order_id AND o.user_id='.$this->user_id.' AND o.date_add BETWEEN '.$bargain['bargain_start'].' AND '.$bargain['bargain_end'])
                    ->where(array('og.buy_flag'=>'bargain','og.goods_id'=>$bargain['goods_id']))->find();

                if ( !$order ){
                    if ( $bargain['skus'] != '[]' && !is_array($post['skus']) )
                        E('抱歉，请选择商品规格');
                    if ( !$post['consignee'] )
                        E('抱歉，请填写姓名');
                    if ( !$post['mobile'] || !preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i',$post['mobile']) )
                        E('抱歉，请输入有效的手机号码');
                    if ( !$post['province'] || !$post['city'] || !$post['district'] )
                        E('抱歉，请选择省、市、区');
                    if ( !$post['address'] )
                        E('抱歉，请输入详细地址');

                    //插入订单
                    $order_data = array(
                        'user_id' => $this->user_id,
                        'order_sn' => get_order_sn(),
                        'goods_fee' => $bargain['shop_price'],
                        'date_add' => time(),
                    );
                    $order_id = $order_model->add($order_data);
                    if ( !$order_id )
                        E('抱歉，提交失败，请联系网站客服');

                    $order_extend_data = array(
                        'order_id' => $order_id,
                        'consignee' => $post['consignee'],
                        'mobile' => $post['mobile'],
                        'country' => '中国',
                        'province' => $post['province'],
                        'city' => $post['city'],
                        'district' => $post['district'],
                        'address' => $post['address'],
                    );
                    if ( !$order_extend_model->add($order_extend_data) ){
                        $order_model->where(array('id'=>$order_id))->delete();
                        E('抱歉，提交失败，请联系网站客服');
                    }

                    //插入订单商品
                    $order_goods_data = array(
                        'order_id' => $order_id,
                        'goods_id' => $bargain['goods_id'],
                        'buy_flag' => 'bargain',
                        'goods_number' => 1,
                        'market_price' => $bargain['market_price'],
                        'goods_price' => $bargain['shop_price'],
                        'goods_name' => $bargain['goods_name'],
                        'skus' => json_encode($post['skus']?:array()),
                    );
                    if ( !$order_goods_model->add($order_goods_data) ){
                        $order_model->where(array('id'=>$order_id))->delete();
                        $order_extend_model->where(array('order_id'=>$order_id))->delete();
                        E('抱歉，提交失败，请联系网站客服');
                    }

                    unset($order_data,$order_extend_data,$order_goods_data);
                    $order = array(
                        'id' => $order_id,
                        'order_state' => 'new',
                        'payment_state' => 'new',
                    );
                }

                if ( $order['order_state'] != 'new' || !in_array($order['payment_state'],array('new','paying')) )
                    E('抱歉，您已参加过该活动，进入整体美商城体验更多精彩');

                $bargain_price = round($this->log_model->where(array('bargain_id'=>$this->bargain_id,'order_user'=>$this->user_id))->sum('money'),2);
                $final_price = round($bargain['shop_price'] - $bargain_price,2);

                if ( $final_price < $bargain['middle_price'] && $final_price > $bargain['min_price'] ){
                    $final_price = $bargain['middle_price'];
                }elseif ( $final_price <= $bargain['min_price'] ){
                    $final_price = $bargain['min_price'];
                }

                //更新订单表
                $data = array(
                    'goods_fee' => $final_price,
                    'order_state' => $final_price ? 'new' : 'confirm',
                    'payment_state' => $final_price ? 'new' : 'payed',
                    'date_confirm' => $final_price ? 0 : time(),
                    'date_pay' => $final_price ? 0 : time(),
                );
                $order_model->where(array('id'=>$order['id']))->save($data);

                //更新订单商品
                $data = array(
                    'goods_price' => $final_price,
                );
                $order_goods_model->where(array('order_id'=>$order['id']))->save($data);

                $state['order_id'] = $order['id'];
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //我的砍价
    public function index(){
        $bargain = $this->bargain_model->alias('b')->field('b.*,g.market_price,g.shop_price,ge.sku_id,ge.skus')
            ->join('__GOODS__ AS g ON g.id=b.goods_id')
            ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=b.goods_id')
            ->where(array('b.id'=>$this->bargain_id))->find();
        if ( !$bargain )
            $this->_empty();
        $this->assign('bargain',$bargain);

        $bargain['bargain_price'] = round($bargain['bargain_price'],2);
        $bargain['middle_price'] = round($bargain['middle_price'],2);
        $bargain['min_price'] = round($bargain['min_price'],2);

        //判断是否购买过
        $map = array(
            'og.buy_flag' => 'bargain',
            'og.goods_id' => $bargain['goods_id'],
        );
        $order = D('OrderGoods')->alias('og')
            ->join('__ORDER__ AS o ON o.id=og.order_id AND o.user_id='.$this->user_id.' AND o.date_add BETWEEN '.$bargain['bargain_start'].' AND '.$bargain['bargain_end'])
            ->where($map)->find();
        $this->assign('order',$order);

        if ( !$order ){
            $goods_sku = D('GoodsSku')->where(array('id'=>$bargain['sku_id']))->getField('skus');
            $this->assign('goods_sku',$goods_sku);
        }

        $map = array(
            'bargain_id' => $this->bargain_id,
            'order_user' => $this->user_id,
            'bargain_user' => $this->user_id,
        );
        $mine_bargain = $this->log_model->where($map)->getField('money');
        if ( !$mine_bargain ){
            $data = array(
                'bargain_id' => $this->bargain_id,
                'order_user' => $this->user_id,
                'bargain_user' => $this->user_id,
                'money' => round(rand($bargain['bargain_price']*5,$bargain['bargain_price']*10)/1000,2),
                'date_add' => time(),
            );
            if ( $this->log_model->add($data) )
                $mine_bargain = $data['money'];
        }
        $this->assign('mine_bargain',$mine_bargain);

        $map = array(
            'bargain_id' => $this->bargain_id,
            'order_user' => $this->user_id,
        );
        $bargain_price = round($this->log_model->where($map)->sum('money'),2);
        $final_price = round($bargain['shop_price'] - $bargain_price,2);

        if ( $final_price < $bargain['middle_price'] && $final_price > $bargain['min_price'] ){
            $final_price = $bargain['middle_price'];
        }elseif ( $final_price <= $bargain['min_price'] ){
            $final_price = $bargain['min_price'];
        }
        $this->assign('final_price',$final_price);

        $map = array(
            'on_sale' => 'Y',
            'bargain_start' => array('elt',time()),
            'bargain_end' => array('egt',time()),
            'id' => array('neq',$bargain['id']),
        );
        $bargain_relation = $this->bargain_model->where($map)->select();
        $this->assign('bargain_relation',$bargain_relation);

        $this->assign('page_title','砍价活动');
        $this->display();
    }

    //砍价详情
    public function log(){
        $bargain = $this->bargain_model->alias('b')->field('b.*,g.market_price,g.shop_price,ge.sku_id,ge.skus')
            ->join('__GOODS__ AS g ON g.id=b.goods_id')
            ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=b.goods_id')
            ->where(array('b.id'=>$this->bargain_id))->find();
        if ( !$bargain )
            $this->_empty();
        $this->assign('bargain',$bargain);

        $bargain['middle_price'] = round($bargain['middle_price'],2);
        $bargain['min_price'] = round($bargain['min_price'],2);

        //判断是否购买过
        $order = D('OrderGoods')->alias('og')
            ->join('__ORDER__ AS o ON o.id=og.order_id AND o.user_id='.$this->user_id.' AND o.date_add BETWEEN '.$bargain['bargain_start'].' AND '.$bargain['bargain_end'])
            ->where(array('og.buy_flag'=>'bargain','og.goods_id'=>$bargain['goods_id']))->find();
        $this->assign('order',$order);

        if ( !$order ){
            $goods_sku = D('GoodsSku')->where(array('id'=>$bargain['sku_id']))->getField('skus');
            $this->assign('goods_sku',$goods_sku);
        }

        $mine_bargain = round($this->log_model->where(array('order_user'=>$this->user_id,'bargain_user'=>$this->user_id,'bargain_id'=>$this->bargain_id))->sum('money'),2);
        $this->assign('mine_bargain',$mine_bargain);

        $friend_bargain = round($this->log_model->where(array('order_user'=>$this->user_id,'bargain_user'=>array('neq',$this->user_id),'bargain_id'=>$this->bargain_id))->sum('money'),2);
        $this->assign('friend_bargain',$friend_bargain);

        $final_price = $bargain['shop_price'] - $mine_bargain - $friend_bargain;
        if ( $final_price < $bargain['middle_price'] && $final_price > $bargain['min_price'] ){
            $final_price = $bargain['middle_price'];
        }elseif ( $final_price <= $bargain['min_price'] ){
            $final_price = $bargain['min_price'];
        }
        $this->assign('final_price',$final_price);

        $this->display();
    }

    //好友砍价
    public function friend(){
        $bargain = $this->bargain_model->alias('b')->field('b.*,g.market_price,g.shop_price')
            ->join('__GOODS__ AS g ON g.id=b.goods_id')
            ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=b.goods_id')
            ->where(array('b.id'=>$this->bargain_id))->find();
        if ( !$bargain )
            $this->_empty();
        $this->assign('bargain',$bargain);

        $bargain['bargain_price'] = round($bargain['bargain_price'],2);

        if ( ($order_user = I('get.u',0,'intval')) < 1 )
            $this->_empty();

        //分享用户信息
        $share_user = D('WechatUser')->field('user_id,nick_name,avatar')->where(array('user_id'=>$order_user))->find();
        if ( !$share_user )
            $this->_empty();
        $this->assign('share_user',$share_user);

        $mine_bargain = round($this->log_model->where(array('bargain_id'=>$this->bargain_id,'order_user'=>$share_user['user_id'],'bargain_user'=>$this->user_id))->sum('money'),2);
        $bargain_price = round($this->log_model->where(array('bargain_id'=>$this->bargain_id,'order_user'=>$share_user['user_id']))->sum('money'),2);
        if ( !$mine_bargain ){
            if ($bargain['shop_price'] - $bargain_price > $bargain['middle_price'])
                $mine_bargain = round(rand($bargain['bargain_price']*5,$bargain['bargain_price']*8)/10000,2);
            else
                $mine_bargain = round(rand($bargain['bargain_price'],$bargain['bargain_price']*3)/10000,2);

            $this->log_model->add(array(
                'bargain_id' => $this->bargain_id,
                'order_user' => $share_user['user_id'],
                'bargain_user' => $this->user_id,
                'money' => $mine_bargain,
                'date_add' => time(),
            ));
        }
        $this->assign('mine_bargain',$mine_bargain);

        $map = array(
            'on_sale' => 'Y',
            'bargain_start' => array('elt',time()),
            'bargain_end' => array('egt',time()),
            'id' => array('neq',$bargain['id']),
        );
        $bargain_relation = $this->bargain_model->where($map)->select();
        $this->assign('bargain_relation',$bargain_relation);

        $this->display();
    }
}