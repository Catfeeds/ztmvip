<?php
/**
 * Author: lihongfu
 * Date: 2016/1/23
 */

namespace Computer\Controller;


class AlipayController
{
    private $alipay;

    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->alipay = new \Common\Vendor\Alipay();
    }

    //异步
    public function depositNotifyUrl()
    {
//        $string = 'a:22:{s:8:"discount";s:4:"0.00";s:12:"payment_type";s:1:"1";s:7:"subject";s:21:"整体美商城购物";s:8:"trade_no";s:28:"2016012121001004960021696533";s:11:"buyer_email";s:17:"2358196186@qq.com";s:10:"gmt_create";s:19:"2016-01-21 15:23:50";s:11:"notify_type";s:17:"trade_status_sync";s:8:"quantity";s:1:"1";s:12:"out_trade_no";s:19:"20445O2016012122730";s:9:"seller_id";s:16:"2088911849346454";s:11:"notify_time";s:19:"2016-01-21 15:28:24";s:12:"trade_status";s:13:"TRADE_SUCCESS";s:19:"is_total_fee_adjust";s:1:"N";s:9:"total_fee";s:4:"0.01";s:11:"gmt_payment";s:19:"2016-01-21 15:24:04";s:12:"seller_email";s:17:"2797448794@qq.com";s:5:"price";s:4:"0.01";s:8:"buyer_id";s:16:"2088512365831961";s:9:"notify_id";s:34:"5e2c4c39a200929dc637b6b179a8e2dneo";s:10:"use_coupon";s:1:"N";s:9:"sign_type";s:3:"MD5";s:4:"sign";s:32:"db10f00c6e78a2d3da62ac7d2be8220d";}';
//        $_POST = unserialize($string);
//        $_POST = json_encode($_POST,JSON_UNESCAPED_UNICODE);
//
//        $string = '{"discount":"0.00","payment_type":"1","subject":"整体美商城充值","trade_no":"2016012121001004960021696533","buyer_email":"2358196186@qq.com","gmt_create":"2016-01-25 15:23:50","notify_type":"trade_status_sync","quantity":"1","out_trade_no":"2016012532192995","seller_id":"2088911849346454","notify_time":"2016-01-21 15:28:24","trade_status":"TRADE_SUCCESS","is_total_fee_adjust":"N","total_fee":"0.01","gmt_payment":"2016-01-25 15:24:04","seller_email":"2797448794@qq.com","price":"0.01","buyer_id":"2088512365831961","notify_id":"5e2c4c39a200929dc637b6b179a8e2dneo","use_coupon":"N","sign_type":"MD5","sign":"db10f00c6e78a2d3da62ac7d2be8220d"}';
//        $_POST = json_decode($string,true);

        try {
            $message = 'success';
            if (!$_POST)
                E('fail');
            if (!$this->alipay->notify_url())
                E('fail');
            if ($_POST['trade_status'] != 'TRADE_SUCCESS')
                E('fail');
            /************他妈个巴子的，开始业务逻辑*****************************/

            $order = D('User')->UserAccountIsPay($_POST['out_trade_no']);

            if ($order !== true) {
                if ($_POST['total_fee'] != $order['amount'])
                    E('fail');
                //修改订单状态
                if (!D('User')->userAccountPaid($order, $_POST['trade_no'])) {
                    E('fail');
                }
            }
        } catch (\Think\Exception $e) {
            $message = $e->getMessage();
        }
        echo $message;
    }

}