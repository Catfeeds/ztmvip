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
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//user_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//user_pad.css" media="(min-width:750px)">
</head>
<body>
<!-- 收藏按钮 -->
<div class="collection"><a href="<?php echo U('Favor/index');?>"><img src="/Public/Mobile/Images/xin.png" height="58" width="58" alt="" /></a></div>
<!-- 网站头部 -->
<div class="user_head">
    <div class="use_banner"><img src="/Public/Mobile/Images/user_banner.jpg" alt="" /></div>
    <a class="user_photo" href="<?php echo U('info');?>">
        <div class="user_photo_box"><img src="<?php echo ($info['avatar']); ?>" alt="" /></div>
        <div class="real_box"><div class="real_photo"><img src="<?php echo ($info['avatar']); ?>" alt="" /></div></div>
    </a>
</div>
<script type="text/javascript">
    $(function(){
        var useph = $('.use_banner').height();
        var collh = $('.collection').height();
        var collt = $('.collection').offset().top
        $(window).on('scroll',function(e){
            var winST = $(window).scrollTop()
            if(winST>useph-collh-collt){
                $('.collection').fadeOut();
                
            }else{
                $('.collection').fadeIn();
            }
        })
    })
</script>
<!-- 个人信息 -->
<div class="user_inf">
    <div class="user_name">
        <i><?php echo ($info['nick_name']); ?></i><br />
        <?php echo ($info['parent_name']); ?>推荐会员
    </div>
    <div class="user_other">
        <span>
            <div class="left">
                <i>积分</i><br />
                <?php echo ($info['integral']); ?>
            </div>
        </span>
<!--         <a href="javascript:;"  id="qrcode">
            <div class="right"><img src="/Public/Mobile/Images/erweima.jpg" height="46" width="46" alt="" /></div>
        </a> -->
    </div>
</div>
<!-- 功能列表 -->
<div class="user_list">
    <div class="list">
        <a href="<?php echo U('order','state=new');?>">
            <div class="icon dif">
                <img src="/Public/Mobile/Images/user_icon1.jpg" height="45" width="58" alt="" />
                <?php if($order_count['new']): ?><div class="goods_num"><?php echo ($order_count['new']); ?></div><?php endif; ?>
            </div>
            <div class="icon_inf">待付款</div>
        </a>
    </div>
    <div class="list">
        <a href="<?php echo U('order','state=payed');?>">
            <div class="icon dif">
                <img src="/Public/Mobile/Images/user_icon2.jpg" height="45" width="58" alt="" />
                <?php if($order_count['payed']): ?><div class="goods_num"><?php echo ($order_count['payed']); ?></div><?php endif; ?>
            </div>
            <div class="icon_inf">待发货</div>
        </a>
    </div>
    <div class="list">
        <a href="<?php echo U('order','state=send');?>">
            <div class="icon">
                <img src="/Public/Mobile/Images/user_icon3.jpg" height="45" width="58" alt="" />
                <?php if($order_count['send']): ?><div class="goods_num"><?php echo ($order_count['send']); ?></div><?php endif; ?>
            </div>
            <div class="icon_inf">待收货</div>
        </a>
    </div>
    <div class="list">
        <a href="<?php echo U('order','state=receive');?>">
            <div class="icon">
                <img src="/Public/Mobile/Images/user_icon4.jpg" height="45" width="58" alt="" />
                <?php if($order_count['receive']): ?><div class="goods_num"><?php echo ($order_count['receive']); ?></div><?php endif; ?>
            </div>
            <div class="icon_inf">待评价</div>
        </a>
    </div>
    <div class="list">
        <a href="<?php echo U('order','state=refund');?>">
            <div class="icon dif">
                <img src="/Public/Mobile/Images/user_icon5.jpg" height="45" width="58" alt="" />
                <?php if($order_count['refund']): ?><div class="goods_num"><?php echo ($order_count['refund']); ?></div><?php endif; ?>
            </div>
            <div class="icon_inf">退款/售后</div>
        </a>
    </div>
</div>
<div class="list_box">
    <a href="javascript:;" id="qrcode_one">
        <div class="list_in">
            我的二维码
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('Affiliate/index');?>">
        <div class="list_in">
            返利中心
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('money');?>">
        <div class="list_in">
            我的余额 <i style="font-size:1.0rem;color:#808080;">￥<?php echo (sprintf('%.2f',$info['real_money'])); ?></i>
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('bonus');?>">
        <div class="list_in">
            我的红包
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('coupon');?>">
        <div class="list_in">
            我的优惠券
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('prepaid');?>">
        <div class="list_in">
            我的储值卡
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('safety');?>">
        <div class="list_in">
            安全中心
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
    <a href="<?php echo U('notice');?>">
        <div class="list_in">
            售后说明
            <div class="jump"><img src="/Public/Mobile/Images/fhy2.jpg" height="24" width="13" alt="" /></div>
        </div>
    </a>
</div>
<!-- 版权 -->

      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 

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
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    $('#qrcode ,#qrcode_one').on('click',function(){
        Core.Layout({ 'text':'<p>推荐好友,您和好友各得190元红包</p><img src="<?php echo ($qrcode); ?>" style="height:300px;width:300px;"><span id="display">活动规则 >></span><div>1. 推荐好友注册好友即可获得红包<br />２.推荐好友注册同时自己也可获得红包<br />３.推荐的好友已在商城注册的不参与本活动<br />４.本活动最终解释权归整体美社交商城所有</div>' });
        $('#display').on('click',function(){
            $('.core-layer .content div').show();
        })
    });

    wx.config({
        debug:false,
        appId:"<?php echo ($signPackage['appid']); ?>",
        timestamp:"<?php echo ($signPackage['timestamp']); ?>",
        nonceStr:"<?php echo ($signPackage['noncestr']); ?>",
        signature:"<?php echo ($signPackage['signature']); ?>",
        jsApiList:[
            'onMenuShareAppMessage',
            'onMenuShareTimeline',
        ]
    });

    wx.ready(function() {
        var _title = '分享就能赚钱.整体美商城',
                _desc = '整体美解决方案领导者',
                _link = "<?php echo U('Index/index','u='.session('user_id'),'html',true);?>",
                _imgUrl = "http://<?php echo ($_SERVER['HTTP_HOST']); echo ($qrcode); ?>";
        //发送给朋友
        wx.onMenuShareAppMessage({
            title:_title,
            desc:_desc,
            link:_link,
            imgUrl:_imgUrl,
            type:'link',
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //分享到朋友圈
        wx.onMenuShareTimeline({
            title:_title,
            link:_link,
            imgUrl:_imgUrl,
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?0f0b15bb49fcf471ea731895570e125c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>