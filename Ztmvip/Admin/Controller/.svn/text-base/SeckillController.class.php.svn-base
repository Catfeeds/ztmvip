<?php
/**
 * 商品控制器
 * author: Tom
 */
namespace Admin\Controller;
class SeckillController extends BaseController
{
    protected $seckill_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('seckill',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->seckill_model = D('SeckillGoods');
        $this->assign('aside_id',7);
    }

    /**
     * 修改秒杀
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
                if ( !$post['kill_price'] || !is_numeric($post['kill_price']) || floatval($post['kill_price']) < 0 )
                    E('抱歉，秒杀价格格式错误');
                if ( !$post['goods_number'] )
                    E('抱歉，请填写秒杀数量');

                if ( !$post['kill_start'] || strtotime($post['kill_start']) < 1 )
                    E('抱歉，请选择开始时间');
                else
                    $post['kill_start'] = strtotime($post['kill_start']);

                if ( !$post['kill_end'] || strtotime($post['kill_end']) < 1 )
                    E('抱歉，请选择结束时间');
                else
                    $post['kill_end'] = strtotime($post['kill_end']);

                if ( $post['kill_end'] <= $post['kill_start'] )
                    E('抱歉，结束时间必须大于开始时间');

                //同商品时段内活动重复性检查
                $sql = "((kill_start >= {$post['kill_start']} AND kill_start <= {$post['kill_end']}) OR (kill_end >= {$post['kill_start']} AND kill_end <= {$post['kill_end']}))
                        AND goods_id = {$post['goods_id']}";
                $id && $sql .= " AND id != $id";
                if ( $this->seckill_model->where($sql)->count() )
                    E('抱歉，此时段内已有该商品的秒杀活动');

                $data = array_intersect_key($post,array_flip(array(
                    'goods_id',
                    'kill_price',
                    'goods_number',
                    'kill_start',
                    'kill_end',
                )));

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->seckill_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->seckill_model->next_primary();

                    if ( !$this->seckill_model->add($data) )
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
            $seckill = $this->seckill_model->where(array('id' => $id))->find();
            if ( !$seckill )
                $this->_empty();

            $this->assign('edit',$seckill);
        }

        $this->assign('page_title','秒杀信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            's.disabled' => 'N',
        );
        $join = '__GOODS__ AS g ON g.id=s.goods_id';

        if ( $get['goods_name'] )
            $join .= ' AND INSTR(g.goods_name,"'.$get['goods_name'].'") > 0';

        if ( $get['kill_start'] )
            $map['kill_start'] = array('egt',strtotime($get['kill_start']));

        if ( $get['kill_end'] )
            $map['kill_end'] = array('elt',strtotime($get['kill_end']));

        $count = $this->seckill_model->alias('s')->join($join)->where($map)->count();
        $page = $this->page($count);
        $seckill = $this->seckill_model->alias('s')->field('s.*,g.goods_name,g.shop_price')
            ->join($join)
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('s.rank DESC')->select();
        $this->assign('list',$seckill);

        $this->assign('page_title','秒杀专区');
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
                        $this->seckill_model->where($map)->save(array('disabled' => 'Y'));
                        break;
                    case 'saleup':
                    case 'saledown':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->seckill_model->where($map)->save(array('on_sale' => $post['action'] == 'saleup' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $seckill = $this->seckill_model->field('id,rank')->where($map)->find();
                        if ( !$seckill )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $seckill['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $seckill_rank = $this->seckill_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$seckill_rank )
                            break;

                        foreach ( $seckill_rank as $val ){
                            $this->seckill_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->seckill_model->where(array('id'=>$rank_id))->save(array('rank'=>$seckill['rank']));
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