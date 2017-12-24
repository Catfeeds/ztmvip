<?php
/**
 * 管理员控制器
 * author: Tom
 */
namespace Admin\Controller;
class ManagerController extends BaseController
{
    protected $manager_model,$depart_model,$group_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('admin',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->manager_model = D('Manager');
        $this->depart_model = D('ManagerDepart');
        $this->group_model = D('ManagerGroup');
        $this->assign('aside_id',6);
    }

    /**
     * 修改管理员
     * @param null $id 管理员id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['user_name'] )
                    E('抱歉，请填写用户名');

                if ( !$post['nick_name'] )
                    E('抱歉，请填写姓名');

                if ( !$post['depart_id'] )
                    E('抱歉，请选择部门');

                if ( !$post['group_id'] )
                    E('抱歉，请选择管理组');

                if ( !$id && !$post['password'] )
                    E('抱歉，请输入密码');

                if ( $post['password'] != $post['repassword'] )
                    E('抱歉，前后密码不一致');

                $data = array_intersect_key($post,array_flip(array(
                    'user_name',
                    'nick_name',
                    'depart_id',
                    'group_id',
                )));

                if ( $post['password'] )
                    $data['password'] = $this->manager_model->compile_password($post['password']);

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->manager_model->where($map)->save($data);
                }else{
                    if ( !$this->manager_model->add($data) )
                        E('抱歉，操作失败');
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $depart = $this->depart_model->field('id,depart_name')->select();
        $this->assign('depart',make_array($depart,'id','depart_name'));

        $group = $this->group_model->field('id,group_name')->select();
        $this->assign('group',make_array($group,'id','group_name'));

        if ( $id ){
            $manager = $this->manager_model->where(array('id' => $id))->find();
            if ( !$manager )
                $this->_empty();

            $this->assign('edit',$manager);
        }

        $this->assign('page_title','管理员信息');
        $this->display();
    }

    public function index(){
        $map = array(
            'm.id' => array('neq',1),
        );
        $count = $this->manager_model->alias('m')->where($map)->count();
        $page = $this->page($count);
        $manager = $this->manager_model->field('m.*,md.depart_name,mg.group_name')->alias('m')
            ->join('__MANAGER_DEPART__ AS md ON m.depart_id=md.id')
            ->join('__MANAGER_GROUP__ AS mg ON m.group_id=mg.id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$manager);

        $this->assign('page_title','管理员列表');
        $this->display();
    }

    //修改属性
    public function prop(){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['action'] )
                    E('非法操作');

                if ( !$post['id'] )
                    E('抱歉，请选择要操作的项目');

                switch ( $post['action'] ){
                    case 'delete':
                        $map = array(
                            'id' => array(array('neq',1),array('in',$post['id'])),
                        );
                        if ( !$this->manager_model->where($map)->delete() )
                            E('抱歉，操作失败');
                        break;
                    case 'disable':
                    case 'enable':
                        $map = array(
                            'id' => array(array('neq',1),array('in',$post['id'])),
                        );
                        $this->manager_model->where($map)->save(array('disabled' => $post['action']=='enable'?'N':'Y'));
                        break;
                    default:
                        E('非法操作');
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
}