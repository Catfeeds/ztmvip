/*********************购物车页面***************************************************************************************/


/**
 *  购物车页面,用户进行二次添加、减少购物的数量
 *  跟详情页的区别在于：
 *  这里的+、-购物车中肯定是已经存在相同类型的商品了
 *  这里是最后一道防线，数量变化的时候，库存也要进行判断，不像详情页，整个数量的多少通过添加购物车这个按钮最后判断
 *  
 */

    function change_goods_number(type,cart_id)
    {
      
  
      var goods_number = document.getElementById('goods_number'+cart_id).value;

     
      if(type == 1){  goods_number--;  }
      if(type == 3){  goods_number++;  }
      if(goods_number <=0 ){ goods_number=1; }

     //当输入的不是数字的时候，则恢复之前的购买数量
     //注意，每次输入之前，必然触发focus事件，会将未更改之前的值保存到隐藏域中
      if(!/^[0-9]*$/.test(goods_number))
        { 
          goods_number = document.getElementById('back_number'+cart_id).value;
       }
      document.getElementById('goods_number'+cart_id).value = goods_number;

       var url="/index.php?m=Mobile&c=Flow&a=ajaxUpdateCart";
       var send={
                'cart_id':cart_id,
                'goods_number':goods_number,
       };
         

       $.post(url,send,function(reback){


       
           if(reback.error==8)
           {
             
              document.getElementById('together_price').innerHTML = reback.goods_price;
              document.getElementById('cnumber').innerHTML=reback.count;
              document.getElementById('gonumber').innerHTML=reback.go_number;

              if(goods_number==1)
              {
                $('#back_number'+cart_id).prev().css('color', '#999');
                
              }else{
                $('#back_number'+cart_id).prev().css('color', '#252525');

              }

  

           }else if(reback.error==1)
           {
               alert('库存不足,您最多只能购买'+reback.allow_number);
                document.getElementById('goods_number'+cart_id).value =reback.allow_number;
              
           }
           

       });
    }

    //每次在用户想手动输入购买量的时候我们都将之前的购买量保存到隐藏域中
    function back_goods_number(cart_id)
    {
       var goods_number = document.getElementById('goods_number'+cart_id).value;
       document.getElementById('back_number'+cart_id).value = goods_number;
    }




    /*
       购物车费中删除商品
     */
    
    function drop_cart_goods(This)
    {
       
       var result=window.confirm('您确定要把该商品移出购物车吗?');
       if(result)
       {

      
           var url="/index.php?m=Mobile&c=Flow&a=dropCartGoods";
           var cart_id=$(This).next().val();
   
    
           var send={
               'cart_id':cart_id,
           };

           $.post(url,send,function(reback){

                if(reback.error==8)
                {
                     $(This).closest('.columns_box').remove();
    
                     if(reback.count==0)
                     {
                 
                        //购物车里什么也没有了
                       window.location.replace('/index.php?m=Mobile&c=Flow&a=cart');
                         
                     }else{
                       
                         document.getElementById('cnumber').innerHTML=reback.count;
                         document.getElementById('gonumber').innerHTML=reback.go_number;
                         document.getElementById('together_price').innerHTML=reback.goods_price;


                     }
                      

                    

                }
           })
       }
       

    }


    /*
       清空购物车
     */
    
    function clear_cart()
    {
       
       var result=window.confirm('您确定要清空购物车吗?');
       if(result)
       {
         
           var url="/index.php?m=Mobile&c=Flow&a=clearCart";
    

           $.post(url,'',function(reback){

                 
                if(reback.error==8)
                {
                     document.getElementById('cart').innerHTML=reback.content;
                }
           })
       }
    }


    /**
     *购物车页面改变选择
     * @return {[type]} [description]
     */
    function change_selected(cart_id)
    {

        var url="/index.php?m=Mobile&c=Flow&a=changeSelected";
        var send={
           'cart_id':cart_id,
        };
        $.post(url,send,function(reback){

            if(reback.error==8){
            
          document.getElementById('together_price').innerHTML = reback.goods_price;
          document.getElementById('gonumber').innerHTML=reback.go_number; 
          if(reback.all_selected==1)
          {
              $('#shan_all .rud').hide();
              $('#shan_all .tick').show();
          }else{
              
              $('#shan_all .rud').show();
              $('#shan_all .tick').hide();

          }

              
               
            }
        })
    }


    /**
     * 要么全选，要么全不选
     * @return [type] [description]
     */
     function select_all()
      {

          var url="/index.php?m=Mobile&c=Flow&a=selectAll";  
          $.post(url,'',function(reback){

              document.getElementById('together_price').innerHTML = reback.goods_price;
              document.getElementById('gonumber').innerHTML=reback.go_number; 
                
                if(reback.code=='none')
                {
                   $('.rud').show();
                   $('.tick').hide();

                }else{
                    $('.rud').hide();
                    $('.tick').show();
                }
          })

      }
