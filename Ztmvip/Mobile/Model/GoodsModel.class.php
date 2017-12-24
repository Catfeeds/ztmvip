<?php
namespace Mobile\Model;
class GoodsModel extends BaseModel{



############首页跳转对应的二级列表页################################################


  /**
   *   获取的是精品
   */
    public function bestGoodsList($start=0,$end=10)
    {
        $where=array(
             'on_sale'=>'Y',#上架
             'disabled'=>'N',#未删除
             'best'=>'Y',#新品
          );

        $arr=$this->field('id,goods_name,market_price,shop_price,goods_thumb')
                  ->where($where)->order('rank desc')
                  ->limit($start,$end)
                  ->select();

        return $arr;

    }





/**
 * 秒杀产品
 * @param  integer $start [description]
 * @param  integer $end   [description]
 * @return [type]         [description]
 */
  public function secondSkillGoods($start=0,$end=100)
  {
        
 
      
      $sql="SELECT g.goods_name,g.market_price,g.shop_price,sg.goods_id,g.goods_thumb,sg.kill_price,sg.goods_number,sg.kill_start,sg.kill_end FROM ztm_seckill_goods AS sg LEFT JOIN ztm_goods AS g ON sg.goods_id=g.id WHERE sg.on_sale='Y' AND sg.disabled='N' ORDER BY sg.rank DESC LIMIT $start,$end";
      $arr=$this->query($sql);


      return $arr;


  }

  function threeKill($start,$end)
  {
     
     $stime=strtotime(date('Y-m-d 00:0:0'));
     $etime=strtotime(date('Y-m-d 24:0:0'));
     $sql="SELECT g.goods_name,g.market_price,g.shop_price,sg.goods_id,g.goods_thumb,sg.kill_price,sg.goods_number,sg.kill_start,sg.kill_end FROM ztm_seckill_goods AS sg LEFT JOIN ztm_goods AS g ON sg.goods_id=g.id WHERE sg.on_sale='Y' AND sg.disabled='N' AND sg.kill_start=$stime AND sg.kill_end=$etime ORDER BY sg.rank DESC LIMIT $start,$end";

     $arr=$this->query($sql);


     return $arr;    

  }

/**
 * 延时加载获取某个类的商品
 * @param  [type] $cat_id [description]
 * @param  [type] $page   [description]
 * @return [type]         [description]
 */
public function ajaxCatGoods($cat_id='',$page='',$limit='')
{


        $arr=D('GoodsCategory')->getChildTree($cat_id);

       $cat_ids=array();
        foreach ($arr as $key => $value) {
           $cat_ids[]=$value['id'];
           if($value['cat_id'])
           {
               foreach ($value['cat_id'] as $key2 => $value2) {
                  $cat_ids[]=$value2['id'];
               }
           }
        }
        #将自己加进来
        $cat_ids[]=$cat_id;
        $string=implode(',',$cat_ids);
      
        $map['g.on_sale'] = 'Y';
        $map['g.disabled'] = 'N';
        //扩展分类也考虑
        $map['_string'] = 'g.category_id in ('.$string.') or gec.category_id='.$cat_id;
        $join = 'left join __GOODS_EXTEND_CATEGORY__ gec on g.id=gec.goods_id and gec.category_id='.$cat_id;
        $goods = $this->alias('g')
                    ->field('g.id,g.goods_name,g.market_price,g.shop_price,g.goods_thumb')
                    ->join($join)
                    ->order('g.rank desc')
                    ->page($page,$limit)
                    ->where($map)
                    //->distinct('g.id')
                    ->select();
 
        return $goods;

        
}


  /**
   * 获取某个类下面的商品(扩展分类也考虑在内了)
   * 该函数的作用是取出某个栏目下的所有商品
   *注意如果是顶级栏目，只有它的后代才会有商品的，自身是没有的
   * 放心，这里我们是会通通找出来的
   * @param  [type]  $cat_id [description]
   * @param  integer $start  [description]
   * @param  integer $end    [description]
   * @return [type]          [description]
   */
  public function categoryGetGoods($cat_id,$start=0,$end=10000) 
  {
     
    $arr=D('GoodsCategory')->getChildTree($cat_id);


   $cat_ids=array();
    foreach ($arr as $key => $value) {
       $cat_ids[]=$value['id'];
       if($value['cat_id'])
       {
           foreach ($value['cat_id'] as $key2 => $value2) {
              $cat_ids[]=$value2['id'];
           }
       }
    }
    #将自己加进来
    $cat_ids[]=$cat_id;
    $string=implode(',',$cat_ids);
 	
 	  $map['g.on_sale'] = 'Y';
    $map['g.disabled'] = 'N';
    //扩展分类也考虑
    $map['_string'] = 'g.category_id in ('.$string.') or gec.category_id='.$cat_id;
    $join = 'left join __GOODS_EXTEND_CATEGORY__ gec on g.id=gec.goods_id and gec.category_id='.$cat_id;
    $goods = $this->alias('g')
                ->field('g.id,g.goods_name,g.market_price,g.shop_price,g.goods_thumb')
                ->join($join)
                ->order('g.rank desc')
                ->limit("$start,$end")
                ->where($map)
                //->distinct('g.id')
                ->select();
    return $goods;
      
    //$sql="SELECT id as goods_id,goods_name,market_price,shop_price,goods_thumb FROM ztm_goods where on_sale='Y' and disabled='N' and category_id IN ($string) OR id IN (SELECT goods_id FROM ztm_goods_extend_category WHERE category_id=$cat_id) ORDER BY rank desc LIMIT $start,$end";
    //return  M()->query($sql);
  }



############商品详情页##################################################################
  
  /**
   *   获取的是商品相册
   */

    public function getGoodsGallery($goods_id,$start=0,$end=10)
    {
         $where=array(
            'goods_id'=>$goods_id,
          );
          $pictures=M('goods_extend')-> field('goods_gallery')
                   ->where($where)->limit($start,$end)->find();
          $arr=json_decode($pictures['goods_gallery'],true); 
          return $arr;

    }

/**
 *  获取商品的属性规格
 * @param  [type] $goods_id [description]
 * @return [type]           [description]
 */
  public function getGoodsProperties($goods_id)
{
 
    $sql="SELECT ge.skus AS oneskus,gs.skus AS twoskus FROM ztm_goods_extend AS ge LEFT JOIN ztm_goods_sku AS gs ON ge.sku_id=gs.id WHERE ge.goods_id=$goods_id";
     

     $arr=$this->query($sql);


           $oneskus=json_decode($arr[0]['oneskus'],true);
           $twoskus=json_decode($arr[0]['twoskus'],true);

    
           $return=array();
           foreach ($oneskus as $key => $value) 
           {
                ###############
                foreach ($twoskus as $key2 => $value2) {
                     if($value['sku_id']==$value2['id'])
                     {
                
                          $return[$value['sku_id']]['name']=$value2['name'];
                          $return[$value['sku_id']]['sku_id']=$value['sku_id'];
                         break;
                     }
                }
                #################
                $return[$value['sku_id']]['values'][]=array(
                     'label' => $value['value'],
                     
                  );
           }


     return $return;


}

public function getSkusPrice($goods_id,$spec)
{


    $back=M('goods_extend')->where('goods_id='.$goods_id)->getField('skus_price');
    $back2=json_decode($back,true);

    if(count($back2))
    {
          $compare='';
          foreach ($spec as $key => $value) {
               $compare.=str_replace('_',':',$value).';';
          }
         
         $new_compare=substr($compare,0,strlen($compare)-1);
 
          foreach ($back2 as $key => $value) {
              if($value['skus']==$new_compare)
              {
                  return $skus_price=$value['price'];
              }
          }

    }else{
        return 0;
    }

}

/**
 * 取得商品最终的购买单价
 * 属性价格未考虑进去的
 * @param   string  $goods_id      商品编号
 *
 * @return  商品最终购买单价
 */
function getFinalPrice($goods_id,$spec='') 
{

   
    $where['on_sale']='Y';
    $where['disabled']='N';
    $where['id']=$goods_id;
    $shop=M('goods')->field('shop_price')->where($where)->find();


#############################################
    $where2['goods_id']=$goods_id;
    $where2['on_sale']='Y';
    $where2['disabled']='N';
    $where2['kill_start']=array('LT',time());
    $where2['kill_end']=array('GT',time());
    $kill=M('seckill_goods')->where($where2)->field('kill_price')->find();

########################看下属性价格#######################################
if($spec)
{
    $skus_price=$this->getSkusPrice($goods_id,$spec);
}




    #比较商品的促销价格，会员价格，优惠价格,属性价格 ===>得到该商品的最终单价
    if($kill['kill_price']>0)
    {
        $final_price =$kill['kill_price'];
    }else{

        $final_price=$shop['shop_price'];
    }
   
//当有属性价格的时候，秒杀价将会失效
   if(!empty($skus_price) && $skus_price>0)
   {
       $final_price=$skus_price;
   }

    #返回商品最终购买的单价
    return $final_price;
}

/**
 * 获取某件商品的销售量
 * @param  int $goods_id goods_id字段值
 * @return int           返回销售数量
 */
public function getSaleCount($goods_id)
{
   

  $sql="SELECT SUM(og.goods_number) AS sale_count FROM ztm_order_goods AS og LEFT JOIN ztm_order AS o ON og.order_id=o.id WHERE
  o.payment_state='payed' AND og.goods_id=$goods_id";

  $arr=$this->query($sql);

return $arr[0]['sale_count'];

}


/**
 * 获得指定商品的关联商品
 *
 * @access public
 * @param integer $goods_id
 * @return array
 */
function getRelatedGoods($goods_id,$start=0,$end=20) 
{

   $where['goods_id']=$goods_id;
   $res=$this->table('ztm_goods_extend')->where($where)->field('relation_goods')->find();



       $arr=json_decode($res['relation_goods'],true);

      if($arr)
      {
         $condition['id']=array('IN',$arr);
         $condition['on_sale']='Y';
         $condition['disabled']='N';
         return $this->table('ztm_goods')
              ->where($condition)
              ->field('id AS goods_id,goods_name,shop_price,market_price,goods_thumb')
              ->limit($start,$end)
              ->select();  

      }
        



 
}


/**
 * 获取商品的评价详情 by shanbumin
 * @param type $id    商品goods_id 
 */
function getCommentInfo($goods_id) 
{
  
    
//评论总数
   $where=array(
       'relation_id'=>$goods_id,
       'display'=>'Y',
       'relation_type'=>'goods',
    );

$info['count']=M('comment')->where($where)->count();
//好评总数

$where['level']=array('IN','4,5');
$favorable=M('comment')->where($where)->count();

//中评总数
$where['level']=array('IN','2,3');
$medium=M('comment')->where($where)->count();

//差评总数
$where['level']=1;
$bad=M('comment')->where($where)->count();

    $info['favorable_count'] = $favorable; //好评数量
    $info['medium_count'] = $medium; //中评数量
    $info['bad_count'] = $bad; //差评数量


    if ($info['count'] > 0) 
    {
       
        if ($favorable) {
            $info['favorable_rate'] = round(($favorable / $info['count']) * 100);  //好评率
        }
       
        if ($medium) {
            $info['medium_rate'] = round(($medium / $info['count']) * 100); //中评
        }
       
        if ($bad) {
            $info['bad_rate'] = round(($bad / $info['count']) * 100); //差评
        }
    } else 
    {
        $info['favorable'] = 100;
        $info['medium'] = 100;
        $info['bad'] = 100;
    }

    return $info;
}


/**
 * 获取商品评论列表
 * @param  [type]  $goods_id [description]
 * @param  [type]  $type     1所有评论/2好评/3是中评/4差评
 * @param  integer $start    [description]
 * @param  integer $end      [description]
 * @return [type]            [description]
 */
function commentList($goods_id, $type=1,$start=0,$end=1000) 
{
  
    
       
         $where=array(
             'relation_id'=>$goods_id,
             'display'=>'Y',
             'relation_type'=>'goods',
          );

            if($type==1)
            {
               $arr=$this->table('ztm_comment')->where($where)
                         ->field('user_name,content,level,date_add')
                         ->limit($start,$end)
                         ->order('id desc')
                         ->select();
               return $arr;
               
            }elseif($type==2)
            {
               $where['level']=array('IN','4,5');
               $arr=$this->table('ztm_comment')->where($where)
                         ->field('user_name,content,level,date_add')
                         ->limit($start,$end)
                          ->order('id desc')
                         ->select();
               return $arr;

            }elseif($type==3)
            {
               
               $where['level']=array('IN','2,3');
               $arr=$this->table('ztm_comment')->where($where)
                         ->field('user_name,content,level,date_add')
                         ->limit($start,$end)
                          ->order('id desc')
                         ->select();
               return $arr;



            }elseif($type==4)
            {
              $where['level']=1;
           $arr=$this->table('ztm_comment')->where($where)
                    ->field('user_name,content,level,date_add')
                    ->limit($start,$end)
                     ->order('id desc')
                    ->select();
             return $arr;
            }



}



/**
 * 商品详情页相关的整体美礼包
 * @param  [type] $goods_id [description]
 * @return [type]           [description]
 */
public function packageList($goods_id)
{
     $where['goods_id']=$goods_id;
     $where['display']='Y';
     $where['disabled']='N';
     $res=$this->table('ztm_group_goods')->where($where)->order('rank desc')
               ->field('id AS package_id,group_name,relation_goods')
               ->select();
  
            $package=array();
            foreach ($res as $key => $value) 
            {
                $arr=json_decode($value['relation_goods'],true);
                array_unshift($arr,$goods_id);
                  
                  $goods=array();
                  $condition['on_sale']='Y';
                  $condition['disabled']='N';
                  foreach ($arr as $key2 => $value2) 
                  {
                     $condition['id']=$value2;  
                     $goods[]=$this->table('ztm_goods')->where($condition)->field('goods_thumb')->find();

                  }
                    $value['relation_goods']=$goods;
                    $package[]=$value;
            }
         

          return $package;

 }



######################################礼包详情页#################################################################
/**
 * 礼包详情页以及展示列表页面
 * @param  [type] $goods_id [description]
 * @return [type]           [description]
 */
public function packageGoodsList($goods_id)
{
     $where['goods_id']=$goods_id;
     $where['display']='Y';
     $where['disabled']='N';
     $res=$this->table('ztm_group_goods')->where($where)->order('rank desc')
               ->field('id AS package_id,group_name,relation_goods,price')->select();
              

        $package=array();
        foreach ($res as $key => $value) 
        {
                      $arr=json_decode($value['relation_goods'],true);
                      array_unshift($arr,$goods_id);
              #====================================================
                    $condition['on_sale']='Y';
                    $condition['disabled']='N';
                  $goods_list=array();
                  foreach ($arr as $key2 => $value2) 
                  {
                       $condition['id']=$value2;
                       $goods=$this->table('ztm_goods') ->where($condition) ->field('goods_name,goods_thumb') ->find();
                       $goods_list[$value2]['goods_name']=$goods['goods_name'];
                       $goods_list[$value2]['goods_id']=$value2;
                       $goods_list[$value2]['goods_thumb']=$goods['goods_thumb'];
                       // $goods_list[$value2]['attr']=D('Goods')->getGoodsProperties($value2);
                  }
                  
      

                  $value['relation_goods']=$goods_list;

              #======================================================
                  $condition2['id']=array('IN',$arr);
                  $condition2['on_sale']='Y';
                  $condition2['disabled']='N';
              
              $res=$this->table('ztm_goods')->field('SUM(shop_price) AS org') ->where($condition2)->find(); 
              $value['orgin_price']=$res['org'];
              $value['discount']=$value['orgin_price']-$value['price'];
            #======================================================================
              $package[]=$value;
          }
 
       
    return $package;

}

    /**
     *   获取的是新品
     */
    public function newGoodsList($cat_id,$brand_id,$page,$pageSize)
    {
        if($cat_id==0 && $brand_id==0) return array();
        $map = array(
            'g.brand_id'=>$brand_id,
            'g.on_sale'=>'Y',
            'g.disabled'=>'N',
            'g.new'=>'Y'
        );
        if($cat_id){
            $ids = D('GoodsCategory')->getCatTreeIds($cat_id);
            $map['_string'] = 'g.category_id in ('.$ids.') or gec.category_id='.$cat_id;
        }


        return $this->alias('g')
            ->join('left join __GOODS_EXTEND_CATEGORY__ gec on g.id=gec.goods_id and gec.category_id='.$cat_id)
            ->where($map)->order('g.rank desc')->page($page,$pageSize)->select();

    }

    public function getSpecialList($cat_id,$brand_id,$page,$pageSize){
        if($cat_id==0 && $brand_id==0) return array();

        $map = array(
            'g.brand_id'=>$brand_id,
            'g.on_sale'=>'Y',
            'g.disabled'=>'N',
            'g.hot'=>'Y'
        );
        if($cat_id){
            $ids = D('GoodsCategory')->getCatTreeIds($cat_id);
            $map['_string'] = 'g.category_id in ('.$ids.') or gec.category_id='.$cat_id;
        }
        return $this->alias('g')
                    ->join('left join __GOODS_EXTEND_CATEGORY__ gec on g.id=gec.goods_id and gec.category_id='.$cat_id)
                    ->where($map)->page($page,$pageSize)->order('g.rank desc')->select();
    }


    public function getBrandList($brand_id,$page,$pageSize){
        if($brand_id==0) return array();

        $map = array(
            'g.brand_id'=>$brand_id,
            'g.on_sale'=>'Y',
            'g.disabled'=>'N',
        );
        return $this->alias('g')
            ->where($map)->page($page,$pageSize)->order('g.rank desc')->select();
    }




}#类尾巴





