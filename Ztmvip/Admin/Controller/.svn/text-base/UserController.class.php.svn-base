<?php
/**
 * 会员控制器
 * author: Tom
 */
namespace Admin\Controller;
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

    /**
     * 修改会员
     * @param $id 会员id
     */
    public function edit($id){
        if ( !$id )
            $this->_empty();

        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( $post['password'] || $post['repassword'] ){
                    if ( $post['password'] != $post['repassword'] )
                        E('抱歉，请输入品牌名称');
                    else
                        $post['password'] = \Common\Model\UserBaseModel::compile_password($post['password']);
                }else{
                    unset($post['password']);
                }

                $data = array_intersect_key($post,array_flip(array(
                    'password',
                )));

                $map = array(
                    'id' => $id,
                );
                $this->user_model->where($map)->save($data);
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $user = $this->user_model->where(array('id' => $id))->find();
        $this->assign('edit',$user);

        $this->assign('page_title','会员信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            '_string' => '1',
        );
        $join = '__WECHAT_USER__ AS wu ON wu.user_id=u.id';
        $join_type = 'LEFT JOIN ';

        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['u.id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $map['_string'] .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        if ( $get['wechat_user'] ){
            $join_type = '';
            $join .= ' AND INSTR(wu.nick_name,"'.$get['wechat_user'].'")>0';
        }

        if ( $get['mobile'] )
            $map['_string'] .= ' AND INSTR(u.mobile,"'.$get['mobile'].'")>0';

        $count = $this->user_model->alias('u')->join($join_type?'':$join_type.$join)->where($map)->count();
        $page = $this->page($count);
        $user = $this->user_model->alias('u')->field('u.*,wu.nick_name AS wechat_user')
            ->join($join_type.$join)
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('u.id DESC')->select();
        $this->assign('list',$user);

        $this->assign('page_title','会员列表');
        $this->display();
    }

    //修改属性
    public function prop()
    {
        if ( IS_POST && IS_AJAX ) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try {
                if ( !$post['action'] )
                    E('非法操作');

                if ( !$post['id'] )
                    E('抱歉，请选择要操作的项目');

                switch ( $post['action'] ) {
                    case 'disable':
                    case 'enable':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->user_model->where($map)->save(array('disabled' => $post['action'] == 'disable' ? 'Y' : 'N'));
                        break;
                    default:
                        E('非法操作');
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

    //搜索会员
    public function search(){
        $post = I('post.');

        $map = array(
            'disabled' => 'N',
        );
        $join = '__WECHAT_USER__ AS wu ON wu.user_id=u.id';
        $join_type = 'LEFT JOIN ';

        if ( $post['user_name'] )
            $map['_string'] = 'INSTR(u.user_name,"'.$post['user_name'].'")>0';

        if ( $post['wechat_name'] ){
            $join_type = '';
            $join .= ' AND INSTR(wu.nick_name,"'.$post['wechat_name'].'")>0';
        }

        if ( !$post['user_name'] && !$post['wechat_name'] )
            $this->ajaxReturn(array());

        $user = $this->user_model->alias('u')->field('u.*,wu.nick_name AS wechat_user')
            ->join($join_type.$join)
            ->where($map)->order('u.id DESC')->select();

        $this->ajaxReturn($user?:array());
    }
}