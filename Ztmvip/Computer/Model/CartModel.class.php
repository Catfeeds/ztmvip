<?php

namespace Computer\Model;
use Think\Model;

class CartModel extends Model{



/**
* 仅仅计算出当前客户端用户购车中的商品数量
* @return [type] [description]
*/
public function  cartBuyNumber()
{
   $where=array('quick'=>'N');
   if(session('user_id')){
      $where['user_id']=session('user_id');
   }else{
      $where['cart_key']=CART_KEY;
   }
    $count=M('cart')->field('SUM(goods_number) AS count')
                   ->where($where)
                   ->find();
     $last_count=$count['count']?$count['count']:0;
     session('cnumber',$last_count);
     return $last_count;
}


/**
 * 将属性格式完美化
 * @param  [type] $spec [description]
 * @return [type]       [description]
 */
  public function getCartSpec($spec)
  {
  
       $cart_spec=array();
       foreach ($spec as $key => $value)
        {
              $reback=explode("_",$value);
              $cart_spec[$key][0]=$reback[2];
              $cart_spec[$key][1]=$reback[3];

       }

      return $cart_spec;
  }
      /**
       * 添加商品到购物车
       *
       * @access  public
       * @param   integer $goods_id   商品编号
       * @param   integer $num        商品数量
       * @param   array   $spec       商品规格属性(有的商品可能没有额)
       * 
       * @return  boolean   //被调用的函数最好就不要使用catch啦
       */
function addCart($goods_id,$num, $spec,$quick='N')
{

           #初始化要插入购物车的基本件数据
           $goods=M('Goods')->alias('g')->join('__GOODS_EXTEND__ ge ON g.id=ge.goods_id')
                                 ->where(array('g.id'=>$goods_id))
                                 ->field('g.goods_name,ge.express_id')
                                 ->find();
           //属性
           if($spec)
              $goods_attr=json_encode($this->getCartSpec($spec));  
           //最终单价
           $final_price=D('Goods')->getFinalPrice($goods_id,$spec);
           $data = array(
               'cart_key' =>CART_KEY,
               'goods_id' => $goods_id,
               'goods_name' =>$goods['goods_name'],
               'express_id' => $goods['express_id'],
               'goods_price' =>$final_price,
               'goods_number'=>$num,
               'selected'=>'Y',
               'buy_flag'=>'normal',
               'goods_attr'=>$goods_attr?$goods_attr:'',
               'user_id'=>session('user_id')?session('user_id'):'',
               'quick'=>$quick,
               'date_add'=>time(),
           );
              
           if($quick=='Y'){
               #=============================
               if($id=$this->existQuickCart()){
                     $data['id']=$id;
                     return $this->save($data);
                  }else{
                     return  $this->add($data);
                  }   
               
               #=================================
          }else{
               #===========================
                  if($id=$this->isInCart($goods_id,$goods_attr)){
                       return $this->where('id='.$id)->setInc('goods_number',$num);
                  }else{
                        return $this->add($data);
                  }
                #==============================
          }

}



/**
 * 某件正常商品是否已经存在购物车中了
 * @return boolean [description]
 */
public function isInCart($goods_id,$goods_attr)
{

    $where=array(
         'goods_id'=>$goods_id,
         'goods_attr'=>$goods_attr?$goods_attr:'',
         'quick'=>'N',
      );
    if(session('user_id')){
      $where['user_id']=session('user_id');
    }else{
      $where['cart_key']=CART_KEY;
    }
     return M('Cart')->where($where)->getField('id');

}
/**
 * 判断当前用户是否存在快速购买购物车计数器
 * @return [type] [description]
 */
public function existQuickCart(){
   $where=array(
        'quick'=>'Y',
     );
   if(session('user_id')){
     $where['user_id']=session('user_id');
   }else{
     $where['cart_key']=CART_KEY;
   }
   return M('Cart')->where($where)->getField('id');
}

/**
 * 获取购物车表中的数据
 * @return [type] [description]
 */
public function getCart($quick)
{
     $where=array('quick'=>$quick);
    if(session('user_id')){
      $where['user_id']=session('user_id');
    }else{
      $where['cart_key']=CART_KEY;
    } 
    return $cart=M('cart')->where($where)->order('id desc')->select();
}


/**
 * 获得当前客户端购物车中的商品以及帮其计算出总报价单信息
 *
 * @access  public
 * @return  array
 */
public function getCartList($quick='N') {

    $cart_list=$this->getCart($quick);
    $total = array();

    foreach ($cart_list as $key=> $value) 
   {
            if($value['selected']=='Y'){
               $total['goods_price'] += $value['goods_price'] * $value['goods_number'];
               $total['go_number'] += $value['goods_number'];
            }

            if($value['buy_flag']=='normal') {
               $cart_list[$key]['goods_thumb']=M('Goods')->where(array('id'=>$value['goods_id']))->getField('goods_thumb');
            }
            $cart_list[$key]['goods_attr']=json_decode($value['goods_attr'],true);
            $cart_list[$key]['small_total']=$value['goods_price']*$value['goods_number'];
  }
    return array('cart_list' => $cart_list, 'total' => $total);
}

/**
 * 判断是否存在未选中的商品
 * 
 * @return boolean [description]
 */
  public function  existUnSelected()
  {

       $where=array('quick'=>'N', 'selected'=>'N', );
      if(session('user_id')){
        $where['user_id']=session('user_id');
      }else{
        $where['cart_key']=CART_KEY;
      } 
      return $this->where($where)->count();

     
  }



/**
 * 删除购物车中的某个商品
 * @param  [type] $cart_id [description]
 * @return [type]          [description]
 */
public function  dropCartGoods($cart_id){
      return $this->where(array('id'=>$cart_id))->delete();
}


/**
 * 更新购买的数量
 * @param  [type] $cart_id [description]
 * @param  [type] $number  [description]
 * @return [type]          [description]
 */
public function updateCart($cart_id,$number)
{

  return $this->where(array('id'=>$cart_id))->save(array('goods_number'=>$number));
}


/**
 * 判断某个商品是否是选中的状态
 * @param  [type]  $cart_id [description]
 * @return boolean          [description]
 */
public function isSelected($cart_id)
{

  return $this->where(array('id'=>$cart_id,'selected'=>'Y'))->count();
}

/**
 * 改变选择的状态
 * @param  [type] $cart_id [description]
 * @param  [type] $state   [description]
 * @return [type]          [description]
 */
public function changeSelectState($cart_id,$state)
{

  return $this->where(array('id'=>$cart_id))->save(array('selected'=>$state));

}



/**
 * 改变全选的状态
 * @param  [type] $state [description]
 * @return [type]        [description]
 */
public function changeAllState($state)
{
    

     $where=array('quick'=>'N');
    if(session('user_id')){
      $where['user_id']=session('user_id');
    }else{
      $where['cart_key']=CART_KEY;
    } 
     return $this->where($where)->save(array('selected'=>$state));


}




 /**
  * 清空当前客户端的购物车中已经生成订单的商品
  * 
  */
public function clearCart($quick) 
{
     $map=array(
            'user_id'=>session('user_id'),
            'selected'=>'Y',
            'quick'=>$quick,
         );
      $this->where($map)->delete();
}



/**
 * 将用户id与cart_key结合
 * @return [type] [description]
 */
public function userToCart()
{
    M('cart')->where(array('cart_key'=>CART_KEY))->save(array('user_id'=>session('user_id')));
}



}#类尾部