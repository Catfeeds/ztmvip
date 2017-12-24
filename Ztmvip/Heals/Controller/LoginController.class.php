<?php
/**
 * 登录控制器
 * author: Tom
 */
namespace Heals\Controller;
class LoginController extends \Common\Controller\CommonController
{
    protected $manager_model;
    //初始化
    public function _initialize(){
        if ( DOMAIN_PREFIX != C('admin_domain') )
            $this->_empty();

        $this->manager_model = D('Manager');

        $this->assign('title','管理员登陆');
        $this->assign('sitename',C('website.name'));
    }

    public function index(){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，登陆成功',
                'uri' => $post['ret'] ? base64_decode($post['ret']) : U('Index/index'),
            );

            try{
                if ( !$post['user_name'] ){
                    E('抱歉，用户名为空');
                }

                $map = array(
                    'user_name' => $post['user_name'],
                    'password' => $this->manager_model->compile_password($post['password']),
                );

                $manager_id = $this->manager_model->where($map)->getField('id');
                //dump($manager_id);exit;
                if ( !$manager_id ){
                    E('抱歉，用户名或密码错误');
                }

                if ( !$this->manager_model->login($manager_id) ){
                    E('抱歉，登录失败');
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        C('layout_on',false);
        $this->assign('ret',I('get.ret',''));
        $this->assign('page_title','后台登陆');
        $this->display();
    }

    //登出
    public function out(){
        $this->manager_model->out();
        redirect(U('Login/index'));
    }
}