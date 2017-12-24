<?php
/**
 * 会员控制器
 * author: Tom
 */
namespace Heals\Controller;
class UserController extends BaseController
{
    protected $user_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('user',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->user_model = D('User');
        $this->assign('aside_id',4);
    }

    public function index(){
        $get = I('get.');
        $map = array(
            '_string' => '1',
        );

        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['u.id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $map['_string'] .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        if ( $get['mobile'] )
            $map['_string'] .= ' AND INSTR(u.mobile,"'.$get['mobile'].'")>0';

        $count = $this->user_model->alias('u')->where($map)->count();
        $page = $this->page($count);
        $user = $this->user_model->alias('u')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('u.id DESC')->select();
        $this->assign('list',$user);

        $this->assign('page_title','会员列表');
        $this->display();
    }

}