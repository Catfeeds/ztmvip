<?php
/**
 * 砍价活动控制器
 * author: Tom
 */
namespace Admin\Controller;
class BargainController extends BaseController
{
    protected $bargain_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('bargain',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->bargain_model = D('Bargain');
        $this->assign('aside_id',7);
    }

    /**
     * 修改砍价
     * @param null $id 秒杀id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['goods_id'] )
                    E('抱歉，请选择秒杀商品');
                if ( !$post['title'] )
                    E('抱歉，请输入活动标题');
                if ( !$post['bargain_image'] )
                    E('抱歉，请上传活动主图');
                if ( !$post['bargain_thumb'] )
                    E('抱歉，请上传活动缩略图');
                if ( !$post['goods_name'] )
                    E('抱歉，请输入商品标题');
                if ( !$post['bargain_price'] || !is_numeric($post['bargain_price']) || floatval($post['bargain_price']) < 0 )
                    E('抱歉，商品价格格式错误');
                if ( !$post['middle_price'] || !is_numeric($post['middle_price']) || floatval($post['middle_price']) < 0 )
                    E('抱歉，中阶价格格式错误');
                if ( !$post['min_price'] || !is_numeric($post['min_price']) || floatval($post['min_price']) < 0 )
                    E('抱歉，底价格式错误');
                if ( !$post['bargain_start'] || strtotime($post['bargain_start']) < 1 )
                    E('抱歉，请选择开始时间');
                else
                    $post['bargain_start'] = strtotime($post['bargain_start']);

                if ( !$post['bargain_end'] || strtotime($post['bargain_end']) < 1 )
                    E('抱歉，请选择结束时间');
                else
                    $post['bargain_end'] = strtotime($post['bargain_end']);

                if ( $post['bargain_end'] <= $post['bargain_start'] )
                    E('抱歉，结束时间必须大于开始时间');
                if ( !$post['des'] )
                    E('抱歉，请输入活动描述');

                //同商品时段内活动重复性检查
                $sql = "((bargain_start >= {$post['bargain_start']} AND bargain_start <= {$post['bargain_end']}) OR (bargain_end >= {$post['bargain_start']} AND bargain_end <= {$post['bargain_end']}))
                        AND goods_id = {$post['goods_id']}";
                $id && $sql .= " AND id != $id";
                if ( $this->bargain_model->where($sql)->count() )
                    E('抱歉，此时段内已有该商品的砍价活动');

                $data = array_intersect_key($post,array_flip(array(
                    'goods_id',
                    'title',
                    'bargain_image',
                    'bargain_thumb',
                    'goods_name',
                    'bargain_price',
                    'middle_price',
                    'min_price',
                    'bargain_start',
                    'bargain_end',
                    'des',
                )));

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->bargain_model->where($map)->save($data);
                }else{
                    if ( !$this->bargain_model->add($data) )
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
            $bargain = $this->bargain_model->where(array('id' => $id))->find();
            if ( !$bargain )
                $this->_empty();

            $this->assign('edit',$bargain);
        }

        $this->assign('page_title','活动信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            'b.disabled' => 'N',
        );
        $join = '__GOODS__ AS g ON g.id=b.goods_id';

        if ( $get['goods_name'] )
            $join .= ' AND INSTR(g.goods_name,"'.$get['goods_name'].'") > 0';

        if ( $get['bargain_start'] )
            $map['bargain_start'] = array('egt',strtotime($get['bargain_start']));

        if ( $get['bargain_end'] )
            $map['bargain_end'] = array('elt',strtotime($get['bargain_end']));

        $count = $this->bargain_model->alias('b')->join($join)->where($map)->count();
        $page = $this->page($count);
        $bargain = $this->bargain_model->alias('b')->field('b.*,g.goods_name,g.shop_price')
            ->join($join)
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('b.id DESC')->select();
        $this->assign('list',$bargain);

        $this->assign('page_title','砍价活动');
        $this->display();
    }

    //砍价记录
    public function log($id){
        $log_model = D('BargainLog');
        $get = I('get.');

        $map = array(
            'bargain_id' => $id,
        );
        $join_bargain_user = '__USER__ AS bu ON bu.id=b.bargain_user';
        $join_order_user = '__USER__ AS ou ON ou.id=b.order_user';

        if ( $get['bargain_user'] )
            $join_bargain_user .= ' AND INSTR(bu.user_name,"'.$get['bargain_user'].'")>0';

        if ( $get['order_user'] )
            $join_order_user .= ' AND INSTR(ou.user_name,"'.$get['order_user'].'")>0';

        $count = $log_model->alias('b')
            ->join($join_order_user)
            ->join($join_bargain_user)
            ->where($map)->count();
        $page = $this->page($count);
        $log = $log_model->alias('b')->field('b.*,bu.user_name AS bargain_user_name,ou.user_name AS order_user_name')
            ->join($join_order_user)
            ->join($join_bargain_user)
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
        $this->assign('list',$log);

        $this->assign('page_title','砍价记录');
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
                        $this->bargain_model->where($map)->save(array('disabled' => 'Y'));
                        break;
                    case 'saleup':
                    case 'saledown':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->bargain_model->where($map)->save(array('on_sale' => $post['action'] == 'saleup' ? 'Y' : 'N'));
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