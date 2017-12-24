<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的优惠券</p>
<ul class="xuanzhe">
    <li class="li1"><a href="javascript:;" class="this">未使用(<?php echo ($coupon_count['new']); ?>)</a></li>
    <li class="li2"><a href="javascript:;">已使用(<?php echo ($coupon_count['used']); ?>)</a></li>
    <li class="li3"><a href="javascript:;">已过期(<?php echo ($coupon_count['expired']); ?>)</a></li>
</ul>
<div class="coupon">
    <ul>

        <!-- 未使用红包3种样式 -->
        <?php if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $rand = mt_rand(1,3); ?>
        <li class="ajax_coupon<?php echo ($coupon_type); ?>_display" >
            <div class="coupon_1 coupon_<?php echo ($coupon_type); ?>_<?php echo ($rand); ?> ">
                <p class="p1">整体美优惠券</p>
                <p class="p2"><span><i><?php echo (sprintf('%d',$vo['coupon_money'])); ?></i>元</span><img src="/Public/Computer/Images/coupon_04.jpg" class="l" alt="" />满<?php echo (sprintf('%.2f',$vo['min_order_amount'])); ?>元可用<img src="/Public/Computer/Images/coupon_05.gif" class="r" alt="" /></p>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>


        <!-- 已使用红包3种样式 -->
        <!--<?php if(is_array($coupon_not_used)): $i = 0; $__LIST__ = $coupon_not_used;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $rand = mt_rand(1,3); ?>
        <li class="ajax_coupon2_display" style="display:none;">
            <div class="coupon_2 coupon_2_<?php echo ($rand); ?>">
                <p class="p1">整体美优惠券<span>已使用</span></p>
                <p class="p2"><span><i><?php echo (sprintf('%d',$vo['coupon_money'])); ?></i>元</span><img src="/Public/Computer/Images/coupon_04.jpg" class="l" alt="" />满<?php echo (sprintf('%.2f',$vo['min_order_amount'])); ?>元可用<img src="/Public/Computer/Images/coupon_05.gif" class="r" alt="" /></p>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>-->


        <!-- 过期红包3种样式 -->
        <!--<?php if(is_array($coupon_not_used)): $i = 0; $__LIST__ = $coupon_not_used;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $rand = mt_rand(1,3); ?>
        <li class="ajax_coupon3_display" style="display:none;">
            <div class="coupon_2 coupon_2_<?php echo ($rand); ?>">
                <p class="p1">整体美优惠券<span>已过期</span></p>
                <p class="p2"><span><i><?php echo (sprintf('%d',$vo['coupon_money'])); ?></i>元</span><img src="/Public/Computer/Images/coupon_04.jpg" class="l" alt="" />满<?php echo (sprintf('%.2f',$vo['min_order_amount'])); ?>元可用<img src="/Public/Computer/Images/coupon_05.gif" class="r" alt="" /></p>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>-->
    </ul>
</div>
<p class="text"><a href="" >红包使用说明>></a></p>