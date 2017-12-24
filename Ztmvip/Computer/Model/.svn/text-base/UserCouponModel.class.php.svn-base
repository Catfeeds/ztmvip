<?php

namespace Computer\Model;
class UserCouponModel extends BaseModel
{

   /**
    * 取得优惠券的信息
    * @param   int     $coupon_id   
    * @param   array   优惠券信息
    */
   function couponInfo($coupon_id,$min_order_amount) 
   {
       $where=array(
            'uc.id'=>$coupon_id,
            'uc.date_use'=>0,
            'c.use_start'=>array('LT',time()),
            'c.use_end'=>array('GT',time()),
            'c.min_order_amount'=>array('ELT',$min_order_amount),
         );

        return M('UserCoupon')->alias('uc')->join('__COUPON__ c ON uc.coupon_id=c.id')
                             ->where($where)
                             ->field('c.coupon_money,c.coupon_name')
                             ->find();
   }

   /**
    * 取得用户当前可用代金券(且是没过期未使用的额)
    * @param   float   $goods_amount   订单商品金额
    * @return  array   代金券数组
    */
   function userCoupon($goods_amount) 
   {


     $where=array(
            'uc.user_id'=>session('user_id'),
            'uc.date_use'=>0,
            'c.use_end'=>array('GT',time()),
            'c.use_start'=>array('LT',time()),
            'c.min_order_amount'=>array('ELT',$goods_amount),
         );
     return  M('Coupon')->alias('c')->join('__USER_COUPON__ uc ON uc.coupon_id=c.id')
                ->field('c.coupon_name,c.coupon_money,uc.id AS coupon_id,c.min_order_amount')
                ->where($where)
                ->select();
    }




    /**
     * 设置代金券为已使用
     * @param   int     $bonus_id   代金券id
     * @return  bool
     */
   public  function usedCoupon($coupon_id) 
  {
       return $this->where(array('id'=>$coupon_id))->save(array('date_use'=>time()));
  }


}#类尾部