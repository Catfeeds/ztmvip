<?php
/**
 * 消费明细控制器
 * author: Tom
 */
namespace Admin\Controller;
class AccountController extends BaseController
{
    protected $account_model,$user_account_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('account',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->account_model = D('AccountLog');
        $this->user_account_model = D('UserAccountLog');
        $this->assign('aside_id',8);
    }

    //手动到账
    public function deposit(){
        if ( IS_POST && IS_AJAX ){
            $manager_model = D('Manager');
            $user_model = D('User');

            $id = I('post.id',0,'intval');
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$id )
                    E('抱歉，请选择要操作的项目');
                if ( !$post['payment_no'] )
                    E('抱歉，请输入充值流水');
                if ( !$post['password'] )
                    E('抱歉，请输入您的登录密码');

                $map = array(
                    'id' => $this->_manager_id,
                    'password' => $manager_model->compile_password($post['password']),
                    'disabled' => 'N',
                );
                if ( !$manager_model->where($map)->find() )
                    E('抱歉，登录密码错误');

                $map = array(
                    'id' => $id,
                    'change_type' => 'deposit',
                    'date_pay' => 0,
                );
                $user_action = $this->user_account_model->where($map)->find();
                if ( !$user_action )
                    E('非法操作');

                $data = array(
                    'payment_no' => $post['payment_no'],
                    'manager_id' => $this->_manager_id,
                    'date_pay' => time(),
                    'manager_note' => '管理员手动到账，'.$post['manager_note'],
                );
                $this->user_account_model->where(array('id'=>$id))->save($data);

                //加入流水记录
                D('AccountLog')->add(array(
                    'user_id' => $user_action['user_id'],
                    'change_type' => 'deposit',
                    'user_money' => $user_action['amount'],
                    'integral' => 0,
                    'manager_id' => $this->_manager_id,
                    'change_desc' => '用户充值手动到账',
                    'date_add' => time(),
                ));

                //修改余额
                $user_model->where(array('id'=>$user_action['user_id']))->setInc('user_money',$user_action['amount']);
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //充值记录
    public function depositLog(){
        $get = I('get.');

        $map = array(
            'a.change_type' => 'deposit',
        );
        $join = '__USER__ AS u ON u.id=a.user_id';

        if ( $get['user_id'] )
            $map['a.user_id'] = $get['user_id'];

        if ( $get['paid'] == 'Y' )
            $map['a.date_pay'] = array('gt',0);
        elseif ( $get['paid'] == 'N' )
            $map['a.date_pay'] = 0;

        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['a.user_id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $join .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        $count = $this->user_account_model->alias('a')->where($map)->count();
        $page = $this->page($count);
        $account = $this->user_account_model->alias('a')->field('a.*,u.user_name,m.nick_name AS manager_name')
            ->join($join)
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=a.manager_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('a.id DESC')->select();
        $this->assign('list',$account);

        $this->assign('change_type',C('account'));
        $this->assign('paid',array('Y'=>'已支付','N'=>'未支付'));

        $this->assign('page_title','充值记录');
        $this->display();
    }

    //资金明细
    public function index(){
        $get = I('get.');

        $map = array(
        );
        $join = '__USER__ AS u ON u.id=a.user_id';

        if ( $get['user_id'] )
            $map['a.user_id'] = $get['user_id'];

        if ( $get['change_type'] )
            $map['a.change_type'] = $get['change_type'];

        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['a.user_id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $join .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        //导出xls文件
        if ( $get['xls'] == 'Y' )
            $this->xls($map,$join);

        $count = $this->account_model->alias('a')->where($map)->count();
        $page = $this->page($count);
        $account = $this->account_model->alias('a')->field('a.*,u.user_name,m.nick_name AS manager_name')
            ->join($join)
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=a.manager_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('a.id DESC')->select();
        $this->assign('list',$account);

        $this->assign('change_type',C('account'));

        $this->assign('page_title','资金明细');
        $this->display();
    }

    //转账
    public function withdraw(){
        if ( IS_POST && IS_AJAX ){
            $manager_model = D('Manager');
            $user_model = D('User');

            $id = I('post.id',0,'intval');
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$id )
                    E('抱歉，请选择要操作的项目');
                if ( !$post['password'] )
                    E('抱歉，请输入您的登录密码');

                $map = array(
                    'id' => $this->_manager_id,
                    'password' => $manager_model->compile_password($post['password']),
                    'disabled' => 'N',
                );
                if ( !$manager_model->where($map)->find() )
                    E('抱歉，登录密码错误');

                $map = array(
                    'id' => $id,
                    'change_type' => 'withdraw',
                    'date_pay' => 0,
                );
                $user_action = $this->user_account_model->where($map)->find();
                if ( !$user_action )
                    E('非法操作');

                if ( $post['do'] == 'agree' ){
                    if ( !$post['payment_no'] )
                        E('抱歉，请输入支付流水');

                    $data = array(
                        'payment' => '银行汇款/转帐',
                        'payment_no' => $post['payment_no'],
                        'manager_id' => $this->_manager_id,
                        'date_pay' => time(),
                        'manager_note' => '管理员手动转账，'. $post['manager_note'],
                    );
                    $this->user_account_model->where(array('id'=>$id))->save($data);

                    //加入流水记录
                    D('AccountLog')->add(array(
                        'user_id' => $user_action['user_id'],
                        'change_type' => 'withdraw',
                        'user_money' => $user_action['amount'],
                        'integral' => 0,
                        'manager_id' => $this->_manager_id,
                        'change_desc' => '用户提现银行汇款/转帐',
                        'date_add' => time(),
                    ));
                }elseif ( $post['do'] == 'refuse' ){
                    if ( !$post['manager_note'] )
                        E('抱歉，请输拒绝原因');

                    $data = array(
                        'manager_id' => $this->_manager_id,
                        'date_refuse' => time(),
                        'manager_note' => '管理员拒绝转帐，'. $post['manager_note'],
                    );
                    $this->user_account_model->where(array('id'=>$id))->save($data);
                }

                //修改余额
                $user_model->update_money($user_action['user_id']);
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //提现记录
    public function withdrawLog(){
        $get = I('get.');

        $map = array(
            'change_type' => 'withdraw',
        );
        $join = '__USER__ AS u ON u.id=a.user_id';

        if ( $get['user_id'] )
            $map['a.user_id'] = $get['user_id'];

        if ( $get['paid'] == 'Y' )
            $map['a.date_pay'] = array('gt',0);
        elseif ( $get['paid'] == 'N' )
            $map['a.date_pay'] = 0;

        if ( $get['user_name'] && preg_match('/^(\d+,?)+$/i',$get['user_name']) ) {
            $map['a.user_id'] = array('in',explode(',',$get['user_name']));
        }elseif ( $get['user_name'] ){
            $join .= ' AND INSTR(u.user_name,"'.$get['user_name'].'")>0';
        }

        $count = $this->user_account_model->alias('a')->where($map)->count();
        $page = $this->page($count);
        $account = $this->user_account_model->alias('a')->field('a.*,u.user_name,u.bank_name,u.bank_card,u.bank_user,m.nick_name AS manager_name')
            ->join($join)
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=a.manager_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('a.id DESC')->select();
        $this->assign('list',$account);

        $this->assign('change_type',C('account'));
        $this->assign('paid',array('Y'=>'已转账','N'=>'未转账'));

        $this->assign('page_title','提现记录');
        $this->display();
    }

    //导出xls文件
    public function xls($map,$join){
        $xml = new \Common\Vendor\PhpExcel();
        // Set document properties
        $xml->getProperties()->setTitle('ZTMVIP')
            ->setSubject('资金明细');

        $keys = array(
            'id' => '用户ID',
            'user_name' => '用户名',
            'change_type' => '类型',
            'user_money' => '用户余额',
            'frozen_money' => '冻结金额',
            'integral' => '用户积分',
            'level_integral' => '等级积分',
            'change_desc' => '备注',
            'date_add' => '操作时间',
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

        $account = $this->account_model->alias('a')->field('a.*,u.user_name,m.nick_name AS manager_name')
            ->join($join)
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=a.manager_id')
            ->where($map)->order('a.id DESC')->select();

        $change_type = C('account');

        // Add data
        foreach ( $account as $key => &$val ){
            $val['change_type'] = $change_type[$val['change_type']];
            $val['date_add'] = date('Y-m-d H:i',$val['date_add']);

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
        header('Content-Disposition: attachment;filename="资金明细 '.date('YmdHis').'.xls"');
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