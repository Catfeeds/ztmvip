<?php
/**
 * 商品分类控制器
 * author: Tom
 */
namespace Admin\Controller;
class GoodsCategoryController extends BaseController
{
    protected $category_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('goods_category',false) && !in_array(ACTION_NAME,array('search')) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->category_model = D('GoodsCategory');
        $this->assign('aside_id',0);
    }

    //
    /**
     * 修改分类
     * @param null $id 分类id
     */
    public function edit($id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['category_name'] )
                    E('抱歉，请输入品牌名称');

                $data = array_intersect_key($post,array_flip(array(
                    'category_name',
                    'category_logo',
                    'parent_id',
                    'category_tagline',
                )));
                !$data['parent_id'] && $data['parent_id'] = 0;

                $parent_tree_struct = $this->category_model->where(array('id'=>$data['parent_id']))->getField('tree_struct');
                if ( $parent_tree_struct ){
                    $data['tree_struct'] = $parent_tree_struct . $data['parent_id'].'.';
                }else{
                    $data['tree_struct'] = $data['parent_id'].'.';
                }

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->category_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->category_model->next_primary();

                    if ( !$this->category_model->add($data) )
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
            $category = $this->category_model->where(array('id' => $id))->find();
            if ( !$category )
                $this->_empty();

            $this->assign('edit',$category);
        }

        $map = array(
            'disabled' => 'N',
        );
        if ( $id ){
            $map['id'] = array('neq',$id);
            $map['_string'] = "INSTR(tree_struct,'{$category['tree_struct']}$id.')=0";
        }
        $parent_category = $this->category_model->where($map)->select();
        $this->assign('parent_category',make_array($parent_category,'id','category_name'));

        $this->assign('page_title','分类信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
            'shop_id' => 0,
            'disabled' => 'N',
        );

        if ( $get['category_name'] )
            $map['_string'] = 'INSTR(category_name,"'.$get['category_name'].'")>0';

        if ( $get['category_name'] ){
            $category = $this->category_model->where($map)->order('parent_id ASC,rank DESC')->select();
        }else{
            $category = $this->category_model->category_list();
        }

        $this->assign('list',$category);

        $this->assign('page_title','商品分类');
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
                        $this->category_model->where($map)->save(array('disabled' => 'Y'));
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->category_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $category = $this->category_model->field('id,rank')->where($map)->find();
                        if ( !$category )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $category['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $category_rank = $this->category_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$category_rank )
                            break;

                        foreach ( $category_rank as $val ){
                            $this->category_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->category_model->where(array('id'=>$rank_id))->save(array('rank'=>$category['rank']));
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

    //搜索分类json数据
    public function search(){
        $post = I('post.');

        $map = array(
            'disabled' => 'N',
        );

        if ( $post['words'] )
            $map['_string'] = 'INSTR(category_name, "'.$post['words'].'")>0';

        if ( $post['category_id'] )
            $map['id'] = $post['category_id'];

        if ( isset($post['parent_category']) )
            $map['parent_id'] = $post['parent_category'];

        $category = $this->category_model->where($map)->select();
        $this->ajaxReturn($category?:array());
    }
}