<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的储值卡</p>

<div class="con">
    <ul>
        <?php if(is_array($prepaid)): $i = 0; $__LIST__ = $prepaid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><p><?php echo ($vo['prepaid_sn']); ?></p></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

    <script type="text/javascript">
        $('.index_right_nav .right .save .con ul').height($('.index_right_nav').height()-49);
    </script>
</div>