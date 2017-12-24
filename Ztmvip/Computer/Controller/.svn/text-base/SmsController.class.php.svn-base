<?php
/**
 * 短信发送控制器
 * author: Tom
 */
namespace Computer\Controller;
class SmsController extends BaseController
{
    protected $sms_model;

    public function _initialize()
    {
        parent::_initialize();

        $this->sms_model = D('SmsLog');
        C('layout_on', false);
    }

    /**
     * 发送短信
     * @param $mobile 手机号
     * @param $content 短信内容
     * @return bool 发送成功
     */
    private function send($mobile, $content)
    {
        $sms = new \Common\Vendor\Sms();
        $xml = simplexml_load_string($sms->send($mobile, $content, time(), 2));
        if (strval($xml->response->result->attributes()->code) == 2000)
            return true;
        else
            return false;

        return true;
    }

    //会员注册发送短信
    public function userRegister()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );
        $post = I('post.');

        try {

            switch (I('post.topic')) {
                case 'old':
                    $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
                    if (!$mobile)
                        E('非法访问');
                    break;
                case 'new':
                    if (!preg_match('/(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}/i', $post['mobile']))
                        E('抱歉，请输入有效的手机号码');

                    $mobile = $post['mobile'];
                    break;
            }

            $map = array(
                'mobile' => $mobile,
                'template' => 'userRegister',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userRegister');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userRegister',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //会员找回密码
    public function userFindPwd()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );
        $post = I('post.');

        try {

            switch (I('post.topic')) {
                case 'old':
                    $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
                    if (!$mobile)
                        E('非法访问');
                    break;
                case 'new':
                    if (!preg_match('/(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}/i', $post['mobile']))
                        E('抱歉，请输入有效的手机号码');

                    $mobile = $post['mobile'];
                    break;
            }

            $map = array(
                'mobile' => $mobile,
                'template' => 'userFindPwd',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userFindPwd');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userFindPwd',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //会员手机绑定
    public function userMobile()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );
        $post = I('post.');

        try {
            if (!session('user_id'))
                E('抱歉，请先登录商城');

            switch (I('post.topic')) {
                case 'old':
                    $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
                    if (!$mobile)
                        E('非法访问');
                    break;
                case 'new':
                    if (!preg_match('/(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}/i', $post['mobile']))
                        E('抱歉，请输入有效的手机号码');

                    $mobile = $post['mobile'];
                    break;
            }

            $map = array(
                'mobile' => $mobile,
                'template' => 'userMobile',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userMobile');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userMobile',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //会员银行卡绑定
    public function userBank()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );

        try {
            if (!session('user_id'))
                E('抱歉，请先登录商城');

            $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
            if (!$mobile)
                E('非法访问');

            $map = array(
                'mobile' => $mobile,
                'template' => 'userBank',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userBank');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userBank',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //会员支付密码
    public function userPayword()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );

        try {
            if (!session('user_id'))
                E('抱歉，请先登录商城');

            $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
            if (!$mobile)
                E('非法访问');

            $map = array(
                'mobile' => $mobile,
                'template' => 'userPayword',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userPayword');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userPayword',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //会员登录密码
    public function userPassword()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );

        try {
            if (!session('user_id'))
                E('抱歉，请先登录商城');

            $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
            if (!$mobile)
                E('非法访问');

            $map = array(
                'mobile' => $mobile,
                'template' => 'userPassword',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userPassword');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userPassword',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }

    //设置安全信息
    public function userSafety()
    {
        $state = array(
            'state' => true,
            'message' => '短信发送成功，请注意接收',
        );

        try {
            if (!session('user_id'))
                E('抱歉，请先登录商城');

            $mobile = D('User')->where(array('id' => session('user_id')))->getField('mobile');
            if (!$mobile)
                E('非法访问');

            $map = array(
                'mobile' => $mobile,
                'template' => 'userSafety',
                'date_add' => array('egt', strtotime(date('Y-m-d 0:00:00'))),
            );
            if ($this->sms_model->where($map)->count() >= 5)
                E('抱歉，您的短信发送过多，请联系客服人员');

            $code = rand(100000, 999999);
            $this->assign('code', $code);
            $content = $this->fetch('userSafety');

            $data = array(
                'mobile' => $mobile,
                'template' => 'userSafety',
                'content' => md5($code),
                'date_add' => time(),
            );
            $id = $this->sms_model->add($data);

            if (!$this->send($mobile, $content))
                E('抱歉，短信发送失败，请联系客服人员');

            $this->sms_model->where(array('id' => $id))->save(array('date_send' => time()));
            //$state['message'] .= $content;
        } catch (\Think\Exception $e) {
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }
}