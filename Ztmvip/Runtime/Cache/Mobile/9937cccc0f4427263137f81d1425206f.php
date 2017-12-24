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
<script type="text/javascript" src="/Public/Mobile/Js/swiper.jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/classify_base.css"/>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/classify_detailed.css"/>
<script type="text/javascript" src="/Public/Mobile/Js//jquery.lazyload.min.js"></script>
<script type="text/javascript">
	// $(function() {
	// 	$("img.lazy").lazyload({'threshold':400});
	// 	var height = $('.classify_nav').height()+10
	// 	var wheight = $(window).height()-$('.nav').height();
	// 	$('article').css({'padding-top': height,"min-height": wheight-2*height,"background":"#F3F3F3" });
	// 	$('.classify_nav').on('click',function(){
	// 		$('html,body').animate({scrollTop:0},0);
	// 	});
	// });

	im = new Image();
	im.onload = function(){
		$(function() {
		$("img.lazy").lazyload({'threshold':400});
		var height = $('.classify_nav').height()+10
		var wheight = $(window).height()-$('.nav').height();
		$('article').css({'padding-top': height,"min-height": wheight-2*height,"background":"#F3F3F3" });
		$('.classify_nav').on('click',function(){
			$('html,body').animate({scrollTop:0},0);
		});
	});
	}
	im.src = '/Public/Mobile/Images/classify_makings_03.png';
</script>
</head>

<body>
<ul class="classify_nav">
	<li class="js_nav_li1"  style="color:#252525;" cat_id="<?php echo ($top_category[1]["id"]); ?>"><img src="/Public/Mobile/Images/classify_makings_03.png" />
		<p><?php echo ($top_category[1]["category_name"]); ?></p>
	</li>
	<li class="js_nav_li2" cat_id="<?php echo ($top_category[2]["id"]); ?>"><img src="/Public/Mobile/Images/classify_makings_05.png" />
		<p><?php echo ($top_category[2]["category_name"]); ?></p>
	</li>
	<li class="js_nav_li3" cat_id="<?php echo ($top_category[3]["id"]); ?>"><img src="/Public/Mobile/Images/classify_makings_05.jpg" />
		<p><?php echo ($top_category[3]["category_name"]); ?></p>
	</li>
	<li class="js_nav_li4" cat_id="<?php echo ($top_category[0]["id"]); ?>"><img src="/Public/Mobile/Images/classify_makings_07.jpg"/>
		<p><?php echo ($top_category[0]["category_name"]); ?></p>
	</li>
</ul>

<!--形象美 心灵美  样式-->
<article>
	<div class="classify_content" id="brand_list">
		<div class="classify_title"><span>品牌</span></div>
		<ul>
			<div>
				<?php if(is_array($brands)): $i = 0; $__LIST__ = array_slice($brands,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Category/catDetail',array('brand_id'=>$val['id']));?>"><img  class="lazy"data-original="<?php echo ($val["brand_logo"]); ?>"   src="/Public/Mobile/Images/lastbg.jpg" />
						<p><?php echo ($val["brand_name"]); ?></p></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div id="ext_brand" style="display:none">
				<?php if(is_array($brands)): $i = 0; $__LIST__ = array_slice($brands,5,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Category/catDetail',array('brand_id'=>$val['id']));?>"><img class="lazy"data-original="<?php echo ($val["brand_logo"]); ?>"  src="/Public/Mobile/Images/lastbg.jpg" />
						<p><?php echo ($val["brand_name"]); ?></p></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<li id="all_brand"><a href="javascript:;"><img class="lazy"data-original="/Public/Mobile/Images/classify_makings_24.jpg"   src="/Public/Mobile/Images/lastbg.jpg" />
				<p>全部品牌</p></a>
			</li>
		</ul>
	</div>

	<div id="child_tree">
	</div>
</article>

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

<script type="text/javascript">
	$(function(){
		var width = $(window).width();
		if(width<750){
			$('.nav').css('font-size', '12px');
		}
	})
</script>
<script>


	$(function(){
		function setTitleOffset(){
			var titles = document.getElementsByClassName("classify_title");
			for(i=0;i<titles.length;i++){
				var j=titles[i].getElementsByTagName("span")[0].offsetWidth+20;
				titles[i].style.width=j+"px";
			}
		}

		function getChildTree(id){
			$.post("<?php echo U('getChildTree');?>",{id:id},function(data){
				if(id != $('li.js_nav_li1').attr('cat_id')){
					$(data).find('.classify_content').eq(0).addClass('padding-top40');
					$('#brand_list').hide();
				}else{
					$('#brand_list').show();
				}
				setTitleOffset();
				$('#child_tree').html(data);
				setTitleOffset();
				$("#child_tree img.lazy").lazyload({effect: "fadeIn"});
			},'text');

		}


		getChildTree($(".js_nav_li1").attr('cat_id'));
		$(".js_nav_li1").on('click',function(){
			$(".js_nav_li1 img").attr("src", "/Public/Mobile/Images/classify_makings_03.png");
			$(".js_nav_li2 img").attr("src", "/Public/Mobile/Images/classify_makings_05.png");
			$(".js_nav_li3 img").attr("src", "/Public/Mobile/Images/classify_makings_05.jpg");
			$(".js_nav_li4 img").attr("src", "/Public/Mobile/Images/classify_makings_07.jpg");
			for(i=0;i<=4;i++){
				$(".js_nav_li"+i).css({"color":"#808080"});
			}
			$(this).css({"color":"#252525"});
			getChildTree($(this).attr('cat_id'));

		})
		$(".js_nav_li2").on('click',function(){
			$(".js_nav_li1 img").attr("src", "/Public/Mobile/Images/classify_appearance_03.jpg");
			$(".js_nav_li2 img").attr("src", "/Public/Mobile/Images/classify_appearance_05.jpg");
			$(".js_nav_li3 img").attr("src", "/Public/Mobile/Images/classify_makings_05.jpg");
			$(".js_nav_li4 img").attr("src", "/Public/Mobile/Images/classify_makings_07.jpg");
			for(i=0;i<=4;i++){
				$(".js_nav_li"+i).css({"color":"#808080"});
			}
			$(this).css({"color":"#252525"});
			getChildTree($(this).attr('cat_id'));

		})
		$(".js_nav_li3").on('click',function(){
			$(".js_nav_li1 img").attr("src", "/Public/Mobile/Images/classify_appearance_03.jpg");
			$(".js_nav_li2 img").attr("src", "/Public/Mobile/Images/classify_makings_05.png");
			$(".js_nav_li3 img").attr("src", "/Public/Mobile/Images/classify_health_03.jpg" );
			$(".js_nav_li4 img").attr("src", "/Public/Mobile/Images/classify_makings_07.jpg");
			for(i=0;i<=4;i++){
				$(".js_nav_li"+i).css({"color":"#808080"});
			}
			$(this).css({"color":"#252525"});
			getChildTree($(this).attr('cat_id'));
		})
		$(".js_nav_li4").on('click',function(){
			$(".js_nav_li1 img").attr("src", "/Public/Mobile/Images/classify_appearance_03.jpg");
			$(".js_nav_li2 img").attr("src", "/Public/Mobile/Images/classify_makings_05.png");
			$(".js_nav_li3 img").attr("src", "/Public/Mobile/Images/classify_makings_05.jpg");
			$(".js_nav_li4 img").attr("src", "/Public/Mobile/Images/classify_heart_03.jpg");
			for(i=0;i<=4;i++){
				$(".js_nav_li"+i).css({"color":"#808080"});
			}
			$(this).css({"color":"#252525"});
			getChildTree($(this).attr('cat_id'));
		})

		//全部品牌
		$('#all_brand').on('click',function(){
			$('#ext_brand').toggle();
		});
	});


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