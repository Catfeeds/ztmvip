<?php if (!defined('THINK_PATH')) exit();?>
<div class="con">
    <form action="">
        <div class="alert_top">新增收货人信息<div class="img js-false"><img src="/Public/Computer/Images/shopping_alert_04.png" alt="" /></div></div>
        <ul>
            <li class="li1 js-name">
                <span><i>*</i>收货人：</span>
                <input type="text" name="consignee" />
                <p>请您填写收货人姓名</p>
            </li>
            <li class="li2">
                <span><i>*</i>所在地区：</span>
                <select name="province" onChange="change_province(this)">
                    <option>请选择</option>
                    <?php if(is_array($province_list)): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($value["region_id"]); ?>"><?php echo ($value["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="city" onChange="change_city(this)">
                    <option>请选择</option>
                </select>
                <select name="district" onchange="change_district(this)">
                    <option>请选择</option>
                </select>
                <p>请您填写完整的地区信息</p>
            </li>
            <li class="li3 js-address">
                <span><i>*</i>详细地址：</span>
                <input type="text" name="address" />
                <p>请您填写收货人详细地址</p>
            </li>
            <li  class="li4 js-phone">
                <span><i>*</i>手机号码：</span>
                <input type="text" maxlength="11" name="mobile" />
                <p>请您填写收货人手机号码</p>
            </li>
            <li  class="li5">
             <?php if(($default) == "Y"): ?><button type="button" onclick="do_add_consignee('Y')">保存收货人信息</button>
             <?php else: ?>
                 <button type="button" onclick="do_add_consignee('N')">保存收货人信息</button><?php endif; ?>
          
            </li>
        </ul>
    </form>
    <script type="text/javascript">
    $('.js-name input').on('blur', function() {
        var name=$(this).val();
        if(name==""){
            $('.js-name p').show();
        }else{
            $('.js-name p').hide();
        }
    });
    $('.js-address input').on('blur',function(){
        var address=$(this).val();
        if(address==""){
            $('.js-address p').show();
        }else{
            $('.js-address p').hide();
        }        
    });
    $('.js-phone input').on('blur',function  () {
        var phone=$(this).val();
        var p=$('.js-phone p');
        var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
        if(!reg.test(phone)){
            p.text("请填入正确的收货人手机号码").show();
        }else{
            p.hide();
        }
    });

    $('.js-false').on('click',function(){
        $('.shopping_alert').fadeOut();
    });
    $('.shopping_alert .con').on('click', function() {
        return false; 
    });

    </script>
</div>