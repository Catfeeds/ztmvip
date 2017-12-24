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
<script type="text/javascript" src="/Public/Computer/Js//shan_detail.js"></script>
<script type="text/javascript" src="/Public/Computer/Js//jquery.jqzoom.js"></script>
<style type="text/css">
.index_top .nav li.li1 ul{ background:#bfbfbf;}
</style>
</head>

<body>

<!-- 头部横条 -->
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




<div class="goods_deta_bg">
    <p class="gps">
        <span>商品ID：<?php echo ($special_goods_id); ?></span>
        <a href="<?php echo U('Index/index');?>">首页</a> >
        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>$nav['id']));?>"><?php echo ($nav["category_name"]); ?></a> > <?php echo ($detail["goods_name"]); ?>
    </p>

    <div class="top">
        <div class="left">
            <div class="goods_img">
                <div class="min_img">
                    <ul>
                        <?php if(is_array($pictures)): $key = 0; $__LIST__ = $pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><li <?php if(($key) == "1"): ?>class="this"<?php endif; ?>>
                            <a href="javascript:;">
                                <img src="http://www.ztmvip.com/<?php echo ($value["thumb"]); ?>" alt="" /></a>
                            <div class="this"></div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                    <script type="text/javascript">
                        $(".goods_deta_bg .top .left .goods_img .min_img li").on('click', function() {
                            $(".goods_deta_bg .top .left .goods_img .min_img li").removeClass('this');
                            $(this).addClass('this');

                            $('#js-shan_change img').attr('src',$(this).find('img').attr('src'));
                        });
                    </script>
                </div>

                <div class="img">
                    <a href="http://www.ztmvip.com/<?php echo ($pictures[0]['thumb']); ?>" id="jqzoom" title="放大图">
                        <img src="http://www.ztmvip.com/<?php echo ($pictures[0]['thumb']); ?>" alt="" title="放大图" />
                    </a>
                </div>
                <script type="text/javascript">
                    // 图片放大特效
                    function max_img(){
                        $("#jqzoom").jqzoom({
                            zoomWidth: 400, //小图片所选区域的宽
                            zoomHeight: 400, //小图片所选区域的高
                            zoomType: 'reverse' //设置放大镜的类型
                        });
                    };
                    max_img();
                    // 略缩图动画
                    function this_img(this_li){
                        var lis=$('.goods_deta_bg .top .left .goods_img .min_img li').length;
                        var ul_min_top=320-lis*80;
                        if(lis>5){
                            var ul_top=160-this_li*80;
                            // alert("共有li个数为"+lis+"当前值为:"+ul_top+"最小值为:"+ul_min_top);
                            if(ul_top<ul_min_top || ul_top>80){
                                return
                            }else if(ul_top==80){
                                $('.goods_deta_bg .top .left .goods_img .min_img ul').animate({"top":"0px"});
                            }else if(ul_top==ul_min_top){
                                var ul_top_wei=ul_min_top+80;
                                $('.goods_deta_bg .top .left .goods_img .min_img ul').animate({"top":ul_top_wei});
                            }else{
                                $('.goods_deta_bg .top .left .goods_img .min_img ul').animate({"top":ul_top});
                            }

                        };
                    };
                    //小图片受到点击改变小图片位置   更换显示图的   更换放大的图
                    $(".goods_deta_bg .top .left .goods_img .min_img li").on('click', function() {
                        var this_li=$(this).index();
                        $(".goods_deta_bg .top .left .goods_img .min_img li").removeClass('this');
                        $(this).addClass('this');
                        var src=$(this).find('img').attr("src");
                        $('.goods_deta_bg .top .left .goods_img .img img').attr("src",src);//替换当前可见的图片
                        var max_href=src;//更换放大图的href(大小为1278*1260)
                        $('.goods_deta_bg .top .left .goods_img .img a').attr("href",max_href);
                        this_img(this_li);
                        max_img();
                    });
                </script>

                <ul class="baozheng">
                <?php if(!empty($service["quality"])): ?><li class="li1">100%正品</li><?php endif; ?>

                <?php if(!empty($service["refund"])): ?><li class="li2">7天放心退</li><?php endif; ?>
                <?php if(!empty($service["share"])): ?><li class="li3">分享就赚钱</li><?php endif; ?>
                <?php if(!empty($service["double"])): ?><li class="li4">买贵返差额</li><?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="right">

            <form action="<?php echo U('Flow/checkout');?>"  method="post" id="shan_form">
                <p class="title"><?php echo ($detail["goods_name"]); ?></p>
                <dl class="dl1">
                    <dt>原价:</dt>
                    <dd><span>￥<?php echo ($detail["market_price"]); ?></span></dd>
                </dl>
                <dl class="dl2">
                    <dt>现价:</dt>
                    <dd><span id="shan_final"><?php echo ($detail["final_price"]); ?></span></dd>
                </dl>
                <div class="hr"></div>
 
 
                <?php if(is_array($skus)): $key1 = 0; $__LIST__ = $skus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><dl class="dl4">
                        <dt><?php echo ($value["name"]); ?>:</dt>
                        <?php if(is_array($value["values"])): $key2 = 0; $__LIST__ = $value["values"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value2): $mod = ($key2 % 2 );++$key2;?><dd onclick="make_check(this)" <?php if(($key2) == "1"): ?>class='this'<?php endif; ?>><?php echo ($value2["label"]); ?>
                            <input  type="radio" style="display:none"  <?php if(($key2) == "1"): ?>checked="checked"<?php endif; ?> name="spec_<?php echo ($key1); ?>" value="<?php echo ($value["sku_id"]); ?>_<?php echo ($key2-1); ?>_<?php echo ($value["name"]); ?>_<?php echo ($value2["label"]); ?>" />
                            <img class="gou" src="/Public/Computer/Images/goods_details_03.png" alt="" />
                            </dd><?php endforeach; endif; else: echo "" ;endif; ?>

                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>

        


                <dl class="dl5">
                    <dt>购买数量:</dt>
                    <dd >
                        <ul class="add">
                            <li class="li1" onclick="changeNumber(1)"></li>
                            <li class="li2">
                                <input type="text" onchange="changeNumber(2)" name="number" id="goods_number" value="1" />
                            </li>
                            <li class="li3" onclick="changeNumber(3)"></li>
                        </ul>
                    </dd>
                    <?php if(!empty($detail['goods_number'])): ?><dd>仅剩 <span><?php echo ($detail["goods_number"]); ?></span> 件，抓紧时间购买哦！</dd><?php endif; ?>
                </dl>

                <ul class="ok">
                    <li>
                        <button type="button" onclick="add_cart('Y')">立即购买</button>
                    </li>
    
                    <input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>"/>
                    <input type="hidden" id="shan_quick" name="quick" />
                    <li class="li2">
                        <button type="button"  onclick="add_cart('N')">加入购物车</button>
                    </li>
                </ul>
                <ul class="collection">
                    <li class="li1" id="shan_collect" onclick="collect(<?php echo ($goods_id); ?>)">收藏</li>
                    <li class="li2">分享
                       <div class="bdsharebuttonbox" data-tag="share_1">
    <!-- 此处添加展示按钮 -->
    <a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
    <a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
    <a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
    <a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
</div>

<script>
    window._bd_share_config = {

     //此处放置通用设置
        'common' : {
            "bdText":"<?php echo ($title); ?>",
            "bdDesc":"<?php echo ($desc); ?>",
            "bdUrl":"<?php echo ($link); ?>",
            "bdPic":"<?php echo ($imgUrl); ?>",
        },
    //分享按鈕設置
        'share' : {"bdSize" : 16 },
 
    //浮窗分享設置
        // 'slide' : {
        //       "bdImg" : 0,
        //       "bdPos" : "right",
        //       "bdTop" : 20
        //   },

    //圖片分享設置
        // "image": {
        //           "viewList":["qzone","tsina","tqq","weixin"],
        //           "viewText":"分享到：",
        //            "viewSize":"16",
        //          },

    //劃詞分享設置 
       // "selectShare":
       //          {
       //               "bdContainerClass":null,
       //               "bdSelectMiniList":["qzone","tsina","tqq","weixin"]
       //           }
    }
</script>
<script>
    //以下为js加载部分
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];

</script>
                    </li>

                </ul>


                <?php if(($flag) == "1"): ?><script type="text/javascript">
                        $('#shan_collect').addClass('hover');
                    </script><?php endif; ?>
            </form>
        </div>
    </div>


    <div class="goods_container">
        <div class="goods_left">

            <?php if(!empty($linked_goods)): ?><dl>
                    <dt>相关商品</dt>
                    <?php if(is_array($linked_goods)): $i = 0; $__LIST__ = $linked_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Goods/detail',array('goods_id'=>$value['id']),'');?>">
                            <dd>
                                <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" alt="" /></div>
                                <p class="p1"><?php echo (subtext($value["goods_name"],20)); ?></p>
                                <p class="p2">￥<?php echo ($value["shop_price"]); ?></p>
                            </dd>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </dl><?php endif; ?>

            <?php if(!empty($history_goods)): ?><dl>
                    <dt>浏览过的商品</dt>
                    <?php if(is_array($history_goods)): $i = 0; $__LIST__ = $history_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Goods/detail',array('goods_id'=>$value['id']),'');?>">
                            <dd>
                                <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" alt="" /></div>
                                <p class="p1"><?php echo (subtext($value["goods_name"],20)); ?></p>
                                <p class="p2">￥<?php echo ($value["shop_price"]); ?></p>
                            </dd>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </dl><?php endif; ?>



        </div>
        <div class="goods_tight">
            <ul class="nav4">
                <li class="li1 hover">商品详情</li>
                <li class="li2">累计评价</li>
                <li class="li3">售后服务</li>
                <li class="li4" onclick="add_cart('N')" >加入购物车</li>
            </ul>
            <?php if(($pagehover) == "1"): ?><script type="text/javascript">
                 $(function(){
                    $('.nav4 li').removeClass('hover');
                    $('.nav4 li.li2').addClass('hover');
                    $('.goods_tight .con1,.goods_tight .con2,.goods_tight .con3').css({"display":"none"});
                    $('.goods_tight .con2').css({"display":"block"});  
                 })
                 
                 </script><?php endif; ?>
            <script type="text/javascript">
                $('.goods_tight .nav4').on('click', '.li1', function() {
                    $('.goods_tight .nav4 li').removeClass("hover");
                    $(this).addClass('hover');
                    $('.goods_tight .con1,.goods_tight .con2,.goods_tight .con3').css({"display":"none"});
                    $('.goods_tight .con1').css({"display":"block"});
                });
                $('.goods_tight .nav4').on('click', '.li2', function() {
                    $('.goods_tight .nav4 li').removeClass("hover");
                    $(this).addClass('hover');
                    $('.goods_tight .con1,.goods_tight .con2,.goods_tight .con3').css({"display":"none"});
                    $('.goods_tight .con2').css({"display":"block"});
                });
                $('.goods_tight .nav4').on('click', '.li3', function() {
                    $('.goods_tight .nav4 li').removeClass("hover");
                    $(this).addClass('hover');
                    $('.goods_tight .con1,.goods_tight .con2,.goods_tight .con3').css({"display":"none"});
                    $('.goods_tight .con3').css({"display":"block"});
                });
            </script>


            <div class="con1" >
                <?php echo ($detail["goods_desc"]); ?>
            </div>
            <div class="con2" style="display:none">

                <?php if(!empty($comment_list)): ?><div class="title"><span>用户评价</span></div>
                    <div class="pingjun">
                        <a href="#" class="fabiao">发表评价</a>
                        <span>综合评分</span>
                        <ul class="xingxing">
                            <li><i class="iconfont">&#xe632;</i></li>
                            <li><i class="iconfont">&#xe632;</i></li>
                            <li><i class="iconfont">&#xe632;</i></li>
                            <li><i class="iconfont">&#xe632;</i></li>
                            <li><i class="iconfont">&#xe632;</i></li>
                        </ul>
                        <p>5.0<em>/5.0</em></p>
                    </div><?php endif; ?>
                <div class="user">

                    <?php if(is_array($comment_list)): $i = 0; $__LIST__ = $comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="user">
                            <div class="user_l">
                                <div class="img"><img src="" alt="" /></div>
                                <p><?php echo ($value["user_name"]); ?></p>
                            </div>
                            <div class="user_r">
                                <div class="user_t">
                                    <ul class="use_xing">
                                        <?php $__FOR_START_26285__=0;$__FOR_END_26285__=$value["level"];for($i=$__FOR_START_26285__;$i < $__FOR_END_26285__;$i+=1){ ?><li><i class="iconfont">&#xe632;</i></li><?php } ?>

                                    </ul>
                                    <span><?php echo ($value["level"]); ?>.0</span>
                                    <p><?php echo ($value["rq"]); ?>&nbsp;&nbsp;&nbsp;<?php echo ($value["ms"]); ?></p>
                                </div>
                                <p class="text"><?php echo ($value["content"]); ?></p>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                    <div class="yeshu">
                        <?php echo ($page_show); ?>
                    </div>
                </div>
            </div>


            <div class="con3" style="display:none;">
                <?php echo ($promise); ?>
            </div>


        </div>
    </div>


</div>
</body>
</html>
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