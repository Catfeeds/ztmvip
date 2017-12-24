<?php
/**
 * 商品控制器
 * author: Tom
 */
namespace Admin\Controller;
class GoodsController extends BaseController
{
    protected $goods_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('goods',false) && !in_array(ACTION_NAME,array('search')) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->goods_model = D('Goods');
        $this->assign('aside_id',0);
    }

    /**
     * 修改商品
     * @param null $id 商品id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                M()->startTrans();

                if ( !$post['category_id'] || intval($post['category_id']) < 1 )
                    E('抱歉，请选择商品分类');
                if ( !$post['goods_name'] )
                    E('抱歉，请输入商品名称');

                if ( !$post['market_price'] || round($post['market_price'],2) < 0 )
                    E('抱歉，请输入市场价');
                else
                    $post['market_price'] = round($post['market_price'],2);

                if ( !$post['shop_price'] || round($post['shop_price'],2) < 0 )
                    E('抱歉，请输入商城价');
                else
                    $post['shop_price'] = round($post['shop_price'],2);

                if ( $post['market_price'] < $post['shop_price'] )
                    E('抱歉，商城价不能大于市场价');
                if ( !$post['express_id'] || intval($post['express_id']) < 0 )
                    E('抱歉，请选择运费模版');
                if ( intval($post['profit']) < 0 )
                    E('抱歉，请输入分佣比例');
                else
                    $post['profit'] = intval($post['profit']);
                if ( intval($post['pay_integral']) < 0 )
                    E('抱歉，请输入可用积分');
                if ( !$post['goods_gallery'] )
                    E('抱歉，请上传商品图');
                if ( !$post['goods_desc'] )
                    E('抱歉，请输入商品详情');

                $post['goods_gallery'] = array_diff(array_unique($post['goods_gallery']),array(''));
                $post['relation_goods'] = array_diff(array_unique($post['relation_goods']),array('',$id));

                $data = array_intersect_key($post,array_flip(array(
                    'category_id',
                    'brand_id',
                    'goods_name',
                    'market_price',
                    'shop_price',
                    'goods_thumb',
                    'goods_number',
                )));
                $data['brand_id'] = intval($post['brand_id'])?:0;
                $data['verify'] = 'Y';

                $data_extend = array_intersect_key($post,array_flip(array(
                    'goods_id',
                    'express_id',
                    'profit',
                    'sales',
                    'sku_id',
                    'skus',
                    'skus_price',
                    'pay_integral',
                    'goods_gallery',
                    'relation_goods',
                    'relation_clerk',
                    'service',
                    'goods_desc',
                )));
                $data_extend['goods_image'] = $data_extend['goods_gallery'][0];
                $data_extend['service'] = is_array($data_extend['service'])?json_encode($data_extend['service']):'[]';

                !$data['goods_thumb'] && $data['goods_thumb'] = $data_extend['goods_image'];
                $this->goods_model->image_thumb('.'.$data['goods_thumb']);//缩略图

                foreach ( $data_extend['goods_gallery'] as &$val ){
                    $val = array(
                        'image' => $val,
                        'thumb' => $this->goods_model->gallery_thumb('.'.$val),
                    );
                }
                unset($val);

                $data_extend['goods_desc'] = htmlspecialchars_decode($data_extend['goods_desc']);
                $data_extend['goods_gallery'] = json_encode($data_extend['goods_gallery']);
                $data_extend['skus'] = json_encode($data_extend['skus']?:array());
                $data_extend['skus_price'] = json_encode($data_extend['skus_price']?:array());
                $data_extend['relation_goods'] = json_encode($data_extend['relation_goods']?:array());
                $data_extend['relation_clerk'] = json_encode($data_extend['relation_clerk']?:array());

                if ( $id ){
                    $data['date_upd'] = time();

                    $map = array(
                        'id' => $id,
                    );
                    $this->goods_model->where($map)->save($data);

                    $map = array(
                        'goods_id' => $id,
                    );
                    D('GoodsExtend')->where($map)->save($data_extend);

                    //清空关联的扩展分类
                    D('GoodsExtendCategory')->where(array('goods_id' => $id))->delete();
                }else{
                    $data['rank'] = $this->goods_model->next_primary();
                    $data['date_add'] = time();

                    if ( !($id = $this->goods_model->add($data)) )
                        E('抱歉，操作失败');

                    $data_extend['goods_id'] = $id;
                    D('GoodsExtend')->add($data_extend);
                }


                /* 添加扩展分类 */
                if ( $post['extend_category'] ){
                    $post['extend_category'] = is_array($post['extend_category']) ? $post['extend_category'] : array($post['extend_category']);
                    $tmp = array();

                    foreach ( $post['extend_category'] as $val ){
                        $tmp[] = array(
                            'goods_id' => $id,
                            'category_id' => $val,
                        );
                    }

                    D('GoodsExtendCategory')->addAll($tmp);
                }
                /* end */

                /* 双向关联商品 */
                if ( $post['relation_type'] && $post['relation_goods'] ){
                    $relation_goods = $this->goods_model->field('id,relation_goods')->where(array('id'=>array('in',$post['relation_goods'])))->select();
                    foreach ( $relation_goods as $val ){
                        $val['relation_goods'] = json_decode($val['relation_goods'],true);
                        $val['relation_goods'][] = $id;
                        $val['relation_goods'] = json_encode($val['relation_goods']);
                        $this->goods_model->where(array('id'=>$val['id']))->save(array('relation_goods'=>$val['relation_goods']));
                    }
                }

                M()->commit();

                //商品规格加入mongo缓存
                //$this->goods_model->skus_mongo($data_extend['sku_id'],$post['skus'],$id);
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );

                M()->rollback();
            }

            $this->ajaxReturn($state);
        }

        if ( $id ){
            $goods = $this->goods_model->alias('g')
                ->join('__GOODS_EXTEND__ AS ge ON ge.goods_id=g.id')
                ->where(array('g.id' => $id))->find();
            if ( !$goods )
                $this->_empty();

            $goods['goods_gallery'] = json_decode($goods['goods_gallery'],true);
            $goods['category_name'] = D('GoodsCategory')->where(array('display'=>'Y','id'=>$goods['category_id']))->getField('category_name');
            $default_express = $goods['express_id'];
            $this->assign('edit',$goods);

            $goods_extend_category = D('GoodsExtendCategory')->field('category_id')->where(array('goods_id'=>$id))->select();
            $this->assign('goods_extend_category',json_encode($goods_extend_category?:array()));

            $all_goods_category = D('GoodsCategory')->field('id,category_name')->where(array('disabled'=>'N'))->select();
            $this->assign('all_goods_category',$all_goods_category);
        }else{
            $default_express = D('GoodsExpress')->where(array('is_default'=>'Y'))->getField('id');
        }

        $goods_brand = D('GoodsBrand')->brand_list();
        $this->assign('goods_brand',make_array($goods_brand,'id','brand_name'));

        $goods_category = D('GoodsCategory')->category_list(0);
        $this->assign('goods_category',$goods_category);

        $goods_express = D('GoodsExpress')->order('is_default DESC')->select();
        $this->assign('default_express',$default_express);
        $this->assign('goods_express',make_array($goods_express,'id','express_name'));

        $this->assign('page_title','商品信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');
        $page_title = '商品列表';

        $map = array(
            'g.shop_id' => 0,
            'g.disabled' => 'N',
            '_string' => '1',
        );

        if ( $get['new'] ){
            $map['g.new'] = 'Y';
            $page_title = '新品首发';
        }

        if ( $get['hot'] ){
            $map['g.hot'] = 'Y';
            $page_title = '特卖专区';
        }

        if ( $get['goods_name'] && preg_match('/^(\d+,?)+$/i',$get['goods_name']) ) {
            $map['g.id'] = array('in',explode(',',$get['goods_name']));
        }elseif ( $get['goods_name'] ){
            $map['_string'] .= ' AND INSTR(g.goods_name,"'.$get['goods_name'].'")>0';
        }

        if ( $get['category_id'] ){
            $extend_category = D('GoodsExtendCategory')->where(array('category_id'=>$get['category_id']))->getField('goods_id',true);
            $map['_string'] .= ' AND (g.category_id='.$get['category_id'].' OR g.id IN ('.join(',',$extend_category?:array(0)).'))';
        }

        if ( $get['brand_id'] && intval($get['brand_id']) > 0 ){
            $map['g.brand_id'] = intval($get['brand_id']);
        }

        if ( $get['on_sale'] ){
            $map['g.on_sale'] = $get['on_sale'];
        }

        $count = $this->goods_model->alias('g')->where($map)->count();
        $page = $this->page($count);
        $goods = $this->goods_model->alias('g')->field('g.*,gc.category_name,gb.brand_name')
            ->join('LEFT JOIN __GOODS_CATEGORY__ AS gc ON gc.id=g.category_id')
            ->join('LEFT JOIN __GOODS_BRAND__ AS gb ON gb.id=g.brand_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('g.rank DESC')->select();
        $this->assign('list',$goods);

        $goods_category = D('GoodsCategory')->category_list(0);
        $this->assign('goods_category',$goods_category);

        $goods_brand = D('GoodsBrand')->brand_list();
        $this->assign('goods_brand',make_array($goods_brand,'id','brand_name'));

        $this->assign('page_title',$page_title);
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

                $post['id'] = is_array($post['id']) ? $post['id'] : array($post['id']);

                $sphinx = new \SphinxClient();
                $sphinx->SetServer(C('SPHINX.host'),C('SPHINX.port'));

                switch ( $post['action'] ) {
                    case 'best':
                    case 'hot':
                    case 'new':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $data = array(
                            $post['action'] => ($post['state']=='Y'?:'N'),
                        );
                        $this->goods_model->where($map)->save($data);
                        break;
                    case 'delete':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->goods_model->where($map)->save(array('disabled' => 'Y'));

                        //更新sphinx
                        foreach ( $post['id'] as $val ){
                            $sphinx->updateAttributes('ztm_goods',array('disabled'),array($val=>array(1)));
                        }
                        break;
                    case 'pass':
                    case 'refuse':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->goods_model->where($map)->save(array('verify' => $post['action'] == 'pass' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        if ( !$post['rank'] )
                            break;

                        $post['rank'] = intval($post['rank']);

                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->goods_model->where($map)->save(array('rank'=>$post['rank']));
                        break;
                    case 'saleup':
                    case 'saledown':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->goods_model->where($map)->save(array('on_sale' => $post['action'] == 'saleup' ? 'Y' : 'N'));

                        //更新sphinx
                        foreach ( $post['id'] as $val ){
                            $sphinx->updateAttributes('ztm_goods',array('on_sale'),array($val=>array($post['action'] == 'saleup' ? 1 : 0)));
                        }

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

    //搜索商品json数据
    public function search(){
        $post = I('post.');

        $map = array(
            'disabled' => 'N',
        );

        if ( $post['words'] )
            $map['_string'] = 'INSTR(goods_name, "'.$post['words'].'")>0';

        if ( $post['goods_id'] )
            $map['id'] = array('in',$post['goods_id']);

        if ( $post['category_id'] ){
            $extend_category = D('GoodsExtendCategory')->where(array('category_id'=>$post['category_id']))->getField('goods_id',true);
            $map['_string'] .= '(category_id='.$post['category_id'].' OR id IN ('.join(',',$extend_category?:array(0)).'))';
        }

        if ( $post['brand_id'] )
            $map['brand_id'] = $post['brand_id'];

        $goods = $this->goods_model->where($map)->select();
        $this->ajaxReturn($goods?:array());
    }

    //店铺商品
    public function shop(){
        $get = I('get.');

        $map = array(
            'g.shop_id' => array('gt',0),
            'g.disabled' => 'N',
            '_string' => '1',
        );
        $join_shop = '__SHOP__ AS s ON s.id=g.shop_id';

        if ( $get['shop_name'] ) {
            $join_shop .= ' AND INSTR(s.shop_name,"'.$get['shop_name'].'")>0';
        }elseif ( $get['shop_id'] ){
            $map['g.shop_id'] = $get['shop_id'];
        }

        if ( $get['goods_name'] && preg_match('/^(\d+,?)+$/i',$get['goods_name']) ) {
            $map['g.id'] = array('in',explode(',',$get['goods_name']));
        }elseif ( $get['goods_name'] ){
            $map['_string'] .= ' AND INSTR(g.goods_name,"'.$get['goods_name'].'")>0';
        }

        if ( $get['category_id'] ){
            $extend_category = D('GoodsExtendCategory')->where(array('category_id'=>$get['category_id']))->getField('goods_id',true);
            $map['_string'] .= ' AND (g.category_id='.$get['category_id'].' OR g.id IN ('.join(',',$extend_category?:array(0)).'))';
        }

        if ( $get['brand_id'] && intval($get['brand_id']) > 0 ){
            $map['g.brand_id'] = intval($get['brand_id']);
        }

        if ( $get['on_sale'] ){
            $map['g.on_sale'] = $get['on_sale'];
        }

        $count = $this->goods_model->alias('g')->where($map)->count();
        $page = $this->page($count);
        $goods = $this->goods_model->alias('g')->field('g.*,gc.category_name,gb.brand_name,s.shop_name')
            ->join($join_shop)
            ->join('LEFT JOIN __GOODS_CATEGORY__ AS gc ON gc.id=g.category_id')
            ->join('LEFT JOIN __GOODS_BRAND__ AS gb ON gb.id=g.brand_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('g.rank DESC')->select();
        $this->assign('list',$goods);

        $goods_category = D('GoodsCategory')->category_list(0);
        $this->assign('goods_category',$goods_category);

        $goods_brand = D('GoodsBrand')->brand_list();
        $this->assign('goods_brand',make_array($goods_brand,'id','brand_name'));

        $this->assign('aside_id',10);

        $this->assign('page_title','店铺商品');
        $this->display();
    }
}