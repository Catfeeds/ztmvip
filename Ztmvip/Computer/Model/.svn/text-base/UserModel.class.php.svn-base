<?php
namespace Computer\Model;
class UserModel extends \Common\Model\UserCommonModel
{
    //获得下属用户
    public function affiliate_users($user_id, $deep = 3, $now_deep = 0)
    {
        $user_id = is_array($user_id) ? $user_id : array($user_id);
        $user = $this->where(array('parent_id' => array('in', $user_id)))->getField('id', true);

        if ($user && $now_deep < $deep - 1) {
            $deep_user = $this->affiliate_users($user, $deep, $now_deep + 1);
            if ($deep_user)
                $user = array_merge($user, $deep_user);
        }

        return $user ?: array();
    }

    //是否登录
    public function isLogin()
    {
        $is_login = false;  //是否登录
        //session('user_id',19023);
        if ( !session('user_id')){
            if ( cookie('wechat_token') ) {
                $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                $token = base64_decode(cookie('wechat_token'));
                $userid = $mem->get('userid_'. $token);

                if ($userid ){
                    session('user_id',$userid);
                    $is_login = true;
                }else{
                    cookie('wechat_token',null);
                }
            }
        }else{
            $is_login = true;
        }
        return $is_login;
    }

    //会员登录
    public function login($user_id)
    {
        $user = $this->field('id,mobile')->where(array('id' => $user_id))->find();

        if (!$user)
            return false;

        $session_id = session_id();
        if (I('remember') == 'ok') {
            cookie('wechat_token', base64_encode($session_id), 7200);
            $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
            $mem->set('userid_' . $session_id, $user_id, 7200);
        }

        session('user_id', $user_id);
        return true;
    }

    //会员登出
    public function out()
    {
        session('user_id', null);
        $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
        $mem->rm('userid_' . session_id());
        $mem->rm('wechat_openid_' . session_id());
        cookie('wechat_token',null);
    }

    //个人中心获取个人信息
    public function getUserInfo()
    {
        $user_id = session('user_id');
        $info = D('User')->alias('uu')->field('uu.*,up.user_name as parent_name')
            ->join('left join __USER__ up on uu.parent_id = up.id')->where(array('uu.id' => $user_id))->find();


        $info['real_money'] = $this->real_money($user_id);

        return $info;
    }

    /**
     * 插入会员账目明细
     *
     */
    public function addUserAccountLog($order) {
        $model = M('user_account_log');
        $data['user_id'] = $order['user_id'];
        $data['account_sn'] = $order['order_sn'];
        $data['amount'] = $order['order_amount'];
        $data['source_type'] = 'money';
        $data['change_type'] = 'deposit';
        $data['payment'] = '支付宝支付';
        $data['manager_id'] = 0;
        $data['user_note'] = '';
        $data['manager_note'] = '';
        $data['date_add'] = time();
        $data['date_pay'] = 0;
        return $model->add($data);
    }
    //验证微信支付回调数据
    public function userAccountIsPay($order_sn){
        $order = M('UserAccountLog')->field('account_sn,id,amount,date_pay,user_id')->where(array('account_sn'=>$order_sn))->find();
        if($order['date_pay']>0){
            return true;
        }else{
            return $order;
        }
    }
    //支付成功后，操作业务
    public function userAccountPaid($order,$transaction_id){
        $update = M('UserAccountLog')->where(array('id'=>$order['id']))->save(array('date_pay'=>time(),'payment_no'=>$transaction_id));
        $data['change_type'] = 'deposit';
        $data['user_id'] = $order['user_id'];
        $data['user_money'] = $order['amount'];
        $data['change_desc'] = '支付宝支付，充值订单 '.$order['account_sn'];
        $data['date_add'] = time();
        if($update !== false && M('AccountLog')->add($data)){
            M('User')->where(array('id'=>$order['user_id']))->setInc('user_money',$order['amount']);
            return true;
        }
        return false;
    }



/***********  below belongs to author  of sansheng ***************************************************/
/**
 * 获取当前用户的消费积分
 * @return [type] [description]
 */
public function yourIntegral()
{
    return $this->where(array('id'=>session('user_id')))->getField('integral');
}


/**
 * 获得用户的可用积分
 *
 * @access private
 * @return integral
 */
public function allowIntegral() 
{  
    $where=array(
            'c.buy_flag'=>'normal',
            'c.selected'=>'Y',
            'ge.pay_integral'=>array('gt',0),
            'c.user_id'=>session('user_id'),
         );
    $back=M('Cart')->alias('c')->join('__GOODS_EXTEND__ ge ON c.goods_id=ge.goods_id')
                         ->field('SUM(ge.pay_integral * c.goods_number) AS sum')
                         ->where($where)
                         ->find();
    return intval($back['sum']);
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
function logIntegral($integral,$user_id=0) 
{         


           $account_log = array(
               'user_id' =>$user_id?$user_id:session('user_id'),
               'integral' =>$integral['integral'],
               'date_add' =>time(),
               'change_desc' => $integral['change_desc'],
               'change_type' => $integral['change_type'],
           );
           $log_id=M('Account_log')->add($account_log);

           /* 上述是做记录，下面是正式更改变动 */

           return $this->where(array('id' =>$user_id?$user_id:session('user_id')))
               ->setDec('integral',$integral['integral']);

 }

/**
 *对余额进行记录
 */

 function logUserMoney($user_money,$user_id=0) 
 {         
            $account_log = array(
                'user_id' =>$user_id?$user_id:session('user_id'),
                'user_money' =>$user_money['user_money'],
                'date_add' =>time(),
                'change_desc' => $user_money['change_desc'],
                'change_type' => $user_money['change_type'],
            );
            $log_id=M('Account_log')->add($account_log);

            /* 上述是做记录，下面是正式更改变动 */

            return $this->where(array('id' =>$user_id?$user_id:session('user_id')))
                ->setDec('user_money',$user_money['user_money']);
  }

 /**
  * 罗列用户的储值卡
  * @return [type] [description]
  */
 public function userCards()
 {
       $where=array(
                   'user_id'=>session('user_id'),
                   'money'=>array('gt',0),
                  );
       $cards=M('User_prepaid')->where($where)
                               ->field('id,prepaid_sn,money')
                               ->select();
       if(!$cards){
           return false;
       }else{
            $new=array();
            foreach ($cards as $key => $value){
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

      $card=M('user_prepaid')->where(array('user_id'=>session('user_id'),'id'=>$prepaid_id))->field('money')->find();
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
 /**
  * 判断商城密码是否正确
  * @param  [type] $password [description]
  * @return [type]           [description]
  */
 public function checkPasswordTrue($password)
 {
      #为防止灌水，还是重复着先判断该条记录的存在性之后再判断密码正确性吧
      
      $where['id']=session('user_id');
      $record=$this->where(array('id'=>session('user_id')))->field('id,payment_password')
                       ->find();

      if(!$record)
        return false;
  
       $md5password=md5(md5($password));
       if($md5password==$record['payment_password']) {
           return true;
       }else{
           return false;
       }

 }


 /**
  * 用户真实余额
  * @param $user_id 会员id
  * @return float
  */
 public function real_money($user_id){
     //总金额
     $account_money = D('AccountLog')->field('SUM(user_money)+SUM(frozen_money) AS money')
         ->where(array('source_type' => 'money', 'user_id' => $user_id))->find();

     $account_money = $account_money['money'];
     //已申请未转账金额
     $withdraw_money = D('UserAccountLog')->where(array('source_type' => 'money', 'change_type' => 'withdraw', 'date_pay' => 0, 'user_id' => $user_id))->sum('amount');

     return round($account_money + $withdraw_money,2);
 }






}#类尾