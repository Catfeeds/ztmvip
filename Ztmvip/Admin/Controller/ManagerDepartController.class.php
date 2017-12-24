<?php
/**
 * 管理部门控制器
 * author: Tom
 */
namespace Admin\Controller;
class ManagerDepartController extends BaseController
{
    protected $depart_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('admin',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->depart_model = D('ManagerDepart');
        $this->assign('aside_id',6);
    }

    /**
     * 修改部门
     * @param null $id 部门id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['depart_name'] )
                    E('抱歉，请填写部门名称');

                $data = array_intersect_key($post,array_flip(array(
                    'depart_name',
                )));

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->depart_model->where($map)->save($data);
                }else{
                    if ( !$this->depart_model->add($data) )
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
            $depart = $this->depart_model->where(array('id' => $id))->find();
            if ( !$depart )
                $this->_empty();

            $this->assign('edit',$depart);
        }

        $this->assign('page_title','部门信息');
        $this->display();
    }

    public function index(){
        $map = array(
            'id' => array('neq',1),
        );
        $count = $this->depart_model->where($map)->count();
        $page = $this->page($count,1);
        $depart = $this->depart_model->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$depart);

        $this->assign('page_title','部门列表');
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
                        if ( !$this->depart_model->where($map)->delete() )
                            E('抱歉，操作失败');
                        break;
                    case 'disable':
                    case 'enable':
                        $map = array(
                            'id' => array(array('neq',1),array('in',$post['id'])),
                        );
                        $this->depart_model->where($map)->save(array('disabled' => $post['action']=='enable'?'N':'Y'));
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