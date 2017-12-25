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
    
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//details_index_mobile.css" media="(max-width:750px)" />
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//details_index_pad.css" media="(min-width:750px)">
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css//swiper.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Common/Css//collect/wait.css" />
    <script type="text/javascript" src="/Public/Mobile/Js//swiper.jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Mobile/Js//shan_detail.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<style type="text/css">
  .swiper-lazy-preloader{ height: 300px;}
  .swiper2 .swiper-slide img{width:100%;height:100%;}
/*###### shiqian add #########*/
      .miaosha{ width:100px; float:left; margin: 14px 10px; }
      @media (max-width:750px ) {
    .miaosha {
      width: 47px;
      float: left;
      margin: 8px 7px;
  }      
      }
/*######################################*/
</style>
</head>
<body>
<!-- 商品详情页头部开始 -->
<header class="header">
    <div class="left">
        <a href="<?php echo ($go_out); ?>">
            <img src="/Public/Mobile/Images/fh2.jpg" alt="" />
        </a>
    </div>
    <div class="click_index">
        <a href="<?php echo U('Index/index');?>"><img src="/Public/Mobile/Images/xin3.png"  /></a>
    </div>
    <div class="click js_carone">
        <a href="<?php echo U('Flow/cart');?>">
            <img src="/Public/Mobile/Images/car.png" alt="" />
            <div class="num">
                <?php if(session('cnumber')) { echo session('cnumber'); }else{ echo 0; } ?>
            </div>   
        </a>     
    </div>
    <div class="click">
        <img class="collect" src="<?php if(!empty($flag)): ?>/Public/Mobile/Images/xin2.png<?php else: ?>/Public/Mobile/Images/xin.png<?php endif; ?>"  onclick="collect(<?php echo ($goods_id); ?>)" />
    </div>
<!-- ################################################### -->

<!-- ########################################################### -->
</header>
<!-- 商品详情页头部结束 -->
<div class="bgc">
    <div class="place"></div>
    <div class="swiper-container" id="swiper2">
        <div class="swiper-wrapper">
          <?php if(is_array($pictures)): $i = 0; $__LIST__ = $pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                <img class="img swiper-lazy" data-src="<?php echo ($value["thumb"]); ?>"  />
                <div class="swiper-lazy-preloader"></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <script>
        var swiper2 = new Swiper('#swiper2', {
            pagination: '.swiper-pagination',
            slidesPerView: 'auto',
            paginationClickable: true,
            spaceBetween: 0,
            autoplay: 2500,
            autoplayDisableOnInteraction: false,
            loop: true,
            preloadImages: false,
            lazyLoading: true
        });
    </script> 

    <div class="inf_box">
        <!-- <div class="inf_top">
            <div class="click other js_cartwo">
            <a href="<?php echo U('Flow/cart');?>">
                <img src="/Public/Mobile/Images/car.png" alt="" />
                <div class="num">
                    <?php if(session('cnumber')) { echo session('cnumber'); }else{ echo 0; } ?>
                </div>
            </a>
            </div>
            <div class="click">
              <img class="collect" src="<?php if(!empty($flag)): ?>/Public/Mobile/Images/xin2.png <?php else: ?>/Public/Mobile/Images/xin.png<?php endif; ?>"  onclick="collect(<?php echo ($goods_id); ?>)" />
            </div>
        </div> -->

        <div class="inf_title"><?php echo ($details["goods_name"]); ?></div>
        <div class="inf_price">
            <div class="left" id='shan_final'>￥<i><?php echo ($details["final_price"]); ?></i></div>
            <div class="ori">￥<?php echo (intval($details["market_price"])); ?></div>
            <!-- 日期1202添加一张秒杀图片,ccs在页面头部 -->
            <?php if(!empty($is_kill)): ?><img src="/Public/Mobile/Images//inf_price.png" class="miaosha" /><?php endif; ?>
            <!-- ########### ##################### -->
            <div class="right">已售：<i><?php echo ((isset($sale_count) && ($sale_count !== ""))?($sale_count):0); ?>&nbsp;件</i></div>
        </div>

    </div>

<?php if(!empty($package_goods_list)): ?><!-- 整体美礼包开始 -->
    <div class="inf_box">
        <div class="bag_title">整体美礼包</div>
        <div class="bag_box">
            <div class="swiper-container" id="swiper3">
                <div class="swiper-wrapper">
                <!-- ########################### -->
            <?php if(is_array($package_goods_list)): $i = 0; $__LIST__ = $package_goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                        <div class="bag">
                        <a href="<?php echo U('Goods/packageList',array('goods_id'=>$goods_id));?>">
                            <div class="bag_name"><?php echo ($value["group_name"]); ?></div>
                         <?php if(is_array($value["relation_goods"])): $i = 0; $__LIST__ = $value["relation_goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value1): $mod = ($i % 2 );++$i;?><div class="bag_goods"><img src="<?php echo ($value1["goods_thumb"]); ?>_710x700.jpg" alt="" /></div><?php endforeach; endif; else: echo "" ;endif; ?>
                
                        </a>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                     <!-- ################### -->


                </div>
            </div>
        </div>
    </div>
    <!-- 整体美礼包结束 --><?php endif; ?>

    <script>
            var gd_w = $(window).width()
        if(gd_w<750){
            $(".bag_goods").css('width',gd_w*0.27);
        }else{
            $(".bag_goods").css('width',750*0.21)
        };
        var swiper3 = new Swiper('#swiper3', {
            slidesPerView: "auto",
            freeMode : true,
            spaceBetween: 4
        });
</script>

<div class="inf_box down">
        <div class="goods_inftitle">商品详情
            <div class="jump"><img src="/Public/Mobile/Images/fhy.gif" alt="" /></div>
        </div>
        <div class="article">
            <?php echo ($details['goods_desc']); ?>
        </div>
    </div>

    <div class="inf_box">
        <div class="service_title same">服务：</div>
        <div class="service_box">
            <a id="js_seven" class="service same" href="<?php echo U('Article/show','id=59');?>">
            <?php if($details['service']['refund']): ?><span class="dec"><img src="/Public/Mobile/Images/gou.png" alt="" /></span>
                <span class="two">7天无理由退货</span>
                <?php else: ?>
                <span class="dec"><img src="/Public/Mobile/Images/yangyang.png" alt="" /></span>
                <span class="two" style="color:#888;">7天无理由退货</span><?php endif; ?>
            </a>
            <a class="service same" href="<?php echo U('Article/show','id=59');?>">
                <span class="dec"><img src="/Public/Mobile/Images/gou.png" alt="" /></span>
                <span>分享赚钱</span>
            </a>
            <a class="service same" href="<?php echo U('Article/show','id=59');?>">
                <span class="dec"><img src="/Public/Mobile/Images/gou.png" alt="" /></span>
                <span>正品保障</span>
            </a>
            <a class="service same" href="<?php echo U('Article/show','id=59');?>">
                <span class="dec"><img src="/Public/Mobile/Images/gou.png" alt="" /></span>
                <span>买贵返双倍差额</span>
            </a>
        </div>
    </div>
    <div class="inf_box js-skus">

    <!-- 属性规格 -->
        <form name="ZTM_FORMBUY" id="ZTM_FORMBUY">


      <?php if(is_array($properties)): $key1 = 0; $__LIST__ = $properties;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><div class="radio_box">
             <div class="radio_title"><?php echo ($value["name"]); ?>：</div>
             <div class="color">
             <!-- ############################## -->
               <?php if(is_array($value["values"])): $key2 = 0; $__LIST__ = $value["values"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value2): $mod = ($key2 % 2 );++$key2;?><input onclick="final_price(<?php echo ($goods_id); ?>);" type="radio" <?php if(($key2) == "1"): ?>checked<?php endif; ?> name="spec_<?php echo ($key1); ?>" value="<?php echo ($value["sku_id"]); ?>_<?php echo ($key2-1); ?>_<?php echo ($value["name"]); ?>_<?php echo ($value2["label"]); ?>" id="ztm<?php echo ($key1); echo ($key2); ?>" />
                 <label for="ztm<?php echo ($key1); echo ($key2); ?>"<?php if(($key2) == "1"): ?>class="rdo_cur"<?php endif; ?> ><?php echo ($value2["label"]); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
               <!-- ################################# -->
             </div>                          
         </div><?php endforeach; endif; else: echo "" ;endif; ?>          

                <div class="radio_box" >
                     <div class="radio_title">购买数量：</div>
                     <div class="goods_num">
                         <button class="cut" type="button" onclick="changePrice('1',<?php echo ($goods_id); ?>)">－</button>
        <input type="text" name="number" value="1" id="goods_number" onchange="changePrice('2',<?php echo ($goods_id); ?>)" />

                         <button class="add" type="button" onclick="changePrice('3',<?php echo ($goods_id); ?>)">＋</button>
                     </div>                          
                 </div>

        </form>
    </div>
    <script type="text/javascript">
         final_price(<?php echo ($goods_id); ?>);
    </script>

<?php if(!empty($commentlist)): ?><div class="inf_box">
        <div class="comm_title">
            <div class="left">用户评论</div>
            <div class="right"><i><?php echo ($total_comments['count']); ?>人</i>评论<i><?php echo ($total_comments['favorable_rate']); ?>%</i>好评</div>
        </div>

    <?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="comm_box">
            <div class="comm">
            <!-- 星星 -->

                <div class="left">
                    <?php $__FOR_START_186044657__=0;$__FOR_END_186044657__=$value["level"];for($i=$__FOR_START_186044657__;$i < $__FOR_END_186044657__;$i+=1){ ?><div class="star"><img src="/Public/Mobile/Images/star.gif" alt="" /></div><?php } ?>
                </div>
                <div class="right">
                    <!-- 用户名 -->
                    <?php echo ($value["user_name"]); ?>
                    <!-- 日期 -->
                    <?php echo ($value["add_time"]); ?>
                    <!-- 时间 -->
                    
                </div>
            </div>
            <div class="comm_in"><?php echo (subtext($value["content"],25)); ?></div>            
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
       
    <div class="comm_more"><a href="<?php echo U('Goods/allComment',array('goods_id'=>$goods_id));?>">查看全部评论&nbsp;＞</a></div>
</div><?php endif; ?>


<?php if(!empty($linked_goods)): ?><!-- 相关推荐开始 -->
    <div class="inf_box">
        <div class="goods_inftitle">相关推荐</div>
        <div class="swiper-container" id="swiper0">
            <div class="swiper-wrapper">

             <?php if(is_array($linked_goods)): $i = 0; $__LIST__ = $linked_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="swiper-slide" onclick="javascript:window.location='<?php echo U('Goods/detail',array('goods_id'=>$value['goods_id']),'');?>';">
                    <div class="seckill"><img src="<?php echo ($value["goods_thumb"]); ?>_217x217.jpg" alt="" /></div>
                    <div class="seckill_inf">
                        <div class="price">￥<em><?php echo ($value["shop_price"]); ?></em></div>
                        <div class="inf"><?php echo (subtext($value["goods_name"],6)); ?></div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>    
        <script>
            var swiper = new Swiper('#swiper0', {
                slidesPerView: "auto",
                freeMode : true,
                paginationClickable: true,
                spaceBetween: 4
            });
        </script>
    </div>

    <!-- 相关推荐结束 --><?php endif; ?>
    <script>
        $(".down").on('click',function(event){
            $(this).children('.article').slideToggle(300)
            $(this).siblings('.down').children('.article').slideUp(300)
        });
    </script>

    <style type="text/css">
        .goods_weixin{ overflow: hidden;background: rgb(255, 255, 255);margin: 1% auto 0px;width: 94%; padding:5px 0px;}
        .goods_weixin .img{ width:140px;  margin: auto;}
        .goods_weixin p{  font-size: 13px; text-align: center; }
    </style>
    <div class="goods_weixin">
        <div class="img"><img src="/Public/Mobile/Images/weixin.png" alt="" /></div>
        <p>关注注册送红包，分享购买返佣金！</p>
    </div>

    <div class="inf_box">
          
      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 

    </div>
  
</div>


<div class="details_bt">
    <div class="details_bt_box">
        <div class="shopping_in" onclick="add_cart(<?php echo ($goods_id); ?>)">加入购物车</div>
        <div class="shopping"    onClick="add_cart(<?php echo ($goods_id); ?>,1)">立即购买</div>
    </div>
</div>

<script type="text/javascript">
  $(function(){
      var num = $('#goods_number').val();
      if(num==1){
        $('.cut').css('color', '#999');
      }else{
        $('.cut').css('color', '#252525');
      }
  })
</script>

 <script>
        $(function(){
            $("label").on('click',function(event) {
                $(this).addClass('rdo_cur').siblings('label').removeClass('rdo_cur')
            });

            // 点击飞入效果
            function fly(){
                $('.shopping_in').on('click',function (){  
                    var cart = $('.js_carone');
                    var imgtodrag = $('.img').eq(0);
                    function flying(){
                        if (imgtodrag) {
                            var imgclone = imgtodrag.clone().offset({
                                top: $('.shopping_in').offset().top,
                                left:$('.shopping_in').offset().left
                            }).css({
                                'opacity': '0.5',
                                'position': 'absolute',
                                'height': '150px',
                                'width': '150px',
                                'z-index': '100'
                            }).appendTo($('body')).animate({
                                'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 75,
                                'height': 75
                            }, 1000);
                            imgclone.animate({
                                'width': 0,
                                'height': 0
                            }, function () {
                                $(this).detach();
                            });
                        }
                    }
                    flying();
                });
            }
            fly();
        }) 
        </script>

<!-- ######################### -->

<!-- 加载中 -->
<div class="load" id="shan_collect" style="display:none;font-size:14px;">加载中．．．</div>
<!-- ############################### -->

</body>
<script type="text/javascript">   
    wx.config({
      debug: false,
      appId:"<?php echo ($signPackage['appid']); ?>",
      timestamp:"<?php echo ($signPackage['timestamp']); ?>",
      nonceStr:"<?php echo ($signPackage['noncestr']); ?>",
      signature:"<?php echo ($signPackage['signature']); ?>",
      jsApiList:[
        'onMenuShareAppMessage',
        'onMenuShareTimeline',
      ]
    });
/*****************************************************/
    wx.ready(function(){
      
    //发送给朋友
    //注意，如果您的分享图标太大，网速又不是很好，则分享的链接将显示不出图标的
    wx.onMenuShareAppMessage({
      title:'<?php echo ($title); ?>',
      desc:'<?php echo ($desc); ?>',
      link:'<?php echo ($link); ?>',
      imgUrl:'<?php echo ($imgUrl); ?>',
      type: 'link', 
       success: function () { 
              // 用户确认分享后执行的回调函数
          },
       cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
    });
   //分享到朋友圈
    wx.onMenuShareTimeline({
        title:'<?php echo ($title); ?>', // 分享标题
        link:'<?php echo ($link); ?>', // 分享链接
        imgUrl:'<?php echo ($imgUrl); ?>', // 分享图标
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });


}); //ready尾

/*****************************************************/
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