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







 <link rel="stylesheet" type="text/css" href="/Public/Computer/Css//goods_list.css" />
 <script type="text/javascript" src="/Public/Computer/Js/shan_search.js"></script>
   <style type="text/css">
    .index_top .nav li.li1 ul{ background:#bfbfbf;}
  </style>
  </head>
  <body>


<div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="">购物车<span>(<?php if($Think.session.cnumber): ?><span id="shan_cnumber"><?php echo (session('cnumber')); else: ?>0<?php endif; ?></span>)</span></a></li>
        <?php if($user_info): ?><li class="li2"><i></i><a href="<?php echo U('User/order');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/logout');?>">退出</a></li>
            <li class="li4"><i></i><a href=""><?php echo ($user_info["user_name"]); ?></a></li>
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
            <form action="<?php echo U('Search/indexSearch');?>">
                <input type="text" name="word" value="<?php echo ($choose["word"]); ?>" />
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
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
                    </dd>

                    <dl class="nav2">
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
                        <dd>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                        </dd>

                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
                        <dd>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
                        </dd>
                    </dl>
                </dl>
            </li>
<!-- ################# 贰 ######################################### -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################## 叁 ####################### -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- #################### 肆  #################################     -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
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






<div class="goods_deta_bg">
<!--     <p class="gps"><a href="">首页</a> > <a href="">形象美</a> > 羊毛围巾</p> -->
    <div style="height:15px;"></div>
    <div class="goods_li">
     <!--    <h2>羊毛围巾</h2> -->
     <div style="height:20px;"></div>
        <ul class="nav3">
        <form action="" id="shan_form">
              <!-- ============默认====================== -->
            <li class="li1 <?php if(($choose["default"]) == "Y"): ?>hover<?php endif; ?>" onclick='reback_default()'>默认</li>
            <!-- ================人气与销量========================== -->
            <li class="li2 js-brother <?php if(($choose["main"]) == "click"): ?>hover<?php endif; ?>" onclick="choose_main(this,'click')">人气</li> 
            <li class="li3 js-brother <?php if(($choose["main"]) == "sales"): ?>hover<?php endif; ?>" onclick="choose_main(this,'sales')" >销量</li>
            <!-- ===============价格====================== -->
            <li onclick="choose_main(this,'sp')"  class="li4 js-brother <?php if(($choose["main"]) == "spdown"): ?>hover li4_1<?php endif; if(($choose["main"]) == "spup"): ?>hover li4_2<?php endif; ?>">价格</li>
            <input  type="hidden"<?php if(($choose["main"]) == "spdown"): ?>value="spdown"<?php endif; ?> <?php if(($choose["main"]) == "spup"): ?>value="spup"<?php endif; ?> />
            <!-- ============手写价格区间======================== -->
            <li class="li5">
               <input type="text" id="price_left" value="<?php echo ($choose["price_left"]); ?>" />
            </li>
            <li class="li6"></li>
            <li class="li7">
                <input type="text" id="price_right" value="<?php echo ($choose["price_right"]); ?>" />
            </li>
            <li class="li8">
                <button type="button" onclick="search_between();">确定</button>
            </li>

            <!-- =================选择性的价格区间===================== -->
        <?php if(is_array($between)): $i = 0; $__LIST__ = $between;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class='li9 js-flag  <?php if(($choose["price_flag"]) == $key): ?>hover<?php endif; ?> ' onclick="choose_price_flag(this,'<?php echo ($key); ?>');">
                 <?php if(($key) == "four"): echo ($v["left"]); ?>以上
                      <?php else: ?>
                      <?php echo ($v["left"]); ?>-<?php echo ($v["right"]); endif; ?>
                  
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <li class="li12"></li>

         <!--    <li class="li10 js-flag" onclick="make_price_choose(this);">200-300</li>
            <input style="display:none;" type="radio" name="price_flag" value="two"/> 
            <li class="li11 js-flag" onclick="make_price_choose(this);">300-400</li>
            <input style="display:none;" type="radio" name="price_flag" value="three"/> 
            <li class="li12 js-flag" onclick="make_price_choose(this);">400以上</li>
            <input style="display:none;" type="radio" name="price_flag" value="four"/>  -->
            <!-- ============================================ -->
        </form>
<!-- 
        <script type="text/javascript">
        $('.goods_li .nav3 .li1,.goods_li .nav3 .li2,.goods_li .nav3 .li3,.goods_li .nav3 .li9,.goods_li .nav3 .li10,.goods_li .nav3 .li11,.goods_li .nav3 .li12').on('click', function() {
            $('.goods_li .nav3 li').removeClass('hover');
            $('.goods_li .nav3 .li4').removeClass('hover li4_1 li4_2 ')
            $(this).addClass('hover');
        });
        $('.goods_li .nav3 .li4').on('click', function() {
            $('.goods_li .nav3 li').removeClass('hover');
            if($(this).hasClass('li4_1')){
                $(this).removeClass('hover li4_1');
                $(this).addClass('hover li4_2');

            }else if($(this).hasClass('li4_2')){
                $(this).removeClass('hover li4_2');
                $(this).addClass('hover li4_1');
            }
            else{
                $(this).addClass('hover li4_1');
            }
        }); 
        </script> -->

        </ul>
        <ul class="g_list">


        <?php if(is_array($search_goods)): $i = 0; $__LIST__ = $search_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li>
                <a href="<?php echo U('Goods/detail',array('goods_id'=>$value['id']),'');?>">
                    <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" alt="" /></div>
                    <p class="p1"><?php echo (subtext($value["goods_name"],20)); ?> <?php echo ($value["click"]); ?>--<?php echo ($value["sales"]); ?></p> 
                </a>
                    <p class="p2"><span class="span1">￥</span><?php echo ($value["shop_price"]); ?><span class="span2">￥<?php echo ($value["market_price"]); ?></span></p>
                    <p class="p3"><span class="span3 <?php if(!empty($value["collect"])): ?>hover<?php endif; ?>" id="shan_collect" onclick="collect(<?php echo ($value["id"]); ?>)">收藏</span></p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>


            
        </ul>
        <script type="text/javascript">
        $('.goods_li .g_list li p.p3 .span3').on('click', function() {
            $(this).toggleClass("hover");
        });
        </script>

        <div class="yeshu">
             <?php echo ($page_show); ?>
            
        </div>
    </div>
</div>





  </body>
</html>
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
            <dd>ICP备案号：123456789</dd>
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
</body>
</html>