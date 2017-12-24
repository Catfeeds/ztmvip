<?php

namespace Mobile\Model;
use Think\Model;

class QuickModel extends Model{

  protected $tableName='cart';  


  /**
   * 快速检测订单页面取得购物车商品
   * @return  array   购物车商品数组
   */
  public function checkGoods() 
  {
        

      $arr=json_decode(session('quick_cart'),true);

      $where['id']=$arr['goods_id'];
      $res=M('goods')->where($where)->field('goods_name,goods_thumb')->find();
      $arr['goods_price']=D('Goods')->getFinalPrice($arr['goods_id'],$arr['spec']);
      $arr['goods_name']=$res['goods_name'];
      $arr['goods_thumb']=$res['goods_thumb'];
      $arr['unique']=$arr['goods_price']*$arr['number'];
      return $arr;
  }



  /**
   * 获得用户的订单信息
   *
   * @access  private
   * @return  array
   */
  function flowOrderInfo($unique)
  {

      if(session('quick_order') && $unique==session('quick_order.unique'))
      {
         $order=session('quick_order');
      }else{
           $order=array(
           'payment_name'=>'wx',
           'bonus_id'=> 0,
           'bonus_name'=>'',#这个是必须的
           'coupon_id'=> 0,
           'coupon_name'=>'',#这个也是必须的
           'integral' => 0,
           'prepaid_id'=>0,
           'unique'=>0,
        );
      }


      return $order;
  }



  /**
   * quick流程购买获得订单中的费用信息
   *
   * @access  public
   * @param   array   $order
   * @param   array   $goods
   *               
   * @return  array
   */
   function orderFee($order,$goods) 
  {

  #初始化
      $total = array(
          'goods_price' => 0, #商品总额
          'shipping_fee' => 0, #邮费
          'integral_amount' => 0, #使用的积分换算成钱的额度
          'bonus_amount' => 0,  #使用的红包额度
          'coupon_amount'=>0,#使用代金券的额度
          'amount'=>0,#应付款金额
      );


      #商品总价
    $total['goods_price']=$goods['number']*$goods['goods_price'];

    #邮费==================================================
    $condition['goods_id']=$goods['goods_id'];
    $express=array();
    $back=M('goods_extend')->where($condition)->field('express_id')->find();
    $express=$back['express_id'];#一维数组

    $total['shipping_fee'] =D('Treatment')->getShippingFee($express,$total['goods_price']);

    #==============================================
     #初始化应付款金额
     $total['amount'] = $total['goods_price'] + $total['shipping_fee'];
     #初始化使用红包与积分的最高额度 
     $max_amount = $total['goods_price'];

      #用户使用的红包(目前是每次只能使用1个，且必然是满足大于自身额度才可以使用的)
      if (!empty($order['bonus_id'])) 
      {
          
          $rebackbonus =D('Treatment')->bonusInfo($order['bonus_id']);
          $use_bonus=$rebackbonus['bonus_money'];

        #===========================================================
          $total['amount'] -= $use_bonus; #红包抵消之后的应付款金额
          $max_amount -= $use_bonus; #积分最多还能支付的金额
          $total['bonus_amount']=$use_bonus;#使用的红包额度
    
       #===========================================================
      }

     #用户使用的优惠券
     if (!empty($order['coupon_id'])) 
     {
          
         $rebackcoupon=D('Treatment')->couponInfo($order['coupon_id']);
         $use_coupon=$rebackcoupon['coupon_money'];

       #===========================================================
         $total['amount'] -= $use_coupon; #代金券抵消之后的应付款金额
         $max_amount -= $use_coupon; #积分最多还能支付的金额
         $total['coupon_amount']=$use_coupon;#使用的代金券
      #===========================================================
     }
    
      #用户使用的积分
      if ($max_amount > 0 && $order['integral'] > 0) 
      {

           #将积分按比例换成钱
          $integral_amount=round(($order['integral'] / 100), 2);
           #减去最终可使用的积分money
          $use_integral= min($max_amount, $integral_amount); 
        #====================================================
          $total['amount'] -= $use_integral;#积分抵消之后的应付款金额
          $total['integral_amount'] = $use_integral;#使用的积分

          $order['integral'] = $use_integral*100;#用户选择的积分将被迫取上述两者的最小值喽
      #========================================
      } 

     
      #保存新的选择(没有选择前，这里会保存初始化的选择)
      #保存新选择前，更新最新的标识
      $order['unique']=$total['goods_price'];
      session('quick_order',$order);
      return $total;
  }






}#类尾部