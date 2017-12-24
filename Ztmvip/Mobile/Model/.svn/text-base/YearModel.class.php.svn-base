<?php

namespace Mobile\Model;
use Think\Model;

class YearModel extends Model{


  protected $tableName='user_bonus';  

#########################################

/**
 * 判断是否已经领了某个红包了
 * @param  [type]  $bonus [description]
 * @return boolean        [description]
 */
public function isGetBonus($bonus_id)
{


     return $this->where(array(
                            'user_id'=>session('user_id'),
                            'bonus_id'=>$bonus_id,
                           ))->count();

}



/**
 * 发送红包啦
 * @param  [type] $bonus_id [description]
 * @return [type]           [description]
 */
public function sendBonus($bonus_id)
{
    

    $info=$this->bonusInfo($bonus_id);
 

    if(!$info)
        return false;
    $info['user_id']=session('user_id')?session('user_id'):0;
    $info['bonus_id']=$bonus_id;
    $info['money']=$info['bonus_money'];
    $info['date_add']=time();
    $info['bonus_sn']='year'.time().'ztmvip'.str_pad(mt_rand(1, 99999),5,'0',STR_PAD_LEFT);
    unset($info['id']);

     return $this->add($info);


   
}


/**
 * 获取固定红包的信息
 * @param  [type] $bonus_id [description]
 * @return [type]           [description]
 */
public function  bonusInfo($bonus_id)
{
   $map=array(
         'id'=>$bonus_id,
         // 'send_start'=>array('elt',time()),
         'send_end'=>array('egt',time()),
      );
   return M('bonus')->where($map)->find();

}



}#类尾