<?php if (!defined('THINK_PATH')) exit();?>
<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li>
        <a href="<?php echo U('Goods/detail',array('goods_id'=>$value['id']));?>">
            <div class="img">
                <img class="lazy" data-original="<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" src="/Public/Mobile/Images/lastbg.jpg" alt="" />
            </div>
            <div class="text">
                <h2>
                    <span class="span1"><i>￥<?php echo ($value["shop_price"]); ?></i></span>
                    <span class="span2">￥<?php echo ($value["market_price"]); ?></span>
                    <!-- <span class="span3">8.8折</span> -->
                </h2>
                <p><?php echo (subtext($value["goods_name"],14)); ?></p>
            </div>
        </a>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>