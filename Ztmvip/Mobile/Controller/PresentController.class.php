<?php
/**
 * 免费送活动控制器
 * author: Tom
 */
namespace Mobile\Controller;
class PresentController extends UserBaseController
{
    protected $order_goods_model;

    public function _initialize(){
        parent::_initialize();

        C('layout_on',false);

        $this->order_goods_model = D('OrderGoods');

        $wechat = new \Common\Vendor\Wechat();
        $signPackage = $wechat->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
        $this->assign('signPackage',$signPackage);
    }

    //面膜
    public function index(){
        $present = array(
            'id' => 1,
            'title' => '整体美面膜免费送-邀您体验郝莲娜美白保湿修复面膜',
            'des' => '郝莲娜登陆中国九周年，为了感谢您的包容和支持，我们将宣传广告费直接做成美白保湿修复多效面膜免费体验，送给最美丽高贵的您',
            'goods_id' => 1532,
            'goods_name' => '郝莲娜庆祝九周年赠送面膜',
            'market_price' => 0,
        );
        $this->assign('present',$present);

        $sign_ups = $this->order_goods_model->where(array('goods_id'=>$present['goods_id']))->count();
        $this->assign('sign_ups',$sign_ups);

        $order = $this->order_goods_model->alias('og')
            ->join('__ORDER__ AS o ON o.id=og.order_id AND o.date_add>='.(strtotime(date('Y-m-d'))-(date('N')-1)*86400).' AND o.user_id='.$this->user_id)
            ->where(array('og.goods_id' => $present['goods_id']))
            ->find();
        $this->assign('order',$order);

        $this->display();
    }

    //领取
    public function receive(){
        $present = array(
            'id' => 1,
            'title' => '整体美面膜免费送-邀您体验郝莲娜美白保湿修复面膜',
            'des' => '郝莲娜登陆中国九周年，为了感谢您的包容和支持，我们将宣传广告费直接做成美白保湿修复多效面膜免费体验，送给最美丽高贵的您',
            'goods_id' => 1532,
            'goods_name' => '郝莲娜庆祝九周年赠送面膜',
            'market_price' => 0,
        );
        $order_model = D('Order');
        $order_extend_model = D('OrderExtend');

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，领取成功',
            );
            $post = I('post.');

            try{
                $order = $this->order_goods_model->alias('og')
                    ->join('__ORDER__ AS o ON o.id=og.order_id AND o.date_add>='.(strtotime(date('Y-m-d'))-(date('N')-1)*86400).' AND o.user_id='.$this->user_id)
                    ->where(array('og.goods_id' => $present['goods_id']))
                    ->find();
                if ( $order )
                    E('抱歉，您已参加过本活动');

                if ( !$order ){
                    if ( !$post['consignee'] )
                        E('抱歉，请填写姓名');
                    if ( !$post['mobile'] || !preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i',$post['mobile']) )
                        E('抱歉，请输入有效的手机号码');
                    if ( !$post['province'] || !$post['city'] || !$post['district'] )
                        E('抱歉，请选择省、市、区');
                    if ( !$post['address'] )
                        E('抱歉，请输入详细地址');

                    if ( stripos($_SERVER['HTTP_REFERER'],'sohu') ){
                        if ( !$post['code'] )
                            E('抱歉，请输入领取码');

                        if ( !D('VerifyCode')->where(array('used'=>'N','code_type'=>'present','relation_id'=>1,'code'=>$post['code']))->count() )
                            E('抱歉，领取码无效或已被使用');
                    }

                    //插入订单
                    $order_data = array(
                        'user_id' => $this->user_id,
                        'order_sn' => get_order_sn(),
                        'order_state' => 'confirm',
                        'payment_state' => 'payed',
                        'goods_fee' => 0,
                        'date_add' => time(),
                        'date_confirm' => time(),
                        'date_pay' => time(),
                    );
                    $order_id = $order_model->add($order_data);
                    if ( !$order_id )
                        E('抱歉，提交失败，请联系网站客服');

                    $order_extend_data = array(
                        'order_id' => $order_id,
                        'consignee' => $post['consignee'],
                        'mobile' => $post['mobile'],
                        'country' => '中国',
                        'province' => $post['province'],
                        'city' => $post['city'],
                        'district' => $post['district'],
                        'address' => $post['address'],
                    );
                    if ( !$order_extend_model->add($order_extend_data) ){
                        $order_model->where(array('id'=>$order_id))->delete();
                        E('抱歉，提交失败，请联系网站客服');
                    }

                    //插入订单商品
                    $order_goods_data = array(
                        'order_id' => $order_id,
                        'goods_id' => $present['goods_id'],
                        'buy_flag' => 'bargain',
                        'goods_number' => 1,
                        'market_price' => $present['market_price'],
                        'goods_price' => 0,
                        'goods_name' => $present['goods_name'],
                        'skus' => json_encode(array()),
                    );
                    if ( !$this->order_goods_model->add($order_goods_data) ){
                        $order_model->where(array('id'=>$order_id))->delete();
                        $order_extend_model->where(array('order_id'=>$order_id))->delete();
                        E('抱歉，提交失败，请联系网站客服');
                    }

                    D('VerifyCode')->where(array('code'=>$post['code']))->save(array('used'=>'Y'));
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //抽奖活动控制器
    public function draw(){
        $mongo = new \Think\Model\MongoModel('draw',C('DB_PREFIX'),C('MONGO'));

        $draw_count = $mongo->where(array('user_id'=>$this->user_id,'date_add'=>array('egt',strtotime(date('Y-m-d')))))->count();
        $this->assign('draw_count',$draw_count);

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，领取成功',
            );
            $post = I('post.');
            $goods = array(-30,-50,-100);
            $post['draw'] = intval($post['draw']);

            try{
                if ( !in_array($post['draw'],$goods) )
                    E('非法访问');

                if ( $draw_count >= 3 )
                    E('抱歉，您的抽奖机会已用完，分享给好友来参加吧');

                if ( $post['draw'] < 0 ){
                    $data = array(
                        'user_id' => $this->user_id,
                        'bonus_name' => '圣诞抽奖送红包',
                        'money' => -$post['draw'],
                        'bonus_sn' => $this->user_id,
                        'min_order_amount' => -$post['draw'] * 10,
                        'use_start' => time(),
                        'use_end' => strtotime('+1 month'),
                        'date_add' => time(),
                    );
                    $id = D('UserBonus')->add($data);
                }

                if ( $id ){
                    $data = array(
                        'user_id' => $this->user_id,
                        'draw' => $post['draw'],
                        'date_add' => time(),
                    );
                    $mongo->add($data);
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $blessing_arr = array(
            '圣诞节到了，为感谢多年来关心我帮助我鼓励我的广大朋友们，我为你精心准备了一件礼物，自己去挑选吧，祝圣诞节快乐！',
            '将我满满的思念，用祝愿包装，用爱心发酵，送上圣诞老人的雪橇，让祝福铺天盖地而来，祝你圣诞快乐！',
            '愿作夜空中最亮的一颗星星，夜夜陪伴在你身旁，当你感觉疲惫仰望星空时，空中点点星光是我洒向你的无尽祝福，祝你圣诞快乐！',
            '每一朵雪花飘下，每一个烟火燃起，每一秒时间流动，每一份思念传送。都代表着我想要送你的每一个祝福：圣诞快乐！',
            '都说流星有求必应，我愿意守在星空之下，等到一颗星星被我感动，划破长空，载着我的祝福落在你枕边，祝你圣诞节快乐！',
        );
        $this->assign('blessing_arr',$blessing_arr);
        $this->assign('blessing',I('get.blessing',0,'intval'));

        //分享用户信息
        $draw_user = I('get.u',0,'intval')?:$this->user_id;
        $draw_user = D('WechatUser')->field('user_id,nick_name,avatar')->where(array('user_id'=>$draw_user))->find();
        $this->assign('draw_user',$draw_user);

        $map = array(
            'on_sale' => 'Y',
            'bargain_start' => array('elt',time()),
            'bargain_end' => array('egt',time()),
        );
        $bargain_relation = D('Bargain')->where($map)->select();
        $this->assign('bargain_relation',$bargain_relation);

        $this->display();
    }

    //凭券领羊腿
    public function lambLeg(){
        $present = D('Goods')->where(array('id'=>1576))->find();

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，领取成功',
            );
            $post = I('post.');
            $code_model = D('VerifyCode');

            try{
                $code = $code_model->where(array(
                    'used' => 'N',
                    'code_type' => 'present',
                    'relation_id' => 2,
                    'code' => $post['code'],
                ))->find();
                if ( !$code )
                    E('抱歉，领取码错误或已被使用');

                if ( !$post['consignee'] )
                    E('抱歉，请填写姓名');
                if ( !$post['mobile'] || !preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i',$post['mobile']) )
                    E('抱歉，请输入有效的手机号码');
                if ( !$post['province'] || !$post['city'] || !$post['district'] )
                    E('抱歉，请选择省、市、区');
                if ( !$post['address'] )
                    E('抱歉，请输入详细地址');

                M()->startTrans();

                //插入订单
                $order_data = array(
                    'user_id' => $this->user_id,
                    'order_sn' => get_order_sn(),
                    'order_state' => 'confirm',
                    'payment_state' => 'payed',
                    'goods_fee' => 0,
                    'date_add' => time(),
                    'date_confirm' => time(),
                    'date_pay' => time(),
                );
                $order_id = D('Order')->add($order_data);
                if ( !$order_id )
                    E('抱歉，提交失败，请联系网站客服');

                $order_extend_data = array(
                    'order_id' => $order_id,
                    'consignee' => $post['consignee'],
                    'mobile' => $post['mobile'],
                    'country' => '中国',
                    'province' => $post['province'],
                    'city' => $post['city'],
                    'district' => $post['district'],
                    'address' => $post['address'],
                    'payment_name' => '赵总赠送',
                    'payment_note' => '赵总赠送',
                );
                if ( !D('OrderExtend')->add($order_extend_data) ){
                    E('抱歉，提交失败，请联系网站客服');
                }

                //插入订单商品
                $order_goods_data = array(
                    'order_id' => $order_id,
                    'goods_id' => $present['id'],
                    'buy_flag' => 'bargain',
                    'goods_number' => 2,
                    'market_price' => $present['market_price'],
                    'goods_price' => 0,
                    'goods_name' => $present['goods_name'],
                    'skus' => json_encode(array()),
                );
                if ( !$this->order_goods_model->add($order_goods_data) ){
                    E('抱歉，提交失败，请联系网站客服');
                }

                $code_model->where(array('code'=>$post['code']))->save(array('used'=>'Y'));

                M()->commit();
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );

                M()->rollback();
            }

            $this->ajaxReturn($state);
        }

        $this->display();
    }

    /*public function lambLegCode(){
        $data = array();
        $time = time();
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ( $i = 0; $i < 30; $i++ ){
            $code = '';
            for ( $j = 0; $j < 6; $j++ ){
                $code .= $str[rand(0,35)];
            }

            $data[] = array(
                'code_type' => 'present',
                'relation_id' => 2,
                'code' => $code,
                'date_add' => $time,
            );
        }

        D('VerifyCode')->addAll($data);
    }*/

    //员工年末福利
    /*public function staffYearBenefits(){
        $user_id = array(
            219,
            3431,
            19259,
            29055,
            13199,
            15233,
            441,
            97,
            19491,
            231,
            24445,
            26941,
            3619,
            25172,
            17474,
            32,
            94,
            17201,
            19487,
            19885,
            19023,
            19191,
            2400,
            82,
            34166,
            29002,
            2911,
            3975,
            28575,
        );
        $money = array(
            400,
            500,
            100,
            100,
            300,
            100,
            400,
            300,
            100,
            400,
            200,
            200,
            100,
            200,
            100,
            400,
            200,
            300,
            200,
            100,
            100,
            100,
            100,
            200,
            100,
            300,
            200,
            100,
            100,
        );
        $time = time();
        $str = '0123456789';

        $prepaid_model = D('Prepaid');
        $user_prepaid_model = D('UserPrepaid');
        $prepaid_account_log_model = D('PrepaidAccountLog');
        $prepaid = $prepaid_model->find(6);

        foreach ( $user_id as $key => $val ){
            $code = '';
            for ( $j = 0; $j < 6; $j++ ){
                $code .= $str[rand(0,9)];
            }

            $data = array(
                'user_id' => $val,
                'prepaid_id' => $prepaid['id'],
                'money' => $money[$key],
                'prepaid_sn' => $prepaid['prefix'] .' '. $prepaid_model->right($prepaid['id']),
                'password' => md5($code),
                'date_add' => $time,
            );
            $user_prepaid_model->add($data);

            $data = array(
                'user_id' => $val,
                'prepaid_id' => $prepaid['id'],
                'payment' => '员工年终福利',
                'amount' => $money[$key],
                'date_add' => $time,
                'date_pay' => $time,
            );
            $prepaid_account_log_model->add($data);
        }
    }*/

    //点赞
    public function thumbs(){
        $thumbs_model = new \Think\Model\MongoModel('thumbs',C('DB_PREFIX'),C('MONGO'));
        $thumbs_hit_model = new \Think\Model\MongoModel('thumbs_hit',C('DB_PREFIX'),C('MONGO'));

        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            try{
                switch ( $post['do'] ){
                    case 'sign':
                        $state = array(
                            'state' => true,
                            'message' => '恭喜，报名成功',
                        );

                        if ( !$post['consignee'] || !$post['corp'] || !$post['mobile'] || !$post['address'] )
                            E('抱歉，请完善您的资料');
                        if ( !$post['mobile'] || !preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i',$post['mobile']) )
                            E('抱歉，请输入有效的手机号码');
                        if ( !$post['province'] || !$post['city'] || !$post['district'] )
                            E('抱歉，请选择省、市、区');
                        if ( $thumbs_model->where(array('user_id'=>$this->user_id,'mobile'=>$post['mobile'],'_logic'=>'OR'))->find() )
                            E('抱歉，您已经报名过该活动');

                        $data = array_intersect_key($post,array_flip(array(
                            'consignee',
                            'corp',
                            'mobile',
                            'province',
                            'city',
                            'district',
                            'address',
                            'note',
                        )));
                        $data['id'] = $thumbs_model->getMongoNextId();
                        $data['user_id'] = $this->user_id;
                        $data['avatar'] = D('User')->where(array('id'=>$this->user_id))->getField('avatar');
                        $data['hits'] = 0;
                        $data['data_add'] = time();

                        if ( !$thumbs_model->add($data) )
                            E('抱歉，报名失败，请联系网站客服');
                        break;
                    case 'hit':
                        $state = array(
                            'state' => true,
                            'message' => '恭喜，点赞成功',
                        );

                        if ( !$thumbs_model->where(array('user_id'=>$post['thumbs_user']))->find() )
                            E('非法操作');
                        if ( $thumbs_hit_model->where(array('user_id'=>$this->user_id,'thumbs_user'=>$post['thumbs_user']))->find() )
                            E('抱歉，已经为她点赞过');

                        $data = array(
                            'user_id' => $this->user_id,
                            'thumbs_user' => $post['thumbs_user'],
                            'data_add' => time(),
                        );
                        if ( !$thumbs_hit_model->add($data) )
                            E('抱歉，点赞失败，请联系网站客服');

                        $thumbs_model->where(array('user_id'=>$post['thumbs_user']))->setInc('hits');
                        break;
                    case 'list':
                        $state = array(
                            'state' => true,
                            'message' => '',
                        );

                        if ( $post['order'] == 'id' )
                            $order = 'id DESC';
                        else
                            $order = 'hits DESC';

                        $count = $thumbs_model->count();
                        $page = $this->page($count,20);
                        $state['list'] = $thumbs_model->order($order)->limit($page->firstRow.','.$page->listRows)->select();
                        $state['count'] = $count;
                        $state['size'] = $page->listRows;
                        $state['pages'] = $page->totalPages;
                        break;
                    default:
                        E('非法操作');
                }
            }catch (\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->display();
    }
}