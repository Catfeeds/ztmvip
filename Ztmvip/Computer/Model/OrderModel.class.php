<?php

namespace Computer\Model;
class OrderModel extends BaseModel
{


    /**
     * 计算某笔订单需要的邮费
     * @param  [type] $express     [description]
     * @param  [type] $goods_price [description]
     * @return [type]              [description]
     */
    public function getShippingFee($express,$goods_price)
    {

        $free=M('goods_express')->where(array('id'=>array('IN',$express)))
                          ->field('max(free_amount) AS free')->find();
        if($goods_price>=$free['free']){
             return 0;
        }else{
           $fee=M('goods_express')->where(array('free_amount'=>$free['free']))->field('postage')->find();
           return $fee['postage'];
        }
      
    }



    /**
     *订单中的费用信息
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
            'shipping_fee' => 0, 
            'integral'=>0,
            'integral_amount' => 0, 
            'bonus_amount' => 0, 
            'coupon_amount'=>0,
            'amount'=>0,#应付款金额
        );
        #商品总价与邮费总价
        $express=array();
         foreach ($goods AS $val) 
         {
            if($val['selected']=='Y'){
               $total['goods_price'] += $val['goods_price'] * $val['goods_number'];
               if($val['express_id'])
               {
                   $express[]=$val['express_id'];
               } 
            }

         }

         $total['shipping_fee'] = $this->getShippingFee(array_unique($express),$total['goods_price']);

  //计算开始
      
       $total['amount'] = $total['goods_price'] + $total['shipping_fee'];
       $max_amount = $total['goods_price'];//积分红包可以抵消的最高额度(抛出了邮费)
        //红包
        if (!empty($order['bonus_id'])){

            $rebackbonus =D('UserBonus')->bonusInfo($order['bonus_id'],$total['goods_price']);
            $use_bonus=$rebackbonus['bonus_money'];
          #===========================================================
            $total['amount'] -= $use_bonus; 
            $max_amount -= $use_bonus; 
            $total['bonus_amount']=$use_bonus;
         #===========================================================
        }
        //优惠券
       if (!empty($order['coupon_id'])){
           $rebackcoupon=D('UserCoupon')->couponInfo($order['coupon_id'],$total['goods_price']);
           $use_coupon=$rebackcoupon['coupon_money'];
         #===========================================================
           $total['amount'] -= $use_coupon; 
           $max_amount -= $use_coupon; 
           $total['coupon_amount']=$use_coupon; 
        #===========================================================
       }
     
      //使用积分 (红包与优惠券不可以同时使用，但是可与积分同时使用，所以这里还得多一步判断)
        if ($max_amount > 0 && $order['integral'] >= 0) 
        {

            $integral_amount=round(($order['integral'] / 100), 2);
            $use_integral_amount= min($max_amount, $integral_amount); #减去最终可使用的积分money
          #====================================================
            $total['amount'] -= $use_integral_amount;
            $total['integral_amount'] = $use_integral_amount; 
            $total['integral']=$use_integral_amount *100; 
        #========================================
        }

        $order['unique']=$total['goods_price'];
        session('flow_order',$order);
        return $total;
    }


    /**
    * $quick用来区分是否是快速购买
    */
    public function makeOrder($consignee,$order,$total,$quick)
    {

  
      //初始化插入order表的数据
             $data_order=array(
                 'user_id'=>session('user_id'),
                 'parent_id'=>0,#以后用来订单合并的
                 'shipping_state'=>'new',#快递状态 
                  'goods_fee'=>$total['goods_price'],          #商品总额
                  'shipping_fee'=>$total['shipping_fee'],       #邮费总额 
                  'date_add'=>time(),    #下单时间
                  'order_sn'=>'1990121055555',
                  'affiliate_user'=>0,#商品推荐人 
                  'order_state'=>'new', #订单状态
                  'payment_state'=>'new',#支付状态
                  'date_confirm'=>0,    #订单确认时间
                  'date_pay'=>0,       #支付时间 
              );
            //商品推荐人
            if(cookie('affiliate_guser') && cookie('affiliate_guser')!=session('user_id') ) 
                  $data_order['affiliate_user']=cookie('affiliate_guser');
            //确保订单号唯一
             $flag=0;
             do{
                $data_order['order_sn'] = get_order_sn(); 
                $insert_id=$this->add($data_order);#尝试着插入表order
                if($insert_id)
                  $flag=333;
             }while($flag!=333);#不等于333,证明就不成功,则需要继续执行

             if(!$insert_id)
                 return array('order'=>false);


    //初始化order_extend表中的数据####################################################################
       $data_order_extend=array(
          'order_id'=>$insert_id,
          'bonus_id'=>$order['bonus_id'],
          'bonus_amount'=>$total['bonus_amount'],
          'coupon_id'=>$order['coupon_id'],
          'coupon_amount'=>$total['coupon_amount'],
          'integral'=>$order['integral'],
          'integral_amount'=>$total['integral_amount'],
          'consignee'=>$consignee['consignee'],
          'country'=>'中国',
          'province'=>$consignee['province'],
          'city'=>$consignee['city'],
          'district'=>$consignee['district'],
          'address'=>$consignee['address'],
          'mobile'=>$consignee['mobile'],
        );
 
      $insert_extend=M('Order_extend')->add($data_order_extend);

      if(!$insert_extend)
          return array('order_extend'=>false,'order'=>$insert_id);
      

    //插入order_goods表

 
        $user_id=session('user_id');
        $sql="INSERT INTO ztm_order_goods(order_id,goods_id,goods_name,goods_number,goods_price,skus,buy_flag) SELECT '$insert_id',goods_id,goods_name,goods_number,goods_price,goods_attr,buy_flag FROM ztm_cart WHERE user_id='$user_id' AND selected='Y' AND quick='$quick' ";  
         $exchange=M()->execute($sql);

        if(!$exchange)
            return array('order_goods'=>false,'order_extend'=>$insert_extend,'order'=>$insert_id);

    //订单生成以后，清除购买轨迹
      session('default_consignee',null);
      D('Cart')->clearCart($quick);
      session('flow_order',null);
      if($quick=='N')
       session('cnumber',D('Cart')->cartBuyNumber());
     return array(
           'order_id'=>$insert_id,
           'order_sn'=>$data_order['order_sn'],
           'code'=>true,
           );

}




/************below of moblie center**********************/

/**
 * 判断该订单是否应经是支付完成状态了
 * @param  [type]  $order_id [description]
 * @return boolean           [description]
 */
public function isOrderPayed($order_id)
{
    $where=array(
          'id'=>$order_id,
          'payment_state'=>'payed',
          'order_state'=>'confirm',
      );
    return M('order')->where($where)->count();
}






/**
 * 订单中的费用信息
 *
 * @access  public
 * @param   array   $order
 * @param   array   $goods
 *               
 * @return  array
 */
 function orderDetail($order_id) 
{


     $detail=M('Order')->alias('o')->join('__ORDER_EXTEND__ oe ON o.id=oe.order_id')
               ->field('o.order_sn,o.goods_fee,o.shipping_fee,oe.bonus_amount,oe.coupon_amount,oe.integral_amount,o.user_id,oe.payment_name')
               ->where(array('o.id'=>$order_id))
               ->find();
 $detail['amount']=$detail['goods_fee']+$detail['shipping_fee']-$detail['bonus_amount']-$detail['coupon_amount']-$detail['integral_amount'];

     return $detail;
}


 /**
  * 将支付宝回调地址处理好了之后的订单状态设置成支付了
  * @return [type] [description]
  */
  public function aliorderPayed($order_id,$amount,$trade_no)
  {
     #先修改order_extend表
       $order_extend=array(
          'payment_amount'=>$amount,
          'payment_sn'=>$trade_no,
          'payment_name'=>'支付宝支付',
       );

     $back=M('Order_extend')->where(array('order_id'=>$order_id))
                      ->save($order_extend);
     if(!$back)
       return false;

        #修改order表 
          $order=array(
               'order_state'=>'confirm',
               'payment_state'=>'payed',
               'date_confirm'=>time(),
               'date_pay'=>time(),
            );
        return M('Order')->where(array('id'=>$order_id))->save($order);
  }




  /**
   * 赠送的积分
   * @param  [type] $give_integral [description]
   * @return [type]                [description]
  *
   *由于数据中的字段是int型的，所以就算这里赠送的积分是小数，入库之后也会成为整数的
   *这点就不用多虑了
   */
  public function giveIntegral($order_id,$change_desc='')
  {  
      
      $order_detail=$this->orderDetail($order_id);
      $integral=array(
              'change_desc'=>'computer',
              'change_type'=>'manual',
              'integral'=>$order_detail['amount'],
          );
      D('User')->logIntegral($integral,$order_detail['user_id']);

  }


  /**
  *获取某个订单的所属者
  **/
   public function getOrderUserid($order_id)
   {
       $where['id']=$order_id;
         $user=M('order')->where($where)->field('user_id')->find();
         return $user['user_id'];
   
   }

  /**发送红包*/
   public function giveBonus($order_id)
   {
     #==============================================================
       $time=time();
       #礼包除外
       $sql="SELECT og.goods_number,b.id AS bonus_id,b.bonus_name,b.bonus_money AS money,b.min_order_amount,b.use_start,b.use_end FROM ztm_order_goods AS og LEFT JOIN ztm_bonus AS b ON og.goods_id=b.goods_id WHERE og.order_id='$order_id' AND b.disabled='N' AND b.send_start<=$time AND b.send_end >=$time AND og.buy_flag='normal'";
       $bonus=$this->query($sql);
   
       if($bonus){

        #初始化一个数组，将赠送的红包id保存起来好存到order_extend表中，防止退款
        
          $bonus_ids=array();
          foreach ($bonus as $key => $value) {
                 for($i=0;$i<$value['goods_number'];$i++){
                       $value['date_add']=time();
                       $value['bonus_sn']=time().rand(1,99999);
                       $value['user_id']=$this->getOrderUserid($order_id);
                       $bonus_ids[]=M('user_bonus')->where($where)->add($value);
                 }
          }
          #插入到order_extend表中
          $string=json_encode($bonus_ids);
          $where2['order_id']=$order_id;
          $save['bonus_get']=$string;
          return M('order_extend')->where($where2)->save($save);
       }
   }


  /**
   * 获取上一级分销人
   * @param  [type] $user_id [description]
   * @return [type]          [description]
   */
  public function getLastAffilicate($user_id)
  {
     $where['id']=$user_id;
     $back=M('user')->where($where)->field('parent_id')->find();
     if($back['parent_id'])
     {
        return $back['parent_id'];
     }else{
        return 0;
     }

  }


  /**
   * 插入分销表
   * @param  [type] $order_user  [description]
   * @param  [type] $rebate_user [description]
   * @param  [type] $order_id    [description]
   * @param  [type] $order_sn    [description]
   * @param  [type] $money       [description]
   * @return [type]              [description]
   */
  public function insertAffilateLog($order_user,$rebate_user,$order_id,$order_sn,$money)
  {
    
      $data=array(
           'order_user'=>$order_user,
           'rebate_user'=>$rebate_user,
           'order_id'=>$order_id,
           'order_sn'=>$order_sn,
           'money'=>$money,
           'date_add'=>time(),
        );
      
     $log_id=M('affiliate_log')->add($data);
     if($log_id)
     {
        return true;
     }else{
        return false;
     }

  }

  /**
   * 按照商品分销的，俺不是看订单的应付款额度额
   * 支付成功之后进行分销标志
   * @param  [type] $order_id [description]
   * @return [type]           [description]
   * 19601
   *
   * 19487  
   */
  public function affiliateFlag($order_id='')
  {

     //再次判断是否已经支付成功
     $where=array(
         'id'=>$order_id,
         'order_state'=>'confirm',
         'payment_state'=>'payed',
      );

     $record=M('order')->where($where)
                ->field('affiliate_user,user_id,order_sn')
                ->find();
       if(empty($record['user_id'])||empty($record['order_sn']))
       {
          return false;
       }


         $user_id=$record['user_id'];
         $affiliate_user=$record['affiliate_user'];
         $order_sn=$record['order_sn'];

    #====================================================
         #判断是否存在被分销人
         if($affiliate_user || $row=M('user')->field('parent_id')->where('parent_id>0 and id='.$user_id)->find())
         {
            $sql="SELECT og.goods_price,og.goods_number,ge.profit FROM `ztm_order_goods` AS og LEFT JOIN `ztm_goods_extend` AS ge ON og.goods_id=ge.goods_id WHERE og.order_id=$order_id AND og.buy_flag='normal' ";
            $back=$this->query($sql);
            if(!$back[0])
            {
               return;
            }

             foreach ($back as $key => $value){
                #分销总额度
                 $total_affiliate+=($value['goods_price']*$value['goods_number']*$value['profit'])/100;
             }

             #==========================================
             #商品推荐人分销
             if($affiliate_user>0)
             {
               
               $this->insertAffilateLog($user_id,$affiliate_user,$order_id,$order_sn,$total_affiliate);
               return;


             }else{
                 
              #注册推荐人分销
            #先获取三级分销的分销比例
             $config=M('rebate_config')->where("disabled='N'")->select();
             foreach ($config as $key => $value) {
                  switch ($value['level']) {
                    case '1':
                        $first_level=$value['percent'];
                      break;
                    case '2':
                        $second_level=$value['percent'];
                      break;
                    case '3':
                          $third_level=$value['percent'];
                    break;
                    
                    default:
                      # code...
                      break;
                  }
             }

             $real_first_level=$first_level/($first_level+$second_level+$third_level);
             $real_second_level=$second_level/($first_level+$second_level+$third_level);
             $real_third_level=$third_level/($first_level+$second_level+$third_level);

              #一级分销人(程序能进入这里必然存在)
               $first_id=$row['parent_id'];
               $first_money=round($total_affiliate*$real_first_level,2);
               $this->insertAffilateLog($user_id,$first_id,$order_id,$order_sn,$first_money);
              #二级分销人(不一定额)
               $second_id=$this->getLastAffilicate($first_id);
               if($second_id)
               {
                  $second_money=round($total_affiliate*$real_second_level,2);
                  $this->insertAffilateLog($user_id,$second_id,$order_id,$order_sn,$second_money);
               }
              #三级分销人(不一定额)
               $third_id=$this->getLastAffilicate($second_id);
               if($third_id)
               {
                  $third_money=round($total_affiliate*$real_third_level,2);
                  $this->insertAffilateLog($user_id,$third_id,$order_id,$order_sn,$third_money);
               }

               return;
             
             }


                  
         }#存在分销人的if尾巴
   
  }


   /**
    * 将订单中心处理好了之后的非微信支付订单状态设置成支付了
    *
    * @return [type] [description]
    */
    public function orderPayed($order_id,$amount,$payment_name)
    {

      #先修改order_extend表
      if($payment_name=='balance'){
         $order_extend=array('payment_name'=>'余额支付', 'surplus_amount'=>$amount,);
      }else{
         $order_extend=array('payment_name'=>'储值卡支付', 'prepaid_amount'=>$amount,);
      }

      $back=M('Order_extend')->where(array('order_id'=>$order_id))->save($order_extend);
    
         #修改order表 
       $order=array('order_state'=>'confirm', 'payment_state'=>'payed', 'date_confirm'=>time(), 'date_pay'=>time());
       M('Order')->where(array('id'=>$order_id))->save($order);
    }


}#类尾部