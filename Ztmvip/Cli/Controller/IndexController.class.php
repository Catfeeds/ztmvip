<?php
/**
 * 管理组模型
 * crontab 每5分钟运行一次脚本
#ztmvip.sh
#!/bin/bash
#ztmvip crontab
cd /home/wwwroot/ztmvip2
php -f cli.php Cli/Index/index
 * author: Tom
 */
namespace Cli\Controller;
class IndexController extends BaseController
{
    protected $today,$deviation=30;

    public function _initialize(){
        parent::_initialize();

        $this->today = strtotime(date('Y-m-d'));
    }

    public function index(){
        $now = time();

        //每日任务
        if ( $this->today - $now < $this->deviation ){
            $this->order(); //处理订单
            $this->slimDownPrepaid(); //健康减重基金
        }

        //每3分钟任务
        if ( $now / 300 < $this->deviation ){
            $this->prompt(); //秒杀提示
        }

        //每月任务
        if ( $this->today - $now < $this->deviation && date('j') == 1 ){
            //$this->slimDownAffiliate(); //健康减重卡顾问返佣
        }
    }

    //处理订单
    protected function order(){
        $order_model = D('Order');
        $start_day = 1447776000; //2.0上线时间戳
        $seven_day = $this->today - 604800; //7天前时间戳
        $fourteen_day = $this->today - 1209600; //14天前时间戳

        //超过7天未付款订单设为无效
        $map = array(
            'order_state' => 'new',
            'payment_state' => 'new',
            'date_add' => array('between',array($start_day,$seven_day)),
        );
        $order_model->where($map)->save(array('order_state'=>'invalid'));

        //超过14天未收货订单设为已完成、已收货
        $map = array(
            'order_state' => 'confirm',
            'payment_state' => 'payed',
            'shipping_state' => 'send',
            'date_send' => array('between',array($start_day,$fourteen_day)),
        );
        $order_model->where($map)->save(array('order_state'=>'finish','shipping_state'=>'receive'));

        //超过7天已完成订单分佣
        $affiliate_model = D('AffiliateLog');

        $map = array(
            'order_state' => 'finish',
            'payment_state' => 'payed',
            'date_add' => array('between',array($start_day,$seven_day)),
        );
        $finish_order = $order_model->where($map)->getField('id',true);
        if ( $finish_order ){
            $map = array(
                'order_type' => 'normal',
                'order_id' => array('in',$finish_order),
                'separated' => 'N',
            );
            $affiliate_model->where($map)->save(array('separated'=>'Y'));
        }

        //储值卡分佣
        $map = array(
            'order_type' => 'prepaid',
            'separated' => 'N',
            'date_add' => array('between',array($start_day,$seven_day)),
        );
        $affiliate_model->where($map)->save(array('separated'=>'Y'));
    }

    //秒杀提示
    protected function prompt(){
    }

    //健康减重基金
    protected function slimDownPrepaid(){
        $user_prepaid_model = D('UserPrepaid');
        $map = array(
            'prepaid_id' => 2,
            'date_add' => array('egt',strtotime(date('Y-m-d',strtotime('-7 years -2 months')))),
            '_string' => 'FROM_UNIXTIME(date_add,"%d") = "'.date('d').'"',
        );
        $order = $user_prepaid_model->where($map)->select();

        foreach ( $order as $val ){
            $user_prepaid_model->where(array('id'=>$val['id']))->save(array('money'=>190));
        }
    }

    //健康减重卡顾问返佣
    protected function slimDownAffiliate(){
        $goods_id = '2325';
        $rebate_user = '19487';
        $date_pay_end = strtotime(date('Y-m-01')) - 1;
        $date_pay_start = strtotime(date('Y-m-01',$date_pay_end));

        $map = array(
            'o.order_state' => 'finish',
            'o.payment_state' => 'payed',
            'o.date_pay' => array('between',array($date_pay_start,$date_pay_end)),
        );
        $order = D('Order')->alias('o')->field('o.id,o.order_sn,o.user_id,o.goods_fee,o.shipping_fee')
            ->join('__ORDER_GOODS__ AS og ON og.order_id=o.id AND og.goods_id IN ('.$goods_id.')')
            ->where($map)
            ->select();

        $data = array();

        foreach ( $order as $val ){
            $data[] = array(
                'order_user' => $val['user_id'],
                'rebate_user' => $rebate_user,
                'order_type' => 'normal',
                'order_id' => $val['id'],
                'order_sn' => $val['order_sn'],
                'money' => (floatval($val['goods_fee']) + floatval($val['shipping_fee'])) * 0.1,
                'separated' => 'Y',
                'date_add' => time(),
            );
        }

        D('AffiliateLog')->addAll($data);
    }
}