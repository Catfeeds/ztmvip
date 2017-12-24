<?php
/**
 * 会员中心控制器
 * author: Tom
 */
namespace Mobile\Controller;
class UserController extends UserBaseController
{
    protected $user_model;

    public function _initialize()
    {
        parent::_initialize();

        $this->user_model = D('User');
    }

    //银行卡绑定
    public function bank()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->_empty(302,'抱歉，请先将您的手机绑定到账户',U('mobile','redirect='.base64_encode($_SERVER['REQUEST_URI'])));

        if (!$user['answer'])
            $this->_empty(302,'抱歉，请先设置您的安全问题',U('question','redirect='.base64_encode($_SERVER['REQUEST_URI'])));

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，银行卡绑定成功',
            );
            $post = I('post.');
            $sms_model = D('SmsLog');

            try {
                if (!$post['bank_name'])
                    E('抱歉，请输入开户行');
                if (!preg_match('/\d{16,}/i', $post['bank_card']))
                    E('抱歉，请输入有效的银行卡号');
                if (!$post['bank_user'])
                    E('抱歉，请输入开户名');

                $sms_code = $sms_model->where(array('mobile' => $user['mobile'], 'topic' => 'userBank'))->order('id DESC')->getField('content');
                if (md5($post['sms_code']) != $sms_code)
                    E('抱歉，短信验证码错误');

                if ($this->user_model->compile_password($post['answer']) != $user['answer'])
                    E('抱歉，安全问题答案错误');

                $data = array_intersect_key($post, array_flip(array(
                    'bank_name',
                    'bank_card',
                    'bank_user',
                )));

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('user', $user);

        $this->assign('page_title', '绑定银行卡');
        $this->display();
    }

    //红包
    public function bonus()
    {
        $bonus_model = D('UserBonus');

        $map = array(
            'user_id' => $this->user_id,
        );
        switch (I('post.state')) {
            case 'used':
                $map['date_use'] = array('gt', 0);
                break;
            case 'expired':
                $map['date_use'] = 0;
                $map['use_end'] = array('elt', time());
                break;
            default:
                $map['date_use'] = 0;
                $map['use_end'] = array('gt', time());
                break;
        }
        $bonus = $bonus_model->where($map)->order('id DESC')->select();

        if (IS_POST && IS_AJAX)
            $this->ajaxReturn($bonus ?: array());
        else
            $this->assign('bonus', $bonus);

        //红包数统计
        $bonus_count = array(
            'new' => $bonus_model->where(array('date_use' => 0, 'use_end' => array('gt', time()), 'user_id' => $this->user_id))->count(),
            'used' => $bonus_model->where(array('date_use' => array('gt', 0), 'user_id' => $this->user_id))->count(),
            'expired' => $bonus_model->where(array('date_use' => 0, 'use_end' => array('elt', time()), 'user_id' => $this->user_id))->count(),
        );
        $this->assign('bonus_count', $bonus_count);

        $this->assign('page_title', '我的优惠券');
        $this->display();
    }

    //优惠券
    public function coupon()
    {
        $coupon_model = D('UserCoupon');

        $map = array(
            'uc.user_id' => $this->user_id,
        );
        switch (I('post.state')) {
            case 'used':
                $map['uc.date_use'] = array('gt', 0);
                break;
            case 'expired':
                $map['uc.date_use'] = 0;
                $map['c.use_end'] = array('elt', time());
                break;
            default:
                $map['uc.date_use'] = 0;
                $map['c.use_end'] = array('gt', time());
                break;
        }
        $coupon = $coupon_model->alias('uc')->field('uc.*,c.coupon_money,c.min_order_amount,c.use_start,c.use_end')
            ->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where($map)->order('uc.id DESC')->select();

        if (IS_POST && IS_AJAX)
            $this->ajaxReturn($coupon ?: array());
        else
            $this->assign('coupon', $coupon);

        //优惠券数统计
        $coupon_count = array(
            'new' => $coupon_model->alias('uc')->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where(array('uc.date_use' => 0, 'c.use_end' => array('gt', time()), 'uc.user_id' => $this->user_id))->count(),
            'used' => $coupon_model->where(array('date_use' => array('gt', 0), 'user_id' => $this->user_id))->count(),
            'expired' => $coupon_model->alias('uc')->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where(array('uc.date_use' => 0, 'c.use_end' => array('elt', time()), 'uc.user_id' => $this->user_id))->count(),
        );
        $this->assign('coupon_count', $coupon_count);

        $this->assign('page_title', '我的优惠券');
        $this->display();
    }

    public function index()
    {
        //会员等级名称等信息
        $info = $this->user_model->getHeader();
        $this->assign('info', $info);

        //订单统计
        $order_model = D('Order');
        $order_count = array(
            'new' => $order_model->where(array('user_id'=>$this->user_id, 'order_state'=>'new', 'payment_state'=>array('in',array('new','paying')), 'shipping_state'=>'new'))->count(),
            'payed' => $order_model->where(array('user_id'=>$this->user_id, 'order_state'=>'confirm', 'payment_state'=>'payed', 'shipping_state'=>'new'))->count(),
            'send' => $order_model->where(array('user_id'=>$this->user_id, 'order_state'=>'confirm', 'payment_state'=>'payed', 'shipping_state'=>'send'))->count(),
            'receive' => $order_model->where(array('user_id'=>$this->user_id, 'order_state'=>'confirm', 'shipping_state'=>'receive'))->count(),
            'refund' => $order_model->where(array('user_id'=>$this->user_id, 'order_state'=>array('in',array('refund','refunded','finish'))))->count(),
        );
        $this->assign('order_count', $order_count);

        $qrcode = U('Qrcode/index', 'text=' . base64_encode(U('Index/index', 'u=' . $this->user_id, 'html', true)));
        $this->assign('qrcode', $qrcode);

        $weObj = new \Common\Vendor\Wechat();
        $signPackage = $weObj->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
        $this->assign('signPackage',$signPackage);

        $this->assign('page_title', '会员中心');
        $this->display();
    }

    //会员信息
    public function info()
    {
        $info = $this->user_model->getHeader();
        $this->assign('info', $info);

        $this->assign('page_title', '会员信息');
        $this->display();
    }

    //手机绑定
    public function mobile()
    {
        $user = $this->user_model->find($this->user_id);

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，手机绑定成功',
            );
            $post = I('post.');
            $sms_model = D('SmsLog');

            try {
                if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile']))
                    E('抱歉，手机号码格式错误');

                if ($user['mobile']) {
                    if ($user['mobile'] == $post['mobile'])
                        E('抱歉，新旧手机号码重复');

                    $sms_code = $sms_model->where(array('mobile' => $user['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                    if ($user['mobile'] && md5($post['old_sms_code']) != $sms_code)
                        E('抱歉，原手机短信验证码错误');
                }

                $sms_code = $sms_model->where(array('mobile' => $post['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                if ($post['mobile'] && md5($post['sms_code']) != $sms_code)
                    E('抱歉，新手机短信验证码错误');

                if ($user['answer'] && $this->user_model->compile_password($post['answer']) != $user['answer'])
                    E('抱歉，安全问题答案错误');

                $this->user_model->where(array('id' => $this->user_id))->save(array('mobile' => $post['mobile']));
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('user', $user);

        $this->assign('page_title', '会员手机');
        $this->display();
    }

    //余额
    public function money()
    {
        $account_model = D('UserAccountLog');
        $map = array(
            'user_id' => $this->user_id,
            'source_type' => 'money',
        );

        switch (I('post.state')) {
            case 'withdraw':
                $map['change_type'] = 'withdraw';
                break;
            default:
                $map['change_type'] = 'deposit';
                break;
        }

        $account = $account_model->where($map)->select();
        if (IS_POST && IS_AJAX)
            $this->ajaxReturn($account ?: array());
        else
            $this->assign('account', $account);

        $user = $this->user_model->find($this->user_id);
        $this->assign('user', $user);

        $this->assign('page_title', '我的余额');
        $this->display();
    }

    //售后说明
    public function notice()
    {
        $this->assign('page_title', '售后说明');
        $this->display();
    }

    //我的订单
    public function order()
    {
        $map = array(
            'user_id' => $this->user_id,
        );

        switch (I('get.state') ?: I('post.state')) {
            case 'payed':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'new';
                break;
            case 'send':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'send';
                break;
            case 'receive':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'receive';
                break;
            case 'refund':
                $map['order_state'] = array('in', array('refund','refunded','finish'));
                $map['payment_state'] = 'payed';
                break;
            default:
                $map['order_state'] = 'new';
                $map['payment_state'] = array('in',array('new','paying'));
                $map['shipping_state'] = 'new';
                break;
        }

        $order = D('Order')->field('id,order_sn,order_state,payment_state,shipping_state,date_pay')->where($map)->order('id DESC')->select();
        $order_goods_model = D('OrderGoods');
        foreach ($order as &$val) {
            $val['goods'] = $order_goods_model->alias('og')->field('og.goods_id,og.goods_number,og.goods_price,og.skus,og.different,g.goods_name,g.goods_thumb,g.on_sale')
                ->join('__GOODS__ AS g ON g.id=og.goods_id')
                ->where(array('og.order_id' => $val['id']))->select();
        }
        unset($val);

        if (IS_POST && IS_AJAX)
            $this->ajaxReturn($order ?: array());
        else
            $this->assign('order', $order);

        $this->assign('state', I('get.state'));

        $this->assign('page_title', '我的订单');
        $this->display();
    }

    //登录密码
    public function password()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->_empty(302,'抱歉，请先将您的手机绑定到账户',U('mobile','redirect='.base64_encode($_SERVER['REQUEST_URI'])));

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，登录密码设置成功',
            );
            $post = I('post.');

            try {
                $sms_code = D('SmsLog')->where(array('mobile' => $user['mobile'], 'topic' => 'userPassword'))->order('id DESC')->getField('content');
                if ( md5($post['sms_code']) != $sms_code )
                    E('抱歉，短信验证码错误');
                if ( !$post['password'] )
                    E('抱歉，请设置登录密码');
                if ( $post['password'] != $post['repassword'] )
                    E('抱歉，登录密码前后不一致');

                $data = array_intersect_key($post, array_flip(array(
                    'password',
                )));
                $data['password'] = $this->user_model->compile_password($data['password']);

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('user', $user);

        $this->assign('page_title', '设置登录密码');
        $this->display();
    }

    //支付密码
    public function payword()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->_empty(302,'抱歉，请先将您的手机绑定到账户',U('mobile','redirect='.base64_encode($_SERVER['REQUEST_URI'])));

        if (!$user['answer'])
            $this->_empty(302,'抱歉，请先设置您的安全问题',U('question','redirect='.base64_encode($_SERVER['REQUEST_URI'])));

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，支付密码设置成功',
            );
            $post = I('post.');
            $sms_model = D('SmsLog');

            try {
                if (!$post['payment_password'] || mb_strlen($post['payment_password']) != 6)
                    E('抱歉，请输入6位支付密码');
                if ($post['payment_password'] != $post['repayment_password'])
                    E('抱歉，支付密码前后不一致');

                $sms_code = $sms_model->where(array('mobile' => $user['mobile'], 'topic' => 'userPayword'))->order('id DESC')->getField('content');
                if (md5($post['sms_code']) != $sms_code)
                    E('抱歉，短信验证码错误');

                if ($this->user_model->compile_password($post['answer']) != $user['answer'])
                    E('抱歉，安全问题答案错误');

                $data = array_intersect_key($post, array_flip(array(
                    'payment_password',
                )));
                $data['payment_password'] = $this->user_model->compile_password($data['payment_password']);

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('user', $user);

        $this->assign('page_title', '设置支付密码');
        $this->display();
    }

    //储值卡
    public function prepaid()
    {
        $prepaid = D('UserPrepaid')->alias('up')->field('up.*,p.prepaid_image,p.par')
            ->join('__PREPAID__ AS p ON p.id=up.prepaid_id')
            ->where(array('up.user_id' => $this->user_id, 'up.disabled' => 'N'))->order('up.id DESC')->select();
        $this->assign('prepaid', $prepaid);

        $this->assign('page_title', '我的储值卡');
        $this->display();
    }

    //安全问题
    public function question()
    {
        $user = $this->user_model->find($this->user_id);

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，安全问题设置成功',
            );
            $post = I('post.');

            try {
                if (!$post['question'])
                    E('抱歉，请选择安全问题');
                if (!$post['answer'])
                    E('抱歉，请输入问题答案');

                if ($user['answer'] && $this->user_model->compile_password($post['old_answer']) != $user['answer'])
                    E('抱歉，原安全问题答案错误');

                $data = array_intersect_key($post, array_flip(array(
                    'question',
                    'answer',
                )));
                $data['answer'] = $this->user_model->compile_password($data['answer']);

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('user', $user);

        $this->assign('page_title', '安全问题');
        $this->display();
    }

    //安全中心
    public function safety()
    {
        $user = $this->user_model->find($this->user_id);
        $this->assign('user', $user);

        $this->assign('page_title', '安全中心');
        $this->display();
    }

    //设置安全中心所有内容
    public function safetyAll(){
        $user = $this->user_model->find($this->user_id);
        $this->assign('user', $user);

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，信息设置成功',
            );
            $post = I('post.');

            try {
                $data = array();

                if ( !$user['mobile'] ){
                    if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile']))
                        E('抱歉，手机号码格式错误');

                    $sms_code = D('SmsLog')->where(array('mobile' => $post['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                    if ( md5($post['sms_code']) != $sms_code )
                        E('抱歉，短信验证码错误');

                    $data['mobile'] = $post['mobile'];
                }else{
                    $sms_code = D('SmsLog')->where(array('mobile' => $user['mobile'], 'topic' => 'userSafety'))->order('id DESC')->getField('content');
                    if ( $user['mobile'] && md5($post['sms_code']) != $sms_code )
                        E('抱歉，短信验证码错误');
                }

                if ( !$user['answer'] ){
                    if (!$post['question'])
                        E('抱歉，请选择安全问题');
                    if (!$post['answer'])
                        E('抱歉，请输入问题答案');

                    $data['question'] = $post['question'];
                    $data['answer'] = $this->user_model->compile_password($post['answer']);
                }else{
                    if ( $this->user_model->compile_password($post['answer']) != $user['answer'] )
                        E('抱歉，安全问题答案错误');
                }

                if ( !$user['bank_card'] ){
                    if (!$post['bank_name'])
                        E('抱歉，请输入开户行');
                    if (!preg_match('/\d{16,}/i', $post['bank_card']))
                        E('抱歉，请输入有效的银行卡号');
                    if (!$post['bank_user'])
                        E('抱歉，请输入开户名');

                    $data['bank_name'] = $post['bank_name'];
                    $data['bank_card'] = $post['bank_card'];
                    $data['bank_user'] = $post['bank_user'];
                }

                if ( !$user['payment_password'] ){
                    if (!$post['payment_password'] || mb_strlen($post['payment_password']) != 6)
                        E('抱歉，请输入6位支付密码');
                    if ($post['payment_password'] != $post['repayment_password'])
                        E('抱歉，支付密码前后不一致');

                    $data['payment_password'] = $this->user_model->compile_password($post['payment_password']);
                }

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('page_title', '设置安全信息');
        $this->display();
    }

    //设置安全中心支付内容
    public function safetyPay(){
        $user = $this->user_model->find($this->user_id);
        $this->assign('user', $user);

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，信息设置成功',
            );
            $post = I('post.');

            try {
                $data = array();

                if ( !$user['mobile'] ){
                    if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile']))
                        E('抱歉，手机号码格式错误');

                    $sms_code = D('SmsLog')->where(array('mobile' => $post['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                    if ( md5($post['sms_code']) != $sms_code )
                        E('抱歉，短信验证码错误');

                    $data['mobile'] = $post['mobile'];
                }else{
                    $sms_code = D('SmsLog')->where(array('mobile' => $user['mobile'], 'topic' => 'userSafety'))->order('id DESC')->getField('content');
                    if ( $user['mobile'] && md5($post['sms_code']) != $sms_code )
                        E('抱歉，短信验证码错误');
                }

                if ( !$user['answer'] ){
                    if (!$post['question'])
                        E('抱歉，请选择安全问题');
                    if (!$post['answer'])
                        E('抱歉，请输入问题答案');

                    $data['question'] = $post['question'];
                    $data['answer'] = $this->user_model->compile_password($post['answer']);
                }else{
                    if ( $this->user_model->compile_password($post['answer']) != $user['answer'] )
                        E('抱歉，安全问题答案错误');
                }

                if ( !$user['payment_password'] ){
                    if (!$post['payment_password'] || mb_strlen($post['payment_password']) != 6)
                        E('抱歉，请输入6位支付密码');
                    if ($post['payment_password'] != $post['repayment_password'])
                        E('抱歉，支付密码前后不一致');

                    $data['payment_password'] = $this->user_model->compile_password($post['payment_password']);
                }

                $this->user_model->where(array('id' => $this->user_id))->save($data);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('page_title', '设置支付信息');
        $this->display();
    }

    //提现申请
    public function withdraw()
    {
        $state = array(
            'state' => true,
            'message' => '恭喜，申请提交成功',
        );
        $post = I('post.');
        $post['money'] = floatval($post['money']);

        try {
            $user = $this->user_model->find($this->user_id);
            $account_model = D('AccountLog');
            $user_account_model = D('UserAccountLog');
            //E('抱歉，由于系统升级，提现功能暂不能使用');
            if ( !$user['mobile'] || !$user['answer'] || !$user['bank_card'] )
                E('抱歉，请先设置您的安全信息<script>setTimeout(function(){location.href="' . U('User/safetyAll','redirect='.base64_encode($_SERVER['HTTP_REFERER'])) . '";},2000);</script>');
            if ( $user['payment_password'] != $this->user_model->compile_password($post['payment_password']) )
                E('抱歉，支付密码错误');
            if ( !$post['money'] )
                E('抱歉，请输入提现金额');

            //总金额
            $account_money = $account_model->field('SUM(user_money)+SUM(frozen_money) AS money')
                ->where(array('source_type' => 'money', 'user_id' => $this->user_id))->find();
            $account_money = $account_money['money'];
            //已申请未转账金额
            $withdraw_money = $user_account_model->where(array(
                'user_id' => $this->user_id,
                'source_type' => 'money',
                'change_type' => 'withdraw',
                'date_pay' => 0,
                'date_refuse' => 0,
            ))->sum('amount');

            if ( $withdraw_money )
                E('抱歉，还有未处理的提现申请');
            if ( $post['money'] > $account_money + $withdraw_money )
                E('抱歉，申请的金额超出可提现额度');

            $data = array(
                'user_id' => $this->user_id,
                'account_sn' => uniqid() . rand(100, 999),
                'amount' => -$post['money'],
                'source_type' => 'money',
                'change_type' => 'withdraw',
                'payment' => '银行汇款/转帐',
                'date_add' => time(),
            );
            if ( !$user_account_model->add($data) )
                E('抱歉，提交失败，请联系客服人员');

            $this->user_model->update_money($this->user_id);
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //pc自定义微信登录回馈
    public function pcWologin(){
        $code = I('get.code','','base64_decode');
        if ( !$code )
            die('ERROR');

        $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));

        if ( !$mem->get('wechat_openid_'.$code) || !$mem->get('userid_'.$code) ) {
            $mem->set('wechat_openid_'.$code,session('openid'),7200);
            $mem->set('userid_'.$code,session('user_id'),7200);
        }

        redirect(U('Index/index'));
    }

    //呈现收货地址列表
    public function consigneeList()
    {
        $address_list = D('Region')->getConsigneeList();
        $this->assign('address_list', $address_list);
        $this->display();
    }

    //添加地址前判断数量
    public function addressCount()
    {
        $count = D('Region')->getAddressCount();

        if ($count >= 5) {
            $result['error'] = 4;
            $this->ajaxReturn($result);
        }
    }

    //添加收货地址
    public function addAddress()
    {
        //省的列表
        $province_list = D('Region')->getRegions(1);
        $this->assign('province_list', $province_list);
        $this->display();
    }

    //添加收货地址的处理
    public function doAddAddress()
    {
        //第一关
        if (!D('Region')->checkConsigneeInfo(I('post.'))) {
            //不完整就去回头重新填写
            //这种回头可以保存用户之前填写的一些内容
            echo '<script type="text/javascript">window.history.go(-1);</script>';
            exit;#这个必须有额
        }

        $post = I('post.');
        $data = array_intersect_key($post, array_flip(array(
            'consignee',
            'mobile',
            'address',
            'province',
            'city',
            'district',
        )));
        $data['user_id'] = $this->user_id;
        $data['add_time'] = time();

        D('UserAddress')->add($data);
        $this->redirect('consigneeList');
    }

    //编辑地址
    public function editAddress()
    {
        $address_id = I('get.address_id');

        $address = D('Region')->getAddress($address_id);
        $this->assign('address', $address);
        //省的列表
        $province_list = D('Region')->getRegions(1);
        $this->assign('province_list', $province_list);
        //该省对应的市的列表
        $region_id = D('Region')->getRegionID($address['province']);
        $city_list = D('Region')->getRegions(2, $region_id);
        $this->assign('city_list', $city_list);
        //该市对应县的列表
        $region_id = D('Region')->getRegionID2($address['city']);
        $district_list = D('Region')->getRegions(3, $region_id);
        $this->assign('district_list', $district_list);

        $this->display();
    }

    //处理编辑地址
    public function doEditAddress()
    {
        if (!D('Region')->checkConsigneeInfo(I('post.'))) {
            //不完整就去回头重新填写
            //这种回头可以保存用户之前填写的一些内容

            echo '<script type="text/javascript">window.history.go(-1);</script>';
            exit;//这个必须有额
        }

        //检测，不合法的返回回去(先放着吧)
        $post = I('post.');
        $data = array_intersect_key($post, array_flip(array(
            'consignee',
            'mobile',
            'address',
            'province',
            'city',
            'district',
        )));
        D('UserAddress')->where(array('id' => I('post.address_id')))->save($data);

        $this->redirect('User/consigneeList');
    }

    //个人中心删除地址
    public function deleteAddress()
    {
        $address_id = I('post.address_id');

        $true = D('UserAddress')->delete($address_id);
        if ($true) {
            $result = array(
                'error' => 8,
            );

            $address_list = D('Region')->getConsigneeList();
            $this->assign('address_list', $address_list);

            $content = $this->fetch('Public/address_list');
            $result['content'] = $content;
            $this->ajaxReturn($result);
        }
    }

    //个人中心设置默认地址
    public function makeDefault()
    {
        $address_id = I('post.address_id');

        $map = array(
            'user_id' => $this->user_id,
        );

        D('UserAddress')->where($map)->save(array('is_default' => 'N'));

        $map = array(
            'id' => $address_id,
        );
        D('UserAddress')->where($map)->save(array('is_default' => 'Y'));

        $result = array(
            'error' => 8,
        );
        $address_list = D('Region')->getConsigneeList();
        $this->assign('address_list', $address_list);

        $content = $this->fetch('Public/address_list');
        $result['content'] = $content;

        $this->ajaxReturn($result);
    }

    //会员充值
    public function actAccount()
    {

        $amount = I('post.amount');
        try {
            if(!is_wechat_browser()){
                E('请用微信浏览器打开');
            }
            if(!is_numeric($amount) || floatval($amount)<=0 || floatval($amount)>99999999.99 ){
                E('请输入正确的金额');
            }
            $amount = floatval($amount);
            //生成伪订单号
            $order = array();
            $order['order_sn'] = 'ztm_deposit_' . time() . mt_rand(100, 999);
            $order['order_amount'] = $amount;
            $order['user_id'] = $this->user_id;
            //记录用户支付log
            $order['user_log_id'] = $this->user_model->addUserAccountLog($order);
            //调用微信支付
            $result = array(
                'body' => '充值',
                'order_id' => $order['user_log_id'],
                'order_sn' => $order['order_sn'],
                'total_fee' => $order['order_amount'],
                'notify_url' => U('Wechat/depositNotifyUrl','','html',true)
            );

            $wxpay_model = new \Common\Vendor\Wxpay();
            $parameters = $wxpay_model->get_code($result);
            $url_str = 'User/depositCallBack';
            $this->assign('parameters', $parameters);
            $this->assign('url_str', $url_str);
            $this->assign('order_sn',$result['order_sn']);
            $wxpay = $this->fetch('User/wxpay');
            echo $wxpay;
        } catch (\Think\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    //充值同步回调地址
    public function depositCallBack()
    {
        $order_sn=I('get.order_sn');
        $status=I('get.status');
        if($status){
            $user_account=M('UserAccountLog')->field('amount,payment')->where(array('account_sn'=>$order_sn))->find();
            $pay['order_sn'] = $order_sn;
            $pay['amount']=$user_account['amount'];
            $pay['payment_name']=$user_account['payment'];
            $this->assign('return_url',U('User/money'));
            $this->assign('pay',$pay);
            $this->display('User/pay_success');
        }else{
            $this->assign('return_url',U('User/money'));
            $this->display('User/pay_failure');
        }
    }

    //购买储值卡
    public function buyPrepaid()
	{
        $id = I('prepaid_id',0,'intval');
        $prepaid_price = M('Prepaid')->where(array('id'=>$id))->getField('price');
        $order_sn = time() . mt_rand(100, 999);
        $data = array(
            'user_id'=>$this->user_id,
            'affiliate_user'=>0,
            'prepaid_id'=>$id,
            'order_sn'=>$order_sn,
            'amount'=>$prepaid_price,
            'payment'=>'微信安全支付',
            'date_add'=>time()
        );
        $prepaid_rebate_user = cookie('prepaid_rebate_user');
        $prepaid_rebate_user = intval($prepaid_rebate_user);
        if($prepaid_rebate_user && $prepaid_rebate_user != $this->user_id){
            $data['affiliate_user'] = $prepaid_rebate_user;
        }
        $order_id = M('PrepaidAccountLog')->add($data);

        //调用微信支付
        $result = array(
            'body' => '购买储值卡',
            'order_id' => $order_id,
            'order_sn' => $order_sn,
            'total_fee' => $prepaid_price,
            'notify_url' => U('Wechat/prepaidNotifyUrl','','html',true)
        );
        
        $wxpay_model = new \Common\Vendor\Wxpay();
        $parameters = $wxpay_model->get_code($result);
        $url_str = 'User/prepaidCallBack';
        $this->assign('parameters', $parameters);
        //dump($parameters);exit();
        $this->assign('url_str', $url_str);
        $this->assign('order_sn',$result['order_sn']);
        $wxpay = $this->fetch('User/wxpay');
        echo $wxpay;
    }

    //购买储值卡同步回调地址
    public function prepaidCallBack()
    {
        $order_sn=I('get.order_sn');
        $status=I('get.status');
        if($status)
        {
            $account=M('PrepaidAccountLog')->field('amount,payment')->where(array('order_sn'=>$order_sn))->find();
            $pay['order_sn'] = $order_sn;
            $pay['amount']=$account['amount'];
            $pay['payment_name']=$account['payment'];
            $this->assign('return_url',U('User/prepaid'));
            $this->assign('pay',$pay);
            $this->display('User/pay_success');
        }else{
            $this->assign('return_url',U('User/prepaid'));
            $this->display('User/pay_failure');
        }
    }
}