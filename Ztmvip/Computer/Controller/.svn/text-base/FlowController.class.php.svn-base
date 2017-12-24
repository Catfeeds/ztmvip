<?php
namespace Computer\Controller;
use   Think\Controller;

class FlowController extends BaseController{


  /**
   * 添加购物车(快速与非快速公用一个)
   */
  public function addToCart() 
  {      
        
         $goods=json_decode($_POST['goods'],true);
         

         $spec=array();
         foreach ($goods as $key => $value) {
              if(substr($key,0,4)=='spec')
                 $spec[]=$value;
         }

     try{
         if($goods['quick']=='Y' && !session('user_id'))
           E('login');

         if(!$goods['number'] || !$goods['goods_id'])
            E('stop');
          if($goods['quick']=='Y') {
              if(!D('Cart')->addCart($goods['goods_id'],$goods['number'],$spec,'Y'))
                 E('wrong');
          }else{
              if(!D('Cart')->addCart($goods['goods_id'], $goods['number'], $spec))
                 E('wrong');
              $result['count']=D('Cart')->cartBuyNumber();
          }
           
           $result['code'] ='suc';
     }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error) {
           case 'stop':
               $result['code']='stop';
             break;
           case 'wrong':
              $result['code']='wrong';
              break;
           case 'login':
             $result['code']='login';
             session('redirect_url',base64_encode(U('Goods/detail',array('goods_id'=>$goods['goods_id']))));
               break;
           default:
              $result['code']='grammar';
             break;
         }
     }
     
     $this->ajaxReturn($result);
  }


/**
 * 最终单价(属性价格在内)
 * @return [type] [description]
 */
public function getFinalPrice()
{

   $goods=json_decode($_POST['goods'],true);
   $spec=array();
   foreach ($goods as $key => $value) {
        if(substr($key,0,4)=='spec')
           $spec[]=$value;
   }

  try{

    if(!$goods['goods_id'])
      E('stop');

     $final_price=D('Goods')->getFinalPrice($goods['goods_id'],$spec);
     if(!$final_price)
       E('fail');

     $result['code']='suc';
     $result['final_price']=$final_price;
  
  }catch(\Think\Exception $e)
  {
     $error=$e->getMessage();
     if($error=='stop'){
       $result['code']='stop';
     }else if($error=='fail'){
        $result['code']='fail';
     }


  }

   
   $this->ajaxReturn($result);
}


/**
 * 是否允许提交
 * @return boolean [description]
 */
public function isAllowCheckout()
{

     $result['code']='suc';
     try{
       $cart_goods = D('Cart')->getCartList();
      if(!$cart_goods['total']['go_number'])
          E('select');
      if(!session('user_id'))
         E('login');

     }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error) {
           case 'select':
              $result['code']='select';
             break;
           case 'login':
              $result['code']='login';
              session('redirect_url', base64_encode(U('Flow/cart')));
             break;
         }
     }
    
    $this->ajaxReturn($result);

}

  /**
   * 订单检测
   * @return [type] [description]
   */
   public function checkout() 
   {
        
    try{
       //流程标志
       $quick=I('quick')?I('quick'):'N';
       //登录否   
          if (!session('user_id'))
             E('login');
         
         //地址列表
         $consignee_list = D('UserAddress')->getConsigneeList();

         $this->assign('consignee_list',$consignee_list);
         //获取用户使用的地址列表 
         $consignee=D('UserAddress')->getConsignee();
         session('choose_address_id',$consignee['address_id']);

         $this->assign('consignee',$consignee);
         //商品展示
         $cart_goods =D('Cart')->getCartList($quick); 
         if(!$cart_goods['total']['go_number'])
             E('stop');

         $this->assign('goods_list',$cart_goods['cart_list']);
         $this->assign('go_number',$cart_goods['total']['go_number']);

         //可用红包列表
          $user_bonus = D('UserBonus')->userBonus($cart_goods['total']['goods_price']);
          $this->assign('bonus_list',$user_bonus); 
          if($user_bonus) 
             $this->assign('bonus_exist',1);
         //可用优惠券列表
         $user_coupon = D('UserCoupon')->userCoupon($cart_goods['total']['goods_price']);
         $this->assign('coupon_list',$user_coupon);
         if($user_coupon)
          $this->assign('coupon_exist',1);
 

         //积分
         $this->assign('your_integral',D('User')->yourIntegral()); 
         $this->assign('allow_integral',D('User')->allowIntegral());
 
        //选择
         $order = $this->flowOrderInfo($cart_goods['total']['goods_price']);
         $this->assign('order', $order);
       //订单费用详情总结
       $total=D('Order')->orderFee($order,$cart_goods['cart_list']);
       $this->assign('total',$total);

    }catch(\Think\Exception $e){
        $error=$e->getMessage();
        switch ($error) {
          case 'login':
             session('redirect_url',base64_encode(U('Flow/checkout')));
             $this->redirect('Login/index'); 
             exit;
            break;
         case 'stop':
             $this->redirect('Cart/cart'); 
             exit;
            break;
        }
  }
      $this->assign('page_title','订单结算');
      $this->assign('quick',$quick);
      $this->assign('goods_id',$cart_goods['cart_list'][0]['goods_id']);
      $this->display();
}



/**
 * 获得用户的订单信息
 *
 * @access  private
 * @return  array
 */
function flowOrderInfo($unique)
{
    if(session('flow_order') && $unique==session('flow_order.unique'))
    {
       $order=session('flow_order');
    }else{
         $order=array(
         'bonus_id'=> 0,
         'bonus_money'=>'',
         'coupon_id'=> 0,
         'coupon_money'=>'',
         'integral' => 0,
         'unique'=>0,
      );
    }
    return $order;
}


  /**
   *  生成订单
   */

  public function makeOrder() 
  {    
        $result=array('code'=>'suc');
        $quick=I('post.quick');
     try{
      
          if(!$quick)
             E('fail');
          //配送的地址
          $consignee = D('UserAddress')->getConsignee();
          //商品展示
          $cart_goods =D('Cart')->getCartList($quick); 
          if(!$cart_goods['total']['go_number'])
              E('nogoods');
         //选择
          $order = $this->flowOrderInfo($cart_goods['total']['goods_price']);
          //订单费用详情总结
          $total=D('Order')->orderFee($order,$cart_goods['cart_list']);
          
          //先生成订单吧
           $orderinfo=D('Order')->makeOrder($consignee,$order,$total,$quick);

        

          if(isset($orderinfo['order']))
             E('order');

          if(isset($orderinfo['order_extend']))
             E('order_extend');

          if(isset($orderinfo['order_goods']))
             E('order_goods');
        
 
          $result['order_id']=$orderinfo['order_id'];

  // 上述订单生成成功之后要做的事情

        #减去使用的积分 
         if ($order['integral'] > 0){
            $integral=array(
                    'change_desc'=>'computer',
                    'change_type'=>'manual',
                    'integral'=>(-1)*$order['integral'],
                );

            D('User')->logIntegral($integral);
         }

           #减去使用的红包
           if ($order['bonus_id'] > 0) 
               D('UserBonus')->usedBonus($order['bonus_id']);
          #减去使用的优惠券
          if($order['coupon_id']>0)
              D('UserCoupon')->usedCoupon($order['coupon_id']);

     }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error) {
           case 'nogoods':
                 $result['code']='nogoods';
                break;
           case 'order':
                  $result['code']='fail';
                  break;
           case 'order_extend':
                 M('Order')->delete($orderinfo['order']);
                 $result['code']='fail';
                 break; 
           case 'order_goods':
                M('Order')->delete($orderinfo['order']);
                M('Order_extend')->delete($orderinfo['order_extend']);
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
 * 订单改变红包
 */
public function changeBonus() 
{
    $bonus_id=I('post.bonus_id');
    $quick=I('post.quick');
    $result=array('code'=>'suc');
  
    try{
      //防数据丢失
         if(!$bonus_id || !$quick)
           E('stop');
        
        //防黑客偷鸡
         $cart_goods =D('Cart')->getCartList($quick); 
         $bonus=D('UserBonus')->bonusInfo($bonus_id,$cart_goods['total']['goods_price']);
         if(!$bonus)
            E('out');

         $order = $this->flowOrderInfo($cart_goods['total']['goods_price']);
         $order['bonus_id'] =$bonus_id;
         $order['bonus_money']=$bonus['bonus_money'];
        //红包与优惠券不能同时使用
        $order['coupon_id']=0;
        $order['coupon_money']=0;

        $total=D('Order')->orderFee($order,$cart_goods['cart_list']);
        $this->assign('total',$total);
        $this->assign('go_number',$cart_goods['total']['go_number']);
        $content=$this->fetch('Public/order_total');
        $result['content']=$content;
        $result['amount']=$total['amount'];
        $result['bonus_money']=$bonus['bonus_money'];
    }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
         case 'stop':
           $result['code']='stop';
           break;
         case 'out':
           $result['code']='out';
           break;
         default:
            $result['code']='grammar';
           break;
       }
    }
    $this->ajaxReturn($result);

}



/**
 * 订单改变优惠券
 */
public function changeCoupon() 
{
    $coupon_id=I('post.coupon_id');
    $quick=I('post.quick');
     $result=array('code'=>'suc');
  
    try{
        //防数据丢失
         if(!$coupon_id || !$quick)
           E('stop');
        
        //防黑客偷鸡
         $cart_goods =D('Cart')->getCartList($quick); 
         $coupon=D('UserCoupon')->couponInfo($coupon_id,$cart_goods['total']['goods_price']);

         if(!$coupon)
            E('out');

         $order = $this->flowOrderInfo($cart_goods['total']['goods_price']);
         $order['coupon_id'] =$coupon_id;
         $order['coupon_money']=$coupon['coupon_money'];
        //红包与优惠券不能同时使用
        $order['bonus_id']=0;
        $order['bonus_money']=0;


        $total=D('Order')->orderFee($order,$cart_goods['cart_list']);
        $this->assign('total',$total);
        $this->assign('go_number',$cart_goods['total']['go_number']);
        $content=$this->fetch('Public/order_total');
        $result['content']=$content;
        $result['amount']=$total['amount'];
        $result['coupon_money']=$coupon['coupon_money'];
    }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
         case 'stop':
           $result['code']='stop';
           break;
         case 'out':
           $result['code']='out';
           break;
         default:
           $result['code']='grammar';
           break;
       }
    }
    $this->ajaxReturn($result);

}

/**
 * 改变积分
 */
public function changeIntegral() 
{  
  
      $result=array('code'=>'suc');
      $integral=I('post.integral');
      $quick=I('post.quick');

    try{
       if(!$integral && $integral!=0)
         E('stop');
       if(!is_numeric($integral))
         E('illegal');

       if($integral<0)
         E('minus');
       
       //积分
       if($integral>D('User')->yourIntegral())
         E('yourself');

       if($integral>D('User')->allowIntegral())
         E('allow');
      
       //核心捕获
        $cart_goods =D('Cart')->getCartList($quick); 
        $order = $this->flowOrderInfo($cart_goods['total']['goods_price']);
        $order['integral']=$integral;
  

       $total=D('Order')->orderFee($order,$cart_goods['cart_list']);

       $this->assign('total',$total);
       $this->assign('go_number',$cart_goods['total']['go_number']);
       $content=$this->fetch('Public/order_total');
       $result['content']=$content;
       $result['amount']=$total['amount'];
       $result['new_integral']=$total['integral']; //最终可以使用的积分以模型中计算的为准

    }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
         case 'stop':
            $result['code']='stop';
           break;
         case 'illegal':
            $result['code']='illegal';
           break;
         case 'yourself':
           $result['code']='yourself';
           break;
         case 'allow':
           $result['code']='allow';
           break;
         case 'minus':
          $result['code']='minus';
          break;
        default:
          $result['code']='grammar';
          break;
       }
    }

  $this->ajaxReturn($result);
         

       
}


public function checkPay($order_id)
{

    
    $order_id=I('get.order_id');
    $status=I('get.status');


    if(!$order_id || !$order_id)
      $this->error('参数丢失');

  $this->assign('order_id',$order_id);

    if($status)
    {
       $order_detail=D('Order')->orderDetail($order_id);
       $this->assign('order_detail',$order_detail);
       $this->display('success');
    }else{
       $this->display('fail');
    }
}



}#类尾