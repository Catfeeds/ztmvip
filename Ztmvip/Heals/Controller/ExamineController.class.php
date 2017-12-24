<?php
/**
 * 检测控制器
 * author: Tom
 */
namespace Heals\Controller;
class ExamineController extends BaseController
{
    protected $user_examine_model;

    protected $examine_action_model;

    public function _initialize()
    {
        parent::_initialize();

        if (!check_admin_rights('examine', false))
            $this->error('抱歉，您暂无权限使用该功能');

        $this->user_examine_model = D('UserExamine');
        $this->examine_action_model = D('ExamineActionLog');
        $this->assign('aside_id', 1);
    }

    /**
     * 检测记录
     */
    public function index()
    {
        $get = I('get.');
        $map = array(
            '_string' => '1',
        );
        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['u.id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $map['_string'] .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        if($get['user_id'] && intval($get['user_id'])>0)
        {
            $map['ue.user_id'] = intval($get['user_id']);
        }
        $count = $this->user_examine_model->alias('ue')
            ->join('__USER__ u on ue.user_id=u.id')
            ->where($map)->count();
        $page = $this->page($count);

        $list = $this->user_examine_model->alias('ue')->field('ue.*,u.user_name')
            ->join('__USER__ u on ue.user_id=u.id')->limit($page->firstRow . ',' . $page->listRows)->where($map)
            ->order('date_add desc')->select();
        $this->assign('page_title', '检测记录');
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 检测记录详情
     */
    public function edit($id)
    {
        if (IS_POST && IS_AJAX) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try {
                if (!$id)
                    E('非法操作');

                if (!$post['action_note']) {
                    E('请填写备注');
                }
                if(!$post['user_id']){
                    E('请选择要操作的用户');
                }

                $data_action['user_id'] = $post['user_id'];
                $data_action['manager_id'] = $this->_manager_id;
                $data_action['action_note'] = $post['action_note'];
                $data_action['date_add'] = time();

                $this->examine_action_model->add($data_action);
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
        if (!$id)
            $this->_empty();
        $get = I('get.');
        $count = $this->examine_action_model->alias('ea')->field('ea.*,m.nick_name AS manager_name')
            ->join('__MANAGER__ AS m ON m.id=ea.manager_id')
            ->where(array('ea.user_id' => $get['user_id']))->count();
        $page = $this->page($count);

        $examine_action = $this->examine_action_model->alias('ea')->field('ea.*,m.nick_name AS manager_name')
            ->join('__MANAGER__ AS m ON m.id=ea.manager_id')->limit($page->firstRow . ',' . $page->listRows)
            ->where(array('ea.user_id' => $get['user_id']))->order('date_add desc')->select();

        $examine = $this->user_examine_model->alias('ue')
            ->join('__USER__ u on ue.user_id=u.id')
            ->where(array('ue.id' => $id))->find();

        $this->assign('examine_action', $examine_action);
        $this->assign('edit', $examine);
        $this->assign('page_title', '检测详情');
        $this->display();
    }
}