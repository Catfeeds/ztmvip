<?php
/**
 * 组合商品控制器
 * author: Tom
 */
namespace Admin\Controller;
class GroupGoodsController extends BaseController
{
    protected $group_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('goods',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->group_model = D('GroupGoods');
        $this->assign('aside_id',0);
    }

    /**
     * 修改组合
     * @param $goods_id 商品id
     * @param null $id 组合id
     */
    public function edit($goods_id,$id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['group_name'] )
                    E('抱歉，请输入组合名称');
                if ( !$post['price'] )
                    E('抱歉，请输入组合价格');
                if ( intval($post['profit']) < 0 )
                    E('抱歉，请输入分佣比例');
                else
                    $post['profit'] = intval($post['profit']);
                if ( !$post['relation_goods'] )
                    E('抱歉，请选择组合商品');

                $data = array_intersect_key($post,array_flip(array(
                    'group_name',
                    'price',
                    'profit',
                    'relation_goods',
                )));
                $data['goods_id'] = $goods_id;
                $data['relation_goods'] = json_encode($data['relation_goods']);

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->group_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->group_model->next_primary();

                    if ( !$this->group_model->add($data) )
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
            $group = $this->group_model->where(array('id' => $id))->find();
            if ( !$group )
                $this->_empty();

            $this->assign('edit',$group);
        }

        $goods_category = D('GoodsCategory')->category_list(0);
        $this->assign('goods_category',$goods_category);

        $goods_brand = D('GoodsBrand')->brand_list();
        $this->assign('goods_brand',make_array($goods_brand,'id','brand_name'));

        $this->assign('goods_id',$goods_id);

        $this->assign('page_title','组合信息');
        $this->display();
    }

    /**
     * @param $goods_id 商品id
     */
    public function index($goods_id){
        $get = I('get.');
        $map = array(
            'goods_id' => $goods_id,
            'disabled' => 'N',
        );

        if ( $get['group_name'] )
            $map['_string'] = 'INSTR(group_name,"'.$get['group_name'].'")>0';

        $count = $this->group_model->where($map)->count();
        $page = $this->page($count);
        $group = $this->group_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$group);

        $goods_name = D('Goods')->where(array('id'=>$goods_id))->getField('goods_name');
        $this->assign('goods_id',$goods_id);

        $this->assign('page_title',$goods_name.'——组合商品');
        $this->display();
    }

    //修改属性
    public function prop()
    {
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
                        $this->group_model->where($map)->save(array('disabled' => 'Y'));
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->group_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $group = $this->group_model->field('id,rank')->where($map)->find();
                        if ( !$group )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $group['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $group_rank = $this->group_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$group_rank )
                            break;

                        foreach ( $group_rank as $val ){
                            $this->group_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->group_model->where(array('id'=>$rank_id))->save(array('rank'=>$group['rank']));
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