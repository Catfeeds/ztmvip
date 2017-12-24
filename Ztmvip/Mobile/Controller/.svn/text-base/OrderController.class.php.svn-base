<?php
/**
 * 订单控制器
 * author: Tom
 */
namespace Mobile\Controller;
class OrderController extends UserBaseController
{
    protected $user_model,$order_model,$extend_model,$order_goods_model;

    public function _initialize(){
        parent::_initialize();

        $this->user_model = D('User');
        $this->order_model = D('Order');
        $this->extend_model = D('OrderExtend');
        $this->order_goods_model = D('OrderGoods');
    }

    //评论商品
    public function comment($order_id){
        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );
            $post = I('post.');
            $comment_model = D('Comment');

            try{
                $goods = D('OrderGoods')->alias('og')->field('og.goods_id')
                    ->join('__ORDER__ AS o ON o.id=og.order_id AND o.user_id='.$this->user_id)
                    ->where(array('og.order_id'=>$order_id))->select();

                if ( !$goods )
                    E('抱歉，参数错误');

                foreach ( $goods as $val ){
                    if ( !$post['level_'.$val['goods_id']] )
                        break;

                    $comment_model->add(array(
                        'relation_id' => $val['goods_id'],
                        'relation_type' => 'goods',
                        'level' => $post['level_'.$val['goods_id']],
                        'user_name' => D('User')->where(array('id'=>$this->user_id))->getField('user_name'),
                        'content' => $post['content_'.$val['goods_id']],
                        'date_add' => time(),
                    ));
                }

                D('Order')->where(array('id'=>$order_id))->save(array('order_state'=>'finish'));
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $map = array(
            'o.user_id' => $this->user_id,
            'o.id' => $order_id,
        );
        $order = D('Order')->alias('o')->field('o.id,o.order_sn')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where($map)->order('id DESC')->find();
        $order_goods_model = D('OrderGoods');
        $order['goods'] = $order_goods_model->alias('og')->field('og.goods_id,og.goods_number,og.goods_price,og.skus,og.different,g.goods_name,g.goods_thumb')
            ->join('__GOODS__ AS g ON g.id=og.goods_id')
            ->where(array('og.order_id'=>$order['id']))->select();
        $this->assign('order',$order);

        $this->assign('page_title','评论商品');
        $this->display();
    }

    //订单详情
    public function detail($order_id){
        $order = $this->order_model->alias('o')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where(array('id'=>$order_id))->find();
        if ( !$order )
            $this->_empty();

        $order['goods'] = $this->order_goods_model->alias('og')
            ->field('og.goods_id,og.goods_number,og.goods_price,og.skus,og.different,g.goods_name,g.goods_thumb,g.on_sale')
            ->join('__GOODS__ AS g ON g.id=og.goods_id')
            ->where(array('og.order_id'=>$order['id']))
            ->select();
        $this->assign('order',$order);

        $this->assign('page_title','订单详情');
        $this->display();
    }

    //删除订单
    public function delete(){
        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );
            $post = I('post.');

            $account_model = D('AccountLog');
            $bonus_model = D('UserBonus');
            $coupon_model = D('UserCoupon');

            try{
                $map = array(
                    'id' => $post['order_id'],
                    'user_id' => $this->user_id,
                    'order_state' => 'new',
                    'payment_state' => array('in',array('new','paying')),
                );
                if ( !($order = $this->order_model->where($map)->find()) )
                    E('抱歉，参数错误');

                $order_extend = $this->extend_model->where(array('order_id'=>$order['id']))->find();
                if ( !$order_extend )
                    E('非法操作');

                //计算退回余额
                $surplus_amount = 0;
                $surplus_amount += intval($order_extend['surplus_amount']*100); //余额支付
                $surplus_amount += intval($order_extend['payment_amount']*100); //网上支付
                $surplus_amount = floatval($surplus_amount / 100); //还原数据
                //退回余额
                $this->user_model->where(array('id'=>$order['user_id']))->setInc('user_money',$surplus_amount);

                //退回积分
                $integral = $order_extend['integral'] - $order_extend['integral_get'];
                $this->user_model->where(array('id'=>$order['user_id']))->setInc('integral',$integral);

                //账户余额变动日志
                if ( $surplus_amount || $integral ){
                    $account_model->add(array(
                        'user_id' => $order['user_id'],
                        'change_type' => 'manual',
                        'user_money' => $surplus_amount,
                        'integral' => $integral,
                        'change_desc' => '用户删除订单',
                        'date_add' => time(),
                    ));
                }

                //退回储值卡
                if ( $order_extend['prepaid_amount'] )
                    D('UserPrepaid')->where(array('id'=>$order_extend['prepaid_id']))->setInc('money',$order_extend['prepaid_amount']);

                //退回红包
                if ( $order_extend['bonus_amount'] )
                    $bonus_model->where(array('id'=>$order_extend['bonus_id']))->save(array('order_id'=>0,'date_use'=>0));

                //退回优惠券
                if ( $order_extend['coupon_amount'] )
                    $coupon_model->where(array('id'=>$order_extend['coupon_id']))->save(array('order_id'=>0,'date_use'=>0));

                //删除赠送红包
                $bonus_model->where(array('id'=>array('in',$order_extend['bonus_get']?:'0')))->delete();

                //删除赠送优惠券
                $coupon_model->where(array('id'=>array('in',$order_extend['coupon_get']?:'0')))->delete();

                //删除分佣
                D('AffiliateLog')->where(array('order_type'=>'normal','order_id'=>$order['id']))->delete();

                $this->order_model->where($map)->delete();
                $this->extend_model->where(array('order_id'=>$order['id']))->delete();
                $this->order_goods_model->where(array('order_id'=>$order['id']))->delete();
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //订单物流
    public function express($order_id){
        $map = array(
            'o.user_id' => $this->user_id,
            'o.id' => $order_id,
        );
        $order = D('Order')->alias('o')->field('o.id,o.order_sn,oe.express_name,oe.express_no')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where($map)->order('id DESC')->find();
        $order_goods_model = D('OrderGoods');
        $order['goods'] = $order_goods_model->alias('og')->field('og.goods_number,og.goods_price,og.skus,og.different,g.goods_name,g.goods_thumb')
            ->join('__GOODS__ AS g ON g.id=og.goods_id')
            ->where(array('og.order_id'=>$order['id']))->select();
        $this->assign('order',$order);

        $map = array(
            'o.id' => $order_id,
            'o.user_id' => $this->user_id,
        );
        $order = $this->order_model->alias('o')->field('oe.express_name,oe.express_no')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where($map)->find();
        if ( !$order )
            $this->_empty();

        $express = express_info($order['express_name'],$order['express_no']);
        $this->assign('express',$express);

        $this->assign('page_title','订单物流');
        $this->display();
    }

    //退款&售后
    public function refund($order_id){
        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '申请成功，等待售后人员回访',
            );
            $post = I('post.');

            try{
                if ( !$post['refund_type'] )
                    E('抱歉，请选择售后类型');
                if ( !$post['refund_note'] )
                    E('抱歉，请填写售后说明');

                $order_extend = $this->extend_model->alias('oe')->field('oe.bonus_get,oe.coupon_get,oe.integral_get')
                    ->join('__ORDER__ AS o ON o.id=oe.order_id AND o.order_state="confirm" AND o.shipping_state="receive" AND o.user_id='.$this->user_id)
                    ->where(array('oe.order_id'=>$order_id))->find();
                if ( !$order_extend )
                    E('非法操作');

                $order_extend['bonus_get'] = json_decode($order_extend['bonus_get'],true);
                $order_extend['coupon_get'] = json_decode($order_extend['coupon_get'],true);

                if ( $order_extend['bonus_get'] && D('UserBonus')->where(array('id'=>array('in',$order_extend['bonus_get']),'date_use'=>array('gt',0)))->count() )
                    E('抱歉，订单赠送红包已被使用');

                if ( $order_extend['coupon_get'] && D('UserCoupon')->where(array('id'=>array('in',$order_extend['coupon_get']),'date_use'=>array('gt',0)))->count() )
                    E('抱歉，订单赠送优惠券已被使用');

                if ( $order_extend['integral_get'] > D('AccountLog')->where(array('user_id'=>$this->user_id))->sum('integral') )
                    E('抱歉，订单赠送积分已被使用');

                $this->order_model->where(array('id'=>$order_id))->save(array('order_state'=>'refund'));
                $this->extend_model->where(array('order_id'=>$order_id))->save(array('refund_note'=>'【'.$post['refund_type'].'】'.$post['refund_note']));
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('page_title','申请售后');
        $this->display();
    }

    //订单状态
    public function state(){
        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );
            $post = I('post.');

            try{
                switch ( $post['state'] ){
                    case 'receive':
                        $map = array(
                            'id' => $post['order_id'],
                            'user_id' => $this->user_id,
                            'order_state' => 'confirm',
                            'payment_state' => 'payed',
                            'shipping_state' => 'send',
                        );
                        if ( !$this->order_model->where($map)->find() )
                            E('抱歉，参数错误');

                        $this->order_model->where($map)->save(array('shipping_state'=>'receive','date_receive'=>time()));
                        break;
                    case 'finish':
                        $map = array(
                            'id' => $post['order_id'],
                            'user_id' => $this->user_id,
                            'order_state' => 'confirm',
                            'payment_state' => 'payed',
                            'shipping_state' => 'receive',
                        );
                        if ( !$this->order_model->where($map)->find() )
                            E('抱歉，参数错误');

                        $this->order_model->where($map)->save(array('order_state'=>'finish'));
                        break;
                    default:
                        E('非法访问');
                        break;
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }
}