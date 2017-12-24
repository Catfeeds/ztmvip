<?php
/**
 * 商品品牌控制器
 * author: Tom
 */
namespace Admin\Controller;
class GoodsBrandController extends BaseController
{
    protected $brand_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('goods_brand',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->brand_model = D('GoodsBrand');
        $this->assign('aside_id',0);
    }

    /**
     * 修改品牌
     * @param null $id 品牌id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['brand_name'] )
                    E('抱歉，请输入品牌名称');
                if ( !$post['brand_logo'] )
                    E('抱歉，请上传品牌Logo');
                if ( !$post['brand_desc'] )
                    E('抱歉，请输入品牌介绍');

                $data = array_intersect_key($post,array_flip(array(
                    'brand_name',
                    'brand_logo',
                    'brand_desc',
                )));
                $data['brand_desc'] = htmlspecialchars_decode($data['brand_desc']);

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->brand_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->brand_model->next_primary();

                    if ( !$this->brand_model->add($data) )
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
            $brand = $this->brand_model->where(array('id' => $id))->find();
            if ( !$brand )
                $this->_empty();

            $this->assign('edit',$brand);
        }

        $this->assign('page_title','品牌信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );

        if ( $get['brand_name'] )
            $map['_string'] = 'INSTR(brand_name,"'.$get['brand_name'].'")>0';

        $count = $this->brand_model->where($map)->count();
        $page = $this->page($count);
        $brand = $this->brand_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$brand);

        $this->assign('page_title','商品品牌');
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
                        $this->brand_model->where($map)->delete();
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->brand_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $brand = $this->brand_model->field('id,rank')->where($map)->find();
                        if ( !$brand )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $brand['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $brand_rank = $this->brand_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$brand_rank )
                            break;

                        foreach ( $brand_rank as $val ){
                            $this->brand_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->brand_model->where(array('id'=>$rank_id))->save(array('rank'=>$brand['rank']));
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