<?php if (!defined('THINK_PATH')) exit();?>
<span class="top_false"></span><p class="title">我的余额</p>
<ul class="xuanzhe">
    <li class="li1"><a href="javascript:;">充值记录</a></li>
    <li class="li2"><a href="javascript:;" class="on_click">提现记录</a></li>
</ul>
<dl class="con1">
    <div class="hidden js-scroll">
        <?php if(is_array($account)): $i = 0; $__LIST__ = $account;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd><?php if($_POST['state']== 'withdraw'): ?>提现<?php else: ?>充值<?php endif; ?>金额：<?php echo (round(abs($vo['amount']),2)); ?>元<span><?php echo (date('Y.m.d',$vo['date_add'])); ?></span></dd><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <script type="text/javascript">
        var recharge_hidden_h =$('.index_right_nav').height()-172;
        $('.index_right_nav .right .recharge .con1 .hidden').height(recharge_hidden_h);
    </script>
</dl>
<div class="balance">我的余额：￥<?php echo (sprintf('%.2f',$user_money)); ?></div>
<ul class="bottom">
    <li class="li1"><a href="<?php echo U('Account/withdraw');?>">申请提现</a></li>
    <li class="li2"><a href="<?php echo U('Account/deposit');?>">充值</a></li>
</ul>