<?php if (!defined('THINK_PATH')) exit();?> 

 <li><i><?php echo ($go_number); ?></i> 件商品，总商品金额：<span>¥<?php echo ($total["goods_price"]); ?></span></li>
 <?php if(($total["shipping_fee"]) > "0"): ?><li>运费：<span>¥<?php echo ($total["shipping_fee"]); ?></span></li><?php endif; ?>
 <?php if(($total["coupon_amount"]) > "0"): ?><li>使用优惠券：<span>-¥<?php echo ($total["coupon_amount"]); ?></span></li><?php endif; ?>
<?php if(($total["bonus_amount"]) > "0"): ?><li>使用红包：<span>-¥<?php echo ($total["bonus_amount"]); ?></span></li><?php endif; ?>
<?php if(($total["integral_amount"]) > "0"): ?><li>使用积分（<em id="use_integral"><?php echo ($total["integral"]); ?></em>）：<span>-¥<?php echo ((isset($total["integral_amount"]) && ($total["integral_amount"] !== ""))?($total["integral_amount"]):0); ?></span></li><?php endif; ?>

 <li>应付总额：<span>¥<?php echo ($total["amount"]); ?></span></li>