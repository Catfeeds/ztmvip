<?php

namespace Computer\Controller;
class PayController extends BaseController{

private $alipay;

/**
 * 构造方法
 */
public function __construct()
{
   parent::__construct();  //一定要有的，否则很多父类的方法将不能用，如error,redirect等
   $this->alipay=new \Common\Vendor\Alipay();
}


/**
 * 支付宝支付
 * @param  [type] $order_id [description]
 * @return [type]           [description]
 */
   public function alipay()
   {

    $order_id=I('post.order_id');
    $result=array('code'=>'suc');
 
    try{
     
        if(!$order_id)
           E('stop');

      $order_detail=D('Order')->orderDetail($order_id);

       $order=array(
                 'notify_url'=>__HOST__.U('Pay/aliNotifyUrl'), #异步通知地址
                 'return_url'=>__HOST__.U('Pay/aliCheckPay'),  #同步跳转地址
                 'out_trade_no'=>$order_id.'O'.$order_detail['order_sn'],
                 'subject'=>'整体美商城购物',
                 'total_fee'=>$order_detail['amount'],
             );
       $html=$this->alipay->pay($order);
       if(!$html)
           E('fail');

       $result['content']=$html;
    }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
         case 'stop':
           $result['code']='stop';
           break;
         case 'fail':
           $result['code']='fail';
           break;
         default:
           $result['code']='grammar';
           break;
       }
    }

    $this->ajaxReturn($result);

   }

 /**
  * 支付宝支付回调地址
  * @return [type] [description]
  */
public function  aliNotifyUrl()
{
  
  // $string='a:22:{s:8:"discount";s:4:"0.00";s:12:"payment_type";s:1:"1";s:7:"subject";s:21:"整体美商城购物";s:8:"trade_no";s:28:"2016012121001004960021696533";s:11:"buyer_email";s:17:"2358196186@qq.com";s:10:"gmt_create";s:19:"2016-01-21 15:23:50";s:11:"notify_type";s:17:"trade_status_sync";s:8:"quantity";s:1:"1";s:12:"out_trade_no";s:19:"20445O2016012122730";s:9:"seller_id";s:16:"2088911849346454";s:11:"notify_time";s:19:"2016-01-21 15:28:24";s:12:"trade_status";s:13:"TRADE_SUCCESS";s:19:"is_total_fee_adjust";s:1:"N";s:9:"total_fee";s:4:"0.01";s:11:"gmt_payment";s:19:"2016-01-21 15:24:04";s:12:"seller_email";s:17:"2797448794@qq.com";s:5:"price";s:4:"0.01";s:8:"buyer_id";s:16:"2088512365831961";s:9:"notify_id";s:34:"5e2c4c39a200929dc637b6b179a8e2dneo";s:10:"use_coupon";s:1:"N";s:9:"sign_type";s:3:"MD5";s:4:"sign";s:32:"db10f00c6e78a2d3da62ac7d2be8220d";}';

  // $_POST=unserialize($string);
  // show_bug($_POST);

  try{
       if(!$_POST)
         E('fail');
       //验证确保是支付宝发过来的(验证的依据就是秘钥罢了)
       if(!$this->alipay->notify_url())
         E('fail');
       if($_POST['trade_status']!='TRADE_SUCCESS')
         E('fail');
        $out_trade_no=explode('O',$_POST['out_trade_no']);
        $order_id=$out_trade_no[0]; 
       
       if(D('order')->isOrderPayed($order_id))
          E('suc');
        $order_detail=D('Order')->orderDetail($order_id);
        if($_POST['total_fee'] != $order_detail['amount'])
            E('fail');

        $back=D('Order')->aliorderPayed($order_id,$order_detail['amount'],$_POST['trade_no']);
        if(!$back)
          E('fail');
        D('Order')->giveIntegral($order_id,'alipay');
        D('Order')->giveBonus($order_id);
        D('Order')->affiliateFlag($order_id);
        E('suc');      
  }catch(\Think\Exception $e){
      $error=$e->getMessage();
   
      switch ($error) {
        case 'fail':
           echo 'fail';
          break;
        case 'suc':
           echo "success";
          break;
        default:
          # code...
          break;
      }
  }


 //  serialize($_POST);
 // file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/notify_url.txt',serialize($_POST));
  
}


/**
 * 成功与失败支付展示页面
 * @return [type] [description]
 */
public function aliCheckPay()
{

   try{  
         if(!$this->alipay->return_url())
            E('out'); //非法入侵

        if($_GET['trade_status']!='TRADE_SUCCESS')
          E('fail'); //支付失败
         $out_trade_no=explode('O',$_GET['out_trade_no']);
         $order_id=$out_trade_no[0]; 
        
        if(D('order')->isOrderPayed($order_id))
           E('suc');//异步已经搞定
         $order_detail=D('Order')->orderDetail($order_id);
         if($_GET['total_fee'] != $order_detail['amount'])
             E('fail');

         $back=D('Order')->aliorderPayed($order_id,$order_detail['amount'],$_GET['trade_no']);
         if(!$back)
           E('fail');
         D('Order')->giveIntegral($order_id,'alipay');
         D('Order')->giveBonus($order_id);
         D('Order')->affiliateFlag($order_id);
         E('suc');      

   }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error){
           case 'out':
             $this->error('禁止非法入侵');
             exit;
             break;
           case 'fail':
            $this->redirect('Flow/checkPay',array('status'=>0,'order_id'=>$order_id));
             break;
           case 'suc':
             $this->redirect('Flow/checkPay',array('status'=>1,'order_id'=>$order_id));
            break;
           
           default:
             # code...
             break;
         }
   }

}



/**
 * 判断某笔订单是否已经支付成功了
 * @return boolean [description]
 */
public function isOrderPayed()
{

    $result=array('code'=>'fail');
    $order_id=I('post.order_id');
    if(!$order_id)
       $result['code']='stop';
    if(D('Order')->isOrderPayed($order_id))
       $result['code']='suc';

    $this->ajaxReturn($result);
}








}#类尾巴