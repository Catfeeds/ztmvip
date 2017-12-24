<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的购物车</p>
<div class="con">
    <ul class="js-scroll">
        <?php if(is_array($cart_list)): $key1 = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key1 % 2 );++$key1;?><li>
            <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>" alt="" /></div>
            <p class="p1"><?php echo ($value["goods_name"]); ?></p>
            <?php if($value[goods_attr][0][0]): ?><p class="p2">
                <?php echo ($value[goods_attr][0][0]); ?>:<?php echo ($value[goods_attr][0][1]); ?>
                </p><?php endif; ?>
            <?php if($value[goods_attr][1][0]): ?><p class="p3">
                <?php echo ($value[goods_attr][1][0]); ?>:<?php echo ($value[goods_attr][1][1]); ?>
            </p><?php endif; ?>
            <p class="p4"><span>￥<i><?php echo ($value["goods_price"]); ?></i></span> ×<input type="text" value="<?php echo ($value["goods_number"]); ?>" /><button type="button">删除</button></p>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <script type="text/javascript">
        var trade_ul_h=$('.index_right_nav').height()-115;
        $('.index_right_nav .right .trade .con ul').height(trade_ul_h);
    </script>
</div>
<div class ="bottom">合计：￥<?php if($total['goods_price'] != ''): echo ($total["goods_price"]); else: ?>0<?php endif; ?> <a href="<?php echo U('Cart/cart');?>">去购物车结算</a></div>