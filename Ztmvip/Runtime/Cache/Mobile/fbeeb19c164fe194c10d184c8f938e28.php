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
    
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/sale_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/sale_pad.css" media="(min-width:750px)">
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
        }else{
            $('.returntop').fadeOut(400);
            $('.search_box').fadeOut(400)
        }
    })
    $('.returntop').on('click',function(e) {
        $('html,body').animate({scrollTop:0},500)
    });
</script>
<!-- 特卖专场头部开始 -->
<div class="header_box">
    <div class="header_title"><?php echo ($header_title); ?></div>
    <a class="return" href="<?php echo U('Index/index');?>"><img src="/Public/Mobile/Images/fh.jpg" alt="" /></a>
</div>
<!-- 特卖专场头部结束 -->
<!-- 特卖专场展示开始 -->
<?php if(!empty($brandPavilion)): ?><div class="sale_banner">
        <?php if(is_array($brandPavilion)): $i = 0; $__LIST__ = $brandPavilion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="banner"><a href="<?php echo ($vo["link"]); ?>/id/<?php echo ($vo["id"]); ?>.html"><img src="<?php echo ($vo["image"]); ?>" alt="" /></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>
<!-- 特卖专场展示结束 -->
<!-- 版权开始 -->

      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 

<!-- 版权结束 -->
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