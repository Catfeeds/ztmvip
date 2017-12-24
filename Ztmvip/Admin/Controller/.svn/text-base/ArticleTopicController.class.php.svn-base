<?php
/**
 * 文章分类控制器
 * author: Tom
 */
namespace Admin\Controller;
class ArticleTopicController extends BaseController
{
    protected $topic_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('article_topic',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->topic_model = D('ArticleTopic');
        $this->assign('aside_id',3);
    }

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
                if ( !$post['topic_name'] )
                    E('抱歉，请输入分类名称');

                $data = array_intersect_key($post,array_flip(array(
                    'topic_name',
                    'parent_id',
                )));
                $data['parent_id'] = intval($data['parent_id']);

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->topic_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->topic_model->next_primary();

                    if ( !$this->topic_model->add($data) )
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
            $topic = $this->topic_model->where(array('id' => $id))->find();
            if ( !$topic )
                $this->_empty();

            $this->assign('edit',$topic);
        }

        $map = array(
            'display' => 'Y',
        );
        if ( $id ) {
            $map['id'] = array('neq',$id);
            $map['_string'] = "INSTR(tree_struct,'{$topic['tree_struct']}$id.')=0";
        }
        $parent_topic = $this->topic_model->field('id,topic_name,tree_struct')->where($map)->select();
        $this->assign('parent_topic',make_array($parent_topic,'id','topic_name'));

        $this->assign('page_title','文章分类');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );

        if ( $get['topic_name'] )
            $map['_string'] = 'INSTR(t.topic_name,"'.$get['topic_name'].'")>0';

        if ( $get['parent_topic'] )
            $map['t.parent_id'] = $get['parent_topic'];

        if ( $map ){
            $topic = $this->topic_model->alias('t')->field('t.*,pt.topic_name AS parent_topic_name')
                ->join('LEFT JOIN __ARTICLE_TOPIC__ AS pt ON pt.id=t.parent_id')
                ->where($map)->order('t.rank DESC')->select();
        }else{
            $topic = $this->topic_model->topic_list();
        }
        $this->assign('list',$topic);

        $parent_topic = $this->topic_model->topic_list();
        $this->assign('parent_topic',make_array($parent_topic,'id','topic_name'));

        $this->assign('page_title','文章分类');
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
                        if ( D('Article')->where(array('topic_id'=>array('in',$post['id'])))->count() )
                            E('抱歉，该分类下还有文章');

                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->topic_model->where($map)->delete();
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->topic_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $topic = $this->topic_model->field('id,rank')->where($map)->find();
                        if ( !$topic )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $topic['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $topic_rank = $this->topic_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$topic_rank )
                            break;

                        foreach ( $topic_rank as $val ){
                            $this->topic_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->topic_model->where(array('id'=>$rank_id))->save(array('rank'=>$topic['rank']));
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