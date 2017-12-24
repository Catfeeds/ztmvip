<?php

namespace Mobile\Model;
use Think\Model;

class CenterModel extends Model{

  protected $tableName='order';  



  /**
   * 获取收货地址
   * @param  [type] $order_id [description]
   * @return [type]           [description]
   */
   public function getConsignee($order_id)
   {
        $where['order_id']=$order_id;
        return M('order_extend')->where($where)
                         ->field('consignee,province,city,district,address,mobile')
                         ->find();
   }


   /**
    * 获得用户再次购买的时候的选择
    * 这里的选择都是死的，只有支付方式是变的而已
    *
    * @access  private
    * @return  array
    */
  public  function flowOrderInfo($order_id)
   {
    
       $where['order_id']=$order_id;
       $order=M('order_extend')->where($where)
                        ->field('coupon_id,bonus_id,integral')
                        ->find();

        if(session('center_order') && session('center_order.unique')==$order_id)
        {
          $order['payment_name'] =session('center_order.payment_name');
          $order['prepaid_id']=session('center_order.prepaid_id');

        }else{
            $order['payment_name']='wx';
            $order['prepaid_id']=0;
        }
   
      return $order;
      
   }








      /**
       * checkout页面取得购物车商品
       * @return  array  
       */
  public   function checkGoods($order_id) 
  {

        $where['order_id']=$order_id;

        $cart_list=M('order_goods')->where($where)->select();
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

                if($value['different']=='new')
                {
                $value['skus']=json_decode($value['skus'],true);
                }
             $reback[]=$value;

     }

     return $reback;
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
  function orderFee($order_id) 
 {

      $sql="SELECT o.goods_fee,o.shipping_fee,oe.bonus_id,oe.bonus_amount,oe.coupon_id,oe.coupon_amount,oe.integral,oe.integral_amount FROM `ztm_order` AS o LEFT JOIN `ztm_order_extend` AS oe ON o.id=oe.order_id WHERE o.id=$order_id"; 
      $res=M()->query($sql);

      #初始化
         $total = array(
             'goods_price' =>$res[0]['goods_fee'], #商品总额
             'shipping_fee' =>$res[0]['shipping_fee'], #邮费
             'bonus_amount'=>$res[0]['bonus_amount'],
             'coupon_amount'=>$res[0]['coupon_amount'],
             'integral_amount'=>$res[0]['integral_amount'],
         );
      
   $total['amount']=$total['goods_price']+$total['shipping_fee']-$total['bonus_amount']-$total['coupon_amount']-$total['integral_amount'];
    return $total;
 }

















}#类尾部