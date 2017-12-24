<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript">
  

  function callpay()
  {


    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
        }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
        }
    }else{
        jsApiCall();
    }
  }

  function jsApiCall()
  {
  
    WeixinJSBridge.invoke(
          'getBrandWCPayRequest',<?php echo ($parameters); ?>,
          function(res){     
              if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                     window.location.href="<?php echo U('Treatment/checkPay',array('order_id'=>$order_id,'status'=>1));?>";
              }else{
                 window.location.href="<?php echo U('Treatment/checkPay',array('order_id'=>$order_id,'status'=>0));?>";
       
              }     
          }
      ); 
  }

  callpay();
</script>