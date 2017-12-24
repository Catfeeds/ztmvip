<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">返利中心</p>
<dl class="con1">
    <dt><a href="javascript:;" class="a2">什么是返利？</a><a href="">查看佣金明细 >></a></dt>
    <dd><a href="javascript:;">累计实际提现佣金：￥<?php echo (sprintf('%.2f',$affiliate_count['withdraw_money']*-1)); ?></a></dd>
    <dd><a href="javascript:;">待审核提现佣金：￥<?php echo (sprintf('%.2f',$affiliate_count['wait_money']*-1)); ?></a></dd>
    <dd><a href="javascript:;">可提现佣金：￥<?php echo (sprintf('%.2f',$withdraw_money)); ?></a></dd>
    <dd><a href="javascript:;">累计分享次数：<?php echo count($affiliate_count['share']);?> 次</a></dd>
    <dd><a href="javascript:;">累计客户购买次数：<?php echo ($affiliate_count['sell']); ?> 次</a></dd>
</dl>
<dl class="con2">
    <dt>我的客户（<?php echo count($affiliate_count['users']);?>个）</dt>
    <div class="hidden js-scroll">
        <?php if(is_array($affiliate_user)): $i = 0; $__LIST__ = $affiliate_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd><div class="img"><img src="<?php echo ($vo["avatar"]); ?>" alt="" /></div><?php echo ($vo["user_name"]); ?></dd><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <script type="text/javascript">
        hidden_h =$('.index_right_nav').height()-344;
        $('.index_right_nav .right .rebate .con2 .hidden').height(hidden_h);
    </script>

</dl>
<ul class="con3">
    <li class="li1"><a href="">填写申请</a></li>
    <li class="li2"><a href="">转入余额</a></li>
</ul>