<?php

#author:Sanxing
namespace Mobile\Controller;
class HealthController extends BaseController {


    const HEALTH=2325;

    public function _initialize(){
        parent::_initialize();

        $this->assign('page_title',C('WEBSITE.TITLE'));
    }


/**
 * 测试放置session
 * @return [type] [description]
 */
  public function put_session()
   {
      session('user_id',19023);
      session('openid','oHBm5jnk1nP3bAdFlkjoFytqHM8k');
   }
/**
 * 删除测试订单
 * @param  [type] $shan_order_id [description]
 * @return [type]                [description]
 * www.online.com/Health/delete_test_order/order_id/
 */
public function delete_test_order($order_id)
{

   D('Treatment')->deleteOrder($order_id);

}

/**
 *  注册页面
 * @return [type] [description]
 */
public function special_register()
{
  

  try{

   //以防用户是直接跳过来的
      if ( !session('user_id') || !session('openid') )
        E('auth');
    
    //判断是否购买了
    if(D('Health')->checkIsBuy())
    {
        $this->assign('buy_flag',1);
        //如果已经购买了，且提交过了，则获取默认的不可以更改的信息
        
         $fixed=D('Health')->noallowInfo();
      
         if($fixed)
         {
          $fixed['birthday']=date('Y-m-d',$fixed['birthday']);
          $this->assign('fixed',$fixed);
         }
        
    }



  }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
         case 'auth':
         session('redirect_url', __HOST__ . $_SERVER['REQUEST_URI']);
         A('Wechat')->do_oauth();
           break;
         
         default:
           # code...
           break;
       }
  }

  $this->display();

}

/**
 * ajax注册
 * @return [type] [description]
 */
public function do_register()
{

 
 
   $person=json_decode($_POST['person'],true);

   try{
  
     //服务器端进一步判断是否购买
     if(!D('Health')->checkIsBuy())
      E('buy');

     //检查信息是否完整
     if(!D('Health')->checkRegisterInfo($person))
      E('complete');
  
   //先判断今日是否已经添加过了
   
     if(D('Health')->isSubmited())
      E('submited');
   
   //添加每日提交的信息
   
     $back=D('Health')->updateRegister($person);
     
     if($back){
          E('success');
     }else{

         E('fail');
     }
     
    


   }catch(\Think\Exception $e){
       
        $error=$e->getMessage();


        switch ($error) {
          case 'complete':
            $result['error']='complete'; 
            break;
          case 'buy':
          $result['error']='buy';
          break;
          case 'success':
          $result['error']='success';
          break;
          case 'fail':
          $result['error']='fail';
          break;
          case 'submited':
          $result['error']='submited';
          default:
            # code...
            break;
        }
   }

   $this->ajaxReturn($result);
   


}

/**
 * 套餐banner
 * @return [type] [description]
 */
  public function special()
  {
     

      $this->assign('title','整体美健康管理');
      $this->display();
  }


/**
 * 健康套餐购买页面
 * @return [type] [description]
 */
  public function special_explain()
  {
    $this->assign('title','整体美健康管理');
    $this->display('new_special_explain');
  }



/**
 * 减肥案例分享
 * @return [type] [description]
 */
  public function special_share()
  {
      $this->assign('title','整体美健康管理');
      $this->display();
  }

  public function special_text()
  {
      $this->assign('title','整体美健康管理');
      $this->display();
  }








  /**
   * 健康卡订单确认结算页面
   * @return [type] [description]
   */
  public  function checkout()
  {
      


      try{

        if ( !session('user_id') || !session('openid') )
          E('auth');
        
        
       $consignee = D('Region')->getConsignee();  



       if (!D('Region')->checkConsigneeInfo($consignee)) 
       E('address');   


      $this->assign('consignee',$consignee);

      $back=D('Treatment')->getSpecialGoods(self::HEALTH);
      $this->assign('amount',$back['shop_price']);
      $this->display("confirmation");
    

      }catch(\Think\Exception $e){
              $error=$e->getMessage();
             

              switch ($error) {

                case 'auth':
                session('redirect_url', __HOST__ . $_SERVER['REQUEST_URI']);
                A('Wechat')->do_oauth();  
                break;
                case 'address':
                $this->redirect('Region/addConsignee',array('quick'=>'health')); 
                break;
                default:
                  # code...
                  break;
              }


      }

    


  }




  #健康方案支付成功回调地址
  public function wxpayReback() {
          $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

          // file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/health.txt',$postStr);

       try{
             
              if(empty($postStr))
              E('empty');


              $postdata=json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);



              $wxsign = $postdata['sign'];
              unset($postdata['sign']);

              $nwxpay=new \Common\Vendor\Nwxpay();
              $sign=$nwxpay->getSign($postdata);


              if($wxsign!=$sign)
                E('sign');
              if($postdata['result_code']!='SUCCESS')
                E('result_code');
              
              $out_trade_no = explode('O', $postdata['out_trade_no']);
           

              $order_id=$out_trade_no[1];
              $amount=$postdata['total_fee']/100;
              $transaction_id=$postdata['transaction_id'];
         
              if(D('Treatment')->isOrderPayed($order_id))
                E('payed');
 

              $order_amount=D('Treatment')->orderAmount($order_id);


              #判断付款的额度是否与应付额度相等
              if($order_amount!=$amount)
                 E('amount');
       
              #修改订单状态为已经支付
              $true=D('Treatment')->wxorderPayed($order_id,$amount,$transaction_id);

     
              //添加小屋注册信息
              D('Health')->informal_register($order_id);

              #赠送健康储值卡150
              D('Treatment')->giveCard($order_id);

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

  // file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/echo.txt',$xml);

  echo $xml;
  exit();


  }





  /**
   * 可用来共同检测订单是否已经被设置成支付成功状态了
   * @param  [type] $order_id [description]
   * @return [type]           [description]
   */
  public function checkPay()
  {


        $order_id=I('get.order_id');
        $status=I('get.status');

        if($status)
        {
           $pay=D('Treatment')->displayOrder($order_id);
           $this->assign('pay',$pay);
           $this->display('pay_success');
        }else{

   
         //此特殊商品只要支付失败就清空订单
           D('Treatment')->deleteOrder($order_id);
           $this->display('pay_failure');
        }

  

  }

    public function fatTest(){
        $this->display();
    }
}#类尾