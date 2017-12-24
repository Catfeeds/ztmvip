<?php if (!defined('THINK_PATH')) exit();?> 
 <div class="pay_box">
     <div class="pay_title">付款详情
         <div class="cancel cantwo">取 消</div>
     </div>
     <div class="pay_in">
         <div class="left">支付方式</div>
         <div class="right"><?php echo ($pay_name); ?></div>
     </div>
     <div class="pay_in">
         <div class="left">商品金额</div>
         <div class="right">￥<?php echo ($total["goods_price"]); ?></div>
     </div>
 <!-- 邮费 -->
 <?php if(($total["shipping_fee"]) > "0"): ?><div class="pay_in">
         <div class="left">邮费</div>
         <div class="right">+￥<?php echo ($total["shipping_fee"]); ?></div>
     </div><?php endif; ?>
 <!-- 积分 -->
 <?php if(($total["integral_amount"]) > "0"): ?><div class="pay_in">
         <div class="left">积分</div>
         <div class="right">-￥<span id="integral_amount"><?php echo ((isset($total["integral_amount"]) && ($total["integral_amount"] !== ""))?($total["integral_amount"]):0); ?></span></div>
     </div>
    <?php else: ?>
       <span style="display:none;" id="integral_amount">0</span><?php endif; ?>
 <!-- 红包 -->
 <?php if(($total["bonus_amount"]) > "0"): ?><div class="pay_in">
         <div class="left">红包</div>
         <div class="right">-￥<?php echo ((isset($total["bonus_amount"]) && ($total["bonus_amount"] !== ""))?($total["bonus_amount"]):0); ?></div>
     </div><?php endif; ?>
     <!-- 优惠券 -->
 <?php if(($total["coupon_amount"]) > "0"): ?><div class="pay_in">
         <div class="left">优惠券</div>
         <div class="right">-￥<?php echo ((isset($total["coupon_amount"]) && ($total["coupon_amount"] !== ""))?($total["coupon_amount"]):0); ?></div>
     </div><?php endif; ?>
     <div class="pay_in not">
         <div class="left">需付款</div>
         <div class="right"><?php echo ($total["amount"]); ?>元</div>
     </div>

     <?php switch($flag_buy): case "cart": ?><div class="confirm_box">
                 <div class="confirm" onclick="location.href='<?php echo U('Flow/wxDone');?>'"
              style="background:#4DBA49">微信安全支付</div>
             </div><?php break;?>
         <?php case "quick": ?><div class="confirm_box">
                 <div class="confirm" onclick="location.href='<?php echo U('Flow/quick_wxDone');?>'"
              style="background:#4DBA49">微信安全支付</div>
             </div><?php break;?>
         <?php case "center": ?><div class="confirm_box">
                 <div class="confirm" onclick="location.href='<?php echo U('Flow/center_wxDone','order_id='.$order_id);?>'"
              style="background:#4DBA49">微信安全支付</div>
             </div><?php break; endswitch;?>
 
     
 </div>