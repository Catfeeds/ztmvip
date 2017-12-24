<?php
/**
 * 会员基础模型
 * author: Tom
 */
namespace Common\Model;
class UserCommonModel extends \Think\Model\RelationModel
{
    //编译密码
    static public function compile_password($password){
        return md5(md5($password));
    }

    /**
     * 会员金额操作
     * @param $user_id 会员id
     * @param $money 操作金额
     * @param $change_type 操作类型
     * @param string $notice 操作备注
     * @return bool 返回值
     */
    public function change_money($user_id,$money,$change_type,$notice=''){
        try{
            $this->where(array('id'=>$user_id))->save(array('user_money'=>$money));

            D('AccountLog')->add(array(
                'user_id' => $user_id,
                'change_type' => $change_type,
                'user_money' => $money,
                'change_desc' => $notice,
                'date_add' => time(),
            ));
        }catch (\Think\Exception $e){
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

    /**
     * 更新会员表金额
     * @param $user_id 会员id
     */
    public function update_money($user_id){
        M()->execute('UPDATE __USER__ AS u SET user_money=(SELECT SUM(user_money) FROM __ACCOUNT_LOG__ WHERE user_id=u.id) WHERE u.id='. $user_id);
        M()->execute('UPDATE __USER__ AS u SET frozen_money=(SELECT SUM(amount) FROM __USER_ACCOUNT_LOG__ WHERE source_type="money" AND change_type="withdraw" AND date_pay=0 AND date_refuse=0 AND user_id=u.id) WHERE u.id='. $user_id);;
    }
}