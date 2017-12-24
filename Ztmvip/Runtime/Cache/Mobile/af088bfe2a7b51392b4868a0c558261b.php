<?php if (!defined('THINK_PATH')) exit();?>
<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="goods">
        <a href="<?php echo U('Goods/detail',array('goods_id'=>$value['id']),'');?>">
            <div class="goods_photo"><img class="lazy" data-original="<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" /></div>
            <div class="price">
                <div class="now_price">￥<i><?php echo ($value["shop_price"]); ?></i></div>&nbsp;
                <div class="past_price">￥<?php echo (intval($value["market_price"])); ?></div>
                <!-- <div class="mark">8.8折</div> -->
            </div>
            <div class="inf"><?php echo (subtext($value["goods_name"],14)); ?></div>
        </a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>