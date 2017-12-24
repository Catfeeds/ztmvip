<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的红包</p>
<ul class="xuanzhe">
    <li class="li1"><a href="javascript:;" class="this">未使用(<?php echo ($bount_count['new']); ?>)</a></li>
    <li class="li2"><a href="javascript:;">已使用(<?php echo ($bount_count['used']); ?>)</a></li>
    <li class="li3"><a href="javascript:;">已过期(<?php echo ($bount_count['expired']); ?>)</a></li>
</ul>
<div class="con1">
    <ul>
        <!-- 未使用红包 -->
        <?php if(is_array($bonus)): $i = 0; $__LIST__ = $bonus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_hongbao<?php echo ($bonus_type); ?>_display">
            <div class="hongbao<?php echo ($bonus_type); ?>">
                <span><i><?php echo (sprintf('%d',$vo['money'])); ?></i>元</span>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>

        <!-- 已使用红包 -->
        <!--<?php if(is_array($bonus_used)): $i = 0; $__LIST__ = $bonus_used;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_hongbao<?php echo ($bonus_type); ?>_display" style="display:none;">
            <div class="hongbao<?php echo ($bonus_type); ?>">
                <span><i><?php echo (sprintf('%d',$vo['money'])); ?></i>元</span>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>-->

        <!-- 已过期红包 -->
        <!--<?php if(is_array($bonus_expired)): $i = 0; $__LIST__ = $bonus_expired;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_hongbao<?php echo ($bonus_type); ?>_display" style="display:none;">
            <div class="hongbao3">
                <span><i><?php echo (sprintf('%d',$vo['money'])); ?></i>元</span>
            </div>
            <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>-->
    </ul>
</div>
<p class="text"><a href="" >红包使用说明>></a></p>