<?php
/**
 * 会员资金控制器
 * author: Tom
 */
namespace Computer\Controller;
class AccountController extends UserBaseController
{
    protected $account_model, $user_model;

    public function _initialize()
    {
        parent::_initialize();

        $this->account_model = D('AccountLog');
        $this->user_model = D('User');
    }

    //提现申请
    public function withdraw()
    {
        $user = $this->user_model->find($this->user_id);
        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，申请提交成功',
            );
            $post = I('post.');
            $post['money'] = floatval($post['money']);

            try {

                $account_model = D('AccountLog');
                $user_account_model = D('UserAccountLog');
                //E('抱歉，由于系统升级，提现功能暂不能使用');
                if (!$user['mobile'] || !$user['answer'] || !$user['bank_card'])
                    E('抱歉，请先设置您的安全信息<script>setTimeout(function(){location.href="' . U('User/safetyAll', 'redirect=' . base64_encode($_SERVER['HTTP_REFERER'])) . '";},2000);</script>');
                if ($user['payment_password'] != $this->user_model->compile_password($post['payment_password']))
                    E('抱歉，支付密码错误');
                if (!$post['money'])
                    E('抱歉，请输入提现金额');

                //总金额
                $account_money = $account_model->field('SUM(user_money)+SUM(frozen_money) AS money')
                    ->where(array('source_type' => 'money', 'user_id' => $this->user_id))->find();

                $account_money = $account_money['money'];
                //已申请未转账金额
                $withdraw_money = $user_account_model->where(array('source_type' => 'money', 'change_type' => 'withdraw', 'date_pay' => 0, 'user_id' => $this->user_id))->sum('amount');

                if ($withdraw_money)
                    E('抱歉，还有未处理的提现申请');

                if ($post['money'] > $account_money + $withdraw_money)
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
                if (!$user_account_model->add($data))
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

        if (!$user['mobile'] || !$user['answer'] || !$user['bank_card']) {
            $this->assign('message', '抱歉，请先设置您的安全信息');
            $this->assign('url', U('User/safetyAll', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));
            $this->assign('page_title', '错误信息');
            $this->display('error');
            exit;
        }

        $this->assign('user', $user);
        $this->assign('page_title', '余额申请提现');
        $this->display();
    }

    //会员充值
    public function deposit()
    {
        if (IS_PSOT && IS_AJAX) {
            $amount = I('post.amount');
            try {
                $state = array(
                    'state' => true,
                    'message' => '恭喜，申请提交成功',
                );
                if (!is_numeric($amount) || floatval($amount) <= 0 || floatval($amount) > 99999999.99) {
                    E('请输入正确的金额');
                }
                $amount = floatval($amount);
                //生成伪订单号
                $order = array();
                $next_id = D('UserAccountLog')->next_primary();
                $order['order_sn'] = date('Ymd') . $this->user_id . $next_id . mt_rand(100, 999);
                $order['order_amount'] = $amount;
                $order['user_id'] = $this->user_id;
                //记录用户支付log
                $order['user_log_id'] = $this->user_model->addUserAccountLog($order);
                //调用支付宝支付

                $order = array(
                    'notify_url' => U('Computer/Alipay/depositNotifyUrl', '', 'html', true), #异步通知地址
                    'return_url' => U('Computer/Account/depositReturnUrl', '', 'html', true),  #同步跳转地址
                    'out_trade_no' => $order['order_sn'],
                    'subject' => '整体美商城充值',
                    'total_fee' => $order['order_amount'],
                );
                $alipay = new \Common\Vendor\Alipay();
                $html = $alipay->pay($order);
                $state['data'] = $html;
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }
            $this->ajaxReturn($state);
        }
        $this->assign('page_title', '会员充值');
        $this->display();
    }

    //同步
    public function depositReturnUrl()
    {
//        $string = 'a:17:{s:11:"buyer_email";s:17:"2358196186@qq.com";s:8:"buyer_id";s:16:"2088512365831961";s:9:"exterface";s:25:"create_direct_pay_by_user";s:10:"is_success";s:1:"T";s:9:"notify_id";s:74:"RqPnCoPT3K9%2Fvwbh3InUFZVSWHc%2BGAJjgGaZkmCtZ8K2q3RXt6vNBS%2BlVYRM3XyQp3fA";s:11:"notify_time";s:19:"2016-01-21 15:24:07";s:11:"notify_type";s:17:"trade_status_sync";s:12:"out_trade_no";s:19:"20445O2016012122730";s:12:"payment_type";s:1:"1";s:12:"seller_email";s:17:"2797448794@qq.com";s:9:"seller_id";s:16:"2088911849346454";s:7:"subject";s:21:"整体美商城购物";s:9:"total_fee";s:4:"0.01";s:8:"trade_no";s:28:"2016012121001004960021696533";s:12:"trade_status";s:13:"TRADE_SUCCESS";s:4:"sign";s:32:"dfafd7eaf2174148829586221132ef3a";s:9:"sign_type";s:3:"MD5";}';
//        $_GET = unserialize($string);
//        $_GET = json_encode($_GET,JSON_UNESCAPED_UNICODE);

//        $string = '{"buyer_email":"2358196186@qq.com","buyer_id":"2088512365831961","exterface":"create_direct_pay_by_user","is_success":"T","notify_id":"RqPnCoPT3K9%2Fvwbh3InUFZVSWHc%2BGAJjgGaZkmCtZ8K2q3RXt6vNBS%2BlVYRM3XyQp3fA","notify_time":"2016-01-21 15:24:07","notify_type":"trade_status_sync","out_trade_no":"2016012532192995","payment_type":"1","seller_email":"2797448794@qq.com","seller_id":"2088911849346454","subject":"整体美商城充值","total_fee":"0.01","trade_no":"2016012121001004960021696533","trade_status":"TRADE_SUCCESS","sign":"dfafd7eaf2174148829586221132ef3a","sign_type":"MD5"}';
//        $_GET = json_decode($string, true);

        //http://pc.loztmvip2.com/Account/depositReturnUrl.html?buyer_email=2358196186%40qq.com&buyer_id=2088512365831961&exterface=create_direct_pay_by_user&is_success=T&notify_id=RqPnCoPT3K9%252Fvwbh3InUFZFvuGC6D2%252F%252FVkfW%252BU6e7%252B2%252FUn12rUFtts1lKsGmF%252FmTKqWP&notify_time=2016-01-25+14%3A05%3A35&notify_type=trade_status_sync&out_trade_no=2016012519023193672&payment_type=1&seller_email=2797448794%40qq.com&seller_id=2088911849346454&subject=%E6%95%B4%E4%BD%93%E7%BE%8E%E5%95%86%E5%9F%8E%E5%85%85%E5%80%BC&total_fee=0.01&trade_no=2016012521001004960030520135&trade_status=TRADE_SUCCESS&sign=c411855744a9cbb8a550baa9c580cab9&sign_type=MD5
        if ($_GET['out_trade_no'] && $_GET['trade_status']=='TRADE_SUCCESS') {
            $order = M('UserAccountLog')->where(array('account_sn' => $_GET['out_trade_no']))->find();
            $this->assign('order', $order);
            $this->display('Account/success');
        } else {
            $this->display('Account/fail');
        }
    }

    //提现记录
    public function wdwLog()
    {
        $account_model = D('UserAccountLog');
        $map = array(
            'user_id' => $this->user_id,
            'source_type' => 'money',
            'change_type' => 'withdraw',
        );

        $count = $account_model->where($map)->count();
        $page = $this->page($count);
        $account = $account_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('date_add desc')->select();
        $this->assign('account', $account);

        $user_money = $this->user_model->real_money($this->user_id);
        $this->assign('user_money', $user_money);

        $this->assign('page_title', '余额明细');
        $this->display();
    }

    //充值记录
    public function dptLog()
    {
        $account_model = D('UserAccountLog');
        $map = array(
            'user_id' => $this->user_id,
            'source_type' => 'money',
            'change_type' => 'deposit',
        );

        $count = $account_model->where($map)->count();
        $page = $this->page($count);
        $account = $account_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('date_add desc')->select();
        $this->assign('account', $account);

        $user_money = $this->user_model->real_money($this->user_id);
        $this->assign('user_money', $user_money);

        $this->assign('page_title', '余额明细');
        $this->display();
    }
}