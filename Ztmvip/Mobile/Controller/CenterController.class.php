<?php

namespace Mobile\Controller;
class CenterController extends BaseController
{






/**
 * 从订单中心页面过来的二次结算
 */
   
   public function checkout($order_id)
   {
    #为防止用户多次付款，我们需要检测该订单是否已经是支付状态了
    $true=D('Treatment')->isOrderPayed($order_id);

    if($true)
    {
         $this->redirect('User/order',array('state'=>'payed'));
    }
       #地址
       $consignee = D('Center')->getConsignee($order_id);
       $this->assign('consignee',$consignee);


       #记录用户的选择是我们的荣耀 
       #(这里的标识就使用$order_id就得了)
      $order = D('Center')->flowOrderInfo($order_id);
      $this->assign('order', $order);


       #去order_goods表中获取订单页面确认页面要展示的商品列表##########
        $check_goods =D('Center')->checkGoods($order_id);
        $this->assign('goods_list',$check_goods);
      #订单额度信息
      $total=D('Center')->orderFee($order_id);

      $this->assign('total',$total);

      
      #################用户的储值卡################################
        $user_card=D('Treatment')->userCards();
        $this->assign('card_list',$user_card);


       #获取使用红包的名字
            $bonus_info = D('Treatment')->bonusInfo($order['bonus_id']);
           if($bonus_info['bonus_name'])
           {
            $this->assign('bonus_name',$bonus_info['bonus_name']);
          
           }
       #获取使用优惠券的名字
        $coupon_info= D('Treatment')->couponInfo($order['coupon_id']);
        if($coupon_info['coupon_name'])
        {
          $this->assign('coupon_name',$coupon_info['coupon_name']);
          
        }

       $this->assign('order_id',$order_id);
       $this->assign('page_title','订单中心');
       $this->display('confirmation_center');

   }




   /**
    *
    * 订单中心改变支付方式触发的ajax请求
    * @return [type] [description]
    */
   public function changePayment()
   {
         
        $pay_way=I('post.pay_way');
        $order_id=I('post.order_id');

          #不是微信支付的，看看其是否有商城的支付密码
             if($pay_way!='wx')
             {
                $back=D('Treatment')->checkPaymentPassword();
                if(!$back)
                {
                     
                  $result['error']='nopassword';
                  $url=U('Center/checkout',array('order_id'=>$order_id));
                  $result['url']=base64_encode($url);
                  $this->ajaxReturn($result);
                }
             }


    #========对余额支付的,如果余额为0则不允许选择=====================
      if($pay_way=='ye')
      {
         $user_money=D('Treatment')->userMoney();
         if(!$user_money)
         {
             $result['error']='nomoney';
             $this->ajaxReturn($result);
         } 
      }
        

    
    #=======对储值卡支付的，如果没有储值卡，则不允许选择
    if($pay_way=='card')
    {
       $user_card=D('Treatment')->userCards();
       if(!$user_card)
       {

         $result['error']='nocard';
         $this->ajaxReturn($result); 
       }

    }

  

   #########上述两个关卡通过之后，就可以选择余额支付了
           session('center_order.payment_name',$pay_way);
           session('center_order.unique',$order_id);#唯一标识
           $result['error']=8;
           $this->ajaxReturn($result);
}

public function changeCard()
{
    $prepaid_id=I('post.prepaid_id');
    $order_id=I('post.order_id');
    if($prepaid_id==0)
    {
        #重置为微信支付
        session('center_order.payment_name','wx');  
        session('center_order.prepaid_id',0);  
    }else{

        session('center_order.prepaid_id',$prepaid_id);  
    }
   

   $result['error']=8;
   $this->ajaxReturn($result);


}


   /**
    * 订单处理之前需要做的一些勾当
    * 如显示不同的弹层
    * @return [type] [description]
    */
   public function beforeDone()
   {

    #=============标志====================================
        $order_id=I('post.order_id');
    #===================获得渲染的数据===========================
        $order=D('Center')->flowOrderInfo($order_id);
        $total=D('Center')->orderFee($order_id);
    #==================================================================

        if($order['payment_name']=='wx')
        {
          

             $this->assign('pay_name','微信安全支付');
             $this->assign('total',$total);
             $this->assign('flag_buy','center');
             $this->assign('order_id',$order_id);
             #是微信就抓取这个模板即可
             $content=$this->fetch('Public/order_total_wx');
             $result['content']=$content;
             $result['error']=8;
             $this->ajaxReturn($result);

           
        }else{
           if($order['payment_name']=='ye')
           {
                 $this->assign('pay_name','余额支付');
           }else{
                $this->assign('pay_name','储值卡支付');
           }
           $this->assign('total',$total);
           $content=$this->fetch('Public/order_total');
           $result['content']=$content;
           $result['error']=8;
           $this->ajaxReturn($result);
        }
      
   }

       /**
        *  订单的处理，产生订单号等
        */

   public function done() 
   {

      
    $order_id=I('post.order_id');
    #为防止用户多次付款，我们需要检测该订单是否已经是支付状态了

    $true=D('Treatment')->isOrderPayed($order_id);

    if($true)
    {
         $this->redirect('User/order',array('state'=>'payed'));
    }

   



    #==========判断商城密码的正确性================
    #如果已经输入出错超过3次了，则我们压根不给她再输入了
    $password=I('post.payment_password');
      if(session('password_error') && session('password_error')>3)
      {
          $url=U('Center/checkout',array('order_id'=>$order_id));
          $result['url']=base64_encode($url);
          $result['error']='stop';
          $this->ajaxReturn($result);
      }

      #========================
       $password=I('post.payment_password');
       $true=D('Treatment')->checkPasswordTrue($password);

       if(!$true)
       {   
           $error_count=session('password_error');
           $url=U('Center/checkout',array('order_id'=>$order_id));
           $result['url']=base64_encode($url);
           $result['error']='wrong';
           $result['allow']=4-$error_count;
           $this->ajaxReturn($result);
               
       }
 
#===========================================================

   $order = D('Center')->flowOrderInfo($order_id);
   #订单总体状况
   $total=D('Center')->orderFee($order_id);
 
#=========================余额支付====================================
       if($order['payment_name']=='ye')
       {
                   $user_money=D('Treatment')->userMoney();
                   if($user_money<$total['amount'])
                   {
                       #余额不足
                       $result['error']='ye_little';
                       $this->ajaxReturn($result);
                   }else{
                      
                           $user_money=$total['amount']*(-1);      
               $pay_ye_result=D('Treatment')->logAccountChange($user_money,0,0,0,'center_ye','manual');


                   }
       }
      
 ####################################储值卡支付###############################################

    if($order['payment_name']=='card')
    {
         #判断用户选择的这个卡的余额是否足以支付应付款
         if($order['prepaid_id'])
         {
             $prepaid_money=D('Treatment')->getCardMoney($order['prepaid_id']);
             if($prepaid_money<$total['amount'])
             {
                  #储值卡余额不足
                  $result['error']='card_little';
                  $this->ajaxReturn($result);
                  
             }else{
             
                 $pay_card_result=D('Treatment')->usedCardMoney($order['prepaid_id'],$total['amount']);

             }
           
         }

    }

 
 ########################################################################

      if(!empty($pay_ye_result)||!empty($pay_card_result))
      { 
          
          #将订单设置成已经支付
          
          D('Treatment')->orderPayed($order_id,$total['amount'],$order['payment_name']);
         

            #给支付成功的订单赠送积分
               if($order['payment_name']=='ye')
               {
                  $change_desc='center_ye';
               }else{
                  $change_desc='center_card';
               }
               D('Treatment')->giveIntegral($order_id,$change_desc);

            #给支付成功的订单赠送红包
              D('Treatment')->giveBonus($order_id);

              #打入分销标志
             D('Treatment')->affiliateFlag($order_id);

           #如果是秒杀产品，则需要对应的减少库存的   
             #D('Flow')->changeGoodsStorage();
           

          #==========================
           
             $result['order_id']=$order_id;
             $result['error']=8;
             $result['payment_name']=$order['payment_name'];
             $this->ajaxReturn($result);

               
 


      }
}#函数尾










}#类的尾巴