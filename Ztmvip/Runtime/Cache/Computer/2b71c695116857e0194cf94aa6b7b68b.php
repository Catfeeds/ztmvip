<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($page_title); echo ($sitename); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/core.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/base.css" />
    <script type="text/javascript" src="/Public/Computer/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Common/Js/common.js"></script>
    <script type="text/javascript" src="/Public/Computer/Js/shan_common.js"></script>







<link rel="stylesheet" type="text/css" href="/Public/Computer/Css/index.css" />
</head>
<body>
<div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="<?php echo U('Cart/cart');?>">购物车<span>(<?php if($Think.session.cnumber): ?><span id="shan_cnumber"><?php echo (session('cnumber')); else: ?>0<?php endif; ?></span>)</span></a></li>
        <?php if($user_info): ?><li class="li2"><i></i><a href="<?php echo U('User/order');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/logout');?>">退出</a></li>
            <li class="li4"><i></i><a href="<?php echo U('User/order');?>"><?php echo ($user_info["user_name"]); ?></a></li>
            <?php else: ?>
            <li class="li2"><i></i><a href="<?php echo U('Login/index');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/index');?>">登录</a></li>
            <li class="li4"><i></i><a href="<?php echo U('Register/index');?>">注册</a></li><?php endif; ?>
        <li class="li5">欢迎光临整体美</li>
    </ul>
</div>
<div class="index_top">
    <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Public/Computer/Images/index_logo.png" alt="" /></a></div>
    <div class="search">
        <div id="add">
            <form action="<?php echo U('Search/index');?>">
                <input type="text" name="word" value="<?php echo ($_GET['word']); ?>" maxlength="20" />
                <button type="submit"></button>
            </form>
        </div>
     
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
  
    </div>
    <!-- <div class="weixin"><img src="/Public/Computer/Images/index_02_10.jpg" /></div> -->
    <div class="weixin">
        <p>整体美微信</p>
        <img src="/Public/Computer/Images/gif128_03.gif" />
    </div>
    <ul class="nav">
        <li class="li1"><a href="">全部商品</a>
        <ul>

        <!-- #################### 壹 ############################# -->
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a>
                    </dd>

                    <dl class="nav2">
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a></dt>
                        <dd>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1149));?>">寸衫</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1161));?>">T恤</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1162));?>">毛织</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1188));?>">打底衫</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1158));?>">短裤</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1159));?>">长裤</a>
                        </dd>

                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a></dt>
                        <dd>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1155));?>">连衣裙</a>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1156));?>">半身裙</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1007));?>">休闲包</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1168));?>">时装包</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1176));?>">丝巾</a>
                        </dd>
                    </dl>
                </dl>
            </li>
<!-- ################# 贰 ######################################### -->
<li>
    <dl class="nav1">
        <dt>容颜美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>425));?>">美妆</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">美妆</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>448));?>">底妆</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>450));?>">眼部</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>449));?>">腮红</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>451));?>">唇部</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>421));?>">面部</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1193));?>">身体</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>447));?>">香水</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################## 叁 ####################### -->
<li>
    <dl class="nav1">
        <dt>健康美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>876));?>">葡萄酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>877));?>">起泡酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>878));?>">水</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1192));?>">啤酒</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>923));?>">油</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>924));?>">调味</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>925));?>">五谷杂粮</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1090));?>">维生素</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1106));?>">蛋白质</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1135));?>">鱼油磷脂</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1136));?>">葡萄籽</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1137));?>">酵素</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>935));?>">饼干</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1138));?>">糖</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1194));?>">巧克力</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1195));?>">休闲小吃</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- #################### 肆  #################################     -->
<li>
    <dl class="nav1">
        <dt>心灵美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1183));?>">励志</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1184));?>">旅游</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1132));?>">育儿</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a></dt>
            <dd>
            </dd>

        </dl>
    </dl>
</li>

<!-- ################################################# -->
         
        </ul>
        </li>
        <li ><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li ><a href="<?php echo U('Index/newGoodsList');?>">新品首发</a></li>
        <li ><a href="<?php echo U('Index/specialBuy');?>">特卖专场</a></li>
        <li ><a href="<?php echo U('Health/special');?>">贵宾尊享</a></li>
    </ul>
</div>



<script type="text/javascript">
        var html1=$('#add').html();
        $(window).on('scroll',function(){
            var h_top=$(window).scrollTop()+46;
            var add1="<div class='pos_search'><div class='container'><div class='logo1'><img src='/Public/Computer/Images//index20151218_03.png' alt='' /></div>";
            var add2="</div></div>";
            if(110<h_top){
                if($('#add').hasClass('add')){
                }else{
                    var html2=add1+html1+add2;
                    $('#add').html(html2);
                }
                $('#add').addClass('add');
            }else{
                $('#add').html(html1);
                $('#add').removeClass('add');
            }
        });
</script>

<!-- logo直到导航  结束 -->
<!-- banner轮播 -->
<div class="index_banner">
<div class="container">
    <div class="but">
        <div class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></div>
        <div class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></div>
    </div>
    <ul>
        <li><img  src="/Public/Computer/Images/index_02.jpg" alt="" /></li>
        <li><img  src="/Public/Computer/Images/index_02.jpg" alt="" /></li>
        <li><img  src="/Public/Computer/Images/index_02.jpg" alt="" /></li>
        <li><img  src="/Public/Computer/Images/index_02.jpg" alt="" /></li>
    </ul>
</div>
</div>
<!-- banner轮播 -->
<!-- 圆圈导航 -->
<ul class="index_nav3">
<li class="li1">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_03.jpg" alt="" /></a>
    <p><a href="javascript:;">需求选择</a></p>
</li>
<li class="li2">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_05.jpg" alt="" /></a>
    <p><a href="javascript:;">量身定制</a></p>
</li>
<li class="li3">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_07.jpg" alt="" /></a>
    <p><a href="javascript:;">选择顾问</a></p>
</li>
<li class="li4">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_09.jpg" alt="" /></a>
    <p><a href="javascript:;">解决方案</a></p>
</li>
<li class="li5">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_11.jpg" alt="" /></a>
    <p><a href="javascript:;">产品选购</a></p>
</li>
<li class="li6">
    <i class="hover"></i>
    <a href="javascript:;"><img src="/Public/Computer/Images/index_nav_13.jpg" alt="" /></a>
    <p><a href="javascript:;">跟踪服务</a></p>
</li>
</ul>
<div class="index_title_hr">
<h1>健康减重方案</h1>
</div>
<!-- 减重方案 -->
<div class="weight">
<div class="left"><a href="<?php echo U('Health/special');?>"><img src="/Public/Computer/Images/index_weight_03.jpg" alt="" /></a></div>
<ul class="right">
    <?php if(is_array($health_goods)): $i = 0; $__LIST__ = $health_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="li<?php echo ($i); ?>">
        <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="" /></a>
        <p class="p1"><a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><?php echo ($vo["goods_name"]); ?></a></p>
        <p class="p2">
        <span class="span1">￥<?php echo ($vo["shop_price"]); ?></span>
        <span class="span2">￥<?php echo ($vo["market_price"]); ?></span>
        </p>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<div class="index_title_hr">
<h1>热点分享</h1>
</div>
<div class="hot">
<div class="left"><a href=""><img src="/Public/Computer/Images/index_hot_03.jpg" alt="" /></a></div>
<ul class="min_hot">
    <li class="li1"><a href=""><img src="/Public/Computer/Images/index_hot_05.jpg" alt="" /></a></li>
    <li class="li2"><a href=""><img src="/Public/Computer/Images/index_hot_07.jpg" alt="" /></a></li>
    <li class="li3"><a href=""><img src="/Public/Computer/Images/index_hot_15.jpg" alt="" /></a></li>
    <li class="li4"><a href=""><img src="/Public/Computer/Images/index_hot_17.jpg" alt="" /></a></li>
</ul>
<ul class="right">
    <li class="title"><span><i>热点推荐</i></span></li>
    <?php if(is_array($hot_share_right)): $i = 0; $__LIST__ = $hot_share_right;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="hover"<?php elseif($i == 9): ?>class="li9"<?php endif; ?>>
        <p><a href=""><?php echo ($i); ?>.<?php echo ($vo["title"]); ?></a></p>
        <img src="<?php echo ($vo["article_thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>" />
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<!-- 潮流趋势 -->

<div class="index_title_hr" id="fashion">
<h1>潮流趋势</h1>
</div>
<div class="trend">
<div class="left">
    <div class="img1">
        <a href="<?php echo ($fashion_left[0]['link']); ?>?fashion=<?php echo ($fashion_left[0]['id']); ?>"><img src="<?php echo ($fashion_left[0]['hd_image']); ?>" alt="<?php echo ($fashion_left[0]['title']); ?>" /></a>
    </div>
    <div class="img2">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>"><img src=" /Public/Computer/Images/index_16.jpg" alt="" /></a>
    </div>
</div>
<div class="left">
    <div class="img1">
        <a href="<?php echo ($fashion_left[1]['link']); ?>?fashion=<?php echo ($fashion_left[1]['id']); ?>"><img src="<?php echo ($fashion_left[1]['hd_image']); ?>" alt="<?php echo ($fashion_left[1]['title']); ?>" /></a>
    </div>
    <div class="img2">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>935));?>"><img src=" /Public/Computer/Images/index_18.jpg" alt="" /></a>
    </div>
</div>
<div class="left">
    <div class="img1">
        <a href="<?php echo ($fashion_left[2]['link']); ?>?fashion=<?php echo ($fashion_left[2]['id']); ?>"><img src="<?php echo ($fashion_left[2]['hd_image']); ?>" alt="<?php echo ($fashion_left[2]['title']); ?>" /></a>
    </div>
    <div class="img2">
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>"><img src=" /Public/Computer/Images/index_20.jpg" alt="" /></a>
    </div>
</div>
<div class="right">
    <li class="title"><span><i>热门资讯</i></span></li>
    <?php if(is_array($fashion_right)): $i = 0; $__LIST__ = $fashion_right;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="hover"<?php elseif($i == 9): ?>class="li9"<?php endif; ?>>
        <p><a href=""><?php echo ($i); ?>.<?php echo ($vo["title"]); ?></a></p>
        <img src="<?php echo ($vo["article_thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>" />
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
<!-- 潮流趋势结束 -->
<!-- 品牌馆 -->
<div class="index_title_hr">
<h1>品牌馆</h1>
</div>
<div class="brand">
<ul class="left">
    <li class="li1"><a href=""><img src="/Public/Computer/Images/index_pp_08.jpg" alt="" /></a></li>
    <li class="li2">
        <dl id="brand_banner">
            <dd>
            <a href=""><img src="/Public/Computer/Images/index_pp_13.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_15.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_21.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_22.jpg" alt="" /></a>
            </dd>
            <dd>
            <a href=""><img src="/Public/Computer/Images/index_pp_25.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_26.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_29.jpg" alt="" /></a>
            <a href=""><img src="/Public/Computer/Images/index_pp_30.jpg" alt="" /></a>
            </dd>
        </dl>
    </li>
    <script type="text/javascript">
            function brand_banner(){
                var ind_dd=$('#brand_banner dd').length;
                var dl_w=ind_dd*112;
                $('#brand_banner').css('width',dl_w);
                var dl_left=$('#brand_banner').css('left');
                dl_left=parseInt(dl_left)-112;
                $('#brand_banner').animate({'left':dl_left}, 800);
                var min=224-dl_w;
                if(dl_left<=224-dl_w){
                    $('#brand_banner').animate({'left':"0px"}, 0);
                }
            };
            function he_brand(){
            var ind_dd=$('#brand_banner dd').length;
            if(ind_dd<2){
                return true;
            }
            $('#brand_banner').append($('#brand_banner dd:eq(0)').clone());
            $('#brand_banner').append($('#brand_banner dd:eq(1)').clone());
            setInterval(function(){
                brand_banner();
            },3000)
            }
            he_brand();
    </script>

    <!--    <li class="li2"><a href=""><img src="/Public/Computer/Images/index_pp_13.jpg" alt="" /></a></li>
            <li class="li3"><a href=""><img src="/Public/Computer/Images/index_pp_15.jpg" alt="" /></a></li>
            <li class="li4"><a href=""><img src="/Public/Computer/Images/index_pp_21.jpg" alt="" /></a></li>
            <li class="li5"><a href=""><img src="/Public/Computer/Images/index_pp_22.jpg" alt="" /></a></li>
            <li class="li6"><a href=""><img src="/Public/Computer/Images/index_pp_25.jpg" alt="" /></a></li>
            <li class="li7"><a href=""><img src="/Public/Computer/Images/index_pp_26.jpg" alt="" /></a></li>
            <li class="li8"><a href=""><img src="/Public/Computer/Images/index_pp_29.jpg" alt="" /></a></li>
            <li class="li9"><a href=""><img src="/Public/Computer/Images/index_pp_30.jpg" alt="" /></a></li> -->
</ul>
<ul class="right">
    <li class="li1"><a href=""><img src="/Public/Computer/Images/index_pp_03.jpg" alt="" /></a></li>
    <li class="li2"><a href=""><img src="/Public/Computer/Images/index_pp_05.jpg" alt="" /></a></li>
    <li class="li3"><a href="<?php echo U('Index/brandGoodsList',array('brand_id'=>184));?>"><img src="/Public/Computer/Images/index_pp_17.jpg" alt="" /></a></li>
    <li class="li4"><a href=""><img src="/Public/Computer/Images/index_pp_19.jpg" alt="" /></a></li>
</ul>
</div>
<!-- 品牌馆单品推荐轮播 -->
<div class="banner-container js-trend" id="js-trend">
<ul>
    <?php if(is_array($brand_best)): $i = 0; $__LIST__ = $brand_best;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" /></a>
            <div>
                <a href="">
                    <p class="p1"><?php echo ($vo["goods_name"]); ?></p>
                    <p class="p2">￥<?php echo ((isset($vo["shop_price"]) && ($vo["shop_price"] !== ""))?($vo["shop_price"]):0.00); ?></p>
                </a>
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<span class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></span>
<span class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>
<!-- 品牌馆单品推荐轮播结束 -->
<!-- 女装馆 -->
<div class="index_title_hr">
<h1>女装馆</h1>
</div>
<p class="index_title_hr_a"><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a></p>
<ul class="suit-dress">
<!-- <li class="li1"><a href=""><img src="/Public/Computer/Images/index_031.jpg" alt="" /></a></li> -->
<li class="li2"><a href=""><img src="/Public/Computer/Images/index_0443.jpg" alt="" /></a></li>
<li class="li3">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>"><img src="/Public/Computer/Images/index_08.jpg" alt=""  /></a>
    <p>裙装</p>
</li>
<li class="li4">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>"><img src="/Public/Computer/Images/index_101.jpg" alt="" /></a>
    <p>裤装</p>
</li>
<li class="li5">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1188));?>"><img src="/Public/Computer/Images/index_21.jpg" alt=""  /></a>
    <p>打底类</p>
</li>
<li class="li6">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1149));?>"><img src="/Public/Computer/Images/index_22.jpg" alt=""  /></a>
    <p>衬衫</p>
</li>
</ul>
<!-- 女装馆结束 -->
<!-- 女装馆单品推荐轮播 -->
<div class="banner-container js-suit-dress">
<ul>
    <?php if(is_array($women_clothing_best)): $i = 0; $__LIST__ = $women_clothing_best;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" /></a>
            <div>
                <a href="">
                    <p class="p1"><?php echo ($vo["goods_name"]); ?></p>
                    <p class="p2">￥<?php echo ((isset($vo["shop_price"]) && ($vo["shop_price"] !== ""))?($vo["shop_price"]):0.00); ?></p>
                </a>
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<span class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></span>
<span class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>
<!-- 女装馆单品推荐轮播结束 -->
<!-- 娘们的鞋包配饰馆 -->
<div class="index_title_hr">
<h1>鞋包配饰馆</h1>
</div>
<p class="index_title_hr_a"><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1178));?>">配饰</a></p>
<div class="accessories ">
<ul class="left">
    <li class="li1"><a href=""><img src="/Public/Computer/Images/index_accessories_03.jpg" alt="" /></a></li>
    <li class="li2"><a href=""><img src="/Public/Computer/Images/index_accessories_16.jpg" alt="" /></a></li>
    <li class="li3"><a href=""><img src="/Public/Computer/Images/index_accessories_18.jpg" alt="" /></a></li>
</ul>
<div class="center">
    <a href=""><img src="/Public/Computer/Images/index_accessories_05.jpg" alt="" /></a>
</div>
<ul class="right">
    <li >
        <a href=""><img src="/Public/Computer/Images/index_accessories_08.jpg" alt="" /></a>
        <p class="p1">色非女鞋</p>
        <p class="p2">￥345.00 <span>[5.8折]</span></p>
        <p class="p3"><img src="/Public/Computer/Images/index_28.jpg" alt="" />03天19小时00分48秒</p>
    </li>
    <li >
        <a href=""><img src="/Public/Computer/Images/index_accessories_14.jpg" alt="" /></a>
        <p class="p1">色非女鞋</p>
        <p class="p2">￥345.00 <span>[5.8折]</span></p>
        <p class="p3"><img src="/Public/Computer/Images/index_28.jpg" alt="" />03天19小时00分48秒</p>
    </li>
</ul>
</div>
<!-- 娘们的鞋包配饰馆结束 -->
<!-- 娘们的鞋包单品推荐轮播 -->
<div class="banner-container js-accessories">
<ul>
    <?php if(is_array($shoe_bag_best)): $i = 0; $__LIST__ = $shoe_bag_best;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" /></a>
            <div>
                <a href="">
                    <p class="p1"><?php echo ($vo["goods_name"]); ?></p>
                    <p class="p2">￥<?php echo ((isset($vo["shop_price"]) && ($vo["shop_price"] !== ""))?($vo["shop_price"]):0.00); ?></p>
                </a>
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<span class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></span>
<span class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>
<!-- 娘们的鞋包单品推荐轮播结束 -->
<!-- 美妆馆 -->
<div class="index_title_hr">
<h1>美妆馆</h1>
</div>
<p class="index_title_hr_a"><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>425));?>">美妆</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a></p>
<ul class="beautiful">
<li class="li1"><a href="javasript:;"><img src="/Public/Computer/Images/index_031.jpg" alt="" /></a></li>
<li class="li2">
    <div class="img1">
        <a href="javasript:;"><img src="/Public/Computer/Images/index_33.jpg" alt="" /></a>
    </div>
    <div class="img2">
        <a href="javasript:;"><img src="/Public/Computer/Images/index_33.jpg" alt="" /></a>
    </div>
</li>
<li class="li3">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>448));?>"><img src="/Public/Computer/Images/in_nav1.jpg" alt=""  /></a>
    <p>底妆</p>
</li>
<li class="li4">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>449));?>"><img src="/Public/Computer/Images/in_nav2.jpg" alt="" /></a>
    <p>腮红</p>
</li>
<li class="li5">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>450));?>"><img src="/Public/Computer/Images/in_nav3.jpg" alt=""  /></a>
    <p>眼部</p>
</li>
<li class="li6">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>451));?>"><img src="/Public/Computer/Images/in_nav4.jpg" alt=""  /></a>
    <p>唇部</p>
</li>
</ul>
<!-- 美妆馆结束 -->
<!-- 美妆馆单品推荐轮播 -->
<div class="banner-container js-beautiful">
<ul>
    <?php if(is_array($beauty_makeup_best)): $i = 0; $__LIST__ = $beauty_makeup_best;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" /></a>
            <div>
                <a href="">
                    <p class="p1"><?php echo ($vo["goods_name"]); ?></p>
                    <p class="p2">￥<?php echo ((isset($vo["shop_price"]) && ($vo["shop_price"] !== ""))?($vo["shop_price"]):0.00); ?></p>
                </a>
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<span class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></span>
<span class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>
<!-- 美妆馆单品推荐轮播结束 -->
<!-- 养生馆 -->
<div class="index_title_hr">
<h1>养生馆</h1>
</div>
<p class="index_title_hr_a"><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a></p>
<ul class="rest">
<li class="li1">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1050));?>"><img src="/Public/Computer/Images/index_066.jpg" alt="" /></a>
    <p>家居生活</p>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1199));?>"><img src="/Public/Computer/Images/index_0666.jpg" alt="" /></a>
    <p>日化洗涤</p>
</li>
<li class="li2">
    <a href="javascript:;"><img src="/Public/Computer/Images/index_034.jpg" alt="" /></a>
</li>
<li class="li3">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>"><img src="/Public/Computer/Images/in_nav5.jpg" alt=""  /></a>
    <p>中外名酒</p>
</li>
<li class="li4">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>"><img src="/Public/Computer/Images/in_nav6.jpg" alt="" /></a>
    <p>粮油调味</p>
</li>
<li class="li5">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>"><img src="/Public/Computer/Images/in_nav7.jpg" alt=""  /></a>
    <p>休闲零食</p>
</li>
<li class="li6">
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>"><img src="/Public/Computer/Images/in_nav8.jpg" alt=""  /></a>
    <p>保健品</p>
</li>
</ul>
<!-- 养生馆结束 -->
<!-- 养生馆单品推荐轮播 -->
<div class="banner-container js-rest">
<ul>
    <?php if(is_array($good_health_best)): $i = 0; $__LIST__ = $good_health_best;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
        <a href="<?php echo U('Goods/detail',array('goods_id'=>$vo['id']));?>"><img src="<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" /></a>
        <div>
            <a href="">
            <p class="p1"><?php echo ($vo["goods_name"]); ?></p>
            <p class="p2">￥<?php echo ((isset($vo["shop_price"]) && ($vo["shop_price"] !== ""))?($vo["shop_price"]):0.00); ?></p>
            </a>
        </div>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<span class="left"><img src="/Public/Computer/Images/index_03.png" alt="" /></span>
<span class="right"><img src="/Public/Computer/Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>
<!-- 养生馆单品推荐轮播结束 -->
<div class="top46"></div>
<?php if(!in_array(CONTROLLER_NAME,array('Login','Register'))): ?><a name="maodian"></a>
<!-- 侧边栏 -->
<div class="index_right_nav">
    <div class="personal_nav">
        <ul>
            <li class="li1">
                <div class="denglu">
                    <?php if($user_info): ?><p class="p1">您好！<?php echo ($user_info["user_name"]); ?></p>
                        <a target="_blank" href="<?php echo U('User/order');?>" class="a3">我的订单</a>
                        <?php else: ?>
                        <p class="p1">您好！请 <a target="_blank" href="<?php echo U('Login/index');?>">登录</a><span></span><a target="_blank" href="<?php echo U('Register/index');?>">注册</a></p>
                        <a target="_blank" href="<?php echo U('Login/index');?>" class="a3">我的订单</a><?php endif; ?>
                </div>
                <input type="hidden" name="islogin" value="<?php echo ($islogin); ?>"/>
            </li>
            <li class="li2"><div class="hover">返利中心</div></li>
            <li class="li3"><div class="hover">余额</div></li>
            <li class="li4"><div class="hover">红包</div></li>
            <li class="li5"><div class="hover">优惠券</div></li>
            <li class="li6"><div class="hover">储值卡</div></li>
            <li class="li7"><div class="hover">我的收藏</div></li>
            <li class="li8"><div class="hover">购物车</div><span><?php if($Think.session.cnumber): echo (session('cnumber')); else: ?>0<?php endif; ?></span></li>
            <li class="li9"> <a href="#maodian" class="maodian"></a></li>
        </ul>
    </div>
    <div class="right">
        <!-- 返利中心 -->
        <div class=" rebate">
        </div>
        <!-- 返利中心结束 -->
        <!-- 我的余额 -->
        <div class="recharge" style="display:none;">
        </div>
        <!-- 我的余额结束 -->
        <!-- 红包 -->
        <div class="hongbao js_hongbao_display"  style="display:none;">
        </div>
        <!-- 红包结束 -->
        <!-- 我的优惠券 每个分类又有三个卡片样式 -->
        <div class="hongbao js_coupon"  style="display:none;">
        </div>
        <!-- 我的优惠券结束 -->
        <!-- 储值卡 -->
        <div class="save" style="display:none;" >
        </div>
        <!-- 储值卡结束 -->
        <!-- 我的收藏 -->
        <div class="collect" style="display:none;">
        </div>
        <!-- 收藏结束 -->
        <!-- 我的购物车 -->
        <div class="trade" style="display:none;">
        </div>
        <!-- 我的购物车结束 -->
    </div>
</div>
<!-- 侧边栏结束 --><?php endif; ?>

<div class="index_footer">
    <div class="footer1">
        <ul class="container">
            <li><a href=""><div class="img1"></div>100%正品</a></li>
            <li><a href=""><div class="img2"></div>7天放心退</a></li>
            <li><a href=""><div class="img3"></div>分享就赚钱</a></li>
            <li><a href=""><div class="img4"></div>买贵返差额</a></li>
        </ul>

    </div>
    <div class="footer2">

        <dl class="dl1">
            <dd>客服电话:400-777-1225</dd>
            <dd>ICP备案号：沪ICP备15011936号</dd>
            <dd>COPYRIGHT©整体美商城</dd>
        </dl>

        <dl>
            <dt>公司</dt>
            <dd><a href="">关于我们</a></dd>
            <dd><a href="">加盟合作</a></dd>
            <dd><a href="">联系我们</a></dd>
        </dl>
        <dl>
            <dt>消费者</dt>
            <dd><a href="">帮助中心</a></dd>
            <dd><a href="">意见反馈</a></dd>
        </dl>
        <dl>
            <dt>售后服务</dt>
            <dd><a href="">售后说明</a></dd>
            <dd><a href="">售后质询</a></dd>
        </dl>
        <dl>
            <dt>安全中心</dt>
            <dd><a href="">绑定手机</a></dd>
            <dd><a href="">绑定银行卡</a></dd>
            <dd><a href="">设置支付密码</a></dd>
            <dd><a href="">设置安全问题</a></dd>
            <dd><a href="">忘记密码</a></dd>
        </dl>

        <div class="weixin">
            <div class="weixin_fenxiang">
                <img src="/Public/Computer/Images/weixin.png" alt="" />
                <p>关注注册送红包，分享购买返佣金！</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Computer/Js//index.js"></script>
<script type="text/javascript" src="/Public/Computer/Js//lhf_index.js"></script>
</body>
</html>