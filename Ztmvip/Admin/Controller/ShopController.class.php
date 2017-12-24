<?php
/**
 * 商家控制器
 * author: Tom
 */
namespace Admin\Controller;
class ShopController extends BaseController
{
    protected $shop_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('shop',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->shop_model = D('Shop');
        $this->assign('aside_id',10);

        $this->assign('shop_level',C('shop.level'));
    }

    /**
     * 店铺详情
     * @param $id 店铺id
     */
    public function edit($id){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                $data = array_intersect_key($post,array_flip(array(
                    'verify',
                )));
                $data['verify'] = $data['verify'] == 'Y' ? 'Y' : 'N';

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->shop_model->where($map)->save($data);
                }else{
                    if ( !$this->shop_model->add($data) )
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
            $shop = $this->shop_model->alias('s')
                ->join('__SHOP_EXTEND__ AS se ON se.shop_id=s.id')
                ->where(array('id'=>$id))->find();
            if ( !$shop )
                $this->_empty();

            $this->assign('edit',$shop);
        }

        $this->assign('map',C('map'));

        $this->assign('page_title','店铺详情');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );
        $join = '__SHOP_EXTEND__ AS se ON se.shop_id=s.id';

        if ( $get['shop_name'] && preg_match('/^\d+$/i',$get['shop_name']) )
            $map['s.id'] = $get['shop_name'];
        elseif ( $get['shop_name'] )
            $map['_string'] = 'INSTR(s.shop_name,"'.$get['shop_name'].'")>0';
        if ( $get['tel'] )
            $join .= ' AND INSTR(se.tel,"'.$get['tel'].'")>0';
        if ( $get['province'] )
            $join .= ' AND province="'. $get['province'] .'"';
        if ( $get['city'] )
            $join .= ' AND city="'. $get['city'] .'"';
        if ( $get['district'] )
            $join .= ' AND district="'. $get['district'] .'"';

        $count = $this->shop_model->alias('s')->where($map)->count();
        $page = $this->page($count);
        $shop = $this->shop_model->alias('s')
            ->join($join)
            ->where($map)
            ->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$shop);

        $this->assign('verify',array('Y' => '通过','N' => '未通过'));

        $this->assign('page_title','店铺列表');
        $this->display();
    }

    //修改店铺属性
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
                    case 'enable':
                    case 'disable':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->shop_model->where($map)->save(array('disabled' => $post['action'] == 'disable' ? 'Y' : 'N'));
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