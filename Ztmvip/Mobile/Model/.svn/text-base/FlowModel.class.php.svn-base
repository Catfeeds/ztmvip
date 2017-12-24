<?php
/**
 * 购物车模型
 * author: shan
 */
namespace Mobile\Model;
class FlowModel extends BaseModel{
    protected $tableName='cart';


##############商品详情页##############################################################
  public function getCartSpec($spec)
  {
       

       $cart_spec=array();
       foreach ($spec as $key => $value)
        {
              $reback=explode("_",$value);
              $cart_spec[$key][0]=$reback[2];
              $cart_spec[$key][1]=$reback[3];

       }

      return $cart_spec;
  }

  /**
   * 获取购车中当前用户某个商品的数量
   * @param  [type] $goods_id [description]
   * @return [type]           [description]
   */
    public function cartGoodsNumber($goods_id)
    { 
       
         $where=array(
             'goods_id'=>$goods_id,
             'cart_key'=>CART_KEY,
           );

         $res=M('cart')->where($where)
                   ->field('SUM(goods_number) as number')->find();

         if(!$res['number'])
         {
            return 0;
         }else{
            return $res['number']; 
          }

        
    }


        /**
         * 添加商品到购物车
         *
         * @access  public
         * @param   integer $goods_id   商品编号
         * @param   integer $num        商品数量
         * @param   array   $spec       商品规格属性(有的商品可能没有额)
         * 
         * @return  boolean
         */
        function addCart($goods_id,$num, $spec)
         {

         #转成json字符串
         if(count($spec)) {
            $cart_spec=$this->getCartSpec($spec);
            $goods_attr=json_encode($cart_spec);
         }
     
              #计算商品的最终单价 存入购物车
             $final_price=D('Goods')->getFinalPrice($goods_id,$spec);
    
     
            #初始化要插入购物车的基本件数据
    
        $sql="SELECT g.goods_name,ge.express_id FROM ztm_goods AS g LEFT JOIN ztm_goods_extend AS ge ON g.id=ge.goods_id WHERE g.id=$goods_id";
        $res=$this->query($sql);
        $goods=$res[0];

    #如果购物车中已经存在该商品且类型也一样
              $where=array('goods_id'=>$goods_id);

              if(session('user_id')){
                 $where['user_id']=session('user_id');
              }else{
                 $where['cart_key']=CART_KEY;
              }
            if($goods_attr){
               $where['goods_attr']=$goods_attr;  
            }
          
              $row=M('cart')->where($where)->field('id')->find();

  
            if($row){
               $sql="update ztm_cart set goods_number=goods_number+$num where id=$row[id]";
               return $this->execute($sql);
            }else{
               $data = array(
                   'cart_key' =>CART_KEY,
                   'goods_id' => $goods_id,
                   'goods_name' =>$goods['goods_name'],
                   'express_id' => $goods['express_id'],
                   'goods_price' =>$final_price,
                   'goods_number'=>$num,
                   'selected'=>'Y',
                   'buy_flag'=>'normal',
               );


              if($goods_attr){
                  $data['goods_attr']=$goods_attr;#存的是json字符串 
              }
              
               if(session('user_id')){
                   $data['user_id']=session('user_id');
               }
              return M('cart')->add($data);
            }

        }





/**
* 仅仅计算出当前客户端用户购车中的商品数量
* @return [type] [description]
*/
public function  cartBuyNumber()
{
   $where=array('quick'=>'N');
   if(session('user_id')){
      $where['user_id']=session('user_id');
   }else{
      $where['cart_key']=CART_KEY;
   }
    $count=M('cart')->field('SUM(goods_number) AS count')
                   ->where($where)
                   ->find();
     $last_count=$count['count']?$count['count']:0;
     session('cnumber',$last_count);
     return $last_count;
}



##################################购物车页面########################################################################################


  /**
   * 获得当前客户端购物车中的商品以及帮其计算出总报价单信息
   *
   * @access  public
   * @return  array
   */
  function getCartGoods() {
      $where=array('quick'=>'N');
     if(session('user_id')){
       $where['user_id']=session('user_id');
     }else{
       $where['cart_key']=CART_KEY;
     }
      $cart_list=M('cart')->where($where)->order('id desc')->select();


      #购买总价(selected值为已经选择的)
 
      $total = array();
      foreach ($cart_list as $key=> $value) 
    {
          
                  if($value['selected']=='Y')
                  {
                     
                     $total['goods_price'] += $value['goods_price'] * $value['goods_number'];
                     $total['go_number'] += $value['goods_number'];

                  }

                #增加购物车显示商品图 
              if($value['buy_flag']!='package')
              {
                  $where['id']=$value['goods_id'];
                  $back=$this->table('ztm_goods')->where($where) ->field('goods_thumb')->find();
                 $cart_list[$key]['goods_thumb']=$back['goods_thumb']; 
              }else{

                   #######礼包等会写############
                       
              }
         
              #对属性进行装饰
              $cart_list[$key]['goods_attr']=json_decode($value['goods_attr'],true);

   }

      return array('cart_list' => $cart_list, 'total' => $total);
  }

/**
 * 判断是否全选了购物车中的商品
 * @return boolean [description]
 */
  public function  isAllSelected()
  {
       $where=array('quick'=>'N','selected'=>'N');
      if(session('user_id')){
        $where['user_id']=session('user_id');
      }else{
        $where['cart_key']=CART_KEY;
      }

       $count=M('cart')->where($where)->count();
       if($count) {
          return 0;
       }else{
            return 1;
       }


  }

################################################订单结算页面###############################################################
    /**
     * checkout页面取得购物车商品
     * @return  array   购物车商品数组
     */
public   function checkGoods() 
{
       $where=array('quick'=>'N','selected'=>'Y');
      if(session('user_id')){
        $where['user_id']=session('user_id');
      }else{
        $where['cart_key']=CART_KEY;
      }
      $cart_list=M('cart')->order('id desc') ->where($where)->select();
       $reback=array();
      foreach ($cart_list as $key=> $value) 
      {
                #增加购物车显示商品图 
              if($value['buy_flag']!='package')
              {
                  $where['id']=$value['goods_id'];
                  $back=M('goods')->where($where) ->field('goods_thumb')->find();
                   $value['goods_thumb']=$back['goods_thumb']; 
              }else{

                   #######礼包等会写############
                       
              }
         
              #对属性进行装饰
              $value['goods_attr']=json_decode($value['goods_attr'],true);
           $reback[]=$value;

   }
   return $reback;

  }


/**
 * 获取flow流程的唯一标识
 * @return [type] [description]
 */
public function getFlowUnique($check_goods)
{
   
   
   foreach ($check_goods as $key => $value) {
       $unique+=$value['goods_number']*$value['goods_price'];
   }

   return $unique;
  
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
         'payment_name'=>'wx',
         'bonus_id'=> 0,
         'bonus_name'=>'',
         'coupon_id'=> 0,
         'coupon_name'=>'',
         'integral' => 0,
         'prepaid_id'=>0,
         'unique'=>0,
      );
    }


    return $order;
}


/**
 * 正常流程购买获得订单中的费用信息
 *
 * @access  public
 * @param   array   $order
 * @param   array   $goods
 *               
 * @return  array
 */
 function orderFee($order,$goods) 
{

    $total = array(
        'goods_price' => 0, #商品总额
        'shipping_fee' => 0, #邮费
        'integral_amount' => 0, #使用的积分换算成钱的额度
        'bonus_amount' => 0,  #使用的红包额度
        'coupon_amount'=>0,#使用代金券的额度
        'amount'=>0,#应付款金额
    );

    #商品总价与邮费总价
    $express=array();
     foreach ($goods AS $val) 
     {
         $total['goods_price'] += $val['goods_price'] * $val['goods_number'];
         if($val['express_id'])
         {
             $express[]=$val['express_id'];
         }
     }


     $express = array_unique($express);


     $total['shipping_fee'] =D('Treatment')->getShippingFee($express,$total['goods_price']);
 
 

   #(红包和积分的和)最多能支付的金额为商品总额 
   #如果有邮费，则邮费会被排除在外计算，即不能使用红包或者积分来支付。
   $max_amount = $total['goods_price'];

   //初始化应付款金额
   $total['amount'] = $total['goods_price'] + $total['shipping_fee'];

    #用户使用的红包(目前是每次只能使用1个，且必然是满足大于自身额度才可以使用的)
    if (!empty($order['bonus_id'])) 
    {
         #这里的bonus_id是user_bonus表的主键id
      
        $rebackbonus =D('Treatment')->bonusInfo($order['bonus_id']);
        $use_bonus=$rebackbonus['bonus_money'];

      #===========================================================
        $total['amount'] -= $use_bonus; #红包抵消之后的应付款金额
        $max_amount -= $use_bonus; #积分最多还能支付的金额
        $total['bonus_amount']=$use_bonus;#使用的红包
       #只要用户的选择有所改变，就打入标识
        
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

        $order['integral'] = $use_integral*100;
        
    #========================================
    }

  
    $order['unique']=$total['goods_price'];
    session('flow_order',$order);
    return $total;
}






###################################订单最终计算页面##################################################################################


























    /**
     * 清空当前客户端的购物车中已经生成订单的商品
     * 
     */
    function clearCart() 

   {
  
        $map=array(
               'user_id'=>session('user_id'),
               'selected'=>'Y',
               'quick'=>'N',
            );
         M('Cart')->where($map)->delete();

   }









 


   

}#类尾部