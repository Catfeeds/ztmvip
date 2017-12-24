<?php

namespace Common\Vendor;
class Nwxpay
{

  private $wx_config;
  
 
 public function __construct()
 {
    $this->wx_config=C('wechat');
 }

/**
 * 返回appid
 * @return [type] [description]
 */
public function get_appid()
{
    return $this->wx_config['APPID'];
  
}

/**
 * 返回商户号
 * @return [type] [description]
 */
public function get_mch_id()
{
      return $this->wx_config['MCHID'];
}




/**
 * 生成扫码支付的链接(扫码一)
 * @param  [type] $productid [description]
 * @return [type]            [description]
 */
public function native_one_url($productid)    
{
    $pre=array(
          'appid'=>$this->wx_config['APPID'],
          'mch_id'=>$this->wx_config['MCHID'],
          'time_stamp'=>time(),
          'nonce_str'=>$this->createNoncestr(),
          'product_id'=>$productid,
        );

    $sign=$this->getSign($pre);
   
   return "weixin://wxpay/bizpayurl?appid=".$pre['appid']."&mch_id=".$pre['mch_id']."&nonce_str=".$pre['nonce_str']."&product_id=".$productid."&time_stamp=".$pre['time_stamp']."&sign=".$sign;



}



/**
 * 作用：产生随机字符串，不长于32位
 */
public function createNoncestr($length = 32)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i ++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}




/**
 * 作用：生成签名
 */
public function getSign($arr)
{
    foreach ($arr as $k => $v) {
        $Parameters[$k] = $v;
    }
    // 签名步骤一：按字典序排序参数
    ksort($Parameters);
    
    $buff = "";
    foreach ($Parameters as $k => $v) {
        $buff .= $k . "=" . $v . "&";
    }
    $String;
    if (strlen($buff) > 0) {
        $String = substr($buff, 0, strlen($buff) - 1);
    }
    
    // 签名步骤二：在string后加入KEY
    $String = $String . "&key=" .$this->wx_config['PAYKEY'];
    
    // 签名步骤三：MD5加密
    $String = md5($String);
   
    // 签名步骤四：所有字符转为大写
    $result_ = strtoupper($String);
   
    return $result_;
}






//统一下单接口

/**
 * 统一下单接口有参数说明的
 * 获取prepay_id
 */
function getPrepayId($order)
{

    $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
    $parameters=array(
           'appid'=>$this->wx_config['APPID'],
           'mch_id'=>$this->wx_config['MCHID'],
           'nonce_str'=>$this->createNoncestr(),
            'body'=>isset($order['body'])?$order['body']:$order['order_sn'],
            'out_trade_no'=> str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT).'O'.$order['order_id'],
            'total_fee'=>$order['total_fee'] * 100,
            'spbill_create_ip'=>$_SERVER['REMOTE_ADDR'], // 终端ip
            'notify_url'=>$order['notify_url'],
            'trade_type'=>$order['trade_type'],
        );

        $parameters["sign"] = $this->getSign($parameters); 
       #如果值是字符串的话，最好放到CDATA节点中
        $xml = "<xml>";
        foreach ($parameters as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";

  
    $response = Http::curlPost($url, $xml, 30);
    $result = json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $result["prepay_id"];
}










  








}