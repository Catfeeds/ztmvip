<?php
/**
 * 商家类型控制器
 * author: Tom
 */
namespace Admin\Controller;
class ShopTypeController extends BaseController
{
    protected $type_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('shop',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->type_model = D('ShopType');
        $this->assign('aside_id',10);
    }

    /**
     * 修改类型
     * @param $id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                $data = array_intersect_key($post,array_flip(array(
                    'type_name',
                    'parent_id',
                )));
                $data['parent_id'] = intval($data['parent_id']);
                $data['tree_struct'] = $this->type_model->where(array('id'=>$data['parent_id']))->getField('tree_struct');
                $data['tree_struct'] = $data['tree_struct'] ? $data['tree_struct'] . $data['parent_id'] .'.' : '0.';

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->type_model->where($map)->save($data);
                }else{
                    $data['display'] = 'Y';

                    if ( !$this->type_model->add($data) )
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
            $type = $this->type_model->where(array('id'=>$id))->find();
            if ( !$type )
                $this->_empty();

            $this->assign('edit',$type);
        }

        $shop_type = $this->type_model->where(array('id'=>array('neq',$id),'disabled'=>'N'))->select();
        $this->assign('shop_type',$shop_type);

        $this->assign('page_title','店铺类型');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );

        if ( $get['type_name'] && preg_match('/^\d+$/i',$get['type_name']) )
            $map['st.id'] = $get['type_name'];
        elseif ( $get['type_name'] )
            $map['_string'] = 'INSTR(st.type_name,"'.$get['type_name'].'")>0';

        $count = $this->type_model->alias('st')->where($map)->count();
        $page = $this->page($count);
        $type = $this->type_model->alias('st')->field('st.*,pst.type_name AS parent_type')
            ->join('LEFT JOIN __SHOP_TYPE__ AS pst ON pst.id=st.parent_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$type);

        $this->assign('page_title','店铺类型');
        $this->display();
    }

    //修改类型属性
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
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->type_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
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