<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的收藏</p>
<ul class="xuanzhe">
    <li class="li1"><a href="javascript:;">商品收藏</a></li>
    <li class="li2"><a href="javascript:;" class="on_click">文章收藏</a></li>
</ul>
<div class="con">
    <ul>
        <?php if(!$favor_type): if(is_array($favor)): $i = 0; $__LIST__ = $favor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_li1">
                <div class="img"><img src="<?php echo ($vo['goods_thumb']); ?>_360x440.jpg" alt="" /></div>
                <p class="p1"><?php echo ($vo['goods_name']); ?></p>
                <p class="p2"><span>￥</span><?php echo ($vo['shop_price']==intval($vo['shop_price'])?intval($vo['shop_price']):$vo['shop_price']);?></p>
                <p class="p3">删除</p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
            <?php if(is_array($favor)): $i = 0; $__LIST__ = $favor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ajax_li2" style="display:none;">
                <div class="img"><img src="<?php echo ($vo['article_thumb']); ?>" alt="" /></div>
                <p class="p1"><?php echo ($vo['title']); ?></p>
                <p class="p2"></p>
                <p class="p3">删除</p>
            </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul>
</div>