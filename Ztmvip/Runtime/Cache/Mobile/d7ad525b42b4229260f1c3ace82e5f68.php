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
    
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/index_mobile.css" media="(max-width:750px)" />
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/index_pad.css" media="(min-width:750px)">
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/swiper.css" />
<style type="text/css">
    .swiper-lazy-preloader{height:200px;}
</style>
<script type="text/javascript" src="/Public/Mobile/Js/swiper.jquery.min.js"></script>

<script type="text/javascript">

$(function(){
    var u = navigator.userAgent, app = navigator.appVersion;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid==true){
        $('.search').on('focus',function(event) {
            $('.nav_box').css('display','none');
        });
        $('.search').on('blur',function(event) {
            $('.nav_box').css('display','block');
        })
    }else if(isiOS==true){
        $('.search').on('focus',function(event) {
            $('.search_box').css('position','absolute');
        });
        $('.search').on('blur',function(event) {
            $('.search_box').css('position','fixed');
        })
    }
})  
</script>
<!-- 搜索框开始 -->
<div class="search_box">
    <input type="text" name="search" class="search" required="required" placeholder="搜索商品和品牌" />
    <button class="search_button"><img src="/Public/Mobile/Images/classify_03.png" alt="" /></button>
</div>
<!-- 搜索框结束 -->
<!-- 焦点图开始 -->
<div class="swiper-container" id="swiper1">
    <div class="swiper-wrapper">
        <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                <a href="<?php echo ($vo['link']); ?>"><img class="swiper-lazy" data-src="<?php echo ($vo['image']); ?>" alt="" /></a>
                <div class="swiper-lazy-preloader"></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="swiper-pagination" id="swipwe_pag1"></div>
</div>
<script>
    var swiper = new Swiper('#swiper1', {
        pagination: '#swipwe_pag1',
        slidesPerView: 1,
        paginationClickable: true,
        watchSlidesVisibility:true,
        spaceBetween: 0,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
        loop: true,
        preloadImages: false,
        lazyLoading: true

    });
</script>
<!-- 焦点图结束 -->
<!-- 分类开始 -->
<div class="classify_box" style="margin-top:5px;">
    <a href="<?php echo U('Index/secondSkillGoods');?>">
        <div class="classify">
            <div class="classify_in"><img src="/Public/Mobile/Images/classify01.gif" alt="" /></div>
            <div class="classify_text">秒杀专区</div>
        </div>
    </a>
    <a href="<?php echo U('Index/newGoodsList');?>">
        <div class="classify">
            <div class="classify_in"><img src="/Public/Mobile/Images/classify02.gif" alt="" /></div>
            <div class="classify_text">新品首发</div>
        </div>
    </a>
    <a href="<?php echo U('Index/specialBuy');?>">
        <div class="classify">
            <div class="classify_in"><img src="/Public/Mobile/Images/classify03.gif" alt="" /></div>
            <div class="classify_text">特卖专场</div>
        </div>
    </a>
    <a href="<?php echo U('Health/special');?>">
        <div class="classify">
            <div class="classify_in"><img src="/Public/Mobile/Images/classify04.gif" alt="" /></div>
            <div class="classify_text">贵宾尊享</div>
        </div>
    </a>
</div>
<!-- 分类结束 -->



<!-- 健康减重卡 -->
<a href="<?php echo U('Health/special');?>"><img style=" position: relative;left:0px;top:8px;" src="/Public/Mobile/Images/special_ztmvip_a.jpg"></a>





<?php if(!empty($threekill)): ?><!-- 倒数计时开始 -->
<div class="colockbox" id="demo02">
    <span class="num hour">00</span>
    <span class="symbol">：</span>
    <span class="num minute">00</span>
    <span class="symbol">：</span>
    <span class="num second">00</span>
</div>
<script type="text/javascript">
    $(function(){
        // countDown("2015/10/13 23:59:59","#demo01 .day","#demo01 .hour","#demo01 .minute","#demo01 .second");
        countDown("<?php echo ($date); ?>",null,"#demo02 .hour","#demo02 .minute","#demo02 .second");
    });

    function countDown(time,day_elem,hour_elem,minute_elem,second_elem){
        //if(typeof end_time == "string")
        var end_time = new Date(time).getTime(),//月份是实际月份-1
        //current_time = new Date().getTime(),
                sys_second = (end_time-new Date().getTime())/1000;
        var timer = setInterval(function(){
            if (sys_second > 1) {
                sys_second -= 1;
                var day = Math.floor((sys_second / 3600) / 24);
                var hour = Math.floor((sys_second / 3600) % 24);
                var minute = Math.floor((sys_second / 60) % 60);
                var second = Math.floor(sys_second % 60);
                day_elem && $(day_elem).text(day);//计算天
                $(hour_elem).text(hour<10?"0"+hour:hour);//计算小时
                $(minute_elem).text(minute<10?"0"+minute:minute);//计算分
                $(second_elem).text(second<10?"0"+second:second);// 计算秒
            } else {
                clearInterval(timer);
                alert('shanbumin');
                $(hour_elem).text("00");//计算小时
                $(minute_elem).text("00");//计算分
                $(second_elem).text("00");
            }
        }, 1000);
    }
</script>
<!-- 倒数计时结束 -->
<!-- 秒杀产品开始 -->

    <div class="seckill_box">
     <?php if(is_array($threekill)): $i = 0; $__LIST__ = $threekill;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="seckill_in">
            <a href="<?php echo U('Goods/detail',array('goods_id'=>$value['goods_id']),'');?>">
                <div class="seckill"><img src="<?php echo ($value["goods_thumb"]); ?>" alt="" /></div>
                <div class="seckill_inf">
                    <div class="price">￥<em>
                         <?php echo (intval($value["kill_price"])); ?>
                    </em>.00</div>
                    <div class="inf">
                          <?php echo (subtext($value["goods_name"],14)); ?>
                   </div>
                </div>
            </a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>
<!-- 秒杀产品结束 -->
<!-- 潮流趋势开始 -->
<div class="title">
    <em>潮流趋势</em>
    <span class="left"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
    <span class="right"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
</div>
<div class="swiper-container" id="swiper2">
    <div class="swiper-wrapper">
		<?php if(is_array($fashion)): $i = 0; $__LIST__ = $fashion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                <a href="<?php echo ($vo['link']); ?>?fashion=<?php echo ($vo["id"]); ?>">
                    <div class="article_box">
                        <img src="<?php echo ($vo['image']); ?>"  alt="<?php echo ($vo['title']); ?>" />
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script>
var swiper = new Swiper('#swiper2', {
    slidesPerView: "auto",
    freeMode : true,
    paginationClickable: true,
    spaceBetween: 4
});
</script>
<!-- 潮流趋势结束 -->
<!-- 女装馆开始 -->
<div class="title2">
    <em>女装馆</em>
    <span class="left"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
    <span class="right"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
</div>
<div class="comm_box">
    <div class="comm_top">
        <!-- 大牌原创 -->
        <div class="comm_left">

            <!--<a href="<?php echo U('Index/catGoodsList',array('cat_id'=>711));?>">-->
            <a href="<?php echo U('Index/brandPavilion');?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm1.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
        <div class="comm_right">
            <!-- 裙装 -->
            <div class="comm_right_top">
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm2.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
                </a>
            </div>
            <!-- 裤装 -->
            <div class="comm_right_bottom">
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm3.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="comm_bottom">
        <!-- 大衣 -->
        <div class="comm">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>734));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm4.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
        <!-- 打底 -->
        <div class="comm">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm5.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
        <!-- 衬衫 -->
        <div class="comm">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1149));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm6.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
    </div>
</div>
<!-- 女装馆结束 -->
<!-- 鞋包配饰馆开始 -->
<div class="title3">
    <em>鞋包配饰馆</em>
    <span class="left"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
    <span class="right"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
</div>
<div class="acc_banner">
    <a href="javascript:;">
        <img src="/Public/Mobile/Images/banner2.jpg" alt="" />
    </a>
</div>
<div class="acc_box">
    <!-- 鞋子 -->
    <div class="acc">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1170));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm7.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
        </a>
    </div>
    <!-- 包包 -->
    <div class="acc">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm8.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
        </a>
    </div>
    <!-- 围巾 -->
    <div class="acc">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm9.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
        </a>
    </div>
    <!-- 配饰 -->
    <div class="acc">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1178));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm10.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
        </a>
    </div>
</div>
<!-- 鞋包配饰馆结束 -->
<!-- 美妆馆开始 -->
<div class="title2">
    <em>美妆馆</em>
    <span class="left"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
    <span class="right"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
</div>
<div class="acc_banner">
    <a href="javascript:;">
        <img src="/Public/Mobile/Images/banner3.jpg" alt="" />
    </a>
</div>
<div class="makeup_box">
    <!-- 香氛 -->
    <div class="makeup_left">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">
            <img  class="lazy" data-original="/Public/Mobile/Images/comm11.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
        </a>
    </div>
    <div class="makeup_right">
        <!-- 美妆 -->
        <div class="makeup" style="margin-bottom:3%">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>425));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm12.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
        <!-- 美妆工具 -->
        <div class="makeup">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>453));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm13.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
    </div>
</div>
<!-- 美妆馆结束 -->
<!-- 养生馆开始 -->
<div class="title2">
    <em>养生馆</em>
    <span class="left"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
    <span class="right"><img src="/Public/Mobile/Images/line.gif" alt="" /></span>
</div>
<div class="upkeep_box">
    <div class="upkeep_top">
        <div class="upkeep_left">
            <div class="upkeep" style="margin-bottom:3%">
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm14.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
                </a>
            </div>
            <div class="upkeep">
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm15.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
                </a>
            </div>
        </div>
        <div class="upkeep_right">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1050));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm16.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
    </div>
    <div class="upkeep_bottom">
        <div class="upkeep">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm17.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
        <div class="upkeep">
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">
                <img  class="lazy" data-original="/Public/Mobile/Images/comm18.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </a>
        </div>
    </div>
</div>
<!-- 养生馆结束 -->




<!-- 延时加载 -->
<script type="text/javascript" src="/Public/Mobile/Js//jquery.lazyload.min.js"></script>
<script type="text/javascript">
        $(function() {
          $("img.lazy").lazyload({'threshold':400});
        });
</script>



      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 

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

<script>
$(function(){
	$('.search_button').click(function(){
		var word = $(this).prev('input').val();
		if(word==''){
			return;
		}
		window.location.href = "/Category/catDetail/word/"+word;
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