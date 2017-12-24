<?php if (!defined('THINK_PATH')) exit(); if(!empty($goods)): if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="goods">
    <a href="<?php echo U('Goods/detail',array('goods_id'=>$val['id']));?>">
        <div class="li"><img class="lazy" data-original="<?php echo ($val["goods_thumb"]); ?>_360x440.jpg" src="/Public/Mobile/Images/lastbg.jpg" />
        <p class="p1">￥<?php echo ($val["shop_price"]); ?></p>
        <p class="p2"><?php echo ($val["goods_name"]); ?></p>
        </div>
    </a>
</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>