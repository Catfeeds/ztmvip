<?php
/**
 * 会员返佣控制器
 * author: Tom
 */
namespace Computer\Controller;
class AffiliateController extends UserBaseController
{
    protected $affiliate_model,$user_model;

    public function _initialize(){
        parent::_initialize();

        $this->affiliate_model = D('AffiliateLog');
        $this->user_model = D('User');
    }

    //提现&转余
    public function withdraw(){
        $user = $this->user_model->find($this->user_id);
        if(IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，申请提交成功',
            );
            $post = I('post.');
            $post['money'] = floatval($post['money']);

            try {

                $user_account_model = D('UserAccountLog');

                if (!$user['mobile'] || !$user['answer'] || !$user['bank_card'])
                    E('抱歉，请先设置您的安全信息<script>setTimeout(function(){location.href="' . U('User/safetyAll', 'redirect=' . base64_encode($_SERVER['HTTP_REFERER'])) . '";},2000);</script>');

                if ($user['payment_password'] != $this->user_model->compile_password($post['payment_password']))
                    E('抱歉，支付密码错误');

                //总金额
                $affiliate_money = $this->affiliate_model->where(array('rebate_user' => $this->user_id, 'separated' => 'Y'))->sum('money');
                //已申请金额
                $withdraw_money = $user_account_model->where(array('source_type' => 'affiliate', 'change_type' => 'withdraw', 'user_id' => $this->user_id))->sum('amount');
                //未处理的金额
                $wait_money = $user_account_model->where(array('source_type' => 'affiliate', 'change_type' => 'withdraw', 'user_id' => $this->user_id, 'date_pay' => 0))->sum('amount');

                if ($wait_money)
                    E('抱歉，还有未处理的提现申请');
                if ($post['money'] > $affiliate_money + $withdraw_money)
                    E('抱歉，申请的金额超出可提现额度');

                //提现
                if ($post['action'] == 'withdraw') {
                    if ($post['money'] < 500)
                        E('抱歉，佣金最低提现金额为500');

                    $data = array(
                        'user_id' => $this->user_id,
                        'account_sn' => uniqid() . rand(100, 999),
                        'amount' => -$post['money'],
                        'source_type' => 'affiliate',
                        'change_type' => 'withdraw',
                        'date_add' => time(),
                    );
                    if (!$user_account_model->add($data))
                        E('抱歉，提交失败，请联系客服人员');

                    //转入余额
                } else {
                    $data = array(
                        'user_id' => $this->user_id,
                        'account_sn' => uniqid() . rand(100, 999),
                        'amount' => -$post['money'],
                        'source_type' => 'affiliate',
                        'change_type' => 'withdraw',
                        'payment' => '会员余额',
                        'user_note' => '会员佣金转入余额',
                        'date_add' => time(),
                        'date_pay' => time(),
                    );
                    if (!$user_account_model->add($data))
                        E('抱歉，提交失败，请联系客服人员');

                    //变动日志
                    $id = D('AccountLog')->add(array(
                        'user_id' => $this->user_id,
                        'source_type' => 'affiliate',
                        'change_type' => 'deposit',
                        'user_money' => $post['money'],
                        'change_desc' => '会员佣金转入余额',
                        'date_add' => time(),
                    ));
                    if (!$id)
                        E('抱歉，提交失败，请联系客服人员');

                    //加入用户余额
                    $this->user_model->update_money($this->user_id);
                }
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        if (!$user['mobile'] || !$user['answer'] || !$user['bank_card']){
            $this->assign('message','抱歉，请先设置您的安全信息');
            $this->assign('url',U('User/safetyAll', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));
            $this->assign('page_title','错误信息');
            $this->display('error');
            exit;
        }

        $account_model = D('UserAccountLog');
        $affiliate_count = array(
            'withdraw_money' => $account_model->where(array('user_id'=>$this->user_id,'source_type'=>'affiliate','change_type'=>'withdraw','date_pay'=>array('gt',0)))->sum('amount'),
            'wait_money' => $account_model->where(array('user_id'=>$this->user_id,'source_type'=>'affiliate','change_type'=>'withdraw','date_pay'=>0))->sum('amount'),
            'count_money' => $this->affiliate_model->where(array('rebate_user'=>$this->user_id,'separated'=>'Y'))->sum('money'),
        );

        $withdraw_money = $affiliate_count['count_money'] + $affiliate_count['withdraw_money'] + $affiliate_count['wait_money'];

        $this->assign('withdraw_money',$withdraw_money);
        $this->assign('page_title','返利申请提现');
        $this->display();
    }

    public function inBalance()
    {
        $user = $this->user_model->find($this->user_id);
        $account_model = D('UserAccountLog');
        $affiliate_count = array(
            'withdraw_money' => $account_model->where(array('user_id'=>$this->user_id,'source_type'=>'affiliate','change_type'=>'withdraw','date_pay'=>array('gt',0)))->sum('amount'),
            'wait_money' => $account_model->where(array('user_id'=>$this->user_id,'source_type'=>'affiliate','change_type'=>'withdraw','date_pay'=>0))->sum('amount'),
            'count_money' => $this->affiliate_model->where(array('rebate_user'=>$this->user_id,'separated'=>'Y'))->sum('money'),
        );

        $withdraw_money = $affiliate_count['count_money'] + $affiliate_count['withdraw_money'] + $affiliate_count['wait_money'];

        $this->assign('withdraw_money',$withdraw_money);
        $this->assign('page_title','返利转入余额');
        $this->display();
    }


    public function desc()
    {
        $this->assign('page_title','什么是返利');
        $this->display();
    }

    //分佣明细
    public function log(){
        $map = array(
            'rebate_user' => $this->user_id,
            'separated' => 'Y',
        );
        $count = $this->affiliate_model->where($map)->count();
        $page = $this->page($count);
        $log = $this->affiliate_model
            ->where(array('rebate_user'=>$this->user_id,'separated'=>'Y'))
            ->limit($page->firstRow.','.$page->listRows)
            ->order('id DESC')->select();

        $this->assign('log',$log);

        $this->assign('page_title','分佣明细');
        $this->display();
    }
}