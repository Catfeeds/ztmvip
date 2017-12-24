<?php
/**
 * 会员中心控制器
 * author: lihongfu
 */
namespace Computer\Controller;
class UserController extends UserBaseController
{
    protected $user_model;

    public function _initialize()
    {
        parent::_initialize();

        $this->user_model = D('User');
    }

    private function setCache()
    {
        $seconds_to_cache = 300;
        $ts = gmdate('D, d M Y H:i:s', time() + $seconds_to_cache) . ' GMT';
        header('Expires: ' . $ts);
        header('Pragma: cache');
        header('Cache-Control: max-age=' . $seconds_to_cache);
    }

    //返利中心
    public function rebate()
    {
        $this->setCache();
        //获取返利中心的数据
        $account_model = D('UserAccountLog');
        $order_model = D('Order');
        $affiliate_model = D('AffiliateLog');
        $affiliate_count = array(
            'withdraw_money' => $account_model->where(array('user_id' => $this->user_id, 'source_type' => 'affiliate', 'change_type' => 'withdraw', 'date_pay' => array('gt', 0)))->sum('amount'),
            'wait_money' => $account_model->where(array('user_id' => $this->user_id, 'source_type' => 'affiliate', 'change_type' => 'withdraw', 'date_pay' => 0))->sum('amount'),
            'users' => $this->user_model->affiliate_users($this->user_id),
            'count_money' => $affiliate_model->where(array('rebate_user' => $this->user_id, 'separated' => 'Y'))->sum('money'),
            'share' => $this->user_model->affiliate_users($this->user_id, 1),
        );
        $affiliate_count['sell'] = $affiliate_count['share'] ? $order_model->where(array('user_id' => array('in', $affiliate_count['share'])))->count() : 0;
        $this->assign('affiliate_count', $affiliate_count);

        $withdraw_money = $affiliate_count['count_money'] + $affiliate_count['withdraw_money'] + $affiliate_count['wait_money'];
        $this->assign('withdraw_money', $withdraw_money);

        //$this->assign('page_title','返利中心');
        $affiliate_user = array_slice($this->user_model->affiliate_users($this->user_id, 1), 0, 50);
        $affiliate_user = $this->user_model->field('parent_id,user_name,avatar')->where(array('id' => array('in', $affiliate_user ?: '0'), 'avatar' => array('neq', '')))->select();
        $this->assign('affiliate_user', $affiliate_user);

        $rebate = $this->fetch('User:rebate');
        $this->ajaxReturn(array('rebate' => $rebate));
    }

    //余额
    public function balance()
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
        $this->assign('account', $account);

        if (IS_POST && IS_AJAX) {
            $balanceContent = $this->fetch('User:balanceContent');
            $this->ajaxReturn(array('balanceContent' => $balanceContent));
        }

        $user_money = $this->user_model->real_money($this->user_id);
        $this->assign('user_money', $user_money);

        //$this->assign('page_title', '我的余额');
        $balance = $this->fetch('User:balance');
        $this->ajaxReturn(array('balance' => $balance));
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
                $this->assign('bonus_type', 2);
                break;
            case 'expired':
                $map['date_use'] = 0;
                $map['use_end'] = array('elt', time());
                $this->assign('bonus_type', 3);
                break;
            default:
                $map['date_use'] = 0;
                $map['use_end'] = array('gt', time());
                $this->assign('bonus_type', 1);
                break;
        }
        $bonus = $bonus_model->where($map)->order('id DESC')->select();
        $this->assign('bonus', $bonus);

        if (IS_POST && IS_AJAX) {
            $bonusContent = $this->fetch('User:bonusContent');
            $this->ajaxReturn(array('bonusContent' => $bonusContent));
        }

        //红包数统计
        $bonus_count = array(
            'new' => $bonus_model->where(array('date_use' => 0, 'use_end' => array('gt', time()), 'user_id' => $this->user_id))->count(),
            'used' => $bonus_model->where(array('date_use' => array('gt', 0), 'user_id' => $this->user_id))->count(),
            'expired' => $bonus_model->where(array('date_use' => 0, 'use_end' => array('elt', time()), 'user_id' => $this->user_id))->count(),
        );
        $this->assign('bonus_count', $bonus_count);
        $bonus = $this->fetch('User:bonus');
        $this->ajaxReturn(array('bonus' => $bonus));
    }

    public function bonusDes()
    {
        $this->assign('page_title', '优惠券使用说明');
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
                $this->assign('coupon_type_id', 2);
                $this->assign('coupon_type', '已使用');
                break;
            case 'expired':
                $map['uc.date_use'] = 0;
                $map['c.use_end'] = array('elt', time());
                $this->assign('coupon_type_id', 2);
                $this->assign('coupon_type', '已过期');
                break;
            default:
                $map['uc.date_use'] = 0;
                $map['c.use_end'] = array('gt', time());
                $this->assign('coupon_type_id', 1);
                $this->assign('coupon_type', '');
                break;
        }
        $coupon = $coupon_model->alias('uc')->field('uc.*,c.coupon_money,c.min_order_amount,c.use_start,c.use_end')
            ->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where($map)->order('uc.id DESC')->select();
        $this->assign('coupon', $coupon);

        if (IS_POST && IS_AJAX) {
            $couponContent = $this->fetch('User:couponContent');
            $this->ajaxReturn(array('couponContent' => $couponContent));
        }


        //优惠券数统计
        $coupon_count = array(
            'new' => $coupon_model->alias('uc')->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where(array('uc.date_use' => 0, 'c.use_end' => array('gt', time()), 'uc.user_id' => $this->user_id))->count(),
            'used' => $coupon_model->where(array('date_use' => array('gt', 0), 'user_id' => $this->user_id))->count(),
            'expired' => $coupon_model->alias('uc')->join('__COUPON__ AS c ON c.id=uc.coupon_id')->where(array('uc.date_use' => 0, 'c.use_end' => array('elt', time()), 'uc.user_id' => $this->user_id))->count(),
        );
        $this->assign('coupon_count', $coupon_count);

        //$this->assign('page_title', '我的优惠券');
        $coupon = $this->fetch('User:coupon');
        $this->ajaxReturn(array('coupon' => $coupon));
    }

    public function couponDes()
    {
        $this->assign('page_title', '优惠券使用说明');
        $this->display();
    }

    //储值卡
    public function prepaid()
    {
        $prepaid = D('UserPrepaid')->alias('up')->field('up.*,p.prepaid_image,p.par')
            ->join('__PREPAID__ AS p ON p.id=up.prepaid_id')
            ->where(array('up.user_id' => $this->user_id, 'up.disabled' => 'N'))->order('up.id DESC')->select();
        $this->assign('prepaid', $prepaid);

        //$this->assign('page_title', '我的储值卡');
        $prepaid = $this->fetch('User:prepaid');
        $this->ajaxReturn(array('prepaid' => $prepaid));
    }

    //我的收藏
    public function collection()
    {
        $this->favor_model = D('UserFavor');
        switch ($favor_type = I('post.favor_type')) {
            case 'article':
                $favor = $this->favor_model->alias('f')->field('f.*,a.title,a.article_thumb,a.content')
                    ->join('__ARTICLE__ AS a ON a.id=f.article_id')
                    ->where(array('f.favor_type' => 'article', 'f.user_id' => $this->user_id))->select();
                break;
            default:
                $favor = $this->favor_model->alias('f')->field('f.*,g.goods_name,g.goods_thumb,g.market_price,g.shop_price')
                    ->join('__GOODS__ AS g ON g.id=f.goods_id')
                    ->where(array('f.favor_type' => 'goods', 'f.user_id' => $this->user_id))->select();
        }

        $this->assign('favor', $favor);
        $this->assign('favor_type', $favor_type);

        if (IS_POST && IS_AJAX) {
            $collectionContent = $this->fetch('User:collectionContent');
            $this->ajaxReturn(array('collectionContent' => $collectionContent));
        }

        //$this->assign('page_title','我的收藏');
        $collection = $this->fetch('User:collection');
        $this->ajaxReturn(array('collection' => $collection));
    }

    //订单中心
    public function order()
    {
        $map = array(
            'user_id' => $this->user_id,
        );
        $state = I('get.state') ?: I('post.state');
        $this->assign('state', $state);
        switch ($state) {
            case 'payed':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = array('in', array('new', 'stock'));
                $map['display'] = 'Y';
                break;
            case 'send':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'send';
                $map['display'] = 'Y';
                break;
            case 'receive':
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'receive';
                $map['display'] = 'Y';
                break;
            case 'refund':
                $map['order_state'] = array('in', array('refund', 'refunded', 'finish'));
                $map['payment_state'] = 'payed';
                $map['display'] = 'Y';
                break;
            case 'recycle':
                $map['display'] = 'N';
                break;
            case 'stock'://配货中
                $map['order_state'] = 'confirm';
                $map['payment_state'] = 'payed';
                $map['shipping_state'] = 'stock';
                $map['display'] = 'Y';
                break;
            case 'cancled'://已取消
                $map['order_state'] = array('in', array('cancel', 'invalid'));
                $map['display'] = 'Y';
                break;
            case 'finished'://已完成
                $map['order_state'] = array('in', array('finish', 'refunded'));
                $map['payment_state'] = 'payed';
                $map['display'] = 'Y';
                break;
            case 'refunding'://退款中
                $map['order_state'] = 'refund';
                $map['payment_state'] = 'payed';
                $map['display'] = 'Y';
                break;
            default://等待付款
                $map['order_state'] = 'new';
                $map['payment_state'] = array('in', array('new', 'paying'));
                $map['display'] = 'Y';
                break;
        }

        $order_count = D('Order')->where($map)->count();

        $page = $this->page($order_count);
        $order = D('Order')->field('id,order_sn,order_state,payment_state,shipping_state,shipping_fee,goods_fee,date_pay,date_add')->where($map)
            ->limit($page->firstRow . ',' . $page->listRows)->order('id DESC')->select();
        $order_goods_model = D('OrderGoods');
        foreach ($order as &$val) {
            $val['goods'] = $order_goods_model->alias('og')->field('og.goods_id,og.goods_number,og.goods_price,og.skus,og.different,g.goods_name,g.goods_thumb,g.on_sale')
                ->join('__GOODS__ AS g ON g.id=og.goods_id')
                ->where(array('og.order_id' => $val['id']))->select();
        }
        unset($val);

        $this->assign('order', $order);


        //用户的个人信息
        $this_user = D('User')->getUserInfo();

        //订单数量
        $order_model = D('Order');
        $order_count = array(
            'new' => $order_model->where(array('user_id' => $this->user_id, 'order_state' => 'new', 'payment_state' => array('in', array('new', 'paying')), 'display' => 'Y'))->count(),
            'payed' => $order_model->where(array('user_id' => $this->user_id, 'order_state' => 'confirm', 'payment_state' => 'payed', 'shipping_state' => 'new', 'display' => 'Y'))->count(),
            'send' => $order_model->where(array('user_id' => $this->user_id, 'order_state' => 'confirm', 'payment_state' => 'payed', 'shipping_state' => 'send', 'display' => 'Y'))->count(),
            'receive' => $order_model->where(array('user_id' => $this->user_id, 'order_state' => 'confirm', 'payment_state' => 'payed', 'shipping_state' => 'receive', 'display' => 'Y'))->count(),
            'refund' => $order_model->where(array('user_id' => $this->user_id, 'payment_state' => 'payed', 'order_state' => array('in', array('refund', 'refunded', 'finish')), 'display' => 'Y'))->count(),
        );

        //卡券数量
        $user_bonus_model = D('UserBonus');
        $user_coupon_model = D('UserCoupon');
        $user_prepaid_model = D('UserPrepaid');
        $card_coupons = array(
            'bonus' => $user_bonus_model->where(array('user_id' => $this->user_id))->count(),
            'coupon' => $user_coupon_model->where(array('user_id' => $this->user_id))->count(),
            'prepaid' => $user_prepaid_model->where(array('user_id' => $this->user_id))->count()
        );


        //var_dump($user_info);
        $this->assign('order_count', $order_count);
        $this->assign('card_coupons', $card_coupons);
        $this->assign('this_user', $this_user);
        $this->assign('page_title', '订单中心');
        $this->display();
    }


    //个人信息
    public function info()
    {
        //用户的个人信息
        $this_user = D('User')->field('u.id,u.avatar,u.user_name,u.mobile,ua.consignee,ua.mobile as receive_mobile,ua.province,ua.city,ua.district,ua.zipcode')
            ->alias('u')->join("left join __USER_ADDRESS__ ua on u.id=ua.user_id and ua.is_default='Y'")
            ->where(array('u.id' => $this->user_id))->find();
        $this->assign('page_title', '个人信息');
        $this->assign('this_user', $this_user);
        $this->display();
    }

    //修改个人头像
    public function editAvatar()
    {
        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，修改成功',
            );
            $new_avatar = I('post.avatar');
            $upfile_id = I('post.upfile_id', 0, 'intval');
            $old_avatar = D('User')->where(array('id' => $this->user_id))->getField('avatar');
            try {
                if (!$upfile_id || !$new_avatar) {
                    E('非法操作');
                }

                if (strpos($old_avatar, 'http') === 0) {
                    E('您的头像是微信头像，请前往微信更改');
                }

                $res = D('User')->where(array('id' => $this->user_id))->save(array('avatar' => $new_avatar));
                if (!$res) {
                    E('操作失败');
                }

                //更新user_upload_file的关联用户的relation_id
                $res = D('UserUploadFile')->where(array('id' => $upfile_id, 'user_id' => $this->user_id, 'relation_topic' => 'userAvatar'))->save(array('relation_id' => $this->user_id));
                $res2 = D('UserUploadFile')->where(array('user_id' => $this->user_id, 'relation_topic' => 'userAvatar', 'id' => array('neq', $upfile_id)))->save(array('relation_id' => 0));
                if ($res && $res2) {
                    //找到用户上传没有用的图片，删掉
                    $avatar_file_arr = D('UserUploadFile')->field('file_path,file_name')
                        ->where(array('user_id' => $this->user_id, 'relation_topic' => 'userAvatar', 'relation_id' => 0, 'id' => array('neq', $upfile_id)))
                        ->select();

                    foreach ($avatar_file_arr as $key => $val) {
                        $file = '.' . $val['file_path'] . $val['file_name'];
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                    D('UserUploadFile')->where(array('user_id' => $this->user_id, 'relation_topic' => 'userAvatar', 'relation_id' => 0, 'id' => array('neq', $upfile_id)))->delete();
                }

            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }
            $this->ajaxReturn($state);
        }
    }


    //绑定或者修改手机
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
                    /*
                    $sms_code = $sms_model->where(array('mobile' => $user['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                    if ($user['mobile'] && md5($post['old_sms_code']) != $sms_code)
                        E('抱歉，原手机短信验证码错误');
                    */
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
        $this->assign('page_title', '绑定手机');
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

        $this->assign('page_title', '设置安全问题');
        $this->display();
    }

    //银行卡绑定
    public function bank()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->userError(302, '抱歉！您还未绑定手机号码，请先绑定手机号码再进行下一步操作', U('mobile', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));

        if (!$user['answer'])
            $this->userError(302, '抱歉，您还设置安全问题，请先设置您的安全问题再进行下一步操作', U('question', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));

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

    //设置支付密码
    public function payword()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->userError(302, '抱歉！您还未绑定手机号码，请先绑定手机号码再进行下一步操作', U('mobile', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));

        if (!$user['answer'])
            $this->userError(302, '抱歉，您还设置安全问题，请先设置您的安全问题再进行下一步操作', U('question', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));

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

    //登录密码
    public function password()
    {
        $user = $this->user_model->find($this->user_id);

        if (!$user['mobile'])
            $this->userError(302, '抱歉！您还未绑定手机号码，请先绑定手机号码再进行下一步操作', U('mobile', 'redirect=' . base64_encode($_SERVER['REQUEST_URI'])));

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，登录密码设置成功',
            );
            $post = I('post.');

            try {


                if (!$post['password']) {
                    E('抱歉，密码为空');
                }
                if (strlen($post['password']) < 6 || strlen($post['password']) > 20) {
                    E('抱歉，密码长度应为6~20个字符');
                }
                //判断密码强度
                if ((preg_match('/[0-9]/', $post['password']) + preg_match('/[a-z]/', $post['password']) + preg_match('/[A-Z]/', $post['password']) + preg_match('/[^0-9a-zA-Z]/', $post['password'])) < 2) {
                    E('抱歉，密码过于简单，请尝试 "字母+数字的组合" ');
                }

                if ($post['password'] != $post['repassword']) {
                    E('抱歉，两次输入的密码不一致');
                }

                $sms_code = D('SmsLog')->where(array('mobile' => $user['mobile'], 'topic' => 'userPassword'))->order('id DESC')->getField('content');
                if (md5($post['sms_code']) != $sms_code)
                    E('抱歉，短信验证码错误');

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

    //设置安全中心所有内容
    public function safetyAll()
    {
        $user = $this->user_model->find($this->user_id);
        $this->assign('user', $user);

        if (IS_POST && IS_AJAX) {
            $state = array(
                'state' => true,
                'message' => '恭喜，信息设置成功',
            );
            $post = I('post.');

            try {
                $data = array();

                if (!$user['mobile']) {
                    if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile']))
                        E('抱歉，手机号码格式错误');

                    $sms_code = D('SmsLog')->where(array('mobile' => $post['mobile'], 'topic' => 'userMobile'))->order('id DESC')->getField('content');
                    if (md5($post['sms_code']) != $sms_code)
                        E('抱歉，短信验证码错误');

                    $data['mobile'] = $post['mobile'];
                } else {
                    $sms_code = D('SmsLog')->where(array('mobile' => $user['mobile'], 'topic' => 'userSafety'))->order('id DESC')->getField('content');
                    if ($user['mobile'] && md5($post['sms_code']) != $sms_code)
                        E('抱歉，短信验证码错误');
                }

                if (!$user['answer']) {
                    if (!$post['question'])
                        E('抱歉，请选择安全问题');
                    if (!$post['answer'])
                        E('抱歉，请输入问题答案');

                    $data['question'] = $post['question'];
                    $data['answer'] = $this->user_model->compile_password($post['answer']);
                } else {
                    if ($this->user_model->compile_password($post['answer']) != $user['answer'])
                        E('抱歉，安全问题答案错误');
                }

                if (!$user['bank_card']) {
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

                if (!$user['payment_password']) {
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

}