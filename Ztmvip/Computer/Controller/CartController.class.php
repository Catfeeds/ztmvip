<?php
namespace Computer\Controller;
use   Think\Controller;

class CartController extends BaseController{




/**
 * 购物车
 * @return [type] [description]
 */
public function cart(){

     $cart_goods = D('Cart')->getCartList();
     // show_bug($cart_goods);

     $this->assign('cart_list', $cart_goods ['cart_list']);
     $this->assign('total', $cart_goods ['total']);
     if(!D('Cart')->existUnSelected())
        $this->assign('all_flag',1);
     $this->assign('page_title','购物车');
     $this->display();
}


/**
 * 删除购物车商品
 * @return [type] [description]
 */
public function dropCartGoods()
{

    $cart_id=I('post.cart_id');
    $result=array();
    
     try{
          if(!$cart_id)
            E('stop');
          if(!D('Cart')->dropCartGoods($cart_id))
            E('fail');

        $cart_goods = D('Cart')->getCartList();
        $this->assign('cart_list', $cart_goods ['cart_list']);
        $this->assign('total', $cart_goods ['total']);
        if(!D('Cart')->existUnSelected())
           $this->assign('all_flag',1);
       $content=$this->fetch('Public/cart');
       $result['code']='suc';
       $result['content']=$content;
       $count=D('cart')->cartBuyNumber();
       $result['count']=$count? $count :0;
     }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error) {
             case 'stop':
                 $result['code']='stop';
                 break;
             case 'fail':
                 $result['code']='fail';
                 break;
         }
     }

     $this->ajaxReturn($result);
}





/**
 * 购物车列表页面 + —等 来改变商品购买数量触发的ajax请求
 * 刷新购物车列表
 * @return [type] [description]
 */
public function ajaxUpdateCart()
{
    
          $cart_id=I('post.cart_id');
          $final_number=I('post.goods_number');
        
    try{

        if(!$cart_id || !$final_number)
            E('stop');

        #更新当前的记录
        if(!D('Cart')->updateCart($cart_id,$final_number))
         E('fail');
        
        $result['code']='suc';
        

        #获得当前客户端购物车中的商品
        $cart_goods= $cart_goods = D('Cart')->getCartList();
        $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
        $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;
        $result['count']=D('Cart')->cartBuyNumber();

    }catch(\Think\Exception $e){
         $error=$e->getMessage();
         switch ($error) {
             case 'stop':
                 $result['code']='stop';
                 break;
         }
    }

    $this->ajaxReturn($result);

}



/**
 *  购物车列表页面触发的勾选状况
 * @return [type] [description]
 */
public function changeSelected()
{
      $cart_id=I('post.cart_id');
      $result=array('code'=>'suc');

      try{
          if(!$cart_id)
             E('stop');

         if(D('Cart')->isSelected($cart_id)){
               if(!D('Cart')->changeSelectState($cart_id,'N'))
                  E('fail');
              $result['last_state']='N';
         }else{
             if(!D('Cart')->changeSelectState($cart_id,'Y'))
                E('fail');
            $result['last_state']='Y';
         }

       
       $cart_goods=D('Cart')->getCartList();
       $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
       $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;
       $result['exist_unselected']=D('Cart')->existUnSelected();

      }catch(\Think\Exception $e){
           $error=$e->getMessage();
           switch ($error) {
               case 'stop':
                    $result['code']='stop';
                   break;
               case  'fail':
                    $result['code']='fail';
           }
      }


      $this->ajaxReturn($result);

}



/**
 * 购物全选的状况
 * @return [type] [description]
 */
public function selectAll()
{
   $result=array('code'=>'suc');
   try{
       if(D('Cart')->existUnSelected()){

          if(!D('Cart')->changeAllState('Y'))
               E('fail');
           $result['all']='Y';
       }else{
           if(!D('Cart')->changeAllState('N'))
                E('fail');
            $result['all']='N';
       }

       $cart_goods=D('Cart')->getCartList();
       $result['goods_price']=$cart_goods['total']['goods_price']?$cart_goods['total']['goods_price']:0;
       $result['go_number']=$cart_goods['total']['go_number']?$cart_goods['total']['go_number']:0;

   }catch(\Think\Exception $e){
      $error=$e->getMessage();
      switch ($error) {
          case 'stop':
               $result['code']='stop';
              break;
          case 'fail':
               $result['code']='fail';
              break;
      }
   }

     $this->ajaxReturn($result);

}






}#类尾