<?php
/**
 * 商品类型控制器
 * author: Tom
 */
namespace Admin\Controller;
class GoodsSkuController extends BaseController
{
    protected $sku_model;

    public function _initialize(){
        parent::_initialize();

        $this->sku_model = D('GoodsSku');
        $this->assign('aside_id',0);
    }

    /**
     * 修改类型
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
                if ( !$post['sku_name'] )
                    E('抱歉，请输入类型名称');
                if ( !$post['skus'] )
                    E('抱歉，请输入商品规格');

                $data = array_intersect_key($post,array_flip(array(
                    'sku_name',
                    'skus',
                )));
                $data['skus'] = json_encode($data['skus']?:array($data['skus']));

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->sku_model->where($map)->save($data);
                }else{
                    if ( !$this->sku_model->add($data) )
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
            $sku = $this->sku_model->where(array('id' => $id))->find();
            if ( !$sku )
                $this->_empty();

            $sku['skus'] = json_decode($sku['skus'],true);
            $this->assign('edit',$sku);
        }

        $this->assign('page_title','类型信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');
        $map = array(
            'disabled' => 'N',
        );

        if ( $get['sku_name'] ) {
            $map['_string'] = 'INSTR(sku_name,"'.$get['sku_name'].'")>0';
        }

        $count = $this->sku_model->where($map)->count();
        $page = $this->page($count);
        $sku = $this->sku_model->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$sku);

        $this->assign('page_title','商品类型');
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
                        $this->sku_model->where($map)->save(array('disabled'=>'Y'));
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->sku_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
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

    //搜索属性json数据
    public function search(){
        $post = I('post.');

        $map = array(
            'disabled' => 'N',
        );

        if ( $post['words'] )
            $map['_string'] = 'INSTR(sku_name, "'.$post['words'].'")>0';

        if ( $post['sku_id'] )
            $map['id'] = $post['sku_id'];

        $sku = $this->sku_model->where($map)->select();

        if ( $sku ){
            foreach ( $sku as &$val ){
                $val['skus'] = json_decode($val['skus'],true);
            }
            unset($val);
        }

        $this->ajaxReturn($sku ? $sku : array());
    }
}