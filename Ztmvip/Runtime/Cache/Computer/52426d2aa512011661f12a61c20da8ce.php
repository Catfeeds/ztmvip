<?php if (!defined('THINK_PATH')) exit();?>
<?php if(is_array($bonus)): $i = 0; $__LIST__ = $bonus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_hongbao<?php echo ($bonus_type); ?>_display">
        <div class="hongbao<?php echo ($bonus_type); ?>">
            <span><i><?php echo (sprintf('%d',$vo['money'])); ?></i>元</span>
        </div>
        <p class="date"><?php echo (date('Y-m-d',$vo['use_start'])); ?> —— <?php echo (date('Y-m-d',$vo['use_end'])); ?></p>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>