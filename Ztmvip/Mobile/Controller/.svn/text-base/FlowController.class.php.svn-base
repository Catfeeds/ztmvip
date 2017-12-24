<?php
namespace Mobile\Controller;
use   Think\Controller;

class FlowController extends BaseController{


const HEALTH=2325;


/**
 * 购物车
 * @return [type] [description]
 */
  public function cart()
  {
               #取得购物车商品列表，计算合计(
                $cart_goods = D('Flow')->getCartGoods();
                $this->assign('cart_list', $cart_goods ['cart_list']);
                $this->assign('total', $cart_goods ['total']);

              #判断是否是全选
              $all=D('Flow')->isAllSelected();
              if($all)
              {
                  $this->assign('all_flag',1);
              }
        $this->assign('page_title','女性整体美解决方案领导者');


        if(I('get.another'))
        {
            $this->display('shopping_carttwo');
        }else{
            $this->display('shopping_cart');
        }

  }

/**
 * 删除购物车商品
 * @return [type] [description]
 */
public function dropCartGoods()
{
  

    $cart_id=I('post.cart_id');
    $where['id']=$cart_id;
    $res=M('cart')->where($where)->delete();
   
    if($res)
    {
           $cart_goods = D('Flow')->getCartGoods();

           $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
           $count=D('Flow')->cartBuyNumber();
           $result['count']=$count? $count :0;
           $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;
           $result['error']=8;
           $this->ajaxReturn($result);
    }


}
   


/**
 * 清空购物车
 * @return [type] [description]
 */
public function clearCart()
{
  
   $res=D('Flow')-> clearCart();
   
    if($res)
    {
        $cart_goods = D('Flow')->getCartGoods();
        $this->assign('goods_list', $cart_goods ['goods_list']);
        $this->assign('total', $cart_goods ['total']);
        $content=$this->fetch('Public/cart_list');
        if($content)
        {  
           $result['error']=8;
           $result['content']=$content;
           $this->ajaxReturn($result);
        }


    }


}



/**
 * 富含属性价格的商品
 * @return [type] [description]
 */
public function price()
{

    // {"spec":["0_1_重量_60kg","1_0_肤色_黑色"],"number":"1","goods_id":1880}
    

     $goods=json_decode($_POST['goods'],true);
     $goods_id=$goods['goods_id'];

     if(!empty($goods['spec']))
     {
        $spec=$goods['spec'];
     }else{
         $spec='';
     }


     $final_price=D('Goods')->getFinalPrice($goods_id,$spec);

     $result['error']=8;
     $result['final_price']=$final_price;
  $this->ajaxReturn($result);

 

}

/**
 * 添加购物车(快速与非快速公用一个)
 */
public function addToCart() 
{
       $goods=json_decode($_POST['goods'],true);

       $goods_id=$goods['goods_id'];
       $number=$goods['number'];
       if(!$goods_id || !$number)
       {
          die('stop');
       }

       #判断是否有属性
       if(!empty($goods['spec']))
       {
             $spec=$goods['spec'];
       }else{
          $spec=array();
       }
      
####################购买该商品数量是否有限制########################################################
 /*      
        #秒杀是有库存量限制的，正常商品没有库存量限制的   
          $where=array(
              'goods_id'=>$goods_id,
              'on_sale'=>'Y',
              'disabled'=>'N',
              'kill_start'=>array('LT',time()),
              'kill_end'=>array('GT',time()),
           );
       $record=M('seckill_goods')->field('id,goods_number')->where($where)->find();


       #如果当前商品是秒杀商品则判断购买量是否超过秒杀量
         if($record['id'])
         {
           #库存量
          $storage_number=$record['goods_number'];

        #================解决冲突========================================
              if(!empty($goods['quick']))
              {
                    $final_number=$number;
                    #购买量太多了
                    if ( $storage_number < $final_number) 
                    {
                        $result['error'] =4;
                        $result['allow_number']=$storage_number;
                       $this->ajaxReturn($result);
                    }
              }else{

                   
                   #购物车中已经添加的该商品的数量(当前客户端)
                       $cart_number = D('Flow')->cartGoodsNumber($goods_id);  
                      $final_number=$number+$cart_number;
   
                           if ( $storage_number < $final_number) 
                           {
                               $result['error'] =4;
                               $result['allow_number']=$storage_number-$cart_number;
                              $this->ajaxReturn($result);
                           }
              }


         }
  
*/
    ###################解决冲突#########################################################

       if(!empty($goods['quick']))
       {
            $quick_cart=array(
                  'goods_id'=>$goods_id,
                  'number'=>$number,
                  'spec'=>$spec,
              );
            session('quick_cart',json_encode($quick_cart));
            $result['error'] =8;
            $this->ajaxReturn($result);
       }else{

           #更新：添加到购物车
           $res=D('Flow')->addCart($goods_id, $number, $spec);
           if($res)
           {
                     
                $result['count']=D('Flow')->cartBuyNumber();#更新购物车中的数量
                $result['error'] =8;
                $this->ajaxReturn($result);
           }

       }
  


}








/**
 * 购物车列表页面 + —等 来改变商品购买数量触发的ajax请求
 * 刷新购物车列表
 * @return [type] [description]
 */
public function ajaxUpdateCart()
{
    
          $cart_id=I('post.cart_id');
          $final_number=I('post.goods_number');
         
   ####################检查正常商品中的秒杀产品的数量是否有效########################################################
         $where['id']=$cart_id;
         $res=M()->table('ztm_cart')->where($where)->field('buy_flag,goods_id')->find();
         if($res['flag_buy']!='package')
         {
              #秒杀是有库存量限制的，正常商品没有库存量限制的   
                $where=array(
                    'goods_id'=>$res['goods_id'],
                    'on_sale'=>'Y',
                    'disabled'=>'N',
                    'kill_start'=>array('LT',time()),
                    'kill_end'=>array('GT',time()),
                 );
             $count=M()->table('ztm_seckill_goods')->where($where)->count();

             #如果当前商品是秒杀商品则判断购买量是否超过秒杀量
             

               if($count)
               {

                $goods_number=M()->table('ztm_seckill_goods')->field('goods_number')->where($where)->find();
                $goods_number=$goods_number['goods_number'];

                         #如果该商品的库存量小于购买量
                         if ( $goods_number < $final_number) 
                         {

                           $result['error'] = 1;
                           $result['allow_number']=$goods_number;
                           $this->ajaxReturn($result);
                         }

               }

         }


     
        

        #更新当前的记录
        $where['id']=$cart_id;
        $data['goods_number']=$final_number;
        $yes=M()->table('ztm_cart')->where($where)->save($data); 
        if($yes)  
        {
             
 
             #获得当前客户端购物车中的商品
             $cart_goods=D('Flow')->getCartGoods();
             $result['error']=8;
             $result['goods_price']=$cart_goods['total']['goods_price'];
             $result['go_number']=$cart_goods['total']['go_number'];
             $result['count']=D('Flow')->cartBuyNumber();
             $this->ajaxReturn($result);

        }


}

/**
 *  购物车列表页面触发的勾选状况
 * @return [type] [description]
 */
public function changeSelected()
{
      $cart_id=I('post.cart_id');

      $where=array(
          'id'=>$cart_id,
          'selected'=>'Y',
        );
      $count=M('cart')->where($where)->count();
      #Y存在则改成N
      if($count>0)
      {
         $condition['id']=$cart_id;
         $data['selected']='N';
        M('cart')->where($condition)->save($data);
      }else{

          $condition['id']=$cart_id;
          $data['selected']='Y';
          M('cart')->where($condition)->save($data);
      }

      $cart_goods=D('Flow')->getCartGoods();
      $result['error']=8;
      $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
      $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;#勾选去支付的个数
      #加一个此时是不是全选
      $result['all_selected']=D('Flow')->isAllSelected();
      $this->ajaxReturn($result);

}

/**
 * 购物策划
 * @return [type] [description]
 */
public function selectAll()
{
     $true=D('Flow')->isAllSelected();
     $where=array('quick'=>'N');
    if(session('user_id')){
      $where['user_id']=session('user_id');
    }else{
      $where['cart_key']=CART_KEY;
    }
    
     if($true) {
        $data['selected']='N';
        M('cart')->where($where)->save($data);
        $result['code']='none';   
     }else{
          $data['selected']='Y';
          M('cart')->where($where)->save($data);
          $result['code']='all';    
     }

     $cart_goods=D('Flow')->getCartGoods();
     $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
     $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;#
     $this->ajaxReturn($result);



}


/**
 * 订单检测
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
        $this->redirect('Region/addConsignee');
   }else{

  
      session('default_consignee',$consignee);
      $this->assign('consignee',$consignee);
   }

#去购物车中获取订单页面确认页面要展示的商品列表##########

       $check_goods =D('Flow')->checkGoods(); 
       $this->assign('goods_list',$check_goods);
       #如果没有选择商品则...
       if(!$check_goods[0])
       {
            $this->redirect('Flow/cart');
       }

$unique=D('Flow')->getFlowUnique($check_goods);
$order = D('Flow')->flowOrderInfo($unique);

$this->assign('order', $order);
#订单费用详情总结
$total=D('Flow')->orderFee($order,$check_goods);
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

      ######在当前订单额度下可以使用的优惠券列表
      $user_coupon = D('Treatment')->userCoupon($total['goods_price']);
      if($user_coupon)
      {
      $this->assign('coupon_list',$user_coupon);
      $this->assign('coupon_exist',1);

      }else{
          $this->assign('coupon_exist',0);

        }
      
##############积分##################################
#该用户拥有的积分(这里最好通过log表计算获取出来)
$your_integral=D('Treatment')->yourIntegral();
$this->assign('your_integral', $your_integral); 
#本订单最多可以使用的积分量
$order_max_integral=D('Treatment')->AvailableIntegral();
$this->assign('order_max_integral',$order_max_integral);



$this->assign('page_title','订单结算');
$this->display('confirmation');


}



/**
 * 正常订单改变红包
 */
public function changeBonus() 
{


  $bonus_id=I('post.bonus');
  //看看用户重新勾选的红包是否存在(虽然合法，最好判断是否存在)
    $bonus=D('Treatment')->bonusInfo($bonus_id);
   
   //如果存在，或者是用户取消使用红包则：
    if($bonus || $bonus_id==0)
    {
      #==========标志=================================
       $check_goods =D('Flow')->checkGoods();
       $unique=D('Flow')->getFlowUnique($check_goods);
      #===================================================
       $order =D('Flow')->flowOrderInfo($unique);
       $order['bonus_id'] =$bonus_id;
       $order['bonus_name']=$bonus['bonus_name'];
       //红包与优惠券不能同时使用
       if($bonus_id>0)
       {
          $order['coupon_id']=0;
          $order['coupon_name']='';
       }
      
      #订单费用详情总结
      $total=D('Flow')->orderFee($order,$check_goods);

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
       #===============标志==============================
        $check_goods =D('Flow')->checkGoods();
         $unique=D('Flow')->getFlowUnique($check_goods);
  
        #================================================
       $order =D('Flow')->flowOrderInfo($unique);

       $order['coupon_id'] =$coupon_id;
       $order['coupon_name']=$coupon['coupon_name'];
       //红包与优惠券不能同时使用
       if($coupon_id>0)
       {
          $order['bonus_id']=0;
          $order['bonus_name']='';
       }
 
      #订单费用详情总结
      $total=D('Flow')->orderFee($order,$check_goods);

       $result['error']=8;
       $result['amount']=$total['amount'];

   
      
       $this->ajaxReturn($result);
    }

}

/**
 * 正常购买改变积分
 */
public function changeIntegral() 
{  
  
         
            $points=I('post.points');
            //如果不是数字，则告之重新输入
            if(!is_numeric($points))
            {
                 $result['error'] =4;
                 $this->ajaxReturn($result);
            }
            // 该订单允许使用的积分
            $flow_points =D('Treatment')->AvailableIntegral();
            // 用户的积分总数
            $user_points = D('Treatment')->yourIntegral();


            if ($points > $user_points) 
           {

              //超过了自身的持有量
                $result['error'] =1;
                $this->ajaxReturn($result);
            } elseif ($points > $flow_points) {
               //超过了该订单允许使用的积分了
                 $result['error'] =2;
                 $this->ajaxReturn($result);
            } else {

              $check_goods =D('Flow')->checkGoods();
              $unique=D('Flow')->getFlowUnique($check_goods);
             
               $order =D('Flow')->flowOrderInfo($unique);
               $order['integral'] = $points;
             
              #订单费用详情总结
              $total=D('Flow')->orderFee($order,$check_goods);

               $result['error']=8;
               $result['amount']=$total['amount'];
               $result['new_integarl']=$points;
             
               $this->ajaxReturn($result);
            
                 
            }
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
            $url=U('Flow/checkout');
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
    

      session('flow_order.payment_name',$pay_way);
      $result['error']=8;
      $this->ajaxReturn($result);
    

}

/**
 * 对储值卡的选择进行响应
 * @return [type] [description]
 */
public function changeCard()
{
    $prepaid_id=I('post.prepaid_id');
    if($prepaid_id==0)
    {
        #重置为微信支付
        session('flow_order.payment_name','wx');  
        session('flow_order.prepaid_id',0);  
    }else{

      session('flow_order.prepaid_id',$prepaid_id);  
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

  #===============标志=================================
       $check_goods =D('Flow')->checkGoods(); 
       $unique=D('Flow')->getFlowUnique($check_goods);
    
  #================================================
#=============获得渲染数据===================================
     $order = D('Flow')->flowOrderInfo($unique);
     $total=D('Flow')->orderFee($order,$check_goods);
########################

     if($order['payment_name']=='wx')
     {
    
          $this->assign('pay_name','微信支付');
          $this->assign('total',$total);
          $this->assign('flag_buy','cart');
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
 *  余额支付或者是储值卡支付的订单处理
 */

public function done() 
{



  #==========判断商城密码的正确性================
  #如果已经输入出错超过3次了，则我们压根不给她再输入了
    if(session('password_error') && session('password_error')>3)
    {
        $url=U('Flow/checkout');
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
         $url=U('Flow/checkout');
         $result['url']=base64_encode($url);
         $result['error']='wrong';
         $result['allow']=4-$error_count;
         $this->ajaxReturn($result);
             
     }


################################################################################
#当前配送地址
$consignee = D('Region')->getConsignee();

#当前的商品购买
#=============标志=========================
$check_goods =D('Flow')->checkGoods(); 
#如果没有选择商品则...
      if(!$check_goods[0])
      {
           $this->redirect('Flow/cart');
      }

$unique=D('Flow')->getFlowUnique($check_goods);
#======================================
       
#当前的用户抉择
$order = D('Flow')->flowOrderInfo($unique);
#订单总体状况
$total=D('Flow')->orderFee($order,$check_goods);


#====================余额支付=========================================
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
            $pay_ye_result=D('Treatment')->logAccountChange($user_money,0,0,0,'cart_ye','manual');



                }
    }
   
#========================储值卡支付====================================

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
     
#========================================================================

#余额或者储值卡支付成功了我们才生成订单
if(!empty($pay_ye_result)|| !empty($pay_card_result))
{
    #商城内部支付非快速购买流程
     $orderinfo=D('Treatment')->makeOrder($consignee,$order,$total,1,0);
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
            $change_desc='cart_ye';
         }else{
            $change_desc='cart_card';
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
      if($order['payment_name']=='ye')
      {
         $change_desc='cart_ye';
      }else{
         $change_desc='cart_card';
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

  
}#大的if尾巴


}



#############################################微信的天下##############################################################################
/**
 * 微信支付订单处理
 * @return [type] [description]
 */
public function wxDone() 
{

      $true=is_wechat_browser();
      if($true)
      {
          #当前配送地址
          $consignee = D('Region')->getConsignee();

          #当前的商品购买
          #=============标志=========================
          $check_goods =D('Flow')->checkGoods(); 
          #如果没有选择商品则...
                if(!$check_goods[0])
                {
                     $this->redirect('Flow/cart');
                     exit;
                }

          $unique=D('Flow')->getFlowUnique($check_goods);

         #=====================================================
          #当前的用户抉择
          $order = D('Flow')->flowOrderInfo($unique);
          #订单总体状况
          $total=D('Flow')->orderFee($order,$check_goods);




        #先生成订单吧
        $orderinfo=D('Treatment')->makeOrder($consignee,$order,$total);


        if(!$orderinfo)
        {
            #生成订单失败
             $this->redirect('Flow/checkout');
             exit;
        }


        #上述订单生成成功之后要做的事情

        #减去使用的积分 
         if ($order['integral'] > 0) 
         {
            $change_desc='cart_wx';
            $change_type='manual';
            $integral=$order['integral'] * (- 1);
            D('Treatment')->logAccountChange(0, 0, 0,$integral,$change_desc,$change_type);
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


   
#发送生成订单提醒
          $title='订单提醒';
          $description="订单号为".$orderinfo['order_id']."的订单已成功生成，感谢您对整体美商城的支持";
          $url=__HOST__.U('Center/checkout',array('order_id'=>$orderinfo['order_id']));
            A('Wechat')->send_wechat_news($title,$description,$url);

          #==========================
                #获取发起微信支付的6个参数即可。
                   $need=array(
                        'order_id'=>$orderinfo['order_id'],
                        'order_sn'=>$orderinfo['order_sn'],
                        'body'=>$orderinfo['order_sn'],
                        'total_fee'=>$total['amount'],
                        'notify_url'=>__HOST__.U('Wechat/wxpayReback'),
                    );

                  $wxpay=new \Common\Vendor\Wxpay();
                  $parameters=$wxpay->get_code($need);
                  $this->assign('parameters',$parameters);
                  $this->assign('order_id',$orderinfo['order_id']);#这个order_id是传给wxpay.html的
                  $wxpay=$this->fetch('Public/wxpay');
                  echo $wxpay;
          #===================================================== 

      }else{
             $this->error('请从微信客户端进来...');

        }

}



/**
 * 
 * 快速购买流程之微信支付
 * @return [type] [description]
 */
public function quick_wxDone() 
{

 $true=is_wechat_browser();
 if($true)
 {

      #当前配送地址
      $consignee = D('Region')->getConsignee();
      #==========标志=========================================
      $check_goods =D('Quick')->checkGoods(); 

       if(!$check_goods['goods_id'])
                {
                     $this->redirect('Index/index');
                }
      #当前的用户抉择
      $order = D('Quick')->flowOrderInfo($check_goods['unique']);
      #订单总体状况
      $total=D('Quick')->orderFee($order,$check_goods);




    #微信支付喽，先生成订单吧
    #0表示微信支付
    #1表示快速购买流程
    $orderinfo=D('Treatment')->makeOrder($consignee,$order,$total,0,1);


    if(!$orderinfo)
    {
         #生成订单失败
          $this->redirect('Quick/checkout');
          exit;
    }


    #上述订单生成成功之后要做的事情

    #减去使用的积分 
     if ($order['integral'] > 0) 
     {
        $change_desc='quick_wx';
        $change_type='manual';
        $integral=$order['integral'] * (- 1);
        D('Treatment')->logAccountChange(0, 0, 0,$integral,$change_desc,$change_type);
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

     #发送生成订单提醒
               $title='订单提醒';
               $description="订单号为".$orderinfo['order_id']."的订单已成功生成，感谢您对整体美商城的支持";
               $url=__HOST__.U('Center/checkout',array('order_id'=>$orderinfo['order_id']));
                 A('Wechat')->send_wechat_news($title,$description,$url);
    #============================================================
      
            #获取发起微信支付的6个参数即可。
               $need=array(
                    'order_id'=>$orderinfo['order_id'],
                    'order_sn'=>$orderinfo['order_sn'],
                    'body'=>$orderinfo['order_sn'],
                    'total_fee'=>$total['amount'],
                    'notify_url'=>__HOST__.U('Wechat/wxpayReback'),
                );
              $wxpay=new \Common\Vendor\Wxpay();
              $parameters=$wxpay->get_code($need);
              $this->assign('parameters',$parameters);
              $this->assign('order_id',$orderinfo['order_id']);
              $wxpay=$this->fetch('Public/wxpay');
              echo $wxpay;
    #===========================================================
 }else{
      $this->error('请从微信客户端进来...');
 }


}



/**
 * 微信支付订单处理
 * @return [type] [description]
 */
public function center_wxDone($order_id) 
{

  $true=is_wechat_browser();
  if($true)
  {
       #为防止用户多次付款，我们需要检测该订单是否已经是支付状态了
       $true=D('Treatment')->isOrderPayed($order_id);
       if($true)
       {
            $this->redirect('User/order',array('state'=>'payed'));
       }
      #=====================================================
       #订单总体状况
       $total=D('Center')->orderFee($order_id);
     #=====清空用户轨迹=========================
       session('center_order',null);   
     #======================获取发起微信支付的6个参数即可。
           $order_sn=D('Treatment')->getOrderSn($order_id);
            $need=array(
                 'order_sn'=>$order_sn,
                 'order_id'=>$order_id,
                 'total_fee'=>$total['amount'],
                 'body'=>$order_sn,
                 'notify_url'=>__HOST__.U('Wechat/wxpayReback'),
            );

             $wxpay=new \Common\Vendor\Wxpay();
             $parameters=$wxpay->get_code($need);
        
             $this->assign('order_id',$order_id);
             $this->assign('parameters',$parameters);
             $wxpay=$this->fetch('Public/wxpay');
             echo $wxpay;
      
     #=========================================================

  }else{
      $this->error('请从微信客户端进来...');
  }

}


/**
 * 
 * @param  [type] $need [description]
 * @return [type]       [description]
 */
public function getSix($need,$flag='')
{
   
    $wxpay=new \Common\Vendor\Wxpay();
    $parameters=$wxpay->get_code($need);
    $this->assign('parameters',$parameters);
    $this->assign('order_id',$need['order_id']);

    if($flag=='health'){
     $wxpay=$this->fetch('Public/health_wxpay');
    }else{
       $wxpay=$this->fetch('Public/wxpay');
    }
    return  $wxpay;
}

/**
 * 健康卡支付
 * @return [type] [description]
 */
public function health_wxDone()
{

   try{
       
       if(!is_wechat_browser())
        E('browser');

           #当前配送地址
           $consignee = D('Region')->getConsignee();
          //获取特殊商品信息
           $check_goods =D('Treatment')->getSpecialGoods(self::HEALTH); 

          if(!$check_goods['shop_price'])
            E('shop_price');

       //针对特殊商品生成的特殊订单号
         $orderinfo=D('Treatment')->specialOrder(self::HEALTH,$consignee);

         if(!$orderinfo)
         {
            E('order');
         }

     $need=array(
          'order_id'=>$orderinfo['order_id'],
          'order_sn'=>$orderinfo['order_sn'],
          'body'=>$orderinfo['order_sn'],
          'total_fee'=>$check_goods['shop_price'],
          'notify_url'=>__HOST__.U('Health/wxpayReback'),
      );

     echo $this->getSix($need,'health');

   }catch(\Think\Exception $e){
        $error=$e->getMessage();
        switch ($error) {
          case 'browser':
            $this->error('请从微信客户端进来...');
            break;
          case 'shop_price':
                $this->error('商品价格有误...');
             break;
          case  'order':
             //php程序进行回滚
             $this->error('生成订单失败...');
             break;
          default:
            # code...
            break;
        }

   }
     



}






/**
 * 扫码一发起支付
 * @return [type] [description]
 */
public  function nativeReback()
{
   
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

    if(!empty($postStr))
    {
      $postdata=json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

      $order= explode('O', $postdata['product_id']);
      $order_sn=$order[0];
      $order_id=$order[1];
      $order_amount=D('Treatment')->orderAmount($order_id);
 

      $nwxpay=new \Common\Vendor\Nwxpay();
      
      $need=array(
           'order_sn'=>$order_sn,
           'order_id'=>$order_id,
           'total_fee'=>$order_amount,
           'notify_url'=>__HOST__.U('Native/wxpayReback'),
           'trade_type'=>'NATIVE',
           'body'=>'女性整体美解决方案领导者',
      );

#############################################################
      $prepay_id=$nwxpay->getPrepayId($need);


      if($prepay_id)
      {
         //输出          
           $output=array(
                'return_code'=>'SUCCESS',
                'appid'=>$nwxpay->get_appid(),
                'mch_id'=>$nwxpay->get_mch_id(),
                'nonce_str'=>$nwxpay->createNoncestr(),
                'prepay_id'=>$prepay_id,
                'result_code'=>'SUCCESS',
             );
           $output['sign']=$nwxpay->getSign($output);
            // 数组转化为xml
             $xml = "<xml>";
             foreach ($output as $key => $val) {
                 if (is_numeric($val)) {
                     $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                 } else
                     $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
             }
             $xml .= "</xml>";
             echo $xml;
             exit();
      }

}#大if尾


    

    
   


}
###########################################################################################################################################







}#类尾