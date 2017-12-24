<?php

namespace Computer\Model;
class UserBonusModel extends BaseModel
{

   /**
    * 取得合法红包信息
    * @param   int     $bonus_id    user_bonus的主键id
    * @param   array   红包信息
    */
   function bonusInfo($bonus_id,$min_order_amount) 
   {
       $where=array(
            'id'=>$bonus_id,
            'date_use'=>0,
            'use_start'=>array('LT',time()),
            'use_end'=>array('GT',time()),
            'min_order_amount'=>array('ELT',$min_order_amount),
         );
       return $this->where($where)
                  ->field('money AS bonus_money,bonus_name,min_order_amount')
                  ->find();
   }

   /**
    * 取得用户当前可用红包(且是没过期未使用的额)
    * @param   float   $goods_amount   订单商品金额
    * @return  array   红包数组
    */
   function userBonus($goods_amount) 
   {
       $where=array(
            'user_id'=>session('user_id'),
            'date_use'=>0,
            'use_start'=>array('LT',time()),
            'use_end'=>array('GT',time()),
            'min_order_amount'=>array('ELT',$goods_amount),
         );
     return $this->where($where)
                 ->field('id AS bonus_id,bonus_name,min_order_amount')
                 ->order('id desc')
                 ->select();
  }


   /**
   * 设置红包为已使用
   * @param   int     $bonus_id   红包id
   * @return  bool
   */
  public function usedBonus($bonus_id) 
  {
     return $this->where(array('id'=>$bonus_id))->save(array('date_use'=>time()));
  }
  
  





#死亡地带######################################
 




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


    /**
     * 购买商品赠送的红包
     * @param  [type] $bonus    [description]
     * @param  string $order_id [description]
     * @return [type]           [description]
     */
    public function giveBonus($order_id)
    {
      #==============================================================
        $time=time();
        #礼包除外
        $sql="SELECT og.goods_number,b.id,b.bonus_money FROM ztm_order_goods AS og LEFT JOIN ztm_bonus AS b ON og.goods_id=b.goods_id WHERE og.order_id='$order_id' AND b.send_start<=$time AND b.send_end >=$time AND og.buy_flag='normal'";
        $bonus=$this->query($sql);


        if($bonus[0])
        {

          #初始化一个数组，将赠送的红包id保存起来好存到order_extend表中，防止退款
          
            $bonus_ids=array();
            $user_bonus_model = D('UserBonus');

            foreach ($bonus as $key => $value) {
                   for($i=0;$i<$value['goods_number'];$i++)
                   {
                        $next_id = $user_bonus_model->next_primary();
                         $add['user_id']=$this->getOrderUserid($order_id);
                         $add['bonus_id']=$value['id'];
                         $add['date_add']=time();
                         $add['bonus_sn']='goods'.date('Ymd').$add['user_id'].$next_id;
                         $bonus_ids[]=$user_bonus_model->add($add);
                   }
            }


            #插入到order_extend表中
            $string=json_encode($bonus_ids);
            $where2['order_id']=$order_id;
            $save['bonus_get']=$string;
            return M('order_extend')->where($where2)->save($save);



        }
    
    


    }

 

}#类尾部