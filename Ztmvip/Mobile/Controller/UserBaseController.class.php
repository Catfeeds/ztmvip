<?php
/**
 * 会员基础控制器
 * author: Tom
 */
namespace Mobile\Controller;
class UserBaseController extends BaseController
{
    protected $user_id=0; //会员id

    //检查用户登录状态
    public function _initialize(){
        parent::_initialize();

//        session('user_id','28575');
//        session('openid','oHBm5jmd8Q3KrAWAZ_jBa1tPoYXo');

//       session('user_id','19023');
//       session('openid','oHBm5jnk1nP3bAdFlkjoFytqHM8k');

        $is_login = false;  //是否登录

        if ( !session('user_id') || !session('openid') ){
            if ( cookie('wechat_token') ) {
                $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                $token = base64_decode(cookie('wechat_token'));
                $openid = $mem->get('wechat_openid_'. $token);
                $userid = $mem->get('userid_'. $token);

                if ( $openid && $userid ){
                    session('user_id',$userid);
                    session('openid',$openid);
                    $is_login = true;
                }else{
                    cookie('wechat_token',null);
                }
            }
        }else{
            $is_login = true;
        }

        if ( !$is_login ){
            if ( IS_AJAX ){
                $this->ajaxReturn(array(
                    'state' => false,
                    'message' => '登录超时，请重新登录系统'
                ));
            }else{
                session('redirect_url', __HOST__ . $_SERVER['REQUEST_URI']);
                A('Wechat')->do_oauth();
            }
        }

        $this->user_id = session('user_id');
    }
}