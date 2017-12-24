<?php

namespace Computer\Controller;
class ArticleController extends BaseController
{
    protected $article_model, $article_share_model, $user_model;

    public function _initialize()
    {
        parent::_initialize();
        $this->article_model = D('Article');
        $this->article_share_model = D('ArticleShare');
        $this->user_model = D('User');
    }

    //显示文章
    public function show()
    {
        $id = I('id', 0, 'intval');
        $fashion = I('fashion', 0, 'intval');
        $article_share_user = I('get.at_user', 0, 'intval');

        if ($article_share_user > 0 && $article_share_user!=session('user_id')) {
            $map = array(
                'user_id' => $article_share_user,
                'article_id' => $id,
                'date_upd' => array(array('egt', time() - 3600 * 24), array('elt', time()))
            );
            //用户加积分
            //先判断当前文章，当前用户是否在一天内(昨天的这个时间到今天的这个时间)存在过分享

            if (!$this->article_share_model->where($map)->order('date_upd desc')->limit(1)->getField('id')) {
                //24小时内没有存在当前用户对当前文章的分享
                //寻找24小时内添加了纪录但是没有更新积分到用户表的纪录

                array_pop($map);
                $map['date_add'] = array(array('egt', time() - 3600 * 24), array('elt', time()));

                if (!$row = $this->article_share_model->where($map)->order('date_add desc')->limit(1)->find()) {
                    //添加一条分享纪录
                    $row = array(
                        'user_id' => $article_share_user,
                        'article_id' => $id,
                        'integral' => 10,
                        'date_add' => time()
                    );
                    $row['id'] = $this->article_share_model->add($row);
                }
                //更新用户表的用户积分
                if (false !== $this->user_model->where(array('id' => $article_share_user))->setInc('integral', $row['integral'])) {
                    //更新分享表
                    $this->article_share_model->where($row['id'])->save(array('date_upd' => time()));
                }
            }

        }

        $map = array(
            'display' => 'Y',
            'id' => $id
        );
        $article = $this->article_model->field('id,title,article_thumb,content')->where($map)->find();

        //相关文章
        $relation_article = D('Advert')
            ->where(array('topic' => 'indexFashion', 'disabled' => 'N', 'id' => array('lt', $fashion)))
            ->limit('0,9')->order('rank desc')->field('id,image,hd_image,link')->select();
        foreach ($relation_article as &$val) {
            $val['link'] = parse_url($val['link']);
            $val['link'] = $val['link']['path'];
        }
        unset($val);
        $this->assign('relation_article', $relation_article);
        //是否已经收藏 Start
        if (session('user_id')) {
            $where = array(
                'user_id' => session('user_id'),
                'article_id' => $id,
                'favor_type' => 'article'
            );

            $exist = M('UserFavor')->where($where)->count();

            if ($exist > 0) {
                $this->assign('flag', 1);
            }
        }
        //文章分享 S
        $bd_share = array();
        $bd_share['bdText '] = '整体美解决方案领导者';
        $bd_share['bdDesc '] = $article['title'];
        $share = array(
            'id'=>$article['id'],
            'fashion'=>$fashion,
            'at_user'=>session('user_id') ? session('user_id') : 0,
        );
        $bd_share['bdUrl'] = __HOST__ . U('Article/show', $share);
        $bd_share['bdPic'] = __HOST__ . $article['article_thumb'];
        $bd_share['bdSize'] = 16;
        $this->assign('bd_share', $bd_share);
        //文章分享 E
        $this->assign('article', $article);
        $this->assign('page_title', '女性整体美解决方案领导者');
        $this->display();
    }

    /**
     * 添加收藏文章
     * @param [type] $article_id [description]
     */
    public function addCollection($article_id)
    {

        if (!session('user_id')) {

            $data['status'] = 2;
            $this->ajaxReturn($data);
        } else {
            $where = array(
                'user_id' => session('user_id'),
                'article_id' => $article_id,
                'favor_type' => 'article'
            );
            $res = M('UserFavor')
                ->where($where)
                ->count();


            #有就是删除
            if ($res > 0) {
                $rs = M('UserFavor')
                    ->where($where)
                    ->delete();
                #============================
                if ($rs) {

                    $data['status'] = 8;
                    $data['action'] = 'del';
                    $data['content'] = '取消收藏成功';
                    $this->ajaxReturn($data);
                }
                #===================================

                #没有就是添加
            } else {
                $add['user_id'] = session('user_id');
                $add['article_id'] = $article_id;
                $add['favor_type'] = 'article';
                $add['date_add'] = time();

                #add方法返回值是新增记录的主键id
                $rs = M('UserFavor')
                    ->add($add);

                #==============================
                if ($rs) {
                    $data['status'] = 8;
                    $data['action'] = 'add';
                    $data['content'] = '添加收藏成功';
                    $this->ajaxReturn($data);
                }
                #====================================
            }
        }
    }
}