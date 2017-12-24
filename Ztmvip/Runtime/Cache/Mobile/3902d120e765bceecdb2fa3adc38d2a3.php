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
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//car_mobiletwo.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//car_padtwo.css" media="(min-width:750px)">
<script type="text/javascript" src="/Public/Mobile/Js//shan_cart.js"></script>

</head>
<body>

<?php if(!empty($cart_list)): ?><!-- 购物车头部开始 -->
<div class="header_box">
    <div class="header_title">购物车</div>
    <!--<a href="<?php echo U('Index/index');?>";>
      <div class="return"><img src="/Public/Mobile/Images/fh.jpg" height="37" width="18" alt="" /></div>
    </a>-->
    <span class="editor">编辑</span>
</div>
<!-- 购物车内容开始 -->
<script type="text/javascript">
$(function(){
   $('.editor').on('click',function(event) {
       var text = $('.editor').text();

       if(text == '编辑'){
           $(this).text('完成')
           $('.one').css('display','none');
           $('.two').css('display','block');
           $('.remove').css('display', 'block');
           $('.goods_num2').css('display', 'block');

       }else{
           $(this).text('编辑')
           // $('.one').css('display','block');
           // $('.two').css('display','none');
           // $('.remove').css('display', 'none');
           // $('.goods_num2').css('display', 'none');
            window.location.replace('<?php echo U('Flow/cart','another=1');?>');
       }
   });

})

  
</script>






<div class="address_box">
<form action="">

<!-- ##################### -->
<?php if(is_array($cart_list)): $key1 = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1; if(($value["buy_flag"]) == "normal"): ?><!-- 正常商品 -->
            <div class="columns_box">
                <input type="checkbox" name="goods" id="good<?php echo ($key1); ?>" />


                <div class="tick_box" onclick="change_selected(<?php echo ($value["id"]); ?>);">
                    <div class="rud" <?php if(($value["selected"]) == "Y"): ?>style="display:none"<?php endif; ?>></div>
                    <div class="tick" <?php if(($value["selected"]) == "Y"): ?>style="display:block"<?php endif; ?>><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
                </div>

                <div class="goods_box">
                    <div class="goods_pho"><img src="<?php echo ($value["goods_thumb"]); ?>"  /></div>
                    <div class="inf_box one">
                        <div class="goods_inf"><?php echo ($value["goods_name"]); ?></div>
                        <div class="price">
                          ￥<i><?php echo ($value["goods_price"]); ?></i>
                           <!-- 商品数目 -->
                          <div class="left">x<?php echo ($value["goods_number"]); ?></div>
                        </div>
                        <div>
              
                            <?php if(is_array($value["goods_attr"])): $i = 0; $__LIST__ = $value["goods_attr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i; echo ($attr[0]); ?>：<?php echo ($attr[1]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div class="inf_box two">
                        <div style="margin-top:30px;">
                           <?php if(is_array($value["goods_attr"])): $i = 0; $__LIST__ = $value["goods_attr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i; echo ($attr[0]); ?>：<?php echo ($attr[1]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="goods_num2">
                            <button type="button"  onclick="change_goods_number('1',<?php echo ($value["id"]); ?>)" class="cut"  <?php if(($value["goods_number"]) == "1"): ?>style="color:#999"<?php endif; ?> >－</button>
                            <input type="hidden" id="back_number<?php echo ($value["id"]); ?>" value="<?php echo ($value["goods_number"]); ?>" />
                            <input type="text" name="number" value="<?php echo ($value["goods_number"]); ?>" id="goods_number<?php echo ($value["id"]); ?>" onblur="change_goods_number('2',<?php echo ($value["id"]); ?>)" onfocus="back_goods_number(<?php echo ($value["id"]); ?>)" />
                            <button type="button" onclick="change_goods_number('3',<?php echo ($value["id"]); ?>)" class="add">＋</button>
                        </div>
                        <div class="remove" onclick="drop_cart_goods(this)">删除</div>
                        <input type="hidden" value="<?php echo ($value["id"]); ?>" checked="true"/>
                    </div>
                </div>
            </div>
        <?php else: ?>
           <!-- 大礼包走这里头 -->

              <!-- 礼包 -->
              <div class="columns_box package">
                  <input type="checkbox" name="goods" id="good2" />
                      <div class="package-box">
                          <div class="tick_box">
                              <div class="rud"></div>
                              <div class="tick"><img src="/Public/Mobile/Images/tick.jpg" alt="" /></div>
                          </div>
                          <div class="package_name">
                            礼包1：<u>
                              ￥<i>228</i>
                              <!-- 礼包数目 -->
                              &nbsp;x1
                              </u>
                          </div>
                      </div>
                      <div class="goods_box">
                          <div class="goods_pho"><img src="/Public/Mobile/Images/seckill_goods.jpg" alt="" /></div>
                          <div class="inf_box one">
                              <div class="goods_inf">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</div>
                              <div style="margin:30px 0">
                                  尺码：M
                                  颜色：酒红色
                              </div>
                          </div>
                          <div class="inf_box two">
                              <div style="margin:30px 0">
                                  尺码：M
                                  颜色：酒红色
                              </div>
                          </div>
                      </div>
                      <div class="goods_num2">
                          <button type="button" class="cut">－</button>
                          <input type="number" name="num" value="1" id="num" min="1" />
                          <button type="button" class="add">＋</button>
                      </div>
                      <div class="remove">删除</div>
                      <div class="goods_box">
                          <div class="goods_pho"><img src="/Public/Mobile/Images/seckill_goods.jpg" alt="" /></div>
                          <div class="inf_box one">
                              <div class="goods_inf">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</div>
                              <div style="margin:30px 0">
                                  尺码：M
                                  颜色：酒红色
                              </div>
                          </div>
                          <div class="inf_box two">
                              <div style="margin:30px 0">
                                  尺码：M
                                  颜色：酒红色
                              </div>
                          </div>
                      </div>
              </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<script type="text/javascript">
  $('.tick_box').on("click",function(event){
      $(this).find('.rud').toggle();
      $(this).find('.tick').toggle();
  });

</script>
<!-- ################# -->

</form>
</div>
<div class="bt_box" >

    <div class="inf">
        <input type="radio" name="all" id="all_click" style="display:none;" />
        <i><label for="#all_click" class="js_allclick">
            <div class="tick_box" id="shan_all" onclick="select_all();">
                <div class="rud" <?php if(!empty($all_flag)): ?>style="display:none"<?php endif; ?>></div>
                <div class="tick" <?php if(!empty($all_flag)): ?>style="display:block"<?php endif; ?> >
                    <img src="/Public/Mobile/Images/tick.jpg" alt="" />
                </div>
            </div>
        全选</label></i>
        <em>合计：￥<span id="together_price"><?php echo ((isset($total["goods_price"]) && ($total["goods_price"] !== ""))?($total["goods_price"]):0); ?></span></em>
        <u>(不含运费)</u>
    </div>
    <div class="pay_bt" onclick='javascript:location.href ="<?php echo U('Flow/checkout');?>";'>去支付&nbsp;<i>(<span id="gonumber"><?php echo ((isset($total["go_number"]) && ($total["go_number"] !== ""))?($total["go_number"]):0); ?></span>)</i>
   </div>
</div>

<!-- 点击全选时 -->
<!-- <script type="text/javascript">
  $('.js_allclick').on('click', function(event) {
    $(this).find('.rud').toggle();
    $(this).find('.tick').toggle();
  });
</script> -->



<!-- 购物车页面内容结束 -->
<?php else: ?>
    <div class="header_box">
        <div class="header_title">购物车</div>
        <!--<a href="<?php echo U('Index/index');?>">
          <div class="return"><img src="/Public/Mobile/Images/fh.jpg" height="37" width="18" alt="" /></div>
        </a>-->
       
    </div>
    <div class="car_bg_box">
    <div class="car_bg_boxin">
        <div class="car_photo"><img src="/Public/Mobile/Images/car_bg3.jpg" height="136" width="136" alt="" /></div>
        <div class="car_text"><a href="<?php echo U('Index/index');?>";>您的购物车空空如也~</a></div>
    </div>


</div><?php endif; ?>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/nav_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/nav_pad.css" media="(min-width:750px)">
<!-- 底部导航栏开始 -->
<div class="nav_box" style="z-index:9999">
    <div class="nav_in">
        <a href="<?php echo U('Index/index');?>">
            <div class="nav"><img src="/Public/Mobile/Images/nav1.gif" alt="" /></div>
        </a>
    </div>
    <div class="nav_in">
        <a href="<?php echo U('Category/catAll');?>">
            <div class="nav"><img src="/Public/Mobile/Images/nav2.gif" alt="" /></div>
        </a>
    </div>
    <div class="nav_in">
        <a href="<?php echo U('Flow/cart','another=1');?>">

            <div class="nav">
                <img src="/Public/Mobile/Images/nav3.gif" alt="" />
                <div class="goods_num" id="cnumber">
                     <?php if(session('cnumber')) { echo session('cnumber'); }else{ echo 0; } ?>
                </div>
            </div>
        </a>
    </div>
    <div class="nav_in">
        <a href="<?php echo U('User/index');?>">
            <div class="nav"><img src="/Public/Mobile/Images/nav4.gif" alt="" /></div>
        </a>
    </div>
</div>

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