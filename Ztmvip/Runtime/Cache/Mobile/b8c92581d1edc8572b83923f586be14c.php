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
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/order_mobile.css" media="(max-width:750px)" />
    <link rel="stylesheet" type="text/css" href="/Public/Mobile/Css/order_pad.css" media="(min-width:750px)">
    <style type="text/css">
          a{

          }
    </style>
</head>
<body>
<!-- 网站头部 -->
<div class="head_box">
    <div class="head">
        我的订单
        <a class="return" href="<?php echo U('User/index');?>"><img src="/Public/Mobile/Images/fh.jpg" height="37" width="18" alt="" /></a>
    </div>
    <div class="columns_box" id="js-columns" data-rel="<?php echo ($_GET['state']); ?>">
        <div class="columns_in cur" data-rel="new">
            <div class="columns">待付款</div>
        </div>
        <div class="columns_in" data-rel="payed">
            <div class="columns">待发货</div>
        </div>
        <div class="columns_in" data-rel="send">
            <div class="columns">待收货</div>
        </div>
        <div class="columns_in" data-rel="receive">
            <div class="columns">待评价</div>
        </div>
        <div class="columns_in" data-rel="refund">
            <div class="columns">退款/售后</div>
        </div>
    </div>
</div>
<!-- 内容 -->
<div class="content js-content">
    <!-- 待付款 -->
    <div class="goods_bbox goods_one acc">
        <!-- 订单 -->
        <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods_box" data-rel="<?php echo ($vo['id']); ?>">
                <?php if(is_array($vo['goods'])): $i = 0; $__LIST__ = $vo['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="goods_in">
                        <div class="goods_photo">
                            <a href="<?php echo U('Goods/detail','goods_id='.$v['goods_id']);?>">
                                <img src="<?php echo ($v['goods_thumb']); ?>_250x250.jpg" alt="" />
                            </a>
                        </div>
                        <div class="goods_inf">
                            <a class="title" href="<?php echo U('Order/detail','order_id='.$vo['id']);?>"><?php echo ($v['goods_name']); ?></a>
                            <div class="price">
                                ￥<i><?php echo ($v['goods_price']); ?></i>
                                <div class="left">x<?php echo ($v['goods_number']); ?></div>
                            </div>
                            <div class="inf_other"><?php
 if ( $v['different'] == 'new' ){ $v['skus'] = json_decode($v['skus'],true); foreach ( $v['skus'] as $skus ){ echo $skus[0] .'：'. $skus[1] .' '; } }else{ echo $v['skus']; } ?></div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="bt_box">
                    <!--<div class="bt one js-delete">删 除</div>-->
                    <a class="bt two" href="<?php echo U('Center/checkout','order_id='.$vo['id']);?>">去付款</a>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 待发货 -->
    <div class="goods_bbox goods_two"></div>
    <!-- 代收货 -->
    <div class="goods_bbox goods_three"></div>
    <!-- 待评价 -->
    <div class="goods_bbox goods_four"></div>
    <!-- 退货售后 -->
    <div class="goods_bbox goods_five"></div>
</div>
<script>
    // 切换类型
    $('#js-columns .columns_in').on('click',function(event) {
        var tpl_box = '<div class="goods_box" data-rel="{order_id}">{goods}{btn}</div>';
        var tpl_goods = '<div class="goods_in">' +
                '<div class="goods_photo">' +
                '<a href="<?php echo U("Goods/detail");?>?goods_id={goods_id}">' +
                '<img src="{goods_thumb}_250x250.jpg" alt="" />' +
                '</a>' +
                '</div>' +
                '<div class="goods_inf">' +
                '<a class="title" href="<?php echo U("Order/detail");?>?order_id={order_id}">{goods_name}</a>' +
                '<div class="price">' +
                '￥<i>{goods_price}</i>' +
                '<div class="left">x{goods_number}</div>' +
                '</div>' +
                '<div class="inf_other">{skus}</div>' +
                '</div>' +
                '</div>';
        var tpl_btn = {
            'new':'<div class="bt_box">' +
            '<div class="bt one js-delete">删 除</div>' +
            '<a class="bt two" href="<?php echo U("Center/checkout");?>?order_id={order_id}">去付款</a>' +
            '</div>',
            'payed':'<div class="bt_box">' +
            '<div class="three js-send" data-rel="{order_sn}">提醒发货</div>' +
            '</div>' +
            '<div class="order_inf">订单号：{order_sn} <br />成交时间：{date_pay}</div>',
            'send':'<div class="bt_box">' +
            '<a class="bt one" href="<?php echo U("order/express");?>?order_id={order_id}">查看物流</a>' +
            '<div class="bt two js-receive">确认收货</div>' +
            '</div>',
            'receive':'<div class="bt_box">' +
            '<a class="bt one" href="<?php echo U("Order/refund");?>?order_id={order_id}">申请售后</a>' +
            '<a class="bt two" href="<?php echo U("Order/comment");?>?order_id={order_id}">评价商品</a>' +
            '</div>',
            'refund':'<div class="bt_box">' +
            '<div class="bt three">售后中</div>' +
            '</div>',
            'refunded':'<div class="bt_box">' +
            '<div class="bt three">已退款</div>' +
            '</div>',
            'finish':'<div class="bt_box">' +
            '<div class="bt three">已完成</div>' +
            '</div>'
        };
        var index = $(this).index();
        var state = $(this).attr('data-rel');
        $(this).addClass('cur').siblings().removeClass('cur');

        $.post("<?php echo U('User/order');?>",{ 'state':state },function(ret){
            var box = $('.goods_bbox').eq(index);
            var content = '';
            box.addClass('acc').siblings().removeClass('acc');

            if (ret && ret.length){
                $.each(ret,function(i,e){
                    var goods = '';
                    $.each(e.goods,function(j,k){
                        try{
                            if (k.different == 'new' && k.skus){
                                k.skus = $.parseJSON(k.skus);
                                var skus = '';
                                $.each(k.skus,function(l,m){
                                    skus += m[0] +'：'+ m[1] +' ';
                                });
                                k.skus = skus;
                            }
                        }catch(e){};
                        goods += Core.FormatTpl(tpl_goods,{
                            'order_id':e.id,
                            'goods_id':k.goods_id,
                            'goods_thumb':k.goods_thumb,
                            'goods_name':k.goods_name,
                            'goods_price':k.goods_price,
                            'goods_number':k.goods_number,
                            'skus':k.skus
                        });
                    });

                    var tpl_btn_type = state;
                    if (state == 'refund'){
                        if (e.order_state == 'refunded')
                            tpl_btn_type = 'refunded';
                        else if (e.order_state == 'finish')
                            tpl_btn_type = 'finish';
                    }

                    content += Core.FormatTpl(tpl_box,{
                        'order_id':e.id,
                        'goods':goods,
                        'btn':Core.FormatTpl(tpl_btn[tpl_btn_type],{ 'order_id':e.id,'order_sn':e.order_sn,'date_pay':Core.FormatDate('Y-m-d H:i',e.date_pay*1000) })
                    });
                });
            }

            $('.js-content .goods_bbox').hide().eq(index).html(content).show();
        },'json');
    });

    $('.js-content').on('click','.js-delete',function(event){ //删除订单
        var el = $(this);

        $.post("<?php echo U('Order/delete');?>",{ 'order_id':el.closest('.goods_box').attr('data-rel') },function(ret){
            if (ret.state)
                el.closest('.goods_box').remove();
            else
                Core.Alert({ 'text':ret.message,'state':'err' });
        },'json');
    }).on('click','.js-send',function(){ //提醒发货
        $.post("<?php echo U('Treatment/phpMail');?>",{ 'order_sn':$(this).attr('data-rel') },function(ret){
            if(ret.error == 8)
                Core.Alert({ 'text':'发货提醒成功' });
            else if(ret.error == 4)
                Core.Alert({ 'text':'服务器繁忙...','state':'notic' });
            else if(ret.error == 'pass')
                Core.Alert({ 'text':'您的提醒我们已经收到了，整体美商城会尽快帮您发货' });
        });
    }).on('click','.js-receive',function(){ //确认收货
        var el = $(this);
        if (el.attr('disabled'))
            return;

        $.post("<?php echo U('Order/state');?>",{ 'order_id':el.closest('.goods_box').attr('data-rel'),'state':'receive' },function(ret){
            if (ret.state)
                el.css('background-color','#c9c9c9').attr('disabled','disabled').html('已收货');
            else
                Core.Alert({ 'text':ret.message,'state':'err' });
        },'json');
    }).on('click','.js-finish',function(){
        var el = $(this);
        if (el.attr('disabled'))
            return;

        $.post("<?php echo U('Order/state');?>",{ 'order_id':el.closest('.goods_box').attr('data-rel'),'state':'finish' },function(ret){
            if (ret.state){
                Core.Alert({ 'text':ret.message });
                el.css('background-color','#c9c9c9').attr('disabled','disabled').html('已完成');
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });

    if ($('#js-columns').attr('data-rel'))
        $('#js-columns [data-rel="'+$('#js-columns').attr('data-rel')+'"]').click();
    $('.columns_in').on('click',function(e) {            
        $('html,body').animate({scrollTop:0},0)
    });
</script>
<!-- 版权 -->

      <div class="copyright" style="color:#6d6d6d">
          &copy整体美商城<br />
          客服电话：400-777-1225<br />
          客服微信：HRlianna
      </div>
      <div class="placeholder"></div> 

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