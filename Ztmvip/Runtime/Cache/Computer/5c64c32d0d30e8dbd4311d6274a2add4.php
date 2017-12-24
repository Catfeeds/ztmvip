<?php if (!defined('THINK_PATH')) exit();?>
    <p class="p_top">收货人信息
    <?php if(!empty($consignee_list)): ?><a href="javascript:;" onclick="add_address('N');">新增收货地址</a><?php endif; ?>
    </p>
  <?php if(empty($consignee_list)): ?><ul class="address cur">
        <li class="li1">未设置</li>
        <li class="li5"><a href="javascript:;" class="js-add_address" onclick="add_address('Y');">设置</a></li>
    </ul>
 <?php else: ?>
             <?php if(is_array($consignee_list)): $i = 0; $__LIST__ = $consignee_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><ul class="address <?php if(($value["id"]) == $consignee["address_id"]): ?>cur<?php endif; ?> <?php if(($value["is_default"]) == "Y"): ?>default<?php endif; ?>">
                   <li class="li1" onClick="choose_address(<?php echo ($value["id"]); ?>)"><?php echo ($value["consignee"]); ?>&nbsp;&nbsp;&nbsp;<?php echo ($value["province"]); ?></li>
                   <li class="li2"><?php echo ($value["consignee"]); ?>&nbsp;&nbsp;<?php echo ($value["province"]); ?>  <?php echo ($value["city"]); ?> <?php echo ($value["district"]); ?>  <?php echo ($value["address"]); ?>&nbsp;&nbsp;&nbsp;<?php echo ($value["mobiel"]); ?></li>
                   <li class="li3" onclick="make_default_address(<?php echo ($value["id"]); ?>)"><?php if(($value["is_default"]) == "Y"): ?>默认地址<?php endif; ?>设置默认</li>
                   <li class="li4"><a href="javascript:;" onClick="editor_address(<?php echo ($value["id"]); ?>)">编辑</a></li>
                   <li class="li6" onclick="delete_address(<?php echo ($value["id"]); ?>)">删除</li>
               </ul><?php endforeach; endif; else: echo "" ;endif; ?>
           <?php if(!empty($consignee_list[1])): if(($less) == "1"): ?><p class="gengduo_block gengduo_block1" onclick="more_or_less(this)">收起地址</p>
              <?php else: ?>
               <p class="gengduo_block" onclick="more_or_less(this)">更多地址</p><?php endif; endif; endif; ?>