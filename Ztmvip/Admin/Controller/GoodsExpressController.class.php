<?php
/**
 * 商品运费控制器
 * author: Tom
 */
namespace Admin\Controller;
class GoodsExpressController extends BaseController
{
    protected $express_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('goods_express',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->express_model = D('GoodsExpress');
        $this->assign('aside_id',0);
    }

    /**
     * 修改运费
     * @param null $id 运费id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['express_name'] )
                    E('抱歉，请输入运费名称');

                $data = array_intersect_key($post,array_flip(array(
                    'express_name',
                    'free_amount',
                    'postage',
                    'is_default',
                )));

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->express_model->where($map)->save($data);
                }else{
                    if ( !$this->express_model->add($data) )
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
            $express = $this->express_model->where(array('id' => $id))->find();
            if ( !$express )
                $this->_empty();

            $this->assign('edit',$express);
            $this->assign('edit_is_default',$express['is_default']);
        }else{
            $this->assign('edit_is_default','N');
        }

        $this->assign('is_default',array('Y'=>'是','N'=>'否'));

        $this->assign('page_title','运费信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            'shop_id' => 0,
        );

        if ( $get['express_name'] )
            $map['_string'] = 'INSTR(express_name,"'.$get['express_name'].'")>0';

        $count = $this->express_model->where($map)->count();
        $page = $this->page($count);
        $express = $this->express_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('id ASC')->select();
        $this->assign('list',$express);

        $this->assign('page_title','商品运费');
        $this->display();
    }

    //修改属性
    public function prop(){
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
                    case 'delete':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->express_model->where($map)->delete();
                        break;
                    case 'default':
                        $this->express_model->where('1')->save(array('is_default' => 'N'));
                        $map = array(
                            'id' => $post['id'],
                        );
                        $this->express_model->where($map)->save(array('is_default' => 'Y'));
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
}