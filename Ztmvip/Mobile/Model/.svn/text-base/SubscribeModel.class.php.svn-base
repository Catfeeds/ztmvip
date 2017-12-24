<?php
namespace Mobile\Model;
class SubscribeModel extends BaseModel
{

    protected $tableName = 'user';

/**
 * 判断该微信用户是否已经注册了
 * @param  [type]  $open_id [description]
 * @return boolean          [description]
 */
    public function isRegistered($open_id)
    {
         $where=array(
               'wu.open_id'=>$open_id,
               'wu.user_id'=>array('gt',0),
               );

         return M('user')->alias('u')->join('__WECHAT_USER__  wu ON wu.user_id=u.id')->where($where)->count();
    }

/**
 * 获取注册信息
 * @param  [type] $open_id [description]
 * @return [type]          [description]
 */
    public function getRegisterInfo($open_id)
    {

       $res=M('user')->alias('u')->join('__WECHAT_USER__  wu ON wu.user_id=u.id')
                                 ->where('wu.open_id="'.$open_id.'"')
                                 ->field('u.id,u.date_add')
                                 ->find();
        $res['date_add']=date("Y年m月d日 H时i分s秒",$res['date_add']);
        $res['id']=$res['id']+1500000;
      
        return $res;
    }

    /**
     * 注册的时机：1.第一次授权的时候 2.关注事件发生的时候
     * 关注的时候进行注册(如果是已经注册过，则就更新最后关注时间就可以了)
     * @return [type] [description]
     */
    public function subscribe($open_id)
    {


                  try{
         
                      if($this->isRegistered($open_id))
                        E('registered');

                          $user_id = M('user')->add(
                               array('date_add'=>time())
                            );
                          if ($user_id) 
                              $weid = M('wechat_user')->add(array(
                                   'open_id' => $open_id,
                                   'user_id' => $user_id,
                                   'date_follow' => time(),
                                ));

                         if($weid)
                            E('success');
                  }catch(\Think\Exception $e){
                     $error=$e->getMessage();
                     switch ($error) {
                         case 'registered':

                             $true=M('wechat_user')->where(array('open_id'=>$open_id))->save(array('date_follow'=>time()));
                             if($true)
                                $registered=$this->getRegisterInfo($open_id);
                                $registered['code']='registered';
                                return $registered;
                             break;
                         case 'success':
                           $true=$this->giveRegisterThings($user_id);
                           if($true)
                             $success=$this->getRegisterInfo($open_id);
                             $success['code']='success';
                             return $success;  
                            break;                   
       
                         default:
                             # code...
                             break;
                     }
                  }
    }



/**
 * 扫描关注二维码，送你豪华大礼额
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
public function   giveRegisterThings($user_id,$parent_id='')
{

        //开始送红包，发送4个红包
        $bonus = array(100, 50, 30, 10);
        $time = time();
        $end_time = $time + 3600 * 24 * 30;
        $user_bonus_model = D('UserBonus');

        foreach ($bonus as $val) {

            if($parent_id)
            {
                //推荐人发红包
                $next_id = $user_bonus_model->next_primary();
                $user_bonus_model->add(array(
                    'user_id' => $parent_id,
                    'bonus_name' => '推荐送红包' . $val . '元',
                    'money' => $val,
                    'bonus_sn' => 'recommend'.date('Ymd').$user_id.$next_id,
                    'min_order_amount' => $val * 10,
                    'use_start' => $time,
                    'use_end' => $end_time,
                    'date_add' => $time
                ));
            }
  
            //注册人发红包
            $next_id = $user_bonus_model->next_primary();
            $user_bonus_model->add(array(
                'user_id' => $user_id,
                'bonus_name' => '注册送红包' . $val . '元',
                'money' => $val,
                'bonus_sn' => 'register'.date('Ymd').$user_id.$next_id,
                'min_order_amount' => $val * 10,
                'use_start' => $time,
                'use_end' => $end_time,
                'date_add' => $time
            ));
        }

  return true;

}
    /**
     * 取消关注的时候将关注时间设置为0
     * @param  [type] $open_id [description]
     * @return [type]          [description]
     */
    public function unsubscribe($open_id)
    {

        $save=array('date_follow'=>0);
        return M('wechat_user')->where(array('open_id'=>$open_id))->save($save);


    }
















}
