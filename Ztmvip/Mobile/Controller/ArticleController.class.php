<?php

namespace Mobile\Controller;
class ArticleController extends BaseController
{
    protected $article_model,$article_share_model,$user_model;

    public function _initialize(){
        parent::_initialize();
        $this->article_model = D('Article');
        $this->article_share_model = D('ArticleShare');
        $this->user_model = D('User');
    }

    //显示文章
    public function show(){
        $id = I('id',0,'intval');
        $fashion = I('fashion',0,'intval');
        $article_share_user = I('get.at_user', 0, 'intval');
        $map = array(
            'display'=>'Y',
            'id'=>$id
        );
        $article = $this->article_model->field('id,title,article_thumb,content')->where($map)->find();

        //相关文章
        $relation_article = D('Advert')
            ->where(array('topic' => 'indexFashion','disabled' => 'N','id'=>array('lt',$fashion)))
            ->limit('0,9')->order('rank desc')->field('id,image,link')->select();

        $this->assign('relation_article',$relation_article);
        //是否已经收藏 Start
        if (session('user_id'))
        {
            $where=array(
                'user_id'=>session('user_id'),
                'article_id'=>$id,
                'favor_type'=>'article'
            );

            $exist= M('UserFavor')->where($where)->count();

            if ($exist > 0)
            {

                $this->assign('flag', 1);

            }
        }
        //是否已经收藏 End
        //浏览历史 Start
        if (cookie('article_history')) {
            #按照逗号分割字符串返回值是数组
            $history = explode(',', cookie('article_history'));
            #array_unshift() 函数在数组开头插入一个或多个元素
            #直接影响原来的数组，看来是地址操作
            array_unshift($history, $id);
            #移除数组中的重复的值，并返回结果数组。则重复浏览的商品，只认为是一次喽。
            $history = array_unique($history);
            #当超过规定保存的历史记录  为5个，则移动即可
            while (count($history) > 20) {
                #删除数组中的最后一个元素。
                #先进先出，公平合理，保证呆在被窝子里面的时间都是相当的。
                #本质就是队列机制而已
                array_pop($history);
            }
            #按逗号拼接成字符串保存即可。
            cookie('article_history', implode(',', $history), time() + 3600 * 24 * 30);
        } else {
            cookie('article_history', $id, time() + 3600 * 24 * 30);
        }
        //浏览历史 End
        //文章分享 S
        $true = is_wechat_browser();
        if ($true) {
            $share = array(
                'id' => $article['id'],
                'at_user' => session('user_id')>0?session('user_id'):($article_share_user ? $article_share_user : 0),
            );
            $url = __HOST__ . U('Article/show', $share);
            $weObj = new \Common\Vendor\Wechat();
            //签名地址必须和当前地址一样
            $signPackage = $weObj->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
            $this->assign('signPackage', $signPackage);
            //对分享的储值卡进行描述
            $this->assign('link', $url);
            $this->assign('imgUrl', __HOST__ . $article['article_thumb']);
            //分享成功回调地址
            $share_callback = __HOST__ . U('Article/shareCallback', $share);
            $this->assign('share_callback',$share_callback);
        }
        //文章分享 E
        $this->assign('article',$article);
		$this->assign('page_title','女性整体美解决方案领导者');
        $this->display();
    }

    //文章分享回调
    public function shareCallback()
    {
        $article_id = I('id',0,'intval');
        $article_share_user = I('get.at_user', 0, 'intval');
        $true = is_wechat_browser();
        if(true){
            try {
                $map = array(
                    'user_id' => $article_share_user,
                    'article_id' => $article_id,
                    'date_upd' => array(array('egt', time() - 3600 * 24), array('elt', time()))
                );

                if ($article_share_user > 0) {
                    //用户加积分
                    //先判断当前文章，当前用户是否在一天内(昨天的这个时间到今天的这个时间)存在过分享

                    if ($id = $this->article_share_model->where($map)->order('date_upd desc')->limit(1)->getField('id')) {
                        E('24小时内已经分享过');
                    }
                    //24小时内没有存在当前用户对当前文章的分享
                    //寻找24小时内添加了纪录但是没有更新积分到用户表的纪录

                    array_pop($map);
                    $map['date_add'] = array(array('egt', time() - 3600 * 24), array('elt', time()));

                    if (!$row = $this->article_share_model->where($map)->order('date_add desc')->limit(1)->find()) {
                        //添加一条分享纪录
                        $row = array(
                            'user_id' => $article_share_user,
                            'article_id' => $article_id,
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
                E('分享成功');
            } catch (\Think\Exception $e) {
                $this->redirect(U('Article/show',array('id'=>$article_id)));
            }
        }
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
                'favor_type'=>'article'
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