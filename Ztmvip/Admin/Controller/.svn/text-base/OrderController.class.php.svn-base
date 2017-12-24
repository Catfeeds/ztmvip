<?php
/**
 * 订单控制器
 * author: Tom
 */
namespace Admin\Controller;
class OrderController extends BaseController
{
    protected $order_model,$order_goods_model,$goods_model,$user_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('order',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->order_model = D('Order');
        $this->order_goods_model = D('OrderGoods');
        $this->goods_model = D('Goods');
        $this->user_model = D('User');
        $this->assign('aside_id',1);
    }

    /**
     * 订单详情
     * @param $id 订单id
     */
    public function edit($id){
        $account_model = D('AccountLog');
        $action_model = D('OrderActionLog');
        $bonus_model = D('UserBonus');
        $coupon_model = D('UserCoupon');
        $affiliate_model = D('AffiliateLog');
        $order_state = C('order');
        $order_state = $order_state['state'];

        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$id )
                    E('非法操作');

                $extend_model = D('OrderExtend');

                $map = array(
                    'id' => $id,
                );
                $order = $this->order_model->where($map)->find();
                if ( !$order )
                    E('非法操作');

                $order_extend = $extend_model->where(array('order_id'=>$id))->find();
                if ( !$order_extend )
                    E('非法操作');

                $order_extend['bonus_get'] = json_decode($order_extend['bonus_get'],true);
                $order_extend['coupon_get'] = json_decode($order_extend['coupon_get'],true);

                $data = $extend_data = array();

                //新订单
                if ( $order['order_state'] == 'new' && $order['payment_state'] == 'new'
                    && in_array($post['order_state'],array('cancel','invalid')) ){
                    $data['order_state'] = $post['order_state'];
                }

                //未确认付款中
                if ( $order['order_state'] == 'new' && $order['payment_state'] == 'paying'
                    && in_array($post['order_state'],array('cancel','invalid')) ){
                    //取消、无效
                    $data['order_state'] = $post['order_state'];
                }

                //未确认已付款
                if ( $order['order_state'] == 'new' && $order['payment_state'] == 'payed'
                    && in_array($post['order_state'],array('confirm','cancel')) ){
                    //确认、取消、无效
                    $data['order_state'] = $post['order_state'];
                }

                //已确认未发货、备货中
                if ( $order['order_state'] == 'confirm' && in_array($order['shipping_state'],array('new','stock'))
                    && ( $post['order_state'] == 'cancel' || in_array($post['shipping_state'],array('send','stock')) ) ){
                    //取消
                    if ( $post['order_state'] ){
                        $data['order_state'] = $post['order_state'];
                    //发货、备货
                    }elseif ( $post['shipping_state'] ){
                        $data['shipping_state'] = $post['shipping_state'];

                        if ( $post['shipping_state'] == 'send' ){
                            if ( !$post['express_name'] || !$post['express_no'] )
                                E('抱歉，请输入快递名称及单号');

                            $data['date_send'] = time();
                            $extend_data['express_name'] = $post['express_name'];
                            $extend_data['express_no'] = $post['express_no'];
                        }
                    }
                }

                //已确认已发货
                if ( $order['order_state'] == 'confirm' && $order['shipping_state'] == 'send' && $post['order_state'] == 'cancel' ){
                    //取消
                    $data['order_state'] = $post['order_state'];
                }

                //已确认已收货
                if ( $order['order_state'] == 'confirm' && $order['shipping_state'] == 'receive' && $post['order_state'] == 'refunded' ){
                    //退款
                    $data['order_state'] = $post['order_state'];
                }

                //申请退款
                if ( $order['order_state'] == 'refund' && in_array($post['order_state'],array('refunded')) ){
                    $data['order_state'] = $post['order_state'];
                }

                /* --退款、取消时所赠送红包、优惠券、积分是否已被使用-- */
                if ( in_array($data['order_state'],array('cancel','refunded')) ){
                    if ( $bonus_model->where(array('id'=>array('in',$order_extend['bonus_get']?:'0'),'date_use'=>array('gt',0)))->count() > 0 )
                        E('抱歉，订单赠送红包已被使用');

                    if ( $coupon_model->where(array('id'=>array('in',$order_extend['coupon_get']?:'0'),'date_use'=>array('gt',0)))->count() > 0 )
                        E('抱歉，订单赠送优惠券已被使用');

                    if ( $order_extend['integral_get'] > intval($account_model->where(array('user_id'=>$order['user_id']))->sum('integral')) )
                        E('抱歉，订单赠送积分已被使用');

                    if ( $affiliate_model->where(array('order_type'=>'normal','order_id'=>$order['id'],'separated'=>'Y'))->count() )
                        E('抱歉，订单已分佣');
                }
                /* --end-- */

                $this->order_model->where(array('id'=>$id))->save($data);
                $extend_model->where(array('order_id'=>$id))->save($extend_data);

                //操作日志
                $data_action = array(
                    'order_state' => '',
                    'payment_state' => '',
                    'shipping_state' => '',
                );
                $data_action = array_merge($data_action,array_intersect_key($data,array_flip(array(
                    'order_state',
                    'payment_state',
                    'shipping_state',
                ))));
                if ( !$data_action )
                    E('非法操作');

                $data_action['order_id'] = $id;
                $data_action['manager_id'] = $this->_manager_id;
                $data_action['action_note'] = $post['action_note'];
                $data_action['date_add'] = time();

                $action_model->add($data_action);

                //退款、取消操作账户资金
                if ( in_array($data['order_state'],array('cancel','refunded')) ){
                    //计算退回余额
                    $surplus_amount = 0;
                    $surplus_amount += intval($order_extend['surplus_amount']*100); //余额支付
                    $surplus_amount += intval($order_extend['payment_amount']*100); //网上支付
                    $surplus_amount = floatval($surplus_amount / 100); //还原数据
                    //退回余额
                    $this->user_model->where(array('id'=>$order['user_id']))->setInc('user_money',$surplus_amount);

                    //退回积分
                    $integral = $order_extend['integral'] - $order_extend['integral_get'];
                    $this->user_model->where(array('id'=>$order['user_id']))->setInc('integral',$integral);

                    //账户余额变动日志
                    if ( $surplus_amount || $integral ){
                        $account_model->add(array(
                            'user_id' => $order['user_id'],
                            'change_type' => 'manual',
                            'user_money' => $surplus_amount,
                            'integral' => $integral,
                            'manager_id' => $this->_manager_id,
                            'change_desc' => '订单状态设置为 '.$order_state['order'][$data['order_state']].' '.$order_state['shipping'][$data['order_state']],
                            'date_add' => time(),
                        ));
                    }

                    //退回储值卡
                    if ( $order_extend['prepaid_amount'] )
                        D('UserPrepaid')->where(array('id'=>$order_extend['prepaid_id']))->setInc('money',$order_extend['prepaid_amount']);

                    //退回红包
                    if ( $order_extend['bonus_amount'] )
                        $bonus_model->where(array('id'=>$order_extend['bonus_id']))->save(array('order_id'=>0,'date_use'=>0));

                    //退回优惠券
                    if ( $order_extend['coupon_amount'] )
                        $coupon_model->where(array('id'=>$order_extend['coupon_id']))->save(array('order_id'=>0,'date_use'=>0));

                    //删除赠送红包
                    $bonus_model->where(array('id'=>array('in',$order_extend['bonus_get']?:'0')))->delete();

                    //删除赠送优惠券
                    $coupon_model->where(array('id'=>array('in',$order_extend['coupon_get']?:'0')))->delete();

                    //删除分佣
                    $affiliate_model->where(array('order_type'=>'normal','order_id'=>$order['id']))->delete();
                }
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        //订单信息
        $order = $this->order_model->alias('o')->field('o.*,u.user_name')
            ->join('__USER__ AS u ON u.id=o.user_id')
            ->where(array('o.id' => $id))->find();
        if ( !$order )
            $this->_empty();

        //订单扩展信息
        $order_extend = D('OrderExtend')->field('id,order_id',true)->where(array('order_id'=>$id))->find();
        $order = array_merge($order,$order_extend);
        $this->assign('edit',$order);

        //订单商品信息
        $order_goods = $this->order_goods_model->alias('og')->field('og.*,g.goods_name')
            ->join('__GOODS__ AS g ON g.id=og.goods_id')
            ->where(array('order_id'=>$id))->select();
        $this->assign('order_goods',$order_goods);

        //订单操作日志
        $order_action = $action_model->alias('oa')->field('oa.*,m.nick_name AS manager_name')
            ->join('__MANAGER__ AS m ON m.id=oa.manager_id')
            ->where(array('order_id'=>$id))->select();
        $this->assign('order_action',$order_action);

        $this->assign('order_state',$order_state);

        $this->assign('page_title','订单详情');
        $this->display();
    }

    //查询物流信息
    public function expressInfo(){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['express_no'] )
                    E('抱歉，请输入快递单号');

                $state['data'] = express_info($post['express_name'],$post['express_no']);
            }catch (\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );
        $join_order_extend = '__ORDER_EXTEND__ AS oe ON oe.order_id=o.id';

        if ( $get['shop'] == 'ztm' )
            $map['o.shop_id'] = 0;
        if ( $get['shop'] == 'shop' )
            $map['o.shop_id'] = array('gt',0);
        if ( $get['order_sn'] )
            $map['_string'] = 'INSTR(o.order_sn,"'.$get['order_sn'].'")>0';
        if ( $get['payment_state'] )
            $map['o.payment_state'] = $get['payment_state'];
        if ( $get['order_state'] )
            $map['o.order_state'] = $get['order_state'];
        if ( $get['shipping_state'] )
            $map['o.shipping_state'] = $get['shipping_state'];

        if ( $get['add_start'] || $get['add_end'] ){
            $map['o.date_add'] = array();
            if ( $get['add_start'] )
                array_push($map['o.date_add'],array('egt',strtotime($get['add_start'])));

            if ( $get['add_end'] )
                array_push($map['o.date_add'],array('elt',strtotime($get['add_end'])));
        }

        if ( $get['user_id'] )
            $map['o.user_id'] = $get['user_id'];
        if ( $get['consignee'] )
            $join_order_extend .= ' AND INSTR(oe.consignee,"'.$get['consignee'].'")>0';

        if ( $get['goods_name'] ){
            $order_id = $this->order_goods_model->alias('og')->field('order_id')
                ->join('__GOODS__ AS g ON og.goods_id=g.id AND INSTR(g.goods_name,"'.$get['goods_name'].'")>0')
                ->select();

            $map['o.id'] = array('in',$order_id?make_array($order_id,'order_id','order_id'):'0');
        }

        //导出xls文件
        if ( $get['xls'] == 'Y' )
            $this->xls($map);

        $count = $this->order_model->alias('o')
            ->join($join_order_extend)
            ->where($map)->count();
        $page = $this->page($count);
        $order = $this->order_model->alias('o')->field('o.*,oe.consignee,s.shop_name')
            ->join($join_order_extend)
            ->join('LEFT JOIN __SHOP__ AS s ON s.id=o.shop_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('o.id DESC')->select();
        foreach ( $order as &$val ){
            $val['order_goods'] = $this->order_goods_model->alias('og')->field('og.goods_id,g.goods_name')
                ->join('LEFT JOIN __GOODS__ AS g ON g.id=og.goods_id')
                ->where(array('og.order_id'=>$val['id']))->select();
        }
        unset($val);

        $this->assign('list',$order);

        $order_state = C('order');
        $order_state = $order_state['state'];
        $this->assign('order_state',$order_state);

        $this->assign('page_title','订单列表');
        $this->display();
    }

    //导出xls文件
    public function xls($map){
        $xml = new \Common\Vendor\PhpExcel();
        // Set document properties
        $xml->getProperties()->setTitle('ZTMVIP')
            ->setSubject('订单数据');

        $keys = array(
            'order_sn' => '订单号',
            'order_goods' => '订单商品',
            'date_add' => '下单时间',
            'consignee' => '收货人',
            'mobile' => '联系电话',
            'province' => '省',
            'city' => '市',
            'district' => '区',
            'address' => '地址',
            'order_amount' => '总金额',
            'order_state' => '订单状态',
            'payment_state' => '付款状态',
            'shipping_state' => '发货状态',
        );
        $width = array(15,45,16,10,13,10,10,15,45,8,9,9);

        // Add title
        $i = 0;
        foreach ( $keys as $val ){
            //列宽
            $xml->setActiveSheetIndex(0)->getColumnDimension(chr($i+65))->setWidth($width[$i]);
            //标题
            $xml->setActiveSheetIndex(0)->setCellValue(chr($i+65).'1',$val);
            $i++;
        }

        $order = $this->order_model->alias('o')->field('o.id,o.order_sn,o.order_state,o.payment_state,o.shipping_state,o.goods_fee,o.shipping_fee,o.date_add,oe.consignee,oe.mobile,oe.province,oe.city,oe.district,oe.address')
            ->join('__ORDER_EXTEND__ AS oe ON oe.order_id=o.id')
            ->where($map)->order('o.id DESC')->limit(1000)->select();

        $state = C('ORDER.state');

        // Add data
        foreach ( $order as $key => &$val ){
            $val['order_amount'] = sprintf('%.2f',$val['goods_fee'] + $val['shipping_fee']);
            $val['order_state'] = $state['order'][$val['order_state']];
            $val['payment_state'] = $state['payment'][$val['payment_state']];
            $val['shipping_state'] = $state['shipping'][$val['shipping_state']];
            $val['date_add'] = date('Y-m-d H:i',$val['date_add']);

            $val['order_goods'] = $this->order_goods_model->alias('og')->field('og.goods_id,og.goods_number,g.goods_name')
                ->join('LEFT JOIN __GOODS__ AS g ON g.id=og.goods_id')
                ->where(array('og.order_id'=>$val['id']))->select();
            foreach ( $val['order_goods'] as $k => &$v ){
                $v = $v['goods_name'] .' x'. $v['goods_number'];
            }
            unset($v);
            $val['order_goods'] = join("\r\n",$val['order_goods']);

            //行数据
            $i = 0;
            foreach ( $keys as $k => $v ){
                $xml->setActiveSheetIndex(0)->setCellValueExplicit(chr($i+65).($key+2),$val[$k],\PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
            }
            unset($v);
        }
        unset($val);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="订单详情 '.date('YmdHis').'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $response = \PHPExcel_IOFactory::createWriter($xml, 'Excel5');
        $response->save('php://output');

        exit();
    }
}