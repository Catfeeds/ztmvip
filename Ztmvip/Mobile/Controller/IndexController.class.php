<?php
/**
 * 首页控制器
 * author: Tom
 * author: Connor
 */
namespace Mobile\Controller;
class IndexController extends BaseController {
    public function index()
    {
        //顶部Banner
        $banner = D('Advert')->advert_list('indexBanner');
        $this->assign('banner',$banner);

        //首页展示的三个秒杀产品
        $end_time=strtotime(date('Y-m-d 24:0:0'));
        $date=date("Y/m/d H:i:s",$end_time);
        $this->assign('date',$date);
        $threekill=D('Goods')->threeKill(0,3);
        $this->assign('threekill',$threekill);

        //首页展示潮流趋势文章
        $fashion = D('Advert')->advert_list('indexFashion',0,9);
        $this->assign('fashion',$fashion);

        $this->assign('page_title',C('WEBSITE.TITLE'));
        $this->display();
    }


/**
 * 新品首发
 * @return [type] [description]
 */
    public function newGoodsList()
    {
        $newStarting = D('Advert')->advert_list('newStarting');
        $this->assign('newStarting',$newStarting);
      $this->assign('header_title','新品首发');
      $this->assign('page_title',C('WEBSITE.TITLE'));
      $this->display('new_index');

    }





/**
 * 特卖专场
 * @return [type] [description]
 */
  public function specialBuy()
  {
     $specialBuy = D('Advert')->advert_list('specialBuy');
       $this->assign('specialBuy',$specialBuy);
      $this->assign('header_title','特卖专场');
       $this->assign('page_title',C('WEBSITE.TITLE'));
       $this->display('sale_index');

  }

    /**
     * 品牌馆
     * @return [type] [description]
     */
    public function brandPavilion()
    {
        $brandPavilion = D('Advert')->advert_list('brandPavilion');
        $this->assign('brandPavilion',$brandPavilion);
        $this->assign('header_title','品牌馆');
        $this->assign('page_title',C('WEBSITE.TITLE'));
        $this->display();

    }

public function getAjaxGoods()
{
   
  // sleep(2);

    $cat_id=I('post.cat_id');
    $page=I('post.page');


    $goods=D('Goods')->ajaxCatGoods($cat_id,$page,12);
    if(count($goods)==0)
    {
       $result['error']=4;
       $this->ajaxReturn($result);
    }

    $this->assign('goods',$goods);
    $result['content']=$this->fetch('Public/ajax_goods');
    $result['error']=8;
    $this->ajaxReturn($result);

}



/**
 * 某个类(含扩展类)下的商品
 * @param  [type] $cat_id [description]
 * @return [type]         [description]
 */
public function catGoodsList($cat_id)
{
  $category_name = M('GoodsCategory')->where(array('id'=>$cat_id))->getField('category_name');
  $this->assign('header_title',$category_name);
   $this->assign('cat_id',$cat_id);
   $this->assign('page_title',C('WEBSITE.TITLE'));
   $this->display('new_list');
}

/**
 * 秒杀专区商品列表
 * @return [type] [description]
 */
    public function secondSkillGoods()
    {
      

      $seckill=D('Goods')->secondSkillGoods();
      
      $eleven=array();
      $fifteen=array();
      $twenty=array();
      $twenty_two=array();
      $time=time();
                      foreach ($seckill as $key => $value)
                      {
                              if($value['goods_number']<=0)
                              {
                                #已经抢光了
                                 $value['flag']='out';
                              }else{

                                                if($time<$value['kill_start'])
                                                {
                                                    #未开始
                                                    $value['flag']='no';
                                                }elseif($time>=$value['kill_start'] && $time <= $value['kill_end'])
                                                {   #进行中
                                                    $value['flag']='on';
                                                }elseif($time >$value['kill_end'])
                                                {
                                                   #已经结束了
                                                   $value['flag']='off';
                                                }
                                   }
                     
                    
                            #==================
                            #2015/10/20 16:00:00
                             $value['kill_end']=date('Y/m/d H:i:s',$value['kill_end']);
                            #==========================
                            
                            if($value['kill_start']==strtotime(date('Y-m-d 11:0:0')))
                            {
                                   
                                  $eleven[]=$value;
                            }elseif($value['kill_start']==strtotime(date('Y-m-d 15:0:0')))
                            {
                                 $fifteen[]=$value;
                            }elseif($value['kill_start']==strtotime(date('Y-m-d 20:0:0')))
                            {
                                  $twenty[]=$value;
                            }elseif($value['kill_start']==strtotime(date('Y-m-d 22:0:0')))
                            {
                              $twenty_two[]=$value;
                            }
                    }
                    



  // show_bug($twenty_two);

      $this->assign('eleven',$eleven); 
      $this->assign('fifteen',$fifteen); 
      $this->assign('twenty',$twenty); 
      $this->assign('twenty_two',$twenty_two);
      $this->assign('page_title',C('WEBSITE.TITLE'));
      $this->display('seckill_index');      

}

    //pc端页面
    public function pc(){
        C('layout_on',false);
        $this->display();
    }
}#类尾 
