 
     /* *
      * 添加商品到收藏夹
      * shanbumin
      */
     function collect(goods_id) 
     {



        var url="/index.php?m=Computer&c=Goods&a=addCollection";
        var send={'goods_id':goods_id};

        $.post(url,send,function(reback){

                switch(reback.code)
                {
                    case 'sadd':
                     $('#shan_collect').addClass('hover');
                     Core.Alert({'text':'添加收藏成功','state':'suc','timeout':1000,'callback':function(){}});
                    break;
                    case 'sdel':
                      $('#shan_collect').removeClass('hover');
                     Core.Alert({'text':'取消收藏成功','state':'notic','timeout':1000,'callback':function(){}});
                    break;
                    case 'fadd':
                    Core.Alert({'text':'添加收藏失败','state':'err','timeout':1000,'callback':function(){}});
                    break;
                    case 'fdel':
                    Core.Alert({'text':'取消收藏失败','state':'err','timeout':1000,'callback':function(){}});
                    break;
                    case 'login':
                    Core.Alert({'text':'未登录不可以添加收藏','state':'err','timeout':1000,'callback':function(){}});
                    break;
                    default:
                    break;
                }
       
        
        })
     
     }


/**
 * 添加购物车
 * @param {[type]} goods_id [description]
 */
function add_cart(quick) 
{
 
     $('#shan_quick').val(quick);
     var goods=getInputs(document.forms['shan_form']); 
     var url="/index.php?m=Computer&c=Flow&a=addToCart";
     var send={
        'goods':goods,
     };


     $.post(url,send,function(reback){
      //=================
         switch(reback.code)
         {
             case 'stop':
              Core.Alert({'text':'网络卡导致数据丢失','state':'err','timeout':1000,'callback':function(){}});
             break;
             case 'wrong':
              Core.Alert({'text':'提交数据失败','state':'err','timeout':1000,'callback':function(){}});
             break;
             case 'login':
             var will=window.confirm('未登录不能进行快速结算');
             if(will){
                 location.href="/Login/index.html";
                 
             }
    
             break;
             case 'suc':
               if(quick=='Y')
               {
                   window.location.href ="/Flow/checkout/quick/Y.html"; 
               }else{
                  window.location.href ="/Cart/cart.html"; 
               }
             break;

         }
      //==========================
     });
}





/**
 * 前端的特效
 * @param  {[type]} This [description]
 * @return {[type]}      [description]
 */
function make_check(This)
{

     $(This).siblings('dd').find('input').prop("checked",false);
     $(This).find('input').prop('checked',true).end().siblings('dd').removeClass('this').end().addClass('this');


    var goods=getInputs(document.forms['shan_form']); 



   var url="/index.php?m=Computer&c=Flow&a=getFinalPrice";
   var send={
      'goods':goods,
   };

   $.post(url,send,function(reback){
    //=================
       switch(reback.code)
       {
           case 'stop':
            Core.Alert({'text':'网络卡导致数据丢失','state':'err','timeout':1000,'callback':function(){}});
           break;
           case 'fail':
            Core.Alert({'text':'后台管理人员未填写价格属性','state':'err','timeout':1000,'callback':function(){}});
           case 'suc':
              $('#shan_final').html(reback.final_price);

       }
    //==========================
   });
    


}




/**
 * 改变数量的时候
 */
function changeNumber(type)
{
  
  var qty=$('#goods_number').val();
  if(type == 1){qty--; }
  if(type == 3){qty++; }
  if(qty <=0 ){ qty=1; }

  if(!/^[0-9]*$/.test(qty))
    { 
       document.getElementById('goods_number').value =1;
       $('#goods_number').val(1);
   }else{
        $('#goods_number').val(qty);
   }

// //额外添加的按钮
//   var last_num=document.getElementById('goods_number').value;
//    if(last_num==1){
//      $('.cut').css('color', '#999');
//    }else{
//      $('.cut').css('color', '#252525');
//    }



}











