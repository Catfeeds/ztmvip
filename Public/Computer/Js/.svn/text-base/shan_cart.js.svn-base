//弹出alert弹层
function alert_delete(This){
   $(This).next('div').show();
}

//取消删除

function cancle(This){
   $(This).offsetParent().hide();
}

/*
   购物车费中删除商品
 */

function drop_cart_goods(This,id)
{
     $(This).offsetParent().hide();
     var url="/index.php?m=Computer&c=Cart&a=dropCartGoods";
     var send={
         'cart_id':id,
     };
     $.post(url,send,function(reback){
            if(reback.code=='suc'){
                $('div.bg_h').html(reback.content);
                $('#shan_cnumber').html(reback.count);
            }else if(reback.code=='stop'){
                 alert('您的网络卡，请重试');
            }else if(reback.code=='fail'){
                 alert('删除失败，请重新删除');
            }
     })
}

/**
 *  购物车页面,用户进行二次添加、减少购物的数量
 *  跟详情页的区别在于：
 *  这里的+、-购物车中肯定是已经存在相同类型的商品了
 *  这里是最后一道防线，数量变化的时候，库存也要进行判断，不像详情页，整个数量的多少通过添加购物车这个按钮最后判断
 *  
 */

    function change_goods_number(type,cart_id)
    {
      
      var goods_number=$('#goods_number'+cart_id).val();
      if(type == 1){  goods_number--;  }
      if(type == 3){  goods_number++;  }
      if(goods_number <=0 ){ goods_number=1; }

      if(!/^[0-9]*$/.test(goods_number)) {
          goods_number=$('#back_number'+cart_id).val();
       }
      $('#goods_number'+cart_id).val(goods_number);
       var url="/index.php?m=Computer&c=Cart&a=ajaxUpdateCart";
       var send={
                'cart_id':cart_id,
                'goods_number':goods_number,
       };
       $.post(url,send,function(reback){
              
              if(reback.code=='suc'){
                  $('#shan_cnumber').html(reback.count);
                  $('#shan_go_number').html(reback.go_number);
                  $('#shan_goods_price').html(reback.goods_price);
                  // alert($('#perunit'+cart_id).html());
                  // alert(goods_number);
                  var smalltotal=$('#perunit'+cart_id).html() * goods_number;
                  $('#small_total'+cart_id).html(smalltotal.toFixed(2));
              }else if(reback.code=='stop'){
                   alert('您的网络卡，请重试');
              }else if(reback.code=='fail'){
                   alert('更改购买数量失败');
              }
       });
}
//每次在用户想手动输入购买量的时候我们都将之前的购买量保存到隐藏域中
function back_goods_number(cart_id)
{
   var goods_number=$('#goods_number'+cart_id).val();
   $('#back_number'+cart_id).val(goods_number);
}

/**
 *购物车页面改变选择
 * @return {[type]} [description]
 */
function change_selected(This,cart_id)
{
     
          var url="/index.php?m=Computer&c=Cart&a=changeSelected";
          var send={
             'cart_id':cart_id,
          };
          $.post(url,send,function(reback){

           if(reback.code=='suc'){
               $('#shan_go_number').html(reback.go_number);
               $('#shan_goods_price').html(reback.goods_price);
               
               if(reback.last_state=='Y'){
                  $(This).addClass('click');
               }else{
                  $(This).removeClass('click');
               }
               //注意ajax返回来的是字符串0
               if(reback.exist_unselected && reback.exist_unselected!='0'){
                   $('.js_all').removeClass('click');
               }else{
                 $('.js_all').addClass('click');
               }
           }else if(reback.code=='stop'){
                alert('您的网络卡，请重试');
           }else if(reback.code=='fail'){
                alert('更改选择失败，请重试');
           }           
    })
}

/**
 * 要么全选，要么全不选
 * @return [type] [description]
 */
 function select_all()
  {

      var url="/index.php?m=Computer&c=Cart&a=selectAll";  
      $.post(url,'',function(reback){
           if(reback.code=='suc'){
               $('#shan_go_number').html(reback.go_number);
               $('#shan_goods_price').html(reback.goods_price);
               
               if(reback.all=='Y'){
                  $('.js_all').addClass('click');
                  $('div.label label').addClass('click');
               }else{
                  $('.js_all').removeClass('click');
                  $('div.label label').removeClass('click');
               }
           }else if(reback.code=='stop'){
                alert('您的网络卡，请重试');
           }else if(reback.code=='fail'){
                alert('更改选择失败，请重试');
           }           
               
      })

  }

/**
 * 我去，结算去喽
 * @return {[type]} [description]
 */
function go_checkout()
{

   var url="/index.php?m=Computer&c=Flow&a=isAllowCheckout"; 

   $.post(url,'',function(reback){   
         if(reback.code=='suc'){
               location.href="/Flow/checkout.html";
         }else if(reback.code=='login'){
            var will=window.confirm('未登录不能进行结算');
            if(will){
                location.href="/Login/index.html";
                
            }

         }else if(reback.code=='select'){
             alert('请选择购买的商品');
         }else{
            alert('网络卡，请重试');
         }
   })

}














 






