<?php
/**
 * 会员收藏控制器
 * author: Tom
 */
namespace Mobile\Controller;
class FavorController extends UserBaseController
{
    protected $favor_model;

    public function _initialize(){
        parent::_initialize();

        $this->favor_model = D('UserFavor');
    }

    //删除
    public function delete(){
        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );
            $post = I('post.');

            try{
                $this->favor_model->where(array('id'=>$post['favor_id']))->delete();
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }
    }

    //足迹
    public function history(){
        $history_type = I('get.history_type')?:'goods';

        if ( IS_POST && IS_AJAX ){
            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );
            $post = I('post.');

            try{
                $data = cookie($history_type .'_history') .',';
                $data = trim(str_ireplace($post['id'].',','',$data),',');
                cookie($history_type .'_history',$data?:NULL);
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $history = array();

        switch ( $history_type ){
            case 'article':
                if ( !preg_match('/^(\d+,?)+$/i',cookie('article_history')) ){
                    cookie('article_history','');
                }else{
                    $history = D('Article')->field('id,title,article_thumb,content')
                        ->where(array('_string'=>'id IN ('. cookie('article_history') .')'))->select();
                }
                break;
            default:
                if ( !preg_match('/^(\d+,?)+$/i',cookie('goods_history')) ){
                    cookie('goods_history','');
                }else{
                    $time = time();
                    $history = D('Goods')->alias('g')->field('g.id,g.goods_name,g.goods_thumb,g.market_price,IFNULL(sg.kill_price,g.shop_price) AS shop_price')
                        ->join('LEFT JOIN __SECKILL_GOODS__ AS sg ON sg.goods_id=g.id AND sg.kill_start>='.$time.' AND sg.kill_end<='.$time)
                        ->where(array('_string'=>'g.id IN ('. cookie('goods_history') .')'))->select();
                }
        }

        $this->assign('history',$history);
        $this->assign('history_type',$history_type);

        $this->assign('page_title','我的足迹');
        $this->display();
    }

    public function index(){
        switch ( $favor_type = I('get.favor_type') ){
            case 'article':
                $favor = $this->favor_model->alias('f')->field('f.*,a.title,a.article_thumb,a.content')
                    ->join('__ARTICLE__ AS a ON a.id=f.article_id')
                    ->where(array('f.favor_type'=>'article','f.user_id'=>$this->user_id))->select();
                break;
            default:
                $favor = $this->favor_model->alias('f')->field('f.*,g.goods_name,g.goods_thumb,g.market_price,g.shop_price')
                    ->join('__GOODS__ AS g ON g.id=f.goods_id')
                    ->where(array('f.favor_type'=>'goods','f.user_id'=>$this->user_id))->select();
        }

        $this->assign('favor',$favor);
        $this->assign('favor_type',$favor_type);

        $this->assign('page_title','我的收藏');
        $this->display();
    }
}