<?php

namespace Mobile\Model;

use Think\Model;

class PrepaidModel extends Model
{
    //判断是否已经支付
    public function prepaidIsPay($order_sn)
    {
        $order = M('PrepaidAccountLog')->field('id,affiliate_user,prepaid_id,amount,order_sn,date_pay,user_id')->where(array('order_sn' => $order_sn))->find();
        if ($order['date_pay'] > 0) {
            return true;
        } else {
            return $order;
        }
    }

    //支付成功后处理业务
    public function prepaidAfter($order, $transaction_id)
    {
        M('PrepaidAccountLog')->where(array('id' => $order['id']))->save(array('date_pay' => time(), 'payment_sn' => $transaction_id));
        $prepaid = M('Prepaid')->field('id,prefix,par,profit,price')->where(array('id' => $order['prepaid_id']))->find();
        $data['prepaid_id'] = $order['prepaid_id'];
        $data['user_id'] = $order['user_id'];
        $data['money'] = $prepaid['par'];
        $data['prepaid_sn'] = trim($prepaid['prefix']) . ' ' . $this->right($prepaid['id']);
        $data['date_add'] = time();
        M('UserPrepaid')->add($data);
        if ($order['affiliate_user'] && $order['affiliate_user'] > 0 && $prepaid['profit'] > 0) {
            $affiliate_data = array(
                'order_user' => $order['user_id'],
                'rebate_user' => $order['affiliate_user'],
                'order_type' => 'prepaid',
                'order_id' => $order['id'],
                'order_sn' => $order['order_sn'],
                'money' => $prepaid['price'] * $prepaid['profit'] / 100,
                'date_add' => time()
            );
            M('AffiliateLog')->add($affiliate_data);
        }
    }

    //取卡号后十位数
    public function right($id)
    {
        $total = $this->where(array('id'=>$id))->getField('total');
        $str = substr('0000000000' . strval($total+1), -10);
        $str = str_split($str,4);

        $this->where(array('id'=>$id))->setInc('total');
        return trim(join(' ',$str));
    }
}
