<?php if (!defined('THINK_PATH')) exit();?>
<option>请选择</option>
  <?php if(is_array($district_list)): $i = 0; $__LIST__ = $district_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($value["region_id"]); ?>"><?php echo ($value["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>