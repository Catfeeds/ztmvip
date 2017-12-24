<?php
/**
 * 管理组控制器
 * author: Tom
 */
namespace Admin\Controller;
class ManagerGroupController extends BaseController
{
    protected $group_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('admin',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->group_model = D('ManagerGroup');
        $this->assign('aside_id',6);
    }

    /**
     * 修改组
     * @param null $id 组id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['group_name'] )
                    E('抱歉，请填写组名称');

                if ( !$post['rights'] )
                    E('抱歉，请选择权限');

                $data = array_intersect_key($post,array_flip(array(
                    'group_name',
                )));
                $data['rights'] = join(',',$post['rights']);

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->group_model->where($map)->save($data);
                }else{
                    if ( !$this->group_model->add($data) )
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

        if ( $id ){
            $group = $this->group_model->where(array('id' => $id))->find();
            if ( !$group )
                $this->_empty();

            $group['rights'] = explode(',',$group['rights']);
            $this->assign('edit',$group);
            $this->assign('group_rights',$group['rights']);
        }

        $this->assign('rights',$this->group_model->rights);

        $this->assign('page_title','管理组信息');
        $this->display();
    }

    public function index(){
        $map = array(
            'id' => array('neq',1),
        );
        $count = $this->group_model->where($map)->count();
        $page = $this->page($count);
        $group = $this->group_model->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$group);

        $this->assign('page_title','管理组列表');
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
                        if ( !$this->group_model->where($map)->delete() )
                            E('抱歉，操作失败');
                        break;
                    case 'disable':
                    case 'enable':
                        $map = array(
                            'id' => array(array('neq',1),array('in',$post['id'])),
                        );
                        $this->group_model->where($map)->save(array('disabled' => $post['action']=='enable'?'N':'Y'));
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