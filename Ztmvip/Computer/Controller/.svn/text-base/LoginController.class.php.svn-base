<?php
/**
 * 登录控制器
 * author: Tom
 */
namespace Computer\Controller;
class LoginController extends BaseController
{
    //登录页面
    public function index()
    {
       file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/session_index.txt',serialize(session()));
        if(D('User')->isLogin()){
            $this->redirect('Index/index');
        }
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
                'message' => '恭喜，登录成功',
                'uri' =>$redirect_url,
            );

            try {
                if (!$post['mobile']) {
                    E('抱歉，手机号码为空');
                }
                if (!$post['password']) {
                    E('抱歉，密码为空');
                }

                $user_model = D('User');
                $map = array(
                    'mobile' => $post['mobile'],
                    'password' => $user_model->compile_password($post['password']),
                );
                $user_id = $user_model->where($map)->getField('id');
                if (!$user_id) {
                    E('抱歉，手机号码或密码错误');
                }

                if (!$user_model->login($user_id)) {
                    E('抱歉，登录失败');
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
        $this->assign('ret', I('get.ret', ''));
        $this->assign('page_title', '会员登录');
        $this->display();
    }

    //退出登录
    public function logout()
    {
        D('User')->out();
        $this->redirect('Index/index');
    }

    //找回密码
    public function findPwd()
    {
        if (IS_POST && IS_AJAX) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，进入下一步',
                'uri' => $post['ret'] ? base64_decode($post['ret']) : U('Login/resetPwd'),
            );

            try {
                $sms_model = D('SmsLog');

                if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile'])) {
                    E('抱歉，手机号码格式错误');
                }
                if (!$post['sms_code']) {
                    E('请填写手机验证码');
                }
                $sms_code = $sms_model->where(array('mobile' => $post['mobile'], 'topic' => 'userFindPwd'))->order('id DESC')->getField('content');
                if ($post['mobile'] && md5($post['sms_code']) != $sms_code) {
                    E('抱歉，手机短信验证码错误');
                }

                $user_model = D('User');
                //手机是否注册过
                $count = $user_model->where(array('mobile' => $post['mobile']))->count();
                if (!$count) {
                    E('抱歉，该手机未注册过');
                }

                $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                $mem->set('findpwd_key_'.$post['mobile'],$post['mobile'].$sms_code,120);

                $key = base64_encode($post['mobile']);
                $value = base64_encode($post['mobile'].$sms_code);
                $state['uri'] = U('Login/resetPwd',array('k'=>$key,'v'=>$value));
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
        $this->assign('page_title', '找回密码');
        $this->display();
    }

    //重置密码
    public function resetPwd()
    {
        if (IS_POST && IS_AJAX) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，密码修改成功',
                'uri' => $post['ret'] ? base64_decode($post['ret']) : U('Index/index'),
            );

            try {
                $sms_model = D('SmsLog');

                $mobile = base64_decode($post['k']);
                $mobileCode = base64_decode($post['v']);
                $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                $value = $mem->get('findpwd_key_'.$mobile);
                if(!$value || $value != $mobileCode){
                    E('抱歉，您的验证码已过期');
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

                $user_model = D('User');
                //手机是否注册过
                $user_id = $user_model->where(array('mobile' => $mobile))->getField('id');
                if (!$user_id) {
                    E('抱歉，该手机未注册过');
                }
                $data = array(
                    'password' => $user_model->compile_password($post['password']),
                    'date_upd' => time()
                );
                $res = $user_model->where(array('id' => $user_id))->save($data);
                if (!$res) {
                    E('抱歉，操作失败');
                }
                //去登录
                if (!$user_model->login($user_id)) {
                    $state['uri'] = U('Login/index');
                }
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
        $get = I('get.');
        $this->assign('k',$get['k']);
        $this->assign('v',$get['v']);
        $this->assign('page_title', '修改密码');
        $this->display();
    }

    //微信登录
    public function wechat()
    {
        $config = C('WECHAT');
        $user_model = D('User');
        $wechat_user_model = D('WechatUser');

        switch (I('get.state')) {
            case 'token':
                $code = I('get.code');

                if (!$code)
                    $this->_empty(302, '抱歉，授权失败');

                //获取token
                $res = http('https://api.weixin.qq.com/sns/oauth2/access_token', array(
                    'appid' => $config['appid'],
                    'secret' => $config['secret'],
                    'code' => $code,
                    'grant_type' => 'authorization_code',
                ));

                $token = json_decode($res, true);

                if (isset($token['errcode']))
                    $this->_empty(302, '抱歉，微信授权失败');

                //获取微信用户信息
                $res = http('https://api.weixin.qq.com/sns/userinfo', array(
                    'access_token' => $token['access_token'],
                    'openid' => $token['openid'],
                ));
                $userinfo = json_decode($res, true);

                if (isset($userinfo['errcode']))
                    $this->_empty(302, '抱歉，获取微信用户信息失败');

                $wechat_user = $wechat_user_model->where(array('open_id' => $userinfo['openid']))->find();
                //未用微信登陆过
                if (!$wechat_user) {
                    $user = array(
                        'parent_id' => I('get.u', 0, 'intval'),
                        'user_name' => $userinfo['nickname'],
                        'password' => '',
                        'avatar' => $userinfo['headimgurl'],
                        'date_add' => time(),
                    );
                    $user['id'] = $user_model->add($user);
                    if (!$user['id'])
                        $this->_empty(302, '抱歉，微信快捷注册失败，请联系网站客服');

                    $wechat_user = array(
                        'user_id' => $user['id'],
                        'open_id' => $userinfo['openid'],
                        'nick_name' => $userinfo['nickname'],
                        'avatar' => $userinfo['headimgurl'],
                        'sex' => $userinfo['sex'] ? ($userinfo['sex'] == 1 ? 'male' : 'female') : 'unknow',
                        'country' => $userinfo['country'],
                        'province' => $userinfo['privilege'],
                        'city' => $userinfo['city'],
                        'date_authorize' => time(),
                    );
                    $wechat_user['id'] = $wechat_user_model->add($wechat_user);
                    if (!$wechat_user['id'])
                        $this->_empty(302, '抱歉，微信快捷注册失败，请联系网站客服');
                    //已用微信登陆过
                } else {
                    $data = array(
                        'nick_name' => $userinfo['nickname'],
                        'avatar' => $userinfo['headimgurl'],
                        'sex' => $userinfo['sex'] ? ($userinfo['sex'] == 1 ? 'male' : 'female') : 'unknow',
                        'country' => $userinfo['country'],
                        'province' => $userinfo['privilege'],
                        'city' => $userinfo['city'],
                    );
                    $wechat_user_model->where(array('open_id' => $userinfo['openid']))->save($data);

                    $user = $user_model->where(array('id' => $wechat_user['user_id']))->find();
                    $data = array(
                        'parent_id' => I('get.u', 0, 'intval'),
                        'avatar' => $userinfo['headimgurl']
                    );

                    if (!$data['parent_id'] || $data['parent_id'] == $user['id'] || $user['parent_id'])
                        unset($data['parent_id']);

                    $user_model->where(array('id' => $user['id']))->save($data);
                }

                //session赋值
                session('user_id', $user['id']);

                //跳转地址
                if ($redirect = I('get.redirect', '', 'base64_decode'))
                    redirect($redirect);
                else
                    redirect(U('User/index'));
                break;
            default:
                header('Location: https://open.weixin.qq.com/connect/qrconnect' .
                    '?appid=' . $config['appid'] .
                    '&redirect_uri=' . rawurlencode(__HOST__ . $_SERVER['REQUEST_URI']) .
                    '&response_type=code&scope=snsapi_login&state=code#wechat_redirect');
        }
    }

    //微信OEM登录
    public function wechatOem()
    {
      
        if(D('User')->isLogin()){
            $this->redirect('Index/index');
        }
        if (session('wechat_open_id')) {
            if ($redirect = I('get.redirect', '', 'base64_decode'))
                redirect($redirect);
            else
                redirect(U('User/index'));
        }



        switch (I('get.state')) {
            case 'token':
            if(session('redirect_url')){
               $redirect_url=base64_decode(session('redirect_url'));
            }else{
               $redirect_url=U('Index/index'); 
            }
                $state = array(
                    'state' => true,
                    'message' => '恭喜，微信登陆成功',
                    'redirect_url'=>$redirect_url,
                );

                try {
                    $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                    $openid = $mem->get('wechat_openid_' . session_id());
                    $userid = $mem->get('userid_' . session_id());

                    if (!$openid || !$userid)
                        E('抱歉，授权失败');

                    //session赋值
                    session('openid', $openid);
                    session('user_id', $userid);
                    D('Cart')->userToCart();
                    session('redirect_url',null);
                } catch (\Think\Exception $e) {
                    $state = array(
                        'state' => false,
                        'message' => $e->getMessage(),
                    );
                }
                $this->ajaxReturn($state);
                break;
        }

        $host = preg_replace('/\/\/(\w+\.)+(\w+\.\w+)/i', '//www.$2', __HOST__);
        $qrcode = base64_encode($host . U('User/pcWologin', 'code=' . base64_encode(session_id())));
        $this->assign('qrcode', $qrcode);
        $this->assign('page_title', '微信快捷登录');
        $this->display();
    }

}