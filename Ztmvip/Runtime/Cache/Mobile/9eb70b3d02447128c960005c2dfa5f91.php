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
<!--<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/swiper.css" />
<script type="text/javascript" src="/Public/Mobile/Js/swiper.jquery.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/classify_base.css"/>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/classify_detailed.css"/>
<link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/classify.css"/>
<!--<link rel="stylesheet" type="text/css" href="/Public/Common/Css//collect/wait.css" >-->
<script type="text/javascript" src="/Public/Common/Js/cat-detail.more.js"></script>
<script type="text/javascript" src="/Public/Mobile/Js/jquery.lazyload.min.js"></script>

<script type="text/javascript">
	$(function() {
		var height = $('.position').height()+10
		var wheight = $(window).height()
		$('.con1').css({"min-height": wheight-2*height });
		$('.position').on('click',function(){
			$('html,body').animate({scrollTop:0},0);
		})
	});
</script>
</head>

<body>
<div class="classify max">
	<div class="position">
		<div class="Search">
			<a href="<?php echo U('Category/catAll');?>"><img src="/Public/Mobile/Images/classify_06.png" /></a><input type="text" name="search" value="<?php echo ($word); ?>" placeholder="搜索商品和品牌" /><button id="search_goods" type="button"></button>
			<!-- 20151221 筛选S-->
	        <div class="shaixuan">筛选</div>
	        <!-- 20151221 筛选E-->
		</div>
		<ul class="nav" id="ul">
			<li class="click" sort_way="default">默认</li>
			<li sort_way="moods">人气</li>
			<li sort_way="sales">销量</li>
			<li sort_way="price">价格<i class="iconfont">&#xe6b3;</i></li>
		</ul>
	</div>
	<div class="con1">

	</div>
	<form id="js-submit-search">
	<input type="hidden" name="sort_way" value="<?php echo ((isset($sort_way) && ($sort_way !== ""))?($sort_way):'default'); ?>"/>
	<input type="hidden" name="orderby" value="<?php echo ((isset($orderby) && ($orderby !== ""))?($orderby):''); ?>"/>
	<input type="hidden" name="cat_id" value="<?php echo ((isset($cat_id) && ($cat_id !== ""))?($cat_id):0); ?>" />
	<input type="hidden" name="brand_id" value="<?php echo ((isset($brand_id) && ($brand_id !== ""))?($brand_id):0); ?>" />
	<input type="hidden" name="price_start" value="<?php echo I('get.price_start',0,'intval');?>" />
	<input type="hidden" name="price_end" value="<?php echo I('get.price_end',0,'intval');?>" />
	<input type="hidden" name="word" value="<?php echo ((isset($word) && ($word !== ""))?($word):''); ?>" />
	<input type="hidden" name="is_search" value="<?php echo ((isset($is_search) && ($is_search !== ""))?($is_search):''); ?>" />
	</form>
</div>
<div class="l_jiazai" id="loader" ><img src="/Public/Common/Images//jiazai.png" alt="" /></div>

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
<script>
	window.onload=function(){
		var li=document.getElementById("ul").getElementsByTagName("li")
		for(var i=0;i<li.length;i++){
			li[i].onclick=function(){
				$('input[name=search]').val($(':hidden[name=word]').val());
				for(var j=0;j<li.length;j++){
					li[j].className="";
				}
				this.className="click";
				var sort_way = $(this).attr('sort_way');
				var orderby = '';
				if( sort_way == 'price'){
					if( $(this).attr('orderby') == 'asc'){
						$(this).attr('orderby','desc');
						$(this).find('i').addClass('bot');
						orderby = 'desc';
					}else{
						$(this).attr('orderby','asc');
						$(this).find('i').removeClass('bot');
						orderby = 'asc';
					}
				}else{
					$(li[3]).attr('orderby','');
					$(li[3]).find('i').removeClass('bot');
					orderby = '';
				}
				changeType(sort_way,orderby);
			}
		}
	}
	function getCatGoods(){
		$('html,body').animate({scrollTop:0},0);
		$('.con1').html('');
		//重置滚动锁定
		resetLock();
		var inputData = Core.InputObj('#js-submit-search');
		inputData['page'] = 1;
		ajaxCatGoods(inputData);
	}
	function changeType(sort_way,orderby){
		$(':hidden[name=sort_way]').val(sort_way);
		$(':hidden[name=orderby]').val(orderby);
		getCatGoods();
	}
	$(function(){
		getCatGoods();
		$('#search_goods').click(function(){
			var word = $(this).prev('input').val();
			if(word==''){
				return;
			}
			$(':hidden[name=cat_id]').val('');
			$(':hidden[name=brand_id]').val('');
			$(':hidden[name=word]').val(word);
			$(':hidden[name=is_search]').val('true');
			$(':hidden[name=price_start]').val('');
			$(':hidden[name=price_end]').val('');

			getCatGoods();
		});
	});
</script>

<!-- 20151221 弹层 S-->

<div class="shaixuan_pos" style="display:none">
    <div class="container">
         <form action="">


        <!-- 头部   S-->
            <div class="sx_top">
                <span>取消</span>
                筛选
                <button>重置<tton>
            </div>
        <!-- 头部   E -->


            <dl>
            	               
            </dl>
            <dl>
                
            </dl>   
			<ul>
                <li><span>价格区间</span></li>
                <li><input name="price_start_text" type="text" placeholder="最低价格" />-<input name="price_end_text" type="text" placeholder="高价格" /></li>
            </ul>
<!-- 清楚按钮 -->
            <div class="qingchu">
                <button type="button">确定<tton>
            </div>

<!-- 清楚按钮 -->

        </form>

    </div>

</div>
<script type="text/javascript">

var getFilterFlag = false;
var _thisBrandItem = false;
//动画
$(".shaixuan").on('click',function(){
    $(".shaixuan_pos").css({"display":"block"});
    $(".shaixuan_pos .container,.shaixuan_pos .container .qingchu").css({"animation":" donghua 0.3s ease 0s 1 normal","-webkit-animation":" donghua 0.3s ease 0s 1 normal"});

    if(getFilterFlag ===false){
	    $.post("<?php echo U('Category/getFilter');?>",Core.InputObj('#js-submit-search'),function(ret){
	    	if(ret.brand_list && ret.brand_list.length>0){
		    	var brand_dd = '';
		    	$.each(ret.brand_list,function(i,item){
		    		if(item.id==ret.current_brand){
		    			var dd_class = 'class="this thisBrandId"';
		    		}else{
		    			var dd_class = '';
		    		}
		    		var item_dd ='<dd '+dd_class+' data-id='+item.id+'>'+item.brand_name+'</dd>';
		    		// var item_dd ='<dd data-id='+item.id+'>'+item.brand_name+'</dd>';
		    		brand_dd+=item_dd;
		    	});
		    	$('.container dl').eq(0).html('<dt><span>更多品牌</span>品牌</dt>').append(brand_dd);
		    	$('.container dl').eq(0).find('.thisBrandId').removeClass('thisBrandId').siblings('dd').removeClass('this').hide();
		    }
		    if(ret.cat_list && ret.cat_list.length>0){
			    var cat_dd = '';
			    var current_dl = '';
		    	$.each(ret.cat_list,function(i,item){
		    		if(item.id==ret.current_cat){
		    			current_dl = '<dl><dd class="this" data-id='+item.id+'>'+item.category_name+'</dd></dl>';
		    		}else{
		    			cat_dd += '<dd data-id='+item.id+'>'+item.category_name+'</dd>';
		    		}
		    	});
	    		$('.container dl').eq(1).html('<dt><span>更多分类</span>分类</dt>').append(cat_dd);
	    		if(current_dl){
	    			$('.container dl').eq(1).find('dt').after($(current_dl));
	    		}
	    		//$('.container dl').eq(1).find('.thisCatId').removeClass('thisCatId').siblings('dd').removeClass('this').hide();
		    }
		    getFilterFlag = true;
	    },'json');
	}
});
$(".shaixuan_pos").on('click',function(){
    $(this).css({"display":"none"});
    $(".shaixuan_pos .container").css({"animation":" donghua 0s linear 0s 1 normal","-webkit-animation":" donghua 0s linear 0s 1 normal"});
});

//选中
$(".shaixuan_pos dl").on('click','dd',function(event){
	if(event.delegateTarget == $(".shaixuan_pos dl").eq(0)[0]){
		console.log($(this).attr('data-id'));
		if($(this).hasClass('this')){
			$(this).removeClass('this').siblings('dd').show();
		}else{
			$(this).addClass('this').siblings('dd').removeClass('this').hide();
		}
	}
	if(event.delegateTarget == $(".shaixuan_pos dl").eq(1)[0]){
		var cat_id = $(this).attr('data-id');
		if($(this).hasClass('this')){
			//找父节点和兄弟节点
			$.post("<?php echo U('Category/parentAndSiblings');?>",{cat_id:cat_id},function(ret){
				if(ret.state==8){
					if(ret.cat_list && ret.cat_list.length>0){
						var cat_dd = '';
						var current_dl = '';
						$.each(ret.cat_list,function(i,item){
							if(item.id==ret.parent_id){
				    			current_dl = '<dl><dd class="this" data-id='+item.id+'>'+item.category_name+'</dd></dl>';
				    		}else{
				    			cat_dd += '<dd data-id='+item.id+'>'+item.category_name+'</dd>';
				    		}
						});
					}
					$('.container dl').eq(1).html('<dt><span>更多分类</span>分类</dt>').append(cat_dd);
					if(current_dl){
		    			$('.container dl').eq(1).find('dt').after($(current_dl));
		    		}
				}
				
			},'json');
		}else{
			//找自己和他的子节点
			$.post("<?php echo U('Category/selfAndChild');?>",{cat_id:cat_id},function(ret){
				if(ret.state==8){
					if(ret.cat_list && ret.cat_list.length>0){
						var cat_dd = '';
						var current_dl = '';
						$.each(ret.cat_list,function(i,item){
							if(item.id==cat_id){
				    			current_dl = '<dl><dd class="this" data-id='+item.id+'>'+item.category_name+'</dd></dl>';
				    		}else{
				    			cat_dd += '<dd data-id='+item.id+'>'+item.category_name+'</dd>';
				    		}
						});
					}
					$('.container dl').eq(1).html('<dt><span>更多分类</span>分类</dt>').append(cat_dd);
					if(current_dl){
		    			$('.container dl').eq(1).find('dt').after($(current_dl));
		    		}
				}
				
			},'json');
		}
		$(this).addClass('this').siblings('dd').removeClass('this');
	}
    
    return false;
});
$(".shaixuan_pos dl").eq(1).on('click','dd',function(){
	
	
});
$(".shaixuan_pos .container").on('click',function(){
    return false;
});
//取消
$('.sx_top span').on('click',function(){
	$('.shaixuan_pos').css({"display":"none"});
});
//重置
$('.sx_top button').on('click',function(){
	$(".shaixuan_pos dl").find('dd.this').removeClass('this');
	$('.container dl').eq(0).find('dd').show();
	$('input[name=price_start_text]').val('');
	$('input[name=price_end_text]').val('');
	$.post("<?php echo U('Category/parentAndSiblings');?>",{cat_id:0},function(ret){
				if(ret.state==8){
					if(ret.cat_list && ret.cat_list.length>0){
						var cat_dd = '';
						var current_dl = '';
						$.each(ret.cat_list,function(i,item){
							if(item.id==ret.parent_id){
				    			current_dl = '<dl><dd class="this" data-id='+item.id+'>'+item.category_name+'</dd></dl>';
				    		}else{
				    			cat_dd += '<dd data-id='+item.id+'>'+item.category_name+'</dd>';
				    		}
						});
					}
					$('.container dl').eq(1).html('<dt><span>更多分类</span>分类</dt>').append(cat_dd);
					if(current_dl){
		    			$('.container dl').eq(1).find('dt').after($(current_dl));
		    		}
				}
				
			},'json');
	//获取顶级分类
});


//确定
$('.qingchu button').on('click',function(){
	var brand_id = $('.container dl').eq(0).find('.this').attr('data-id');
	var cat_id = $('.container dl').eq(1).find('.this').attr('data-id');
	$(':hidden[name=brand_id]').val(brand_id);
	$(':hidden[name=cat_id]').val(cat_id);
	$(':hidden[name=price_start]').val($('input[name=price_start_text]').val());
	$(':hidden[name=price_end]').val($('input[name=price_end_text]').val());
	getCatGoods();
	//$(".shaixuan_pos dl").find('dd.this').removeClass('this');
	$('.shaixuan_pos').css({"display":"none"});
});
$('.container dl').on('click','dt',function(event){
	if($(event.delegateTarget).height() != 110){
			$(event.delegateTarget).css({'height':'110px'});		
	}else{
		$(event.delegateTarget).css({'height':'auto'});
		if($(event.delegateTarget).height()<110){
			$(event.delegateTarget).css({'height':'110px'});
		}		
	}
});
</script>
<!-- 20151221 弹层 E-->
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