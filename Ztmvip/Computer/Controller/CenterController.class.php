<?php

namespace Computer\Controller;
class CenterController extends BaseController
{

/**
 * 从订单中心页面过来的二次结算
 */
   
   public function  choose($order_id)
   {
    //是否已经支付过了
    if(D('Order')->isOrderPayed($order_id))
         $this->redirect('User/order',array('state'=>'payed'));
 
    // 订单额度信息
    $order_detail=D('Order')->orderDetail($order_id);
    $this->assign('order_detail',$order_detail);

    //扫描支付
    $nwxpay = new \Common\Vendor\Nwxpay();
    $url=base64_encode($nwxpay->native_one_url($order_detail['order_sn'].'O'.$order_id));
    $this->assign('url',$url);

  //储值卡支付
    
    $user_card=D('User')->userCards();
    $this->assign('card_list',$user_card);
    if($user_card)
       $this->assign('exist_card',1);
 
    $this->assign('page_title','订单支付选择');
    $this->assign('order_id',$order_id);
    $this->display();

  }




/**
 * 内部支付
 */

 public function innerPay() 
{

      $order_id=I('post.order_id');
      // $order_id='20475';
      $password=I('post.password');
      // $password='147258';
      $way=I('post.way');

      if($way=='card')
        $card_id=I('post.card_id');
      // $way='banner';
      $result=array('code'=>'suc','order_id'=>$order_id);
      try{
          
         if(!$order_id || !$password  || !$way)
           E('stop');

         if($way=='card' && !$card_id)
          E('stop');
           
        if(!D('User')->checkPasswordTrue($password))
          E('password');

        $order_detail=D('Order')->orderDetail($order_id);
   
        if(D('order')->isOrderPayed($order_id))
           E('payed');

        if($way=='balance'){
            $user_money=D('User')->real_money($order_detail['user_id']);
            if($user_money<$order_detail['amount']) 
                E('b_enough');
            $user_money=array(
                    'change_desc'=>'balance',
                    'change_type'=>'manual',
                    'user_money'=>(-1) * $order_detail['amount'],
                );
            if(!D('User')->logUserMoney($user_money,$order_detail['user_id']))
              E('fail');
          }else{
                  $prepaid_money=D('User')->getCardMoney($card_id);
                  if($prepaid_money<$order_detail['amount']){
                       E('c_enough');
                  }else{
                      if(!D('User')->usedCardMoney($card_id,$order_detail['amount']))
                        E('fail');
                    }
             }
               //设置支付状态为已经支付
                D('Order')->orderPayed($order_id,$order_detail['amount'],$way);
               //赠送积分
               D('Order')->giveIntegral($order_id,'innerpay');
               //赠送红包
               D('Order')->giveBonus($order_id);
               //打入分销标志
               D('Order')->affiliateFlag($order_id);
      }catch(\Think\Exception $e){

         $error=$e->getMessage();
  
         switch ($error) {
           case 'stop':
              $result['code']='stop';
             break;
           case 'password':
              $result['code']='password';
             break;
           case 'b_enough':
              $result['code']='b_enough';
              break;
           case 'c_enough':
              $result['code']='c_enough';
              break;
           case 'fail':
            $result['code']='fail';
            break;
           case 'payed':
            $result['code']='payed';
            break;
           default:
             $result['code']='grammar';
             break;
         }
      }
     
     $this->ajaxReturn($result);
        

  }#函数尾














}#类的尾巴