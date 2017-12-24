<?php
/**
 * 文章控制器
 * author: Tom
 */
namespace Admin\Controller;
class ArticleController extends BaseController
{
    protected $article_model,$topic_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('article',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->article_model = D('Article');
        $this->topic_model = D('ArticleTopic');
        $this->assign('aside_id',3);
    }

    /**
     * 修改文章
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
                if ( !$post['title'] )
                    E('抱歉，请输入文章标题');
                if ( !$post['topic_id'] )
                    E('抱歉，请选择文章分类');
                if ( !$post['content'] )
                    E('抱歉，请输入文章内容');

                $post['relation_article'] = array_diff(array_unique($post['relation_article']),array('',$id));

                $data = array_intersect_key($post,array_flip(array(
                    'title',
                    'topic_id',
                    'article_thumb',
                    'content',
                    'relation_article',
                )));
                $data['content'] = htmlspecialchars_decode($data['content']);
                $data['relation_article'] = json_encode($data['relation_article']?:array());

                if ( $id ){
                    $map = array(
                        'id' => $id,
                    );
                    $this->article_model->where($map)->save($data);
                }else{
                    $data['rank'] = $this->article_model->next_primary();

                    if ( !$this->article_model->add($data) )
                        E('抱歉，操作失败');
                }

                /* 双向关联文章 */
                if ( $post['relation_type'] && $post['relation_article'] ){
                    $relation_article = $this->article_model->field('id,relation_article')->where(array('id'=>array('in',$post['relation_article'])))->select();
                    foreach ( $relation_article as $val ){
                        $val['relation_article'] = json_decode($val['relation_article'],true);
                        $val['relation_article'][] = $id;
                        $val['relation_article'] = json_encode($val['relation_article']);
                        $this->article_model->where(array('id'=>$val['id']))->save(array('relation_article'=>$val['relation_article']));
                    }
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
            $article = $this->article_model->where(array('id' => $id))->find();
            if ( !$article )
                $this->_empty();

            $this->assign('edit',$article);
        }

        $topic = $this->topic_model->topic_list();
        $this->assign('topic',make_array($topic,'id','topic_name'));

        $this->assign('page_title','文章信息');
        $this->display();
    }

    public function index(){
        $get = I('get.');

        $map = array(
        );

        if ( $get['title'] )
            $map['_string'] = 'INSTR(a.title,"'.$get['title'].'")>0';

        if ( $get['topic_id'] )
            $map['a.topic_id'] = $get['topic_id'];

        $count = $this->article_model->alias('a')->where($map)->count();
        $page = $this->page($count);
        $article = $this->article_model->alias('a')->field('a.*,t.topic_name')
            ->join('__ARTICLE_TOPIC__ AS t ON t.id=a.topic_id')
            ->where($map)->limit($page->firstRow.','.$page->listRows)->order('a.rank DESC')->select();
        $this->assign('list',$article);

        $topic = $this->topic_model->topic_list();
        $this->assign('topic',make_array($topic,'id','topic_name'));

        $this->assign('page_title','文章列表');
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
                        $this->article_model->where($map)->delete();
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->article_model->where($map)->save(array('display' => $post['action'] == 'show' ? 'Y' : 'N'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $article = $this->article_model->field('id,rank')->where($map)->find();
                        if ( !$article )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $article['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $article_rank = $this->article_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$article_rank )
                            break;

                        foreach ( $article_rank as $val ){
                            $this->article_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->article_model->where(array('id'=>$rank_id))->save(array('rank'=>$article['rank']));
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

    //搜索
    public function search(){
        $post = I('post.');

        $map = array(
        );

        if ( $post['words'] )
            $map['_string'] = 'INSTR(title,"'.$post['words'].'")>0';

        if ( $post['article_id'] )
            $map['id'] = array('in',$post['article_id']);

        if ( $post['topic_id'] )
            $map['topic_id'] = $post['topic_id'];

        $article = $this->article_model->where($map)->order('rank DESC')->select();
        $this->ajaxReturn($article ? $article : array());
    }
}