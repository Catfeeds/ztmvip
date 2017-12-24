<?php
namespace Common\Vendor;

class Alipay
{
    protected $alipay_config;
    public function __construct()
    {
        $this->alipay_config = C('alipay');
    }

    /**
     * 建立支付请求
     * get传参数过来
     * @param string notify_url 面跳转同异步通知页面路径
     * @param string return_url 服务器同步通知页面路径
     * @param mixed out_trade_no 商户订单号
     * @param string subject 订单名称
     * @param decimal total_fee 付款金额
     * @param string body 订单描述
     * @param string show_url 商品展示地址
     */
    public function pay($order)
    {
        include('Alipay/lib/alipay_submit.class.php');

        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($this->alipay_config['partner']),
            "_input_charset" => trim(strtolower($this->alipay_config['input_charset'])),
            "seller_id" => trim($this->alipay_config['partner']),#卖家支付宝用户号
            "payment_type" =>"1",
            "notify_url" => $order['notify_url'],
            "return_url" => $order['return_url'],
            "out_trade_no" =>$order['out_trade_no'],
            "subject" =>$order['subject'],
            "total_fee" => $order['total_fee'],  
        );
   
        //建立请求
        $alipaySubmit = new \AlipaySubmit($this->alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "");
        return $html_text;
    }


   /*
    *
    *回调验证，确保是支付宝老儿发过来的
    */
    public function notify_url()
    {
       include('Alipay/lib/alipay_notify.class.php');
       $alipayNotify = new \AlipayNotify($this->alipay_config);
       return  $alipayNotify->verifyNotify();
    }


    /**
     * 回调验证，确保是支付宝老儿发过来的
     */
    
    public function return_url()
    {
         include('Alipay/lib/alipay_notify.class.php');
         $alipayNotify = new \AlipayNotify($this->alipay_config);
         return $alipayNotify->verifyReturn();
    }

}
