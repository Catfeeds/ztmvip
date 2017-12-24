
//订单结算改变支付方式
function change_payment(This)
{



 var pay_way= $(This).next().val();
 var send={
        'pay_way':pay_way,
     };

        var url="/index.php?m=Mobile&c=Flow&a=changePayment";

        $.post(url,send,function(reback){
             
              if(reback.error=='nomoney')
              {
                  Core.Alert({'text':'您没有商城余额','state':'notic','timeout':1000,'callback':function(){}});
              }else if(reback.error==8)
              {
                 
                 $('div.pay_way .tick').hide();
                 $(This).find('div.tick').show();
                 if(pay_way=='card')
                 {
                    $('.payin2').fadeIn();
                 }

              }else if(reback.error=='nopassword')
              {
    
                  var result=window.confirm('请去个人中心设置商城支付密码');

                  if(result)
                  {
                      window.location.href="/index.php?m=mobile&c=User&a=payword&redirect="+reback.url;
                  }
              }else if(reback.error=='nocard')
              {
                  Core.Alert({'text':'您没有商城储值卡','state':'notic','timeout':1000,'callback':function(){}});
              }

        })


}

//储值卡的改变

function change_card(This)
{
    var prepaid_id=$(This).next().val();
    var url="/index.php?m=Mobile&c=Flow&a=changeCard";
    var send={
       'prepaid_id':prepaid_id,
    };

    $.post(url,send,function(reback){

          if(reback.error==8)
          {
               if(prepaid_id==0)
               { 
                //支付方式
                  $('div.pay_way .tick').hide();
                  $('.shan_wx').show();
                }
                //储值卡的样式
                $('.payin2 .tick').hide();
                $(This).find('.tick').show();
                   
              
          }

    })

}




/* *
 * 改变红包 
 */
function change_bonus(val)
{

   var bonus_id= $(val).next().val();
   var url="/index.php?m=Mobile&c=Flow&a=changeBonus";
  var send={
     'bonus':bonus_id,
  };

  $.post(url,send,function(reback){

       if(reback.error==8)
       {      
           document.getElementById('amount').innerHTML=reback.amount;
       }

         
  })

}

/* *
 * 改变优惠券 
 */
function change_coupon(val)
{

   var coupon_id= $(val).next().val();

   var url="/index.php?m=Mobile&c=Flow&a=changeCoupon";
  var send={
     'coupon':coupon_id,
  };

  $.post(url,send,function(reback){

       if(reback.error==8)
       {      
           document.getElementById('amount').innerHTML=reback.amount;
       }

         
  })

}

/*
 * 正常订单页面改变积分
 */
function change_integral(val)
{

 var selectedIntegral = val;
 var url="/index.php?m=Mobile&c=Flow&a=changeIntegral";

var send={
     points:val,
};

 $.post(url,send,function(reback){ 
      if(reback.error==8)
      { 

          if(reback.new_integarl>0)
          {
             $('#integral_orgin').val(reback.new_integarl);
             $(".integral .list_box i").html(reback.new_integarl);
             $('.integral .tick').show();
          }else{
           
               $('#integral_orgin').val('');
               $(".integral .list_box i").html('');
                $('.integral .tick').hide();
               $(".integral_input").val('');
          }
          document.getElementById('amount').innerHTML=reback.amount;

      }else{
  
               var orgin=$('#integral_orgin').val();
               if(orgin)
               {
                     $(".integral_input").val(orgin);
                     $('.integral .list_box i').html(orgin);

               }else{
                   $(".integral .list_box i").html('');
                   $('.integral .tick').hide();
                   $(".integral_input").val('');
               } 

               if(reback.error==1)
               {
                  Core.Alert({'text':'您的积分没有这么多','state':'notic','timeout':1000,'callback':function(){}});
               }else if(reback.error==2)
               {
                   Core.Alert({'text':'超过了订单允许使用的积分额度了','state':'notic','timeout':1000,'callback':function(){}});
               }else if(reback.error==4)
               {
                    Core.Alert({'text':'请正确输入阿拉伯数字','state':'notic','timeout':1000,'callback':function(){}});
               }


      } 
    

 });


}
/**
 * 订单详情
 * 点击去去支付按钮
 * 触发的ajax(目的就是请求不同的支付弹层)
 * @return {[type]} [description]
 */
 function checkout_before_done()
 {
     

       var url="/index.php?m=Mobile&c=Flow&a=beforeDone";
       $.post(url,'',function(reback){
               
               if(reback.error==8)
               {

                      $('#ZTM_ORDERTOTAL').html(reback.content);
                        $('.payfor_bg').fadeIn();//大黑层
                       $('.pay_box').slideDown();//结算层

                     $(".pay_title .cancel").on('click',function(event) {


                         $(".cancel_bg").fadeIn();
                         $('.payfor_bg').fadeOut();//大黑层
                     });
                 
               }


           
  

       })


 }


/**
 * 商城内部支付输入完密码后，点击确定触发的ajax
 * @return {[type]} [description]
 */
 function go_check_done()
 {

   var password=$('.pass_num').val();
   var send={
      'payment_password':password,
   };
   var url="/index.php?m=Mobile&c=Flow&a=done";

   $.post(url,send,function(reback){

         //###############################
          $('.bg4').fadeOut();//密码层

          $('span.dian').removeClass('dian_cur');
          $('.bg4 input').val('');
         //###############################

          if(reback.error=='stop'){
            window.location.href='/index.php?m=Mobile&c=User&a=payword&redirect='+reback.url;
          } else if(reback.error=='wrong')
          {
                if(reback.allow==0)
                {
                  window.location.href='/index.php?m=Mobile&c=User&a=payword&redirect='+reback.url;
                }else{
                    $('#shan_fail').fadeIn();

                }
         
          }else if(reback.error=='ye_little')
          {
              Core.Alert({'text':'您的余额不足','state':'err','timeout':1000,'callback':function(){}});
          }else if(reback.error=='card_little')
          {
              Core.Alert({'text':'您的储值卡余额不足','state':'err','timeout':1000,'callback':function(){}});   
          }
          else if(reback.error=='badorder')
          {
              Core.Alert({'text':'您已经支付成功，但由于网络原因造成订单入库失败，请截图尽快联系客服','state':'err','timeout':2000,'callback':function(){}});
          }else if(reback.error==8)
          {   
                  $('.bg4').hide();
               $(".cancel_bg").hide();
               $('.payfor_bg').hide();
               $('.pay_box').hide();

               if(reback.payment_name=='ye')
               {
                   $('.iconfont_zhifu p').html('余额支付');
               }else{
                    $('.iconfont_zhifu p').html('储值卡支付');
               }
                $('.iconfont_zhifu').fadeIn();
                setTimeout(function(){
                   $('.iconfont_zhifu').fadeOut();
                     window.location.href='/index.php?m=Mobile&c=Treatment&a=checkPay&status=1&order_id='+reback.order_id;
               
                },3000)    
          }else if(reback.error=='nogoods')
          {
              Core.Alert({'text':'订单已经生成，请去个人中心支付...','state':'suc','timeout':3000,'callback':function(){
                      
                         window.location.href='/index.php?m=Mobile&c=User&a=index';


              }});       

          }

   })


 }

