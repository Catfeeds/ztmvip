<?php

namespace Mobile\Model;
use Think\Model;

class TreatmentModel extends Model
{

    protected $tableName='user';

    const HEALTH=2325; #待处理的特殊商品id
    const HCARD=2;   #赠送的储值卡id


####################商城支付密码############################################
    /**
     * 结算页面判断用户的商城支付密码是否存在的
     * @return [type] [description]
     */
    public function checkPaymentPassword()
    {
        $where['id']=session('user_id');
        $res=M('user')->field('payment_password')->where($where)->find();
        if($res['payment_password'] && strlen($res['payment_password'])==32)
        {
            return true;
        }else{
            return false;
        }
       
    }

    /**
     * 判断商城密码是否正确
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function checkPasswordTrue($password)
    {
         #为防止灌水，还是重复着先判断该条记录的存在性之后再判断密码正确性吧
         
         $where['id']=session('user_id');
         $record=M('User')->where($where)->field('id,payment_password')
                          ->find();

         if($record['id'])
         {   
              $md5password=md5(md5($password));
              if($md5password==$record['payment_password'])
              {
                  session('password_error',null);
                  return true;
              }else{
                   
                   if(session('password_error'))
                   {
                      $error=session('password_error');
                      $new_error=$error+1;
                      session('password_error',$new_error);

                   }else{
                      session('password_error',1);
                   }
                   return false;
              }

         }
    }



###################储值卡#########################################################
/**
 * 获取购买卡的金额
 * @return [type] [description]
 */
public function giveCardMoney($id)
{
   $back=M('prepaid')->where('id='.$id)->field('par')->find();
   return $back['par'];
}

/**
 * 针对订单发送储值卡
 * @param  string $order_id [description]
 * @return [type]           [description]
 */
public  function giveCard($order_id='')
{

  $back=M('order_goods')->where('order_id='.$order_id)->getField('goods_id',true);  #返回值是一维数组

  foreach ($back as $key => $value) {
      if($value==self::HEALTH)
      {
          $add=array(
                  'user_id'=>$this->getOrderUserid($order_id),
                   'money'=>$this->giveCardMoney(self::HCARD),
                  'prepaid_id'=>self::HCARD,
                  'date_add'=>time(),
             );

          M('user_prepaid')->add($add);

      }
  }

}
/**
 * 罗列用户的储值卡
 * @return [type] [description]
 */
public function userCards()
{
      $where['user_id']=session('user_id');
      $where['money']=array('gt',0);
      $where['disabled']='N';
      $res=M('user_prepaid')->where($where)->field('id,prepaid_sn,money')->select();
      if(!$res[0])
      {
          return false;
      }else{
           $new=array();
           foreach ($res as $key => $value) 
           {
               $value['prepaid_sn']=substr($value['prepaid_sn'], -5);
               $new[]=$value;
           }

           return $new;
      }

}
/**
  *获取某个卡的余额
*/
public function getCardMoney($prepaid_id)
{
     $where['user_id']=session('user_id');
     $where['id']=$prepaid_id;
     $card=M('user_prepaid')->where($where)->field('money')->find();
     return $card['money']?$card['money']:0;

}

/**
 * 减去使用的额度
 * @param  [type] $id     [description]
 * @param  [type] $amount [description]
 * @return [type]         [description]
 */
public function usedCardMoney($id,$amount)
{
    $sql="UPDATE `ztm_user_prepaid` SET money=money-$amount WHERE id=$id";
    return $this->execute($sql);

}
###########################邮费#################################################################


/**
 * 计算某笔订单需要的邮费
 * @param  [type] $express     [description]
 * @param  [type] $goods_price [description]
 * @return [type]              [description]
 */
public function getShippingFee($express,$goods_price)
{
 

    $where['id']=array('IN',$express);
    $free=M('goods_express')->where($where)->field('max(free_amount) AS free')->find();

    if($goods_price>=$free['free'])
    {
         return 0;
    }else{
        $where2['free_amount']=$free['free'];
       $fee=M('goods_express')->where($where2)->field('postage')->find();
       return $fee['postage'];
    }
  
}

###################################红包###############################################################################################
/**
 * 取得用户当前可用红包(且是没过期未使用的额)
 * @param   float   $goods_amount   订单商品金额
 * @return  array   红包数组
 */
function userBonus($goods_amount) 
{

  
    $time=time();
    $user_id=session('user_id');
    $where=array(
         'user_id'=>$user_id,
         'date_use'=>0,
         'use_start'=>array('LT',$time),
         'use_end'=>array('GT',$time),
         'min_order_amount'=>array('ELT',$goods_amount),
      );

    $res=M('user_bonus')->where($where)
                   ->field('id AS bonus_id,bonus_name')
                   ->select();

     if($res[0])
     {
     	 return $res;
     }else{
     	 return false;
     }
  
 }

 /**
  * 取得红包信息
  * @param   int     $bonus_id    user_bonus的主键id
  * @param   array   红包信息
  */
 function bonusInfo($bonus_id) 
 {
     #传过来的bonus_id肯定是该用户合法有效的红包，我们这里就不用判断了
     #该红包肯定也没过期
      $where=array(
           'id'=>$bonus_id,
        );
     $back=M('user_bonus')->where($where)->field('money AS bonus_money,bonus_name')->find();

     #由于目前一次只能使用一个红包，所以就不存在使用的红包总额的计算了
      if(count($back))
      {
      	 return $back;
      }else{
      	 return false;
      }

 }


 /**
  * 取得正常购买的用户应该得到的红包的所有id(bonus)
  */
 function getTotalBonus() 
 {
     
     $time=time();
     $user_id=session('user_id');
     #礼包除外
     $sql="SELECT c.goods_number,b.id,b.bonus_money FROM ztm_cart AS c LEFT JOIN ztm_bonus AS b ON c.goods_id=b.goods_id WHERE c.user_id=$user_id AND b.send_start<=$time AND b.send_end >=$time AND c.buy_flag='normal'";

     $res=$this->query($sql);
     return $res;   

 }

 /**
  * 取得当前用户应该得到的红包总额
  * 快速购买
  */
 function getTotalBonusQuick() 
 {

          $quick_cart=json_decode(session('quick_cart'),true);
          $where['goods_id']=$quick_cart['goods_id'];
          $where['send_start']=array('LT',time());
          $where['send_end']=array('GT',time());
           $res=$this->table('ztm_bonus')->where($where)
               ->field('bonus_money')->find();
          
          if($res['bonus_money'])
          {
             return $res['bonus_money']*$quick_cart['number'];
          }else{

              return 0;
          }
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
  * 设置红包为已使用
  * @param   int     $bonus_id   红包id
  * @return  bool
  */
 function usedBonus($bonus_id) 
 {

   $where['id']=$bonus_id;
   $data=array(
         'date_use'=>time(),
      );
    return M('user_bonus')->where($where)->save($data);
 }
 ######################################优惠券############################################################
 /**
  * 取得用户当前可用代金券(且是没过期未使用的额)
  * @param   float   $goods_amount   订单商品金额
  * @return  array   代金券数组
  */
 function userCoupon($goods_amount) 
 {


     $time=time();
     $user_id=session('user_id');

     $sql="SELECT c.coupon_name,c.coupon_money,uc.id AS coupon_id FROM ztm_user_coupon AS uc LEFT JOIN ztm_coupon AS c ON uc.coupon_id=c.id WHERE uc.user_id=$user_id AND uc.date_use='0'AND c.use_end>$time  AND min_order_amount<=$goods_amount";
      $res=$this->query($sql);
      if($res[0])
      {
      	 return $res;
      }else{
      	 return false;
      }
   
  }


/**
 * 取得优惠券的信息
 * @param   int     $coupon_id   
 * @param   array   优惠券信息
 */
function couponInfo($coupon_id) 
{
    
    $sql="SELECT c.coupon_money,c.coupon_name FROM ztm_coupon AS c LEFT JOIN ztm_user_coupon AS uc ON uc.coupon_id=c.id where uc.id=$coupon_id";

    $res=$this->query($sql);
    if($res[0])
    {
    	 return $res[0];
    }else{
    	 return false;
    }

}


/**
 * 设置代金券为已使用
 * @param   int     $bonus_id   代金券id
 * @return  bool
 */
function usedCoupon($coupon_id) 
{

  $where['id']=$coupon_id;
  $data=array(
        'date_use'=>time(),
     );
  
   return M('user_coupon')->where($where)->save($data);
 
}

##########################################积分#################################################################
/**
 * 快速购买流程 获得用户的可用积分
 *
 * @access private
 * @return integral
 */
public function AvailableIntegral_quick() 
{  
      $check_goods=D('quick')->checkGoods();

     $where['goods_id']=$check_goods['goods_id'];
     $back=M('goods_extend')->where($where)->field('pay_integral')->find();

  return $check_goods['number'] * $back['pay_integral'];

}


/**
 * 正常购买流程 获得用户的可用积分
 *
 * @access private
 * @return integral
 */
public function AvailableIntegral() 
{  

         $cart_key=CART_KEY;
        $sql="SELECT SUM(ge.pay_integral * c.goods_number) AS sum FROM ztm_cart AS c LEFT JOIN ztm_goods_extend AS ge ON c.goods_id=ge.goods_id WHERE
        c.cart_key='$cart_key' AND c.buy_flag!='package' AND ge.pay_integral>0 AND c.selected='Y'";

        $res=$this->query($sql);
        $val = intval($res[0]['sum']);
        return $val;

}

/**
 * 获得用户的可用积分
 *  快速购买
 * @access private
 * @return integral
 */
public function flowIntegralQuick() 
{  
  
        $quick_cart=json_decode(session('quick_cart'),true);
        $where['goods_id']=$quick_cart['goods_id'];
       
        $res=$this->table('ztm_goods_extend')->field('pay_integral')->where($where)->find();

        $pay_integral=$res['pay_integral']? $res['pay_integral']:0;
        return $pay_integral * $quick_cart['number'];
}



/**
 * 获取当前用户的消费积分
 * @return [type] [description]
 */
public function yourIntegral()
{

   $where['id']=session('user_id');
   $res=$this->table('ztm_user')->field('integral')->where($where)->find();
   if($res['integral'])
   {
       return $res['integral'];
   }else{
   	  return 0;
   }
  

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
    
    $sql="SELECT o.goods_fee,o.shipping_fee,o.user_id,oe.bonus_amount,oe.coupon_amount,oe.integral_amount FROM `ztm_order` AS o LEFT JOIN `ztm_order_extend` AS oe ON o.id=oe.order_id WHERE o.id=$order_id"; 
    $res=M()->query($sql);

       #初始化
          $total = array(
              'goods_price' =>$res[0]['goods_fee'], #商品总额
              'shipping_fee' =>$res[0]['shipping_fee'], #邮费
              'bonus_amount'=>$res[0]['bonus_amount'],
              'coupon_amount'=>$res[0]['coupon_amount'],
              'integral_amount'=>$res[0]['integral_amount'],
          );
     
     #应付款的额度就是赠送积分的额度  
      $give_integral=$total['goods_price']+$total['shipping_fee']-$total['bonus_amount']-$total['coupon_amount']-$total['integral_amount'];
      $true=$this->logAccountChange(0,0,0,$give_integral,$change_desc,'manual',$res[0]['user_id']); 
      if($true)
      {
          #将该用户获得的积分写入order_extend表中
          $where['order_id']=$order_id;

          $save['integral_get']=$give_integral;
          return M('order_extend')->where($where)->save($save);

      }
}

##################################余额#############################################################################
/**
 * 获取当前用户的余额
 * @return [type] [description]
 */
public function userMoney()
{
     return D('User')->real_money(session('user_id'));
}


   /**
    * 记录帐户变动
    * @param   float   $user_money     可用余额变动
    * @param   float   $frozen_money   冻结余额变动
    * @param   int     $rank_points    等级积分变动
    * @param   int     $pay_points     消费积分变动
    * @param   string  $change_desc    变动说明
    * @param   int     $change_type    变动类型:自己规定即可
    * @return  void
    */
function logAccountChange($user_money, $frozen_money, $level_integral, $integral, $change_desc, $change_type,$user_id=0) 
{         

       if(!$user_id)
       {
         $user_id=session('user_id');
       }
          
           $time=time();
           /* 插入帐户变动记录 */
           $account_log = array(
               'user_id' =>$user_id,
               'user_money' => $user_money,
               'frozen_money' => $frozen_money,
               'level_integral' => $level_integral,
               'integral' => $integral,
               'date_add' =>$time,
               'change_desc' => $change_desc,
               'change_type' => $change_type
           );

           $res_id=M('account_log')->add($account_log);


           /* 上述是做记录，下面是正式更改变动 */
    
          $sql="UPDATE ztm_user SET user_money=user_money+$user_money,frozen_money=frozen_money+$frozen_money,level_integral=level_integral+$level_integral,integral=integral+$integral,date_upd=$time WHERE id=$user_id";

           $res_true=$this->execute($sql);
          if($res_id && $res_true)
          {
              return true;
          }else{
              return false;
          }
 }

###################################订单###############################################################################################
/**
*获取某个订单的所属者
**/
 public function getOrderUserid($order_id)
 {
 	   $where['id']=$order_id;
       $user=M('order')->where($where)->field('user_id')->find();
       return $user['user_id'];
 
 }
 /**
       * $flag用来区分是否是商城内部支付
       * $quick用来区分是否是快速购买
 */
 public function makeOrder($consignee,$order,$total,$flag='',$quick='')
 {

   #初始化插入order表的数据===============================================
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

         #其中的几个字段要特殊判断的
         #商品推荐人
         if(cookie('affiliate_guser') && cookie('affiliate_guser')!=session('user_id') )
         {
               $data_order['affiliate_user']=cookie('affiliate_guser');
         }
         #订单状态
         if($flag)
         {
             $data_order['order_state']='confirm';
             $data_order['payment_state']='payed';
             $data_order['date_confirm']=time();
             $data_order['date_pay']=time();
         }

      
    $flag=0;
    do{

       $data_order['order_sn'] = get_order_sn(); 
       #尝试着插入表order
       $insert_id=M('order')->add($data_order);
       if($insert_id)
       {
          
           $flag=333;
       }

    }while($flag!=333);#不等于333,证明就不成功,则需要继续执行

    if(!$insert_id)
    {
        return false;
    }

 #初始化order_extend表中的数据####################################################################
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

    #微信支付需要在回调地址成功付款通知到了才能处理的
      switch ($order['payment_name']) {
        case 'card':
             $data_order_extend['payment_name']='储值卡支付';
             $data_order_extend['prepaid_amount']=$total['amount'];
             $data_order_extend['prepaid_id']=$order['prepaid_id'];
          break;
        case 'ye':
           $data_order_extend['payment_name']='余额支付';
           $data_order_extend['surplus_amount']=$total['amount'];
          break;
      }
     
   $insert_extend=M('order_extend')->add($data_order_extend);

   if(!$insert_extend)
   {
       return false;
   }

   #插入order_goods表====================================================
   #新系统对于字段different取值是new
    if($quick)
    {
            $check_goods =D('Quick')->checkGoods();
            $cart_spec=D('Flow')->getCartSpec($check_goods['spec']);
           $add=array(
                'order_id'=>$insert_id,
                'buy_flag'=>'normal',
                'goods_id'=>$check_goods['goods_id'],
                'goods_number'=>$check_goods['number'],
                'goods_price'=>$check_goods['goods_price'],
                'skus'=>json_encode($cart_spec),
                'different'=>'new',
                'goods_name'=>$check_goods['goods_name'],
             );
           $exchange=M('order_goods')->add($add);
       
    }else{
          $user_id=session('user_id');
          $sql="INSERT INTO ztm_order_goods(order_id,goods_id,goods_name,goods_number,goods_price,skus,buy_flag) SELECT '$insert_id',goods_id,goods_name,goods_number,goods_price,goods_attr,buy_flag FROM ztm_cart WHERE user_id='$user_id' AND selected='Y' AND quick='N' "; $exchange=M()->execute($sql);
    }


   if(!$exchange)
   {
       return false;
   }
  
 #===============================================
   #订单生成以后，清除这个流程的购买轨迹
  session('default_consignee',null);
   if($quick)
   {
     session('quick_cart',null);
     session('quick_order',null);
    
   }else{
       D('Flow')->clearCart();
       session('flow_order',null);
       session('cnumber',D('Flow')->cartBuyNumber());
   	  
   }
 #==========
  return array(
        'order_id'=>$insert_id,
        'order_sn'=>$data_order['order_sn'],
        );

 }


 /**
  * 获取订单支付成功后要展示的信息
  *
  * @access  public
  * @param   array   $order
  * @param   array   $goods
  *               
  * @return  array
  */
  function displayOrder($order_id) 
 {


   
      $sql="SELECT o.goods_fee,o.shipping_fee,o.order_sn,oe.payment_name,oe.bonus_amount,oe.coupon_amount,oe.integral_amount FROM `ztm_order` AS o LEFT JOIN `ztm_order_extend` AS oe ON o.id=oe.order_id WHERE o.id=$order_id"; 
      $res=M()->query($sql);

      #初始化
         $total = array(
             'goods_price' =>$res[0]['goods_fee'], #商品总额
             'shipping_fee' =>$res[0]['shipping_fee'], #邮费
             'bonus_amount'=>$res[0]['bonus_amount'],
             'coupon_amount'=>$res[0]['coupon_amount'],
             'integral_amount'=>$res[0]['integral_amount'],
         );
      
   $amount=$total['goods_price']+$total['shipping_fee']-$total['bonus_amount']-$total['coupon_amount']-$total['integral_amount'];
    $res[0]['amount']=$amount;
    return $res[0];
   
 }

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
*计算某笔订单的应付款额度
*/
 public function orderAmount($order_id)
 {
       $sql="SELECT o.goods_fee,o.shipping_fee,oe.bonus_amount,oe.coupon_amount,oe.integral_amount FROM `ztm_order` AS o LEFT JOIN `ztm_order_extend` AS oe ON o.id=oe.order_id WHERE o.id=$order_id"; 
       $res=M()->query($sql);

       #初始化
          $total = array(
              'goods_price' =>$res[0]['goods_fee'], #商品总额
              'shipping_fee' =>$res[0]['shipping_fee'], #邮费
              'bonus_amount'=>$res[0]['bonus_amount'],
              'coupon_amount'=>$res[0]['coupon_amount'],
              'integral_amount'=>$res[0]['integral_amount'],
          );
       
    $amount=$total['goods_price']+$total['shipping_fee']-$total['bonus_amount']-$total['coupon_amount']-$total['integral_amount'];	
    return $amount;  
 }


 /**
  * 将微信回调地址处理好了之后的订单状态设置成支付了
  * $transaction_id用来区分是否是微信回调地址借用该方法了
  * @return [type] [description]
  */
  public function wxorderPayed($order_id,$amount,$transaction_id)
  {

  

     #先修改order_extend表
     
     $where2['order_id']=$order_id;
     $save2['payment_amount']=$amount;
     $save2['payment_sn']=$transaction_id;
     $save2['payment_name']='微信安全支付';

     $res2=M('order_extend')->where($where2)->save($save2);
#==================================================================


        #修改order表 (以这个结果为准)
          $where['id']=$order_id;

          $save=array(
               'order_state'=>'confirm',
               'payment_state'=>'payed',
               'date_confirm'=>time(),
               'date_pay'=>time(),
            );
          $res=M('order')->where($where)->save($save); 

   
           return $res;

  }


   /**
    * 将订单中心处理好了之后的非微信支付订单状态设置成支付了
    * $transaction_id用来区分是否是微信回调地址借用该方法了
    * @return [type] [description]
    */
    public function orderPayed($order_id,$amount,$payment_name)
    {

       #先修改order_extend表
       
       $where2['order_id']=$order_id;
       if($payment_name=='ye')
       {
         $save2['surplus_amount']=$amount;
         $save2['payment_name']='余额支付';
       }else{
          $save2['prepaid_amount']=$amount;
          $save2['payment_name']='商城储值卡支付';
       }
    

       $res2=M('order_extend')->where($where2)->save($save2);
  #==================================================================

       if($res2)
       {
          #修改order表
            $where['id']=$order_id;

            $save=array(
                 'order_state'=>'confirm',
                 'payment_state'=>'payed',
                 'date_confirm'=>time(),
                 'date_pay'=>time(),
              );
            $res=M('order')->where($where)->save($save); 

       }
     
       if($res && $res2)
       {
         #清除轨迹
         session('center_flow',null);
          return true;
       }else{
          return false;
       }

    }

    /**
     * 获取订单号
     * @param  [type] $order_id [description]
     * @return [type]           [description]
     */
    public function getOrderSn($order_id)
    {
         $where['id']=$order_id;
         $res=M('order')->where($where)->field('order_sn')->find();
         return $res['order_sn'];
    }


/**
 * 删除订单
 * @param  [type] $order_id [description]
 * @return [type]           [description]
 */
public function deleteOrder($order_id)
{
      
      M('order')->where('id='.$order_id)->delete();
      M('order_extend')->where('order_id='.$order_id)->delete();
      M('order_goods')->where('order_id='.$order_id)->delete();
}

############################分销########################################################################################################################################
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



 #####################################提醒发货#########################################################################
 
/**
 * 判断发送的提醒是否已经过了一天了
 * @param  [type] $order_sn [description]
 * @return [type]           [description]
 */
public function sendMailed($order_sn)
{  
    $where=array(
        'order_sn'=>$order_sn,
        'date_send'=>array('GT',time()-3600*24),
      );
    $count=M('mail_log')->where($where)->count();
 
    if($count)
    {
      return true;
    }else{
        return false;
    }
}

/**
 * 写入或者更新邮件发送表
 * @param  [type] $order_sn [description]
 * @return [type]           [description]
 */
public function mailLog($order_sn)
{
    $where['order_sn']=$order_sn;
    $count=M('mail_log')->where($where)->count();
    if($count)
    {
       $save=array(
           'date_send'=>time(),
        );

       M('mail_log')->where($where)->save($save);
         
    }else{
        $add=array(
             'order_sn'=>$order_sn,
             'date_send'=>time(),
             'date_add'=>time(),
             'user_id'=>session('user_id'),
          );
        M('mail_log')->add($add);
    }

}




########################小屋屋########################################


/**
 *获取特殊商品的信息
 */

public function getSpecialGoods($goods_id)
{

    $condition=array(
        'g.id'=>$goods_id,
        'g.on_sale'=>'Y',
      );
    $res=M('Goods')->alias('g')->join('__GOODS_EXTEND__ ge ON ge.goods_id=g.id')
                   ->field('goods_name,shop_price,express_id,profit,pay_integral')
                   ->where($condition)
                   ->find();
    return $res;


}

/**
 * 获取特殊商品的邮费
 * @param  [type] $price      [description]
 * @param  [type] $express_id [description]
 * @return [type]             [description]
 */
public function getSpecialShipping($price,$express_id)
{
   $back=M('goods_express')->where('id='.$express_id)->field('free_amount')->find();

   if($price>=$back['free_amount'])
   {
      return 0;
   }else{
       return $back['free_amount'];
   }

 

}
/**
 * 生成特殊订单啦
 * @param  [type] $goods_id  [description]
 * @param  [type] $consignee [description]
 * @return [type]            [description]
 */
public function specialOrder($goods_id,$consignee)
{  


      $goods=$this->getSpecialGoods($goods_id);
      $shipping_fee=$this->getSpecialShipping($goods['shop_price'],$goods['express_id']);

     #初始化插入order表的数据===============================================
            $data_order=array(
                'user_id'=>session('user_id'),
                'shipping_state'=>'new',#快递状态 
                 'goods_fee'=>$goods['shop_price'],          #商品总额
                 'shipping_fee'=>$shipping_fee,       #邮费总额 
                 'date_add'=>time(),    #下单时间
                 'order_sn'=>'1990121055555',
                 'affiliate_user'=>0,#商品推荐人
                 'order_state'=>'new', #订单状态
                 'payment_state'=>'new',#支付状态
                 'date_confirm'=>0,    #订单确认时间
                 'date_pay'=>0,       #支付时间 
             );

           #商品推荐人
           if(cookie('affiliate_guser') && cookie('affiliate_guser')!=session('user_id') )
           {
                 $data_order['affiliate_user']=cookie('affiliate_guser');
           }
        
      $flag=0;
      do{

         $data_order['order_sn'] = get_order_sn(); 
         #尝试着插入表order
         $insert_id=M('order')->add($data_order);
         if($insert_id)
         {
            
             $flag=333;
         }

      }while($flag!=333);#不等于333,证明就不成功,则需要继续执行

      if(!$insert_id)
      {
          return false;
      }

   #初始化order_extend表中的数据####################################################################
      $data_order_extend=array(
         'order_id'=>$insert_id,
         'consignee'=>$consignee['consignee'],
         'country'=>'中国',
         'province'=>$consignee['province'],
         'city'=>$consignee['city'],
         'district'=>$consignee['district'],
         'address'=>$consignee['address'],
         'mobile'=>$consignee['mobile'],
       );

     $insert_extend=M('order_extend')->add($data_order_extend);

     if(!$insert_extend)
     {
         return false;
     }

     #插入order_goods表====================================================
     #新系统对于字段different取值是new

             $add=array(
                  'order_id'=>$insert_id,
                  'buy_flag'=>'normal',
                  'goods_id'=>$goods_id,
                  'goods_number'=>1,
                  'goods_price'=>$goods['shop_price'],
                  'different'=>'new',
                  'goods_name'=>$goods['goods_name'],
               );
             $exchange=M('order_goods')->add($add);



     if(!$exchange)
     {
         return false;
     }
    


  session('default_consignee',null);

    return array(
          'order_id'=>$insert_id,
          'order_sn'=>$data_order['order_sn'],
          );


}


}#类尾