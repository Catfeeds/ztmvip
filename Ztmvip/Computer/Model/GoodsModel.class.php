<?php
namespace Computer\Model;
class GoodsModel extends BaseModel{


    /**
     * 获取某个类下商品的总个数
     * @param  [type] $cat_id [description]
     * @return [type]         [description]
     */
    public function getCatGoodsCount($cat_id)
    {
        $cat_tree=D('GoodsCategory')->getChildTree($cat_id);
        $cat_ids=get_cat_ids($cat_tree);
        array_unshift($cat_ids,$cat_id);
        $extend_goods_ids=$this->getExtendGoodids($cat_ids);
        $string="on_sale='Y' AND disabled='N' AND category_id IN (".implode($cat_ids,',').")";
        if($extend_goods_ids)
            $string.=" OR id IN (".implode($extend_goods_ids,',').")";

        return $this->where($string)->count();
    }
    /**
     * 获取某个类下面的商品(扩展分类也考虑在内了)
     * @param  [type]  $cat_id [description]
     * @return [type]          [description]
     */
    public function categoryGetGoods($cat_id,$start,$end)
    {

        $cat_tree=D('GoodsCategory')->getChildTree($cat_id);
        $cat_ids=get_cat_ids($cat_tree);
        array_unshift($cat_ids,$cat_id);
        $extend_goods_ids=$this->getExtendGoodids($cat_ids);
        $string="on_sale='Y' AND disabled='N' AND category_id IN (".implode($cat_ids,',').")";
        if($extend_goods_ids)
            $string.=" OR id IN (".implode($extend_goods_ids,',').")";

        return $goods=$this->field('id,goods_name,shop_price,market_price,goods_thumb')
            ->where($string)
            ->limit($start,$end)
            ->order('rank desc')
            ->select();

    }


    /**
     * 获取拓展分类下的商品id
     * @param  [type] $cat_ids [description]
     * @return [type]          [description]
     */
    public function getExtendGoodids($cat_ids)
    {
        $where=array(
            'category_id'=>array('IN',$cat_ids),
        );

        return $back=M('Goods_extend_category')->where($where)
            ->getField('goods_id',true);

    }

    /**
     *   获取的是商品相册
     */

    public function getGoodsGallery($goods_id)
    {

        $pictures=M('goods_extend')-> field('goods_gallery')
            ->where(array('goods_id'=>$goods_id))
            ->find();

        return json_decode($pictures['goods_gallery'],true);


    }


    /**
     * 获取商品所属的分类信息
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function getFatherCat($goods_id)
    {
        return M('Goods')->alias('g')->join('__GOODS_CATEGORY__ gc ON gc.id=g.category_id')
            ->field('gc.id,gc.category_name')
            ->where(array('g.id'=>$goods_id))
            ->find();
    }


    /**
     * 返回该商品的详细信息
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function getGoodsDetail($goods_id)
    {


        $detail=M('Goods')->alias('g')
            ->field('g.goods_number,g.goods_name,g.market_price,g.goods_thumb,g.shop_price,ge.goods_desc,ge.service')
            ->join('__GOODS_EXTEND__ ge ON ge.goods_id=g.id')
            ->where(array('g.id'=>$goods_id))
            ->find();

        $detail['final_price']=$detail['shop_price'];
        return $detail;

    }

    /**
     * 取得商品最终的购买单价
     * 现在我们不考虑秒杀啦，哈哈哈
     * @param   string  $goods_id      商品编号
     *
     * @return  商品最终购买单价
     */
    function getFinalPrice($goods_id,$spec)
    {

        $shop_price=$this->where(array('id'=>$goods_id))->getField('shop_price');
        $skus_price=$this->getSkusPrice($goods_id,$spec);
        return $skus_price?$skus_price:$shop_price;

        #比较商品的促销价格，会员价格，优惠价格,属性价格 ===>得到该商品的最终单价
        #由于站小，这里就没得比划喽
    }

    /**
     * 当用户做出商品属性选择的时候，计算出价格
     * @param  [type] $goods_id [description]
     * @param  [type] $spec     [description]
     * @return [type]           [description]
     */
    public function getSkusPrice($goods_id,$spec)
    {
        $back=M('goods_extend')->where('goods_id='.$goods_id)->getField('skus_price');
        $back2=json_decode($back,true);
        if($back2 && $spec)
        {
            $compare='';
            foreach ($spec as $key => $value) {
                $compare.=str_replace('_',':',$value).';';
            }
            $new_compare=substr($compare,0,strlen($compare)-1);
            foreach ($back2 as $key => $value) {
                if(trim($value['skus'])==trim($new_compare))
                {
                    return $value['price'];
                    break;
                }
            }
        }else{
            return 0;
        }
    }



    /**
     * 获得指定商品的关联商品
     *
     * @access public
     * @param integer $goods_id
     * @return array
     */
    function getRelatedGoods($goods_id)
    {


        $res=M('Goods_extend')->where(array('goods_id'=>$goods_id))
            ->field('relation_goods')->find();
        $arr=json_decode($res['relation_goods'],true);

        if($arr)
            return  $this->where(array('id'=>array('IN',$arr),'on_sale'=>'Y','disabled'=>'N'))
                ->field('id,goods_name,shop_price,market_price,goods_thumb')
                ->select();

    }

    /**
     * 获取历史记录商品
     * @param  [type] $history [description]
     * @return [type]          [description]
     */
    function getHistoryGoods($history)
    {


        #[object HTMLCollection]jquery-2.1.4.min.js
        #注意当刷新的时候，浏览器那边提交过来的cookie会添加上述的东西
        #但是幸好有TP过滤，就不用我们处理喽
        #但为了保证浏览顺序，不可以用IN条件
        $goods=array();
        foreach ($history as $key => $value) {
            $back=$this->where(array('id'=>$value,'on_sale'=>'Y','disabled'=>'N'))
                ->field('id,goods_name,shop_price,market_price,goods_thumb')
                ->find();

            if($back)
                $goods[]=$back;
        }


        return $goods;
    }


    /**
     * 获取商品的评价总数 by shanbumin
     * @param type $id    商品goods_id
     */
    function getCommentTotal($goods_id)
    {
        //评论总数
        $where=array(
            'relation_id'=>$goods_id,
            'display'=>'Y',
            'relation_type'=>'goods',
        );
        return M('comment')->where($where)->count();

    }


    /**
     * 获取商品评论列表
     */
    function comments($goods_id,$start=0,$end=1000)
    {

        $where=array(
            'relation_id'=>$goods_id,
            'display'=>'Y',
            'relation_type'=>'goods',
        );
        $arr=M('Comment')->where($where)
            ->field('user_name,content,level,date_add')
            ->limit($start,$end)
            ->order('id desc')
            ->select();

        $comments=array();
        foreach ($arr as $key => $value) {
            $value['add_time'] = date('Y/m/d H:i:s', $value['date_add']);
            $value['rq'] = date('Y/m/d', $value['date_add']);
            $value['ms'] = date('H:i:s', $value['date_add']);
            $comments[] = $value;
        }
        return $comments;

    }


    /**
     * 判断某个商品是否收藏了
     * @param  [type]  $goods_id [description]
     * @return boolean           [description]
     */
    public function isCollected($goods_id)
    {
        $where = array(
            'user_id' => session('user_id'),
            'goods_id' => $goods_id,
        );

        return M('User_favor')->where($where)->count();
    }


    /**
     * 添加收藏
     * @param [type] $goods_id [description]
     */
    public function addCollection($goods_id)
    {
        return M('User_favor')->add(array(
            'user_id'=>session('user_id'),
            'goods_id'=>$goods_id,
            'date_add'=>time(),
        ));
    }



    /**
     * 取消收藏
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function   removeCollection($goods_id)
    {
        return M('User_favor')->where(array('goods_id'=>$goods_id))
            ->delete();
    }





    /**
     *  获取商品的属性规格
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function getGoodsProperties($goods_id)
    {

        $back=M('Goods_extend')->alias('ge')->join('__GOODS_SKU__ gs ON ge.sku_id=gs.id')
            ->where(array('ge.goods_id'=>$goods_id))
            ->field('ge.skus,gs.skus AS catskus')
            ->find();
        $skus=json_decode($back['skus'],true);
        $catskus=json_decode($back['catskus'],true);
        $return=array();
        foreach ($skus as $key => $value)
        {
            ###############
            foreach ($catskus as $key2 => $value2) {
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


    /**
     * 假假的刷新人气，就是为了排序搜索有的排而已
     * @param [type] $goods_id [description]
     */
    public function addClick($goods_id)
    {
        $this->where('id='.$goods_id)->setInc('click',1);
    }













#################################下面是死亡地带


















































































































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






############商品详情页##################################################################







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

    public function singleProductBest($cat_ids,$count=8)
    {
        $map = array(
            'category_id'=>array('in',$cat_ids),
            'on_sale'=>'Y',
            'best'=>'Y',
            'disabled'=>'N',
        );
        $res = $this->where($map)->limit($count)->select();
        shuffle($res);
        return $res;
    }

    public function brandGoodsBest($brand_ids)
    {
        $map = array(
            'brand_id'=>array('in',$brand_ids),
            'on_sale'=>'Y',
            'best'=>'Y',
            'disabled'=>'N',
        );
        return $this->where($map)->limit(8)->select();
    }


}#类尾巴





