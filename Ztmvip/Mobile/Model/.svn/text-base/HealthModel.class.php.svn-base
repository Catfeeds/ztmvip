<?php

namespace Mobile\Model;
use Think\Model;

class HealthModel extends Model{

  protected $dbName="heals";
  protected $tablePrefix="hls_";
  protected $tableName='user';  



/**
 * 判断今日数据是否已经提交过了
 * @return boolean [description]
 */
public function isSubmited()
{ 
     $start=strtotime(date('Y-m-d 00:0:0'));
     $end=strtotime(date('Y-m-d 24:0:0'));
     $condition['user_id']=session('user_id');
     $condition['date_add']=array('BETWEEN',array($start,$end));

     return M('heals.UserExamine','hls_')->where($condition)->count();

     
}
/**
 * 判断当前用户时候存在
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
public function existUser($user_id)
{
     return  $this->where('ztm_user='.$user_id)->count();
}

/**
 * 购买的时候顺便同步地址过来
 */
public function  informal_register($order_id)
{
    
  
   $address=$this->getOrderAddress($order_id);
   $address['date_add']=time();
   return $this->add($address);
    
}


/**
 * 获取具体某个订单的地址
 * @param  [type] $order_id [description]
 * @return [type]           [description]
 */
public function getOrderAddress($order_id)
{


          $where['o.id']=$order_id;

          return M('order')->alias('o')->join('__ORDER_EXTEND__ oe ON oe.order_id=o.id')
                                ->field('o.user_id AS ztm_user,oe.consignee AS user_name,oe.mobile,oe.country,oe.province,oe.city,oe.district')
                                ->where($where)
                                ->find();
}





  /**
    * 检查注册人信息是否完整
    * @return  bool    true 完整 false 不完整
    */
   function checkRegisterInfo($person) 
   {
           $res =  !empty($person['user_name']) &&
                   !empty($person['sex'])  &&
                   !empty($person['birthday']) &&
                   !empty($person['mobile']) &&
                   !empty($person['height']) &&
                   !empty($person['weight']) &&
                   !empty($person['fat']) &&
                   !empty($person['metabolize']) &&
                   !empty($person['waistline']) &&
                   !empty($person['hipline']);
            if($person['sex']=='female')
            {
                                    $res=$res &&  
                  !empty($person['last_red']) &&
                  !empty($person['red_keep']) &&
                  !empty($person['red_period']);
            }

          return $res;
   
   }



/**
 * 判断是否购买了该方案
 * @return [type] [description]
 */
public function checkIsBuy()
{

    $where['ztm_user']=session('user_id');
    return $this->where($where)->count();
    
}



/**
 * 进一步更新注册信息
 */

public function updateRegister($info)
{  


  //替换时间格式
      $info['birthday']=strtotime($info['birthday']);
      if($info['sex']=='female')
      $info['last_red']=strtotime($info['last_red']);



//更新或者不更新user表
      $where['ztm_user']=session('user_id');
      $res=$this->where($where)->save($info);

//添加今日提交的数据进入 user_examine表

     
      $condition['user_id']=session('user_id');
      $info['date_add']=time();
      $info['user_id']=session('user_id');
      return M('heals.UserExamine','hls_')->where($condition)->add($info);


    
  

}


/**
 * 如果已经填过一次了，则获取不可以更改的信息字段
 * @return [type] [description]
 */
public function  noallowInfo()
{
   $user_id=session('user_id');
   //必须是已经注册先
   $count=M('heals.UserExamine','hls_')->where('user_id='.$user_id)->count();
    if($count)
    {
        return $this->where('ztm_user='.$user_id)->find();
    }else{
         return false;
    }
  
    

}



}#类尾