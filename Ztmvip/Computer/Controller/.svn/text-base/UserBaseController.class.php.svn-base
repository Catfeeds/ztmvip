<?php
/**
 * 会员基础控制器
 * author: lihongfu
 */
namespace Computer\Controller;
class UserBaseController extends BaseController
{
    protected $user_id = 0; //会员id

    //检查用户登录状态
    public function _initialize()
    {
        parent::_initialize();

        if (!D('User')->isLogin()) {
            if (IS_AJAX) {
                $this->ajaxReturn(array(
                    'state' => false,
                    'message' => '登录超时，请重新登录系统'
                ));
            } else {
                redirect(U('Login/index'));
            }
        }
        $this->user_id = session('user_id');
    }

    public function userError($state=302,$message='',$url='')
    {
        switch ( $state ){
            case 302:
                $this->assign('page_title','错误');
                $this->assign('message',$message);
                $this->assign('url',$url);
                $this->display('User:error');
                break;
        }
        exit;
    }
}