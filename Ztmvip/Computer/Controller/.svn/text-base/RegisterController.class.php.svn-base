<?php
/**
 * 会员注册
 * Author: lihongfu
 * Date: 2015/12/25
 */
namespace Computer\Controller;

class RegisterController extends BaseController
{
    public function _initialize()
    {
        if(D('User')->isLogin()){
            //已经登录过了，不能再登录，直接跳转到主页
            $this->redirect('Index/index');
        }
        parent::_initialize();
    }

    //显示会员注册
    public function index()
    {
        if (IS_POST && IS_AJAX) {
            $post = I('post.');
            
           if(session('redirect_url')){
              $redirect_url=base64_decode(session('redirect_url'));
              session('redirect_url',null);
           }else{
              $redirect_url=U('Index/index'); 
           }
            $state = array(
                'state' => true,
                'message' => '恭喜，注册成功',
                'uri' =>$redirect_url,
            );

            try {
                $sms_model = D('SmsLog');
                /*
                if (!$post['user_name']) {
                    E('抱歉，用户名为空');
                }
                */
                if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile'])) {
                    E('抱歉，手机号码格式错误');
                }

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

                if (!$post['sms_code']) {
                    E('请填写手机验证码');
                }
                $sms_code = $sms_model->where(array('mobile' => $post['mobile'], 'topic' => 'userRegister'))->order('id DESC')->getField('content');
                if ($post['mobile'] && md5($post['sms_code']) != $sms_code) {
                    E('抱歉，手机短信验证码错误');
                }

                $user_model = D('User');
                //手机是否注册过
                $count = $user_model->where(array('mobile' => $post['mobile']))->count();
                if ($count) {
                    E('抱歉，该手机已经注册过');
                }

                $data = array(
                    'password' => $user_model->compile_password($post['password']),
                    'mobile' => $post['mobile'],
                    'user_name' => $post['mobile'],
                    'date_add' => time()
                );
                $user_id = $user_model->add($data);
                if (!$user_id) {
                    E('抱歉，操作失败');
                }
                //去登录
                if (!$user_model->login($user_id)) {
                    $state['uri'] = U('Login/index');
                }
                D('Cart')->userToCart();
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
        $this->assign('page_title', '会员注册');
        $this->display();
    }

    //判断手机号码是否可用
    public function userMobileAvailable($mobile)
    {
        $state = array(
            'state' => true,
            'message' => '手机号码可用',
        );
        try {
            $user_mobile = $mobile;
            if (!$user_mobile) {
                E('手机号码为空');
            }
            $count = D('User')->where(array('mobile' => $user_mobile))->count();
            if ($count) {
                E('该手机号码已经注册过了');
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