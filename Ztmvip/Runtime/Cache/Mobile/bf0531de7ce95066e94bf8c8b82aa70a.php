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
    <link rel="stylesheet" type="text/css" href="/Public/Common/Css//sale_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Common/Css//sale_pad.css" media="(min-width:750px)">
<script type="text/javascript" src="/Public/Common/Js/shan.more.js"></script>
<script type="text/javascript" src="/Public/Mobile/Js//jquery.lazyload.min.js"></script>
</head>
<body>
<!-- 其他 -->
<div class="returntop top"><img src="/Public/Mobile/Images/top.png" alt="" /></div>
<script>
    $(window).on('scroll',function(e){
        var winST = $(window).scrollTop()
        if(winST>100){
            $('.returntop').fadeIn(400);
            $(".search_box").fadeIn(400)
        }else if(winST<100){
            $('.returntop').fadeOut(400);
            $('.search_box').fadeOut(400)
        }
    })
    $('.returntop').on('click',function(e) {            
        $('html,body').animate({scrollTop:0},0)
    });
</script>


<!-- 特卖专场头部开始 -->
<div class="header_box" onclick="javascript:location.href='<?php echo U('Index/index');?>';">
    <div class="header_title"><?php echo ($header_title); ?></div>
    <span class="return"><img src="/Public/Mobile/Images//fh.jpg" alt="" /></span>
</div>
<!-- 特卖专场头部结束 -->
<!-- 特卖专场展示开始 -->



<article>
<!-- <div class="sale_banner">
    <div class="banner"><img src="Images/banner4.jpg" alt="" /></div>
</div> -->

        <div class="goods_box">


        </div>
</article>



<!-- 转 -->
<div class="l_jiazai" id="loader" ><img src="/Public/Common/Images//jiazai.png" alt="" /></div>
<!-- <div class="l_jiazaihou" id='shan_out' style="font-size:1.2rem;text-align:center;display:none;">全部加载完毕...</div> -->


      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 


</body>



<script type="text/javascript">
   ajax_cat_goods(<?php echo ($cat_id); ?>);
</script>



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