<?php
/**
 * 年货专场控制器
 * author: Sanxing
 */
namespace Mobile\Controller;
class YearController extends UserBaseController {
    public function year(){
        $now=time();
        $start=strtotime('2016-01-14');
        $end=strtotime('2016-01-26');
        if($now<$start) {
            $this->_empty(302,'活动尚未开始...');
        }else if($now>$end){
            $this->_empty(302,'活动已经结束...');
            exit;
        }

        #红包领取问题
        if (session('user_id')) {

            $exist1=D('Year')->isGetBonus('82');
            $exist2=D('Year')->isGetBonus('81');
            $exist3=D('Year')->isGetBonus('80');
            if ($exist1 > 0)
                $this->assign('flag1', 1);

            if($exist2>0)
                $this->assign('flag2',1);

            if($exist3>0)
                $this->assign('flag3',1);
        }

        //获取5类商品
        $cats=C('YEAR.year');
        $this->assign('cats',$cats);

        layout(false);
        $this->display();
    }

    public function getBonus(){
        $bonus_id=I('post.bonus_id');
        $result=array();

        try{
            if(!session('user_id'))
                E('login');
            if(!$bonus_id)
                E('stop');
            if($bonus_id!=82 && $bonus_id!=81 && $bonus_id!=80)
                E('out');

            if(D('Year')->isGetBonus($bonus_id)){
                E('geted');
            }

            if(!D('Year')->sendBonus($bonus_id))
                E('fail');

            $result['code']='suc';
            $result['bonus_id']=$bonus_id;
        }catch(\Think\Exception $e){
            $error=$e->getMessage();
            switch ($error) {
                case 'stop':
                    $result['code']='stop';
                    break;
                case 'out':
                    $result['code']='out';
                    break;
                case 'geted':
                    $result['code']='geted';
                    break;
                case 'fail':
                    $result['code']='fail';
                    break;
                case 'login':
                    $result['code']='login';
                    break;
            }
        }

        $this->ajaxReturn($result);
    }

    public function getAjaxGoods(){
        $cat_id=I('post.cat_id');
        $page=I('post.page');
        $result=array('cat_id'=>$cat_id);

        try{

            if(!$cat_id || !$page)
                E('stop');

            $goods=D('Goods')->ajaxCatGoods($cat_id,$page,10);
            if(count($goods)==0)
                E('empty');

            $this->assign('goods',$goods);
            $result['content']=$this->fetch('Public/year_goods');
            $result['code']='suc';
        }catch(\Think\Exception $e){
            $error=$e->getMessage();
            switch ($error) {
                case 'stop':
                    $result['code']='stop';
                    break;
                case 'empty':
                    $result['code']='empty';
                    break;
            }
        }

        $this->ajaxReturn($result);
    }
}