<?php
/**
 * 储值卡控制器
 * author: Tom
 */
namespace Admin\Controller;
class PrepaidController extends BaseController
{
    protected $prepaid_model,$user_prepaid_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('prepaid',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->prepaid_model = D('Prepaid');
        $this->user_prepaid_model = D('UserPrepaid');
        $this->assign('aside_id',9);
    }

    /**
     * 修改储值卡
     * @param null $id 储值卡id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['prepaid_name'] )
                    E('抱歉，请输入储值卡名称');
                if ( !$post['prepaid_image'] )
                    E('抱歉，请上传卡面外观');
                if ( !$post['prefix'] )
                    E('抱歉，请输入卡号前缀');
                if ( !$post['par'] )
                    E('抱歉，请输入储值卡面额');
                if ( !$post['price'] )
                    E('抱歉，请输入储值卡售价');
                if ( intval($post['profit']) < 0 )
                    E('抱歉，请输入分佣比例');
                if ( !$post['prepaid_desc'] )
                    E('抱歉，请完善卡片描述');

                $data = array_intersect_key($post,array_flip(array(
                    'prepaid_name',
                    'prepaid_image',
                    'prefix',
                    'par',
                    'price',
                    'profit',
                    'prepaid_desc',
                )));
                $data['prepaid_desc'] = htmlspecialchars_decode($data['prepaid_desc']);

                if ( $id ){
                    if ( $this->user_prepaid_model->where(array('prepaid_id'=>$id))->count() )
                        unset($data['prefix'],$data['par']);

                    $map = array(
                        'id' => $id,
                    );
                    $this->prepaid_model->where($map)->save($data);
                }else{
                    $data['manager_id'] = $this->_manager_id;
                    $data['date_add'] = time();

                    if ( !($id = $this->prepaid_model->add($data)) )
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
            $prepaid = $this->prepaid_model->where(array('id' => $id))->find();
            if ( !$prepaid )
                $this->_empty();

            $this->assign('edit',$prepaid);

            $buy_count = $this->user_prepaid_model->where(array('prepaid_id'=>$id))->count();
            $this->assign('buy_count',$buy_count);
        }

        $this->assign('page_title','优惠券信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            'p.disabled' => 'N',
        );

        if ( $get['prepaid_name'] )
            $map['_string'] = 'INSTR(p.prepaid_name,"'.$get['prepaid_name'].'")>0';

        $count = $this->prepaid_model->alias('p')->where($map)->count();
        $page = $this->page($count);
        $prepaid = $this->prepaid_model->alias('p')->field('p.*,m.nick_name AS manager_name')
            ->join('LEFT JOIN __MANAGER__ AS m ON m.id=p.manager_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
        foreach ( $prepaid as &$val ){
            $val['buy_count'] = $this->user_prepaid_model->where(array('prepaid_id'=>$val['id']))->count();
        }
        unset($val);
        $this->assign('list',$prepaid);

        $this->assign('page_title','储值卡列表');
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
                        $this->prepaid_model->where($map)->save(array('disabled' => 'Y'));
                        break;
                    case 'saleup':
                    case 'saledown':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->prepaid_model->where($map)->save(array('on_sale' => $post['action'] == 'saleup' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $prepaid = $this->prepaid_model->field('id,rank')->where($map)->find();
                        if ( !$prepaid )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $prepaid['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $prepaid_rank = $this->prepaid_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$prepaid_rank )
                            break;

                        foreach ( $prepaid_rank as $val ){
                            $this->prepaid_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->prepaid_model->where(array('id'=>$rank_id))->save(array('rank'=>$prepaid['rank']));
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

    /**
     * 购买记录
     * @param $id 优惠券id
     */
    public function log($id){
        $get = I('get.');

        $map = array(
            'up.prepaid_id' => $id,
        );

        $count = $this->user_prepaid_model->alias('up')->where($map)->count();
        $page = $this->page($count);
        $coupon = $this->user_prepaid_model->alias('up')
            ->field('up.*,p.prepaid_name,u.user_name')
            ->join('__PREPAID__ AS p ON p.id=up.prepaid_id')
            ->join('__USER__ AS u ON u.id=up.user_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('up.id DESC')->select();
        $this->assign('list',$coupon);

        $this->assign('page_title','购买记录');
        $this->display();
    }
}