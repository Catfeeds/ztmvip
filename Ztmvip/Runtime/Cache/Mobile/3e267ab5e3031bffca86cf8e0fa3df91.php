<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <!--//不使用缓存
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    -->
    <title><?php echo ($page_title); echo ($sitename); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Common/Images/common.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//base.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/nav_mobile.css" media="(max-width:750px)" />
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/nav_pad.css" media="(min-width:750px)">
    <script type="text/javascript" src="/Public/Mobile/Js//jquery.js"></script>
    <script type="text/javascript" src="/Public/Common/Js/common.js"></script>
    <script type="text/javascript" src="/Public/Common/Js/shanbumin.js"></script>
    <style type="text/css">
        html #hm_t_undefined{ display:none;}
    </style>
    
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//confirmation_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//confirmation_pad.css" media="(min-width:750px)">
<script type="text/javascript" src="/Public/Mobile/Js//shan_quick.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Common/Css/paywait/iconfont_zhifu.css"/>
</head>
<body>


<!-- 订单确认头部开始 -->
<div class="header_box" onClick="javascript:history.go(-1);">
    <div class="header_title">订单结算</div>
    <span class="return" ><img src="/Public/Mobile/Images/fh.jpg" alt="" /></span>
</div>
<!-- 订单确认头部结束 -->
<!-- 订单确认内容开始 -->
<div class="address_box">
    <!-- 默认地址 -->
    <div class="default">
        <div class="default_inf">
            <div class="name">收货人：<?php echo ($consignee["consignee"]); ?></div>
            <div class="telephone"><?php echo ($consignee["mobile"]); ?></div>
        </div>
        <div class="place">
            <?php echo ($consignee["province"]); ?>省&nbsp;
            <?php echo ($consignee["city"]); ?>市&nbsp;
            <?php echo ($consignee["district"]); ?>&nbsp;
            <?php echo ($consignee["address"]); ?>&nbsp;
        </div>
    </div>
 <!-- 添加修改地址 -->
    <div class="list_box">
        <a href="<?php echo U('Region/editConsignee',array('address_id'=>$consignee['address_id'],'quick'=>1));?>">
            <div class="icon"><img src="/Public/Mobile/Images/icon1.jpg" alt="" /></div>
            修改收货地址
            <div class="jump"><img src="/Public/Mobile/Images/fhy.gif" alt="" /></div>
        </a>
    </div>
</div>
<!-- 支付方式 -->
<div class="columns_box pay_way">
    <div class="title">支付方式</div>

    <!-- ########################## -->
    <label for="method1" onclick="change_payment(this)" >
        <div class="list_box" >
            <div class="icon"><img src="/Public/Mobile/Images/icon2.jpg" alt="" /></div>
            微信支付
            <div class="tick shan_wx" <?php if(($order["payment_name"]) == "wx"): ?>style="display:block;"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
        </div>
    </label>
     <input type="radio" name="payment" value="wx"   id="method1" />
     <!-- ################################# -->



    <label for="method2" class="pay1" onclick="change_payment(this)" >
        <div class="list_box">
            <div class="icon not"><img src="/Public/Mobile/Images/icon3.jpg" alt="" /></div>
            余额支付
            <i id="enough"></i>
            <div class="tick" <?php if(($order["payment_name"]) == "ye"): ?>style="display:block;"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" />
          </div>
        </div>
    </label>
    <input type="radio" name="payment" value="ye" id="method2"  />




  
    <label for="method3" class="pay2" onclick="change_payment(this)">
        <div class="list_box">
            <div class="icon"><img src="/Public/Mobile/Images/icon4.jpg" alt="" /></div>
            储值卡支付
            <i></i>
           
            <div class="tick" <?php if(($order["payment_name"]) == "card"): ?>style="display:block;"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
        </div>
    </label>
    <input type="radio" name="payment" value="card" id="method3" />
    <input type="hidden" id="card_exist" value="<?php echo ($card); ?>"/>

</div>



<!-- 优惠方式 -->
<div class="columns_box privilege">
    <div class="title">优惠方式</div>

    <label for="classify1" class="coupons">
        <div class="list_box">
            <div class="icon"><img src="/Public/Mobile/Images/icon5.jpg" alt="" /></div>
            使用优惠券
            <i><?php echo ($order["coupon_name"]); ?></i>
            <div class="tick" <?php if(($order["coupon_id"]) > "0"): ?>style="display:block;"<?php endif; ?> >
               <img src="/Public/Mobile/Images/tick.jpg" alt="" />
            </div>
        </div>
    </label>
    <input type="radio" name="privilege" value="使用优惠券" id="classify1" />
    <script type="text/javascript">
        $(".coupons").click(function(event) {
            var coupon_exist=<?php echo ($coupon_exist); ?>;
            if(coupon_exist==0)
            {
                  Core.Alert({'text':'当前额度下，没有可用的优惠券','state':'notic','timeout':1000,'callback':function(){}});  
            }else{
            $(".couponsin").fadeIn(); 
            }
           
        });
    </script>
<!-- ########################################## -->



    <label for="classify2" class="packet">
        <div class="list_box">
            <div class="icon"><img src="/Public/Mobile/Images/icon6.jpg" alt="" /></div>
            使用红包
            <i id="bonus_name"><?php echo ($order["bonus_name"]); ?></i>
            <div class="tick" <?php if(($order["bonus_id"]) > "0"): ?>style="display:block;"<?php endif; ?> >
               <img src="/Public/Mobile/Images/tick.jpg" alt="" />
            </div>
        </div>
    </label>
    <input type="radio" name="privilege" value="使用红包" id="classify2" />
    <script type="text/javascript">
        $(".packet").click(function(event) {
            var bonus_exist=<?php echo ($bonus_exist); ?>;
            if(bonus_exist==0)
            {
                  Core.Alert({'text':'当前额度下，没有可用的红包','state':'notic','timeout':1000,'callback':function(){}});  
            }else{
              $(".packetin").fadeIn();
            }
           
        });
    </script>
</div>


<div class="columns_box" class="integral">
    <label for="classify3" class="integral">
        <div class="list_box">
            <div class="icon"><img src="/Public/Mobile/Images/icon7.jpg" alt="" /></div>
            使用积分
            <i id="dis_integral"><?php if(($order["integral"]) > "0"): echo ($order["integral"]); endif; ?>
            </i>
            <div class="tick" <?php if(($order["integral"]) > "0"): ?>style="display:block;"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
        </div>
    </label>
    <input type="radio" name="privilege2" value="使用积分" id="classify3" />
</div>

<script type="text/javascript">
    // 积分
    $(".integral").click(function(event) {
        $(".integralin").fadeIn();
    });

</script>


<!-- 商品 -->

    <!-- 正常商品进这里 -->
        <div class="columns_box">
            <div class="goods_box">
                <div class="goods_pho"><img src="<?php echo ($goods_list["goods_thumb"]); ?>_250x250.jpg" alt="" /></div>
                <div class="inf_box">
                    <div class="goods_inf"><?php echo ($goods_list["goods_name"]); ?></div>
                    <div class="price">￥<i><?php echo ($goods_list["goods_price"]); ?></i>  &nbsp;&nbsp;&nbsp;&nbsp;×   <?php echo ($goods_list["number"]); ?>     </div>
                    <div>
                         <?php if(is_array($spec)): $i = 0; $__LIST__ = $spec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i; echo ($attr[0]); ?>：<?php echo ($attr[1]); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
<!-- 
                    <div class="goods_num">
                        <button type="button" onclick="change_goods_number(1);" class="cut">－</button>
                        <input type="text" name="number" onblur="change_goods_number(2);"value="<?php echo ($goods_list["number"]); ?>" id="goods_number" />
                        <input type="hidden" id="back_number" value="<?php echo ($goods_list["number"]); ?>" />
                        <button type="button" class="add" onClick="change_goods_number(3);">＋</button>
                    </div> -->
                </div>
            </div>
        </div>


<div class="placeholder"></div>

<!-- 订单页面内容结束 -->











<!-- 网页底部去支付条 -->
<div class="footer">
    <div class="all_price">合计：<i>￥</i><span id="amount"><?php echo ($total["amount"]); ?></span></div>
    <div class="pay_bt" onclick="checkout_before_done();">去支付</div>
</div>




<!-- 储值卡选择块 -->
<div class="card_bg payin2" >
    <div class="card_box">


        <label for="card0" onclick="change_card(this);">
            <div class="card"> <!-- 点这个，该弹窗就自动消失了 -->
                <i>不使用储值卡</i>
                <div class="tick" <?php if(($order["prepaid_id"]) == "0"): ?>style="display:block;"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
            </div> 
        </label>
        <input type="radio" name="shan_card" value="0" id="card0" />       
     <?php if(is_array($card_list)): $key1 = 0; $__LIST__ = $card_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><label for="card<?php echo ($key1); ?>" onclick="change_card(this);">
            <div class="card">
                <i>尾号：<?php echo ($value["prepaid_sn"]); ?></i>&nbsp;&nbsp;&nbsp;&nbsp;
                可用余额：
                <?php echo ($value["money"]); ?>
                <div class="tick" <?php if(($value["id"]) == $order["prepaid_id"]): ?>style="display:block;"<?php endif; ?>>
                    <img src="/Public/Mobile/Images/tick.jpg" alt="" />
                </div>
            </div> 
        </label>
        <input type="radio" name="shan_card" value="<?php echo ($value["id"]); ?>" id="card<?php echo ($key1); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
    
    </div>
</div>

<!-- 优惠券选择块 -->
<div class="card_bg couponsin">
    <div class="card_box">

        <label for="card0" onclick="change_coupon(this);">
            <div class="card">
                <i>不使用优惠券</i>
                <div class="tick shan_bu" <?php if(($order["coupon_id"]) == "0"): ?>style="display:block;"<?php endif; ?>>
                   <img src="/Public/Mobile/Images/tick.jpg" alt="" />
                </div>
            </div>       
        </label>
        <input type="radio" name="card" value="0" id="card0" /> 
  <?php if(is_array($coupon_list)): $key1 = 0; $__LIST__ = $coupon_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><label for="card<?php echo ($key1); ?>" onclick="change_coupon(this);">
            <div class="card">  <!-- class是card -->
                <i><?php echo ($value["coupon_name"]); ?></i>
                <div class="tick" <?php if(($value["coupon_id"]) == $order["coupon_id"]): ?>style="display:block;"<?php endif; ?>>
                   <img src="/Public/Mobile/Images/tick.jpg" alt="" />
                </div>
            </div>   
        </label>
        <input type="radio" name="card" value="<?php echo ($value["coupon_id"]); ?>" id="card<?php echo ($key1); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>  
<script type="text/javascript">
    $(".couponsin .card").click(function(event) 
    {   
          var string=$(this).children('i').html();
          if(string=='不使用优惠券')
          {
              
               $('.couponsin .card').children('.tick').hide();
               $(this).children('.tick').show();
                $(".coupons .list_box i").html('');
               $('.coupons .tick').hide();
          }else{

            //优惠券与红包只能选择一个
          
            $('.couponsin .card').children('.tick').hide();
            $(this).children('.tick').show();
             $(".coupons .list_box i").html($(this).children('i').html());
             $('.coupons .tick').show();
             //清除红包的选择(即将红包的状态归零)
             $('.packet .tick').hide();
             $('.packet i').html('');
             $(".packetin .card .tick").hide();
             $('.packetin .card').eq(0).find('.tick').show();
          }
        
  });
</script>


 

    </div>
</div>
<!-- 红包选择块 -->
<div class="card_bg packetin">
    <div class="card_box">
        <label for="card0"  onclick="change_bonus(this);" >
            <div class="card">
                <i>不使用红包</i>
                <div class="tick shan_bu" <?php if(($order["bonus_id"]) == "0"): ?>style="display:block;"<?php endif; ?>>
                   <img src="/Public/Mobile/Images/tick.jpg" alt="" />
                </div>
            </div>     
        </label>
        <input type="radio" name="bonus" value="0" id="card0"  />   

     <?php if(is_array($bonus_list)): $key1 = 0; $__LIST__ = $bonus_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><label for="card<?php echo ($key1); ?>" onclick="change_bonus(this);">
            <div class="card">
                <i><?php echo ($value["bonus_name"]); ?></i>
                <div class="tick" <?php if(($value["bonus_id"]) == $order["bonus_id"]): ?>style="display:block";<?php endif; ?> ><img src="/Public/Mobile/Images/tick.jpg" /></div>
            </div>     
        </label>
        <input type="radio" name="bonus" value="<?php echo ($value["bonus_id"]); ?>" id="card<?php echo ($key1); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script type="text/javascript">

      $(".packetin .card").click(function(event) 
      {   
            var string=$(this).children('i').html();
            if(string=='不使用红包')
            {
                 $('.packetin .card').children('.tick').hide();
                 $(this).children('.tick').show();
                  $(".packet .list_box i").html('');
                 $('.packet .tick').hide();
            }else{

              //优惠券与红包只能选择一个
            
              $('.packetin .card').children('.tick').hide();
              $(this).children('.tick').show();
               $(".packet .list_box i").html($(this).children('i').html());
               $('.packet .tick').show();
               //清除优惠券的选择(即将优惠券的状态归零)
               $('.coupons .tick').hide();
               $('.coupons i').html('');
               $(".couponsin .card .tick").hide();
               $('.couponsin .card').eq(0).find('.tick').show();
            }
          
    });
</script>

<!-- 积分选择块 -->

<!-- 积分选择块 -->
<div class="card_bg integralin">
    <div class="integral_box">
        <div class="integralin_now">
            可用积分:<?php echo ($your_integral); ?> <br />
            本订单最多可使用积分：<span id="shan_allow_integral"><?php echo ($order_max_integral); ?></span>
        </div>
     <input type="text" name="integral" placeholder="请输入" id="ZTM_INTEGRAL"  class="integral_input" onchange="change_integral(this.value)" <?php if(($order["integral"]) > "0"): ?>value="<?php echo ($order["integral"]); ?>" <?php else: ?>value=""<?php endif; ?>  />
        <div class="integral_bt">确 定</div>
    </div>
</div>
<input type="hidden" id="integral_orgin" <?php if(($order["integral"]) > "0"): ?>value="<?php echo ($order["integral"]); ?>" <?php else: ?>value=""<?php endif; ?>/>


<script type="text/javascript">
   //点击确定之后的事件
   //这个是在ajax请求改变之后，点击确定才触发的，所以与我们的ajax不冲突，不需要放到里头
   $(".integralin .integral_bt").click(function(event) {
       
       $(".integralin").fadeOut();
   });
</script>
<!-- ###################去支付弹出窗口################### -->
<div class="payfor_bg" id="ZTM_ORDERTOTAL">
     <!-- 此处动态填充的 -->
</div>
<!-- ########################################################## -->
<!-- 支付弹窗点击取消块 -->
<div class="cancel_bg">
    <div class="cancel_box">
        <div class="cancel_title">确定要放弃付款</div>
        <div class="cancel_bt">
            <div class="left">确 定</div>
            <div class="right">取 消</div>
        </div>
    </div>
</div>

<!-- 密码输入层 -->
<div class=" bg bg4">
    <div class="remind_box">
        <div class="text">
            请输入支付密码：<i>
                <span class="dian"></span>
                <span class="dian"></span>
                <span class="dian"></span>
                <span class="dian"></span>
                <span class="dian"></span>
                <span class="dian"></span>
                <input type="password" maxlength="6" class="pass_num" style="" />
            </i>
        </div>
        <div class="remindbt_box">
            <div class="remind_bt1">取 消</div>
            <div class="remind_bt2" onclick="go_check_done();">确 定</div>
        </div>
        <script type="text/javascript">

            $(".cancel_bt .left").on('click',function(event) {
                $(".cancel_bg").fadeOut();
                $('.payfor_bg').css('display','none');
                $('.pay_box').css('display','none');
            });
            $(".cancel_bt .right").on('click',function(event) {
                $(".cancel_bg").fadeOut();
                $('.payfor_bg').fadeIn();//大黑层
                $('.pay_box').slideDown();
            })
        </script>
    </div>
</div>



<script type="text/javascript">
    $(".pass_num").on('keyup',function(){
    //这就是输入值的个数
        var length=this.value.length;
        console.log(length)
        $('.dian:lt('+(length)+')').addClass('dian_cur')
        $('.dian:not(:lt('+(length)+'))').removeClass('dian_cur')  
    });

    

//取消密码弹出框
    $('.remind_bt1').on('click',function(){
        $('.bg4').fadeOut();

        // $('span .dian').html('');
        // $('.pass_num').val('');
    })


//全局控制用户选择之后，弹层自动消失的
//此处修改为card
    $(".card").click(function(event) {
        $(".card_bg").fadeOut();
    });

</script>

<div class="iconfont_zhifu" style="display:none;">
    <i class="iconfont">&#xe7d1;</i>
    <p>余额支付</p>
    <ul>
        <li class="li1"></li>
        <li class="li2"></li>
        <li class="li3"></li>
    </ul>

</div>
<style>
.fail_bg{ position: fixed; width: 100%; height:100%; background: rgba(0,0,0,0.3);top: 0px;
left: 0px;
z-index: 999;
display: none;
}
.fail{ width: 300px; height: 150px; position: absolute; margin: auto; background:#fff; left: 0; right: 0; top: 0; bottom: 0;  font-size: 15px; line-height: 4.5em;}
.fail p{ padding-left: 1em;}
.fail p.bot{ text-align: right; padding-top:20px; }
.fail p.bot *{ display: inline-block; padding-right: 1em; color: #57657f;}
</style>

<div class="fail_bg" id="shan_fail">
  <div class="fail">
    <p>支付密码错误，请重试</p>
    <p class="bot"><span class="fail_but" onClick="again();">重试</span><a href="<?php echo U('User/payword');?>">忘记密码</a></p>
  </div>
</div>
<script type="text/javascript">
     function again()
     {  
         $('#shan_fail').fadeOut();
         $('.bg4').fadeIn();//密码层
     }
    
</script>
</body>
</html>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?0f0b15bb49fcf471ea731895570e125c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>