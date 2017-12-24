<?php
/**
 * 评论控制器
 * author: Tom
 */
namespace Admin\Controller;
class CommentController extends BaseController
{
    protected $comment_model;

    public function _initialize(){
        parent::_initialize();

        $this->comment_model = D('Comment');
        $this->assign('aside_id',0);
    }

    /**
     * 添加评论
     * @param $relation_id
     * @param $relation_type
     */
    public function edit($relation_id,$relation_type){
        if ( IS_POST && IS_AJAX ) {
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try {
                if ( !$post['level'] )
                    E('抱歉，请选择评价等级');
                if ( !$post['user_name'] )
                    E('抱歉，请输入会员昵称');
                if ( !$post['content'] )
                    E('抱歉，请输入评价内容');

                $data = array_intersect_key($post,array_flip(array(
                    'level',
                    'user_name',
                    'content',
                    'date_add',
                )));
                $data['relation_id'] = $relation_id;
                $data['relation_type'] = $relation_type;
                $data['date_add'] = strtotime($data['date_add']);

                if ( !$this->comment_model->add($data) )
                    E('抱歉，添加失败');
            } catch (\Think\Exception $e) {
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('relation_id',$relation_id);
        $this->assign('relation_type',$relation_type);

        $this->assign('page_title','添加评论');
        $this->display();
    }

    /**
     * 商品评论
     * @param $goods_id 商品id
     */
    public function goods($goods_id){
        if ( !check_admin_rights('goods',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $get = I('get.');

        $map = array(
            'relation_id' => $goods_id,
            '_string' => '1',
        );

        if ( $get['user_name'] )
            $map['_string'] .= ' AND INSTR(user_name,"'.$get['user_name'].'")>0';

        if ( $get['content'] )
            $map['_string'] .= ' AND INSTR(content,"'.$get['content'].'")>0';

        $count = $this->comment_model->where($map)->count();
        $page = $this->page($count);
        $comment = $this->comment_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
        $this->assign('list',$comment);

        $goods_name = D('Goods')->where(array('id'=>$goods_id))->getField('goods_name');
        $this->assign('relation_id',$goods_id);

        $this->assign('relation_type','goods');
        $this->assign('page_title',$goods_name.'——评论');
        $this->display('list');
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
                        $this->comment_model->where($map)->delete();
                        break;
                    case 'hidden':
                    case 'show':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $data = array('display'=>$post['action'] == 'show' ? 'Y' : 'N');
                        $this->comment_model->where($map)->save($data);
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

    public function goodsCollect(){
        try{
            $uri = I('post.uri');
            if ( !$uri )
                E('请输入抓取地址');

            $goods_id = preg_replace('#^.*?(\d+)\.html.*?$#i','$1',$uri);
            $page = I('post.page',0,'intval');

            $res = http("http://club.jd.com/productpage/p-{$goods_id}-s-0-t-3-p-{$page}.html?callback=collect_comment");
            $script = mb_convert_encoding($res,'utf-8','gbk');
        }catch (\Think\Exception $e){
            $script = 'Core.Alert({ "text":"'. $e->getMessage() .'","state":"err" });';
        }

        die($script);
    }
}