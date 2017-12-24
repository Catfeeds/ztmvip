<?php
namespace Mobile\Controller;
use   Think\Controller;

class QuickController extends BaseController{




  /**
   * 快速购买订单检测
   * @return [type] [description]
   */
   public function checkout() 
   {



   if ( !session('user_id') || !session('openid') )
   {
        session('redirect_url', __HOST__ . $_SERVER['REQUEST_URI']);
        A('Wechat')->do_oauth();  
   }

  ########获取该用户的配送地址########################################################
      $consignee = D('Region')->getConsignee();

     #检查默认收货人信息是否完整 
    
     if (!D('Region')->checkConsigneeInfo($consignee)) 
     {    
      #不完整就去添加新的地址喽

          session('redirect_url', __HOST__ . $_SERVER['REQUEST_URI']);
          $this->redirect('Region/addConsignee',array('quick'=>1));
     }else{

    
        session('default_consignee',$consignee);
        $this->assign('consignee',$consignee);
     }


#去购物车中获取订单页面确认页面要展示的商品列表##########

            $check_goods =D('Quick')->checkGoods(); 
  

            $this->assign('goods_list',$check_goods);
            if(count($check_goods['spec']))
            {
                 $this->assign('spec',D('Flow')->getCartSpec($check_goods['spec']));
            }

            #如果没有选择商品则...
            if(!$check_goods['goods_id'])
            {
                 $this->redirect('Index/index');
            }
  

#记录用户的选择是我们的荣耀

     $order = D('Quick')->flowOrderInfo($check_goods['unique']);
     $this->assign('order', $order);
     #订单费用详情总结
     $total=D('Quick')->orderFee($order,$check_goods);

     $this->assign('total',$total);

#################用户的储值卡################################
  $user_card=D('Treatment')->userCards();
  $this->assign('card_list',$user_card);

 #############在当前订单额度下可以使用的红包列表###############################
          $user_bonus = D('Treatment')->userBonus($total['goods_price']);
          if($user_bonus)
          {
             $this->assign('bonus_list',$user_bonus); 
             $this->assign('bonus_exist','1');
          }else{
             $this->assign('bonus_exist','0');

          }
         

     ######在当前订单额度下可以使用的优惠券列表
     $user_coupon = D('Treatment')->userCoupon($total['goods_price']);
     if($user_coupon)
     {
     $this->assign('coupon_list',$user_coupon);
     $this->assign('coupon_exist',1);

     }else{
         $this->assign('coupon_exist',0);
     }
    
 
     #该用户拥有的积分
     $your_integral=D('Treatment')->yourIntegral();
     $this->assign('your_integral', $your_integral); 
     #本订单最多可以使用的积分
     $order_max_integral=D('Treatment')->AvailableIntegral_quick();
     $this->assign('page_title','订单结算');
     $this->assign('order_max_integral',$order_max_integral); 
     $this->display('confirmation_quick');
}



  /**
   *
   * 结算页面改变支付方式触发的ajax请求
   * @return [type] [description]
   */
  public function changePayment()
  {
       $pay_way=I('post.pay_way');

    #不是微信支付的，看看其是否有商城的支付密码
       if($pay_way!='wx')
       {
          $back=D('Treatment')->checkPaymentPassword();
          if(!$back)
          {
               
            $result['error']='nopassword';
            $url=U('Quick/checkout');
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

#上述几个关卡通过了，才允许更换选择
    
      session('quick_order.payment_name',$pay_way);
      $result['error']=8;
      $this->ajaxReturn($result);
    

}

public function changeCard()
{
    $prepaid_id=I('post.prepaid_id');
     
    if($prepaid_id==0)
    {
        #重置为微信支付
        session('quick_order.payment_name','wx');  
        session('quick_order.prepaid_id',0);  
    }else{

      session('quick_order.prepaid_id',$prepaid_id);  
    }
   

   $result['error']=8;
   $this->ajaxReturn($result);


}

  /**
   * 改变红包
   */
  public function changeBonus() 
  {


    $bonus_id=I('post.bonus');
    //看看用户重新勾选的红包是否存在(虽然合法，最好判断是否存在)
      $bonus=D('Treatment')->bonusInfo($bonus_id);
     
     //如果存在，或者是用户取消使用红包则：
      if($bonus || $bonus_id==0)
      {

   #================order=========
         $check_goods =D('Quick')->checkGoods();
         $order =D('Quick')->flowOrderInfo($check_goods['unique']);
         $order['bonus_id'] =$bonus_id;
         $order['bonus_name']=$bonus['bonus_name'];
         //红包与优惠券不能同时使用
         if($bonus_id>0)
         {
            $order['coupon_id']=0;
            $order['coupon_name']='';
         }
  #====================================================  
        #订单费用详情总结
        $total=D('Quick')->orderFee($order,$check_goods);

         $result['error']=8;
         $result['amount']=$total['amount'];
        
         $this->ajaxReturn($result);
      }

  }

  /**
   * 正常订单改变优惠券
   */
  public function changeCoupon() 
  {


    $coupon_id=I('post.coupon');

    //看看用户重新勾选的优惠券是否存在(虽然合法，最好判断是否存在)
      $coupon=D('Treatment')->couponInfo($coupon_id);
      
     //如果存在，或者是用户取消使用优惠券则：
      if($coupon || $coupon_id==0)
      {

        #======================order =======================================
         $check_goods =D('Quick')->checkGoods();
         $order =D('Quick')->flowOrderInfo($check_goods['unique']);

         $order['coupon_id'] =$coupon_id;
         $order['coupon_name']=$coupon['coupon_name'];

         //红包与优惠券不能同时使用
         if($coupon_id>0)
         {
            $order['bonus_id']=0;
            $order['bonus_name']='';
         }
   #========================================================================
        #订单费用详情总结
        $total=D('Quick')->orderFee($order,$check_goods);

         $result['error']=8;
         $result['amount']=$total['amount']; 
         $this->ajaxReturn($result);
      }

  }


  /**
   * 改变积分
   */
  public function changeIntegral() 
  {  
    
           
              $points=I('post.points');
              //如果不是数字，则告之重新输入
              if(!is_numeric($points))
              {
                   $result['error'] ='nonum';
                   $this->ajaxReturn($result);
              }
              // 该订单允许使用的积分
              $flow_points =D('Treatment')->AvailableIntegral_quick();
              // 用户的积分总数
              $user_points = D('Treatment')->yourIntegral();


              if ($points > $user_points) 
             {

                //超过了自身的持有量
                  $result['error'] ='self';
                  $this->ajaxReturn($result);
              } elseif ($points > $flow_points) {
                 //超过了该订单允许使用的积分了
                   $result['error'] ='allow';
                   $this->ajaxReturn($result);
              } else {

           #======================order================================
                 $check_goods =D('Quick')->checkGoods();
                 $order =D('Quick')->flowOrderInfo($check_goods['unique']);
                 $order['integral'] = $points;
           #=============================================
               
                #订单费用详情总结
                $total=D('Quick')->orderFee($order,$check_goods);

                 $result['error']=8;
                 $result['amount']=$total['amount'];
                 $result['new_integarl']=$points;
               
                 $this->ajaxReturn($result);
              
                   
              }
  }
  







  /**
   * 订单处理之前需要做的一些勾当
   * 如显示不同的弹层
   * @return [type] [description]
   */
  public function beforeDone()
  {

     
   #=======标志===========================
    $check_goods =D('Quick')->checkGoods();
  #=============获得渲染数据===================================
       $order = D('Quick')->flowOrderInfo($check_goods['unique']);
       $total=D('Quick')->orderFee($order,$check_goods);
  ########################

       if($order['payment_name']=='wx')
       {
      
            $this->assign('pay_name','微信支付');
            $this->assign('total',$total);
            $this->assign('flag_buy','quick');
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
   *  商城内部支付的订单处理
 */

  public function done() 
  {


      #==========判断商城密码的正确性================
      #如果已经输入出错超过3次了，则我们压根不给她再输入了
        if(session('password_error') && session('password_error')>3)
        {
            $url=U('Quick/checkout');
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
             $url=U('Quick/checkout');
             $result['url']=base64_encode($url);
             $result['error']='wrong';
             $result['allow']=4-$error_count;
             $this->ajaxReturn($result);
                 
         }
################################################################################
  #当前配送地址
  $consignee = D('Region')->getConsignee();
  #==========标志=========================================
  $check_goods =D('Quick')->checkGoods(); 
  #当商品已经放到订单表的时候，则滚回去吧，自己去个人中心找吧
   if(!$check_goods['goods_id'])
  {
       $result['error_count']='nogoods';
       $this->ajaxReturn($result);
  }

#========标志
  $order = D('Quick')->flowOrderInfo($check_goods['unique']);
  #订单总体状况
  $total=D('Quick')->orderFee($order,$check_goods);

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
                  $pay_ye_result=D('Treatment')->logAccountChange($user_money,0,0,0,'quick_ye','manual');
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
     
if(!empty($pay_ye_result)|| !empty($pay_card_result))
{

   #商城内部支付，且是快速购买流程 1和1
    $orderinfo=D('Treatment')->makeOrder($consignee,$order,$total,1,1);
    if(!$orderinfo)
    {
        #生成订单失败
         $result['error']='badorder';
         $this->ajaxReturn($result);
    }

#======================这些是订单生成成功之后要做的事情=====================
    #减去使用的积分 
     if ($order['integral'] > 0) 
     {
        $integral=$order['integral'] * (- 1);
            if($order['payment_name']=='ye')
            {
               $change_desc='quick_ye';
            }else{
               $change_desc='quick_card';
            }
       D('Treatment')->logAccountChange(0, 0, 0,$integral,$change_desc,'manual');
     }

       #减去使用的红包
       if ($order['bonus_id'] > 0) 
       {
           D('Treatment')->usedBonus($order['bonus_id']);
       }
     
      #减去使用的优惠券
      if($order['coupon_id']>0)
      {
          D('Treatment')->usedCoupon($order['coupon_id']);
      }

###下面是支付成功要做的事情##################################
  #给支付成功的订单赠送积分
     if($order['payment_name']=='ye')
     {
        $change_desc='quick_ye';
     }else{
        $change_desc='quick_card';
     }
     D('Treatment')->giveIntegral($orderinfo['order_id'],$change_desc);

  #给支付成功的订单赠送红包
    D('Treatment')->giveBonus($orderinfo['order_id']);

    #打入分销标志
   D('Treatment')->affiliateFlag($orderinfo['order_id']);

 #如果是秒杀产品，则需要对应的减少库存的   
   #D('Flow')->changeGoodsStorage();
 

#==========================
 
   $result['order_id']=$orderinfo['order_id'];
   $result['payment_name']=$order['payment_name'];
   $result['error']=8;
   $this->ajaxReturn($result);

     


}#大if尾巴


}#函数尾









}#类尾