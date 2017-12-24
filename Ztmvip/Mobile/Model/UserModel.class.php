<?php
namespace Mobile\Model;
class UserModel extends \Common\Model\UserCommonModel
{
    //获得下属用户
    public function affiliate_users($user_id,$deep=3,$now_deep=0){
        $user_id = is_array($user_id) ? $user_id : array($user_id);
        $user = $this->where(array('parent_id'=>array('in',$user_id)))->getField('id',true);

        if ( $user && $now_deep < $deep - 1 ){
            $deep_user = $this->affiliate_users($user,$deep,$now_deep+1);
            if ( $deep_user )
                $user = array_merge($user,$deep_user);
        }

        return $user?:array();
    }

###################个人中心首页####################################################
    public function getHeader(){
        $user_id = session('user_id');
        $sql = "SELECT u.user_name,u.parent_id,u.user_money,u.frozen_money,u.integral,u.mobile, wu.nick_name,wu.avatar FROM ztm_user AS u LEFT JOIN ztm_wechat_user AS wu ON u.id=wu.user_id WHERE u.id=$user_id";
        $res = $this->query($sql);

        $info = $res[0];
        if ($info['parent_id'] > 0) {
            $sql = "SELECT u.user_name,wu.nick_name FROM ztm_user AS u LEFT JOIN ztm_wechat_user AS wu ON u.id=wu.user_id WHERE
        u.id={$info[parent_id]}";
            $res = $this->query($sql);
            $info['parent_name'] = $res[0]['nick_name'];
        } else {
            $info['parent_name'] = '官网';
        }
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
        $data['payment'] = '微信安全支付';
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
        M('UserAccountLog')->where(array('id'=>$order['id']))->save(array('date_pay'=>time(),'payment_no'=>$transaction_id));
        $data['change_type'] = 'deposit';
        $data['user_id'] = $order['user_id'];
        $data['user_money'] = $order['amount'];
        $data['change_desc'] = '充值订单 '.$order['account_sn'];
        $data['date_add'] = time();
        if(M('AccountLog')->add($data)){
            M('User')->where(array('id'=>$order['user_id']))->setInc('user_money',$order['amount']);
        }else{

        }
    }
}
?>