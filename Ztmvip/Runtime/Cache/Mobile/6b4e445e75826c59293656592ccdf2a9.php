<?php if (!defined('THINK_PATH')) exit(); if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="classify_content">
<div class="classify_title"><span><?php echo ($val["cat_name"]); ?></span></div>
<ul>
    <?php if(is_array($val["cat_id"])): $i = 0; $__LIST__ = $val["cat_id"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Category/catDetail',array('cat_id'=>$v['id']));?>"><img  class="lazy" data-original="<?php echo ($v["cat_logo"]); ?>" src="/Public/Mobile/Images/lastbg.jpg" />
        <p><?php echo ($v["cat_name"]); ?></p></a>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>