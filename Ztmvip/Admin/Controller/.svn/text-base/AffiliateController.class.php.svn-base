<?php
/**
 * 分佣记录控制器
 * author: Tom
 */
namespace Admin\Controller;
class AffiliateController extends BaseController
{
    protected $affiliate_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('affiliate',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->affiliate_model = D('AffiliateLog');
        $this->assign('aside_id',4);
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );
        $join_rebate_user = '__USER__ AS ru ON ru.id=a.rebate_user';

        if ( $get['rebate_user_id'] )
            $map['a.rebate_user'] = $get['rebate_user_id'];

        if ( $get['order_sn'] )
            $map['a.order_sn'] = $get['order_sn'];

        if ( $get['rebate_user'] )
            $join_rebate_user .= ' AND INSTR(ru.user_name,"'.$get['rebate_user'].'")>0';

        if ( $get['separated'] )
            $map['a.separated'] = $get['separated'];

        if ( $get['add_start'] || $get['add_end'] ){
            $map['a.date_add'] = array();
            if ( $get['add_start'] )
                array_push($map['a.date_add'],array('egt',strtotime($get['add_start'])));

            if ( $get['add_end'] )
                array_push($map['a.date_add'],array('elt',strtotime($get['add_end'])));
        }

        $count = $this->affiliate_model->alias('a')->join($join_rebate_user)->where($map)->count();
        $page = $this->page($count);
        $brand = $this->affiliate_model->alias('a')->field('a.*,ru.user_name AS rebate_user_name')
            ->join($join_rebate_user)
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('a.id DESC')->select();
        $this->assign('list',$brand);

        $this->assign('separated',array('Y'=>'已分佣','N'=>'未分佣'));

        $this->assign('page_title','分佣记录');
        $this->display();
    }
}