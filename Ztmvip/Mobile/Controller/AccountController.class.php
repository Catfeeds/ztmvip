<?php
/**
 * 会员资金控制器
 * author: Tom
 */
namespace Mobile\Controller;
class AccountController extends UserBaseController
{
    protected $account_model,$user_model;

    public function _initialize(){
        parent::_initialize();

        $this->account_model = D('AccountLog');
        $this->user_model = D('User');
    }

    //用户充值
    public function deposit(){

    }
}