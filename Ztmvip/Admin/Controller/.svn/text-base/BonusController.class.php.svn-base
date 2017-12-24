<?php
/**
 * 红包控制器
 * author: Tom
 */
namespace Admin\Controller;
class BonusController extends BaseController
{
    protected $bonus_model,$user_bonus_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('bonus',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->bonus_model = D('Bonus');
        $this->user_bonus_model = D('UserBonus');
        $this->assign('aside_id',9);
    }

    /**
     * 修改红包
     * @param null $id 红包id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['bonus_name'] )
                    E('抱歉，请输入红包名称');
                if ( !$post['bonus_money'] )
                    E('抱歉，请输入红包金额');
                if ( !$post['send_type'] )
                    E('抱歉，请选择发放方式');
                if ( !$post['min_order_amount'] )
                    E('抱歉，请输入起用金额');
                if ( !$post['send_start'] || !$post['send_end'] ) {
                    E('抱歉，请输入发放时间');
                }elseif ( strtotime($post['send_start']) >= strtotime($post['send_end']) ) {
                    E('抱歉，结束发放时间必须大于开始发放时间');
                }else{
                    $post['send_start'] = strtotime($post['send_start']);
                    $post['send_end'] = strtotime($post['send_end']);
                }
                if ( !$post['use_start'] || !$post['use_end'] ) {
                    E('抱歉，请输入使用时间');
                }elseif ( strtotime($post['use_start']) >= strtotime($post['use_end']) ) {
                    E('抱歉，结束使用时间必须大于开始使用时间');
                }else{
                    $post['use_start'] = strtotime($post['use_start']);
                    $post['use_end'] = strtotime($post['use_end']);
                }
                if ( $post['send_type'] == 'user' && (!$post['user_id'] || !is_array($post['user_id'])) )
                    E('抱歉，请选择要获得红包的会员');
                if ( $post['send_type'] == 'amount' && intval($post['min_amount']) <= 0 && intval($post['max_amount']) <= 0 ){
                    E('抱歉，请输入订单金额上下线');
                }else{
                    $post['min_amount'] = intval($post['min_amount']);
                    $post['max_amount'] = intval($post['max_amount']);
                }
                if ( $post['send_type'] == 'goods' && intval($post['goods_id']) <= 0 ){
                    E('抱歉，请选择能获得红包的商品');
                }else{
                    $post['goods_id'] = intval($post['goods_id']);
                }

                $data = array_intersect_key($post,array_flip(array(
                    'bonus_name',
                    'bonus_money',
                    'send_type',
                    'min_order_amount',
                    'send_start',
                    'send_end',
                    'use_start',
                    'use_end',
                    'user_id',
                    'min_amount',
                    'max_amount',
                    'goods_id',
                )));

                if ( $id ){
                    if ( $this->user_bonus_model->where(array('bonus_id'=>$id))->count() )
                        unset($data['bonus_money'],$data['send_type']);

                    $map = array(
                        'id' => $id,
                    );
                    $this->bonus_model->where($map)->save($data);

                    //更新用户红包数据
                    $this->user_bonus_model->where(array('bonus_id'=>$id))->save($data);
                }else{
                    if ( !($id = $this->bonus_model->add($data)) )
                        E('抱歉，操作失败');
                }

                /* --按会员发放-- */
                if ( $post['send_type'] == 'user' ){
                    $user_bonus = array();

                    foreach ( $post['user_id'] as $val ){
                        $user_bonus[] = array(
                            'user_id' => $val,
                            'bonus_id' => $id,
                            'bonus_sn' => uniqid().rand(100,999),
                            'manager_id' => $this->_manager_id,
                            'date_add' => time(),
                        );
                    }

                    $this->user_bonus_model->addAll($user_bonus);
                }
                /* --end-- */
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        if ( $id ){
            $bonus = $this->bonus_model->where(array('id' => $id))->find();
            if ( !$bonus )
                $this->_empty();

            $this->assign('edit',$bonus);
            $this->assign('edit_send_type',$bonus['send_type']);

            $send_count = $this->user_bonus_model->where(array('bonus_id'=>$id))->count();
            $this->assign('send_count',$send_count);
        }

        $goods_brand = D('GoodsBrand')->brand_list();
        $this->assign('goods_brand',make_array($goods_brand,'id','brand_name'));

        $goods_category = D('GoodsCategory')->category_list(0);
        $this->assign('goods_category',$goods_category);

        $send_type = C('bonus');
        $this->assign('send_type',$send_type['TYPE']);

        $this->assign('page_title','红包信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            'disabled' => 'N',
        );

        if ( $get['bonus_name'] )
            $map['_string'] = 'INSTR(bonus_name,"'.$get['bonus_name'].'")>0';

        $count = $this->bonus_model->where($map)->count();
        $page = $this->page($count);
        $bonus = $this->bonus_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
        foreach ( $bonus as &$val ){
            $val['send_count'] = $this->user_bonus_model->where(array('bonus_id'=>$val['id']))->count();
            $val['use_count'] = $this->user_bonus_model->where(array('bonus_id'=>$val['id'],'date_use'=>array('neq',0)))->count();
        }
        unset($val);
        $this->assign('list',$bonus);

        $send_type = C('bonus');
        $this->assign('send_type',$send_type['TYPE']);

        $this->assign('page_title','红包列表');
        $this->display();
    }

    /**
     * 发放记录
     * @param $id 红包id
     */
    public function log($id){
        $get = I('get.');

        $map = array(
            'ub.bonus_id' => $id,
        );

        $count = $this->user_bonus_model->alias('ub')->where($map)->count();
        $page = $this->page($count);
        $bonus = $this->user_bonus_model->alias('ub')
            ->field('ub.*,b.bonus_name,u.user_name,m.nick_name AS manager_name')
            ->join('__BONUS__ AS b ON b.id=ub.bonus_id')
            ->join('__USER__ AS u ON u.id=ub.user_id')
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=ub.manager_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('ub.id DESC')->select();
        $this->assign('list',$bonus);

        $send_type = C('bonus');
        $this->assign('send_type',$send_type['TYPE']);

        $this->assign('page_title','发放记录');
        $this->display();
    }

    //修改属性
    public function prop(){
        if (IS_POST && IS_AJAX) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try {
                if (!$post['action'])
                    E('非法操作');

                if (!$post['id'])
                    E('抱歉，请选择要操作的项目');

                switch ($post['action']) {
                    case 'delete':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->bonus_model->where($map)->save(array('disabled' => 'Y'));
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