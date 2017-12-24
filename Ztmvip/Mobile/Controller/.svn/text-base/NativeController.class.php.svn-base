<?php
namespace Mobile\Controller;
use   Think\Controller;
class NativeController extends BaseController
{
    private $nwxpay;


    public function __construct(){
        parent::__construct();
        $this->nwxpay = new \Common\Vendor\Nwxpay();

    }



#扫码微信支付成功回调地址
public function wxpayReback() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        // file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/shanbumin.txt',$postStr);
   
     try{
           
            if(empty($postStr))
               E('empty');

            $postdata=json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            $wxsign = $postdata['sign'];
            unset($postdata['sign']);
            $sign=$this->nwxpay->getSign($postdata);

            if($wxsign!=$sign){
               E('sign');
            }else if($postdata['result_code']!='SUCCESS'){
                E('result_code');
            }

            $out_trade_no = explode('O', $postdata['out_trade_no']);
            $order_id=$out_trade_no[1];
            $amount=$postdata['total_fee']/100;
            $transaction_id=$postdata['transaction_id'];

            $true=D('Treatment')->isOrderPayed($order_id);
            if($true)
              E('payed');
            $order_amount=D('Treatment')->orderAmount($order_id);
            if($order_amount!=$amount)
               E('amount');
            #修改订单状态为已经支付
            $true=D('Treatment')->wxorderPayed($order_id,$amount,$transaction_id);
            #赠送积分
            D('Treatment')->giveIntegral($order_id,'wechat');
            #赠送红包
            D('Treatment')->giveBonus($order_id);
            #打入分销标志
            D('Treatment')->affiliateFlag($order_id);
            $returndata['return_code'] = 'SUCCESS';
        }catch(\Think\Exception $e)
        {
           $error=$e->getMessage();
           switch ($error) {
             case 'empty':
               #当我们没有收到数据的时候，给微信服务器的答复
               $returndata['return_code'] = 'FAIL';
               $returndata['return_msg'] = '无数据返回';
               break;
             case 'sign':
              #签名失败的时候，给微信服务器的答复
              $returndata['return_code'] = 'FAIL';
              $returndata['return_msg'] = '签名失败';
               break;
             case 'result_code':
               $returndata['return_code']='FAIL';
               $returndata['return_msg']='返回结果失败';
               break;
             case 'payed':
                 $returndata['return_code'] = 'SUCCESS';
                break;
             case 'amount':
                 $returndata['return_code'] = 'FAIL';
                 $returndata['return_msg'] = '金额有误'; 
                break;
             default:
               # code...
               break;
        }
 }

// 数组转化为xml
$xml = "<xml>";
foreach ($returndata as $key => $val) {
    if (is_numeric($val)) {
        $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
    } else
        $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
}
$xml .= "</xml>";

echo $xml;
exit();


}






}#类尾