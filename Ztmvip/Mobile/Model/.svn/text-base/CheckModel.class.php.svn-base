<?php
namespace Mobile\Model;
class CheckModel extends BaseModel{
    protected $tableName='cart';

    /**
     * checkout页面取得购物车商品
     * @param $order_id
     * @return array
     */
    public function checkGoods($order_id){
        $cart_list = D('OrderGoods')->field('*,goods_price * goods_number as subtotal')
            ->where(array('order_id' => $order_id))->order('id desc')->select();

        foreach ( $cart_list as &$val ){
            #增加购物车显示商品图
            if ( $val['buy_flag'] != 'package' ){
                $val['goods_thumb'] = D('Goods')->where(array('id'=>$val['goods_id'])) ->getField('goods_thumb');
            }else{
                #######礼包等会写############
            }

            #对属性进行装饰(为了兼容老系统上的数据，这里不能存成json格式啦)
            #但是礼包可以用json的
            if ( $val['different'] == 'new' ){
                $val['skus']=json_decode($val['skus'],true);
            }
        }
        unset($val);

        return $cart_list;
    }

    /**
     * 获得用户再次购买的时候的选择
     * 这里的选择都是死的，只有支付方式是变的而已
     * @param $order_id
     * @return mixed
     */
    public function flowOrderInfo($order_id){
        $order = D('OrderExtend')->field('coupon_id,bonus_id,integral')->where(array('order_id'=>$order_id))->find();

        if ( session('center_payment_name') && session('center_order_id') == $order_id ){
            $order['payment_name'] =session('center_payment_name');
        }else{
            $order['payment_name']='wx';
        }

        return $order;
    }

    /**
     * 订单中的费用信息
     * @param $order_id
     * @return array
     */
    function orderFee($order_id){
        $total = D('Order')->alias('o')->field('o.goods_fee,o.shipping_fee,oe.bonus_id,oe.bonus_amount,oe.coupon_id,oe.coupon_amount,oe.integral,oe.integral_amount')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where(array('o.id'=>$order_id))->find();

        #初始化
        $total['will_get_integral'] = 0;
        $total['will_get_bonus'] = 0;

        $total['amount']=$total['goods_price']+$total['shipping_fee']-$total['bonus_amount']-$total['coupon_amount']-$total['integral_amount'];

        return $total;
    }

    /**
     * 获取收货地址
     * @param $order_id
     * @return mixed
     */
    public function getConsignee($order_id){
        return D('OrderExtend')->field('consignee,province,city,district,address,mobile')
            ->where(array('order_id'=>$order_id))->find();
    }

    /**
     * 将订单状态设置成支付
     * @param $order_id
     * @param $amount
     */
    public function orderPayed($order_id,$amount){
        $order = $this->flowOrderInfo($order_id);
        #修改order表
        $data = array(
            'order_state'=>'confirm',
            'payment_state'=>'payed',
            'date_confirm'=>time(),
            'date_pay'=>time(),
        );
        D('Order')->where(array('id'=>$order_id))->save($data);

        #修改order_extend表
        $data = array();
        switch ( $order['payment_name'] ){
            case 'wx':
                $data['payment_amount'] = $amount;
                break;
            case 'ye':
                $data['surplus_amount'] = $amount;
                break;
            default:
                # code...
                break;
        };

        D('OrderExtend')->where(array('order_id'=>$order_id))->save($data);
    }

    /**
     * 获取订单号
     * @param $order_id
     * @return mixed
     */
    public function getOrderSn($order_id){
        return D('Order')->where(array('id'=>$order_id))->getField('order_sn');
    }
}