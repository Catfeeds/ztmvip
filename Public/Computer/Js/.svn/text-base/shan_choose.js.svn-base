/**
* 去支付宝支付
**/
function go_alipay(order_id)
{
     var url="/index.php?m=Computer&c=Pay&a=alipay";
     var send={
         'order_id':order_id,
      }
     $.post(url,send,function(reback){
          if(reback.code=='suc'){
             $("#shan_alipay").html(reback.content);
          }else if(reback.code=='stop'){
             alert('您的网络卡，请重试');
          }else if(reback.code=='fail'){
             alert('支付宝的服务器卡，请重试');
          }
     })
}



/**
 * 选择储值卡
 * @param  {[type]} This    [description]
 * @param  {[type]} card_id [description]
 * @return {[type]}         [description]
 */
function choose_card(This,card_id)
{
   $('.shan_card label').removeClass('ture');
   $(This).removeClass('false').addClass('ture'); //傻鸡前端，单词拼错，不得不随之附和 you know that is 'true' not 'ture'
   $('[name="card_id"]').val(card_id);

   // alert($('[name="card_id"]').val());

}
/**
 * 储值卡支付
 * @param  {[type]} This [description]
 * @return {[type]}      [description]
 */
function make_card(order_id)
{
    var password=$('[name="password_card"]').val();
    var url="/index.php?m=Computer&c=Center&a=innerPay";
    var send={
       'password':password,
       'order_id':order_id,
       'way':'card',
       'card_id':$('[name="card_id"]').val(),
    };

    $.post(url,send,function(reback){
          if(reback.code=="suc"){
             window.location.href="/Flow/checkPay/status/1/order_id/"+reback.order_id+".html";
          }else if(reback.code=='payed'){
             window.location.href="/User/order/state/payed.html";
          }else if(reback.code=='stop'){
             alert('请填写必要的支付信息');
          }else if(reback.code=='password'){
             alert('密码错误，请重试');
          }else if(reback.code=='c_enough'){
            alert('您的储值卡余额不足');
          }else if(reback.code=='fail'){
             window.location.href="/Flow/checkPay/status/0/order_id/"+reback.order_id+".html";
          }
    })
   

}


/**
 *  去余额支付
 * @return {[type]} [description]
 */
function make_balance(order_id)
{
   var password=$('[name="password"]').val(); 
   var url="/index.php?m=Computer&c=Center&a=innerPay";
   var send={
      'password':password,
      'order_id':order_id,
      'way':'balance',
   };

   $.post(url,send,function(reback){
         if(reback.code=="suc"){
            window.location.href="/Flow/checkPay/status/1/order_id/"+reback.order_id+".html";
         }else if(reback.code=='payed'){
            window.location.href="/User/order/state/payed.html";
         }else if(reback.code=='stop'){
            alert("请填写必要的支付信息");
         }else if(reback.code=='password'){
            alert('密码错误，请重试');
         }else if(reback.code=='b_enough'){
           alert('您的余额不足');
         }else if(reback.code=='fail'){
            window.location.href="/Flow/checkPay/status/0/order_id/"+reback.order_id+".html";
         }
   })

}