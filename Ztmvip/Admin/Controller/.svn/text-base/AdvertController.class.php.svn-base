<?php
/**
 * 广告控制器
 * author: Tom
 */
namespace Admin\Controller;
class AdvertController extends BaseController
{
    protected $advert_model;

    public function _initialize(){
        parent::_initialize();

        if ( !check_admin_rights('advert',false) )
            $this->error('抱歉，您暂无权限使用该功能');

        $this->advert_model = D('Advert');
        $this->assign('aside_id',2);
    }

    /**
     * 修改广告
     * @param $topic 广告主题
     * @param null $id 广告id
     */
    public function edit($topic,$id=null){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['title'] )
                    E('抱歉，请输入广告标题');

                if ( !$post['image'] )
                    E('抱歉，请上传广告图');

                if ( !$post['link'] )
                    E('抱歉，请输入广告链接');

                $data = array_intersect_key($post,array_flip(array(
                    'title',
                    'image',
                    'hd_image',
                    'link',
                )));
                $data['hd_image'] = $data['hd_image']?:$data['image'];

                if ( $id ){
                    $map = array(
                        'id' => $id,
                        'topic' => $topic,
                    );
                    $this->advert_model->where($map)->save($data);
                }else{
                    $data['topic'] = $topic;
                    $data['rank'] = $this->advert_model->next_primary();

                    if ( !$this->advert_model->add($data) )
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
            $advert = $this->advert_model->where(array('id' => $id,'topic' => $topic))->find();
            if ( !$advert )
                $this->_empty();

            $this->assign('edit',$advert);
        }

        $this->assign('topic',$topic);

        $size = array(
            'indexBanner' => array('mob' => '750*414', 'pc' => '1920*400'),
            'indexFashion' => array('mob' => '206*360', 'pc' => '400*500'),
            'indexShare' => array('mob' => '206*360', 'pc' => '305*474'),
            'newStarting' => array('mob' => '750*434', 'pc' => '882*416'),
            'specialBuy' => array('mob' => '750*368', 'pc' => '860*300'),
            'brandPavilion' => array('mob' => '750*368', 'pc' => ''),
        );
        $this->assign('size',$size);

        $this->assign('page_title','广告信息');
        $this->display();
    }

    //首页banner
    public function indexBanner(){
        $map = array(
            'topic' => 'indexBanner',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','indexBanner');

        $this->assign('page_title','首页Banner管理');
        $this->display('list');
    }

    //首页潮流趋势
    public function indexFashion(){
        $map = array(
            'topic' => 'indexFashion',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','indexFashion');

        $this->assign('page_title','首页潮流趋势管理');
        $this->display('list');
    }

    //首页热点分享
    public function indexShare(){
        $map = array(
            'topic' => 'indexShare',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','indexShare');

        $this->assign('page_title','首页热点分享管理');
        $this->display('list');
    }

    //新品首发
    public function newStarting(){
        $map = array(
            'topic' => 'newStarting',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','newStarting');

        $this->assign('page_title','新品首发管理');
        $this->display('list');
    }

    //特卖专区
    public function specialBuy(){
        $map = array(
            'topic' => 'specialBuy',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','specialBuy');

        $this->assign('page_title','特卖专区管理');
        $this->display('list');
    }

    //Brand Pavilion 品牌馆
    public function brandPavilion(){
        $map = array(
            'topic' => 'brandPavilion',
        );
        $count = $this->advert_model->where($map)->count();
        $page = $this->page($count);
        $advert = $this->advert_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('rank DESC')->select();
        $this->assign('list',$advert);

        $this->assign('topic','brandPavilion');

        $this->assign('page_title','品牌馆管理');
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
                        if ( !$this->advert_model->where($map)->delete() )
                            E('抱歉，操作失败');
                        break;
                    case 'disable':
                    case 'enable':
                        $map = array(
                            'id' => array('in', $post['id']),
                        );
                        $this->advert_model->where($map)->save(array('disabled' => $post['action'] == 'enable' ? 'N' : 'Y'));
                        break;
                    case 'rank':
                        $map = array(
                            'id' => $post['id'],
                        );
                        $advert = $this->advert_model->field('id,rank')->where($map)->find();
                        if ( !$advert )
                            E('非法操作');

                        if ( !$post['rank'] || !is_array($post['rank']) )
                            break;

                        $rank_id = $advert['id'];

                        $map = array(
                            'id' => array('in',$post['rank']),
                        );
                        $order = 'FIND_IN_SET(id,"'.join(',',$post['rank']).'") DESC';
                        $advert_rank = $this->advert_model->field('id,rank')->where($map)->order($order)->select();
                        if ( !$advert_rank )
                            break;

                        foreach ( $advert_rank as $val ){
                            $this->advert_model->where(array('id'=>$rank_id))->save(array('rank'=>$val['rank']));
                            $rank_id = $val['id'];
                        }

                        $this->advert_model->where(array('id'=>$rank_id))->save(array('rank'=>$advert['rank']));
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