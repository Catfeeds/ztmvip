<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo ($page_title); ?>-<?php echo ($sitename); ?></title>
    <link rel="sgortcut icon" href="/Public/Admin/Images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/Images/common.css" />
    <script src="/Public/Common/Js/jquery.js"></script>
    <script src="/Public/Common/Js/common.js"></script>
    <script src="/Public/Admin/Js/common.js"></script>
</head>
<body>
<!-- 网站头部 -->
<header class="nav">
    <div class="logo"><img src="/Public/Admin/Images/logo.png" height="50"/></div>
    <div class="nav_in">
        <ul class="left">
            <li class="cur1"><span class="iconfont cur2">&#xe607;</span><a href="<?php echo U('Index/index');?>">起始</a></li>
            <li><span class="iconfont">&#xe7c2;</span><a href="<?php echo U('Goods/index');?>">商品管理</a></li>
            <li><span class="iconfont">&#xe63d;</span><a href="<?php echo U('Order/index');?>">订单管理</a></li>
        </ul>
        <ul class="right">
            <li class="user"><span class="iconfont">&#xe7a4;</span>&nbsp;<?php echo ($manager_nick); ?></li>
            <li><a href="http://www<?php echo strstr($_SERVER['HTTP_HOST'],'.');?>" target="_blank">查看网店</a></li>
            <li><a class="js-ajax" href="<?php echo U('Index/clean');?>">清除缓存</a></li>
            <li><a href="<?php echo U('Login/out');?>">退出</a></li>
        </ul>
    </div>
</header>
<!-- 左侧列表 -->
<aside class="aside">
    <dl class="list">
        <dd index="0"><span class="iconfont2">&#xe7c2;</span>&nbsp;&nbsp;商品管理</dd>
        <?php if(check_admin_rights('goods',false)): ?><dt><a href="<?php echo U('Goods/index');?>">商品列表</a></dt>
        <dt><a href="<?php echo U('Goods/index','new=Y');?>">新品首发</a></dt>
        <dt><a href="<?php echo U('Goods/index','hot=Y');?>">特卖专区</a></dt><?php endif; ?>
        <?php if(check_admin_rights('goods_sku',false)): ?><dt><a href="<?php echo U('GoodsSku/index');?>">商品类型</a></dt><?php endif; ?>
        <?php if(check_admin_rights('goods_category',false)): ?><dt><a href="<?php echo U('GoodsCategory/index');?>">商品分类</a></dt><?php endif; ?>
        <?php if(check_admin_rights('goods_brand',false)): ?><dt><a href="<?php echo U('GoodsBrand/index');?>">商品品牌</a></dt><?php endif; ?>
        <?php if(check_admin_rights('goods_express',false)): ?><dt><a href="<?php echo U('GoodsExpress/index');?>">商品运费</a></dt><?php endif; ?>
    </dl>

    <dl class="list">
        <dd index="7"><span class="iconfont2">&#xe61f;</span>&nbsp;&nbsp;优惠管理</dd>
        <?php if(check_admin_rights('seckill',false)): ?><dt><a href="<?php echo U('Seckill/index');?>">秒杀专区</a></dt><?php endif; ?>
        <?php if(check_admin_rights('bargain',false)): ?><dt><a href="<?php echo U('Bargain/index');?>">砍价专区</a></dt><?php endif; ?>
    </dl>

    <dl class="list">
        <dd index="1"><span class="iconfont2">&#xe63d;</span>&nbsp;&nbsp;订单管理</dd>
        <?php if(check_admin_rights('order',false)): ?><dt><a href="<?php echo U('Order/index');?>">订单记录</a></dt>
            <dt><a href="<?php echo U('Order/index','shop=ztm');?>">商城订单</a></dt>
            <dt><a href="<?php echo U('Order/index','shop=shop');?>">店铺订单</a></dt><?php endif; ?>
    </dl>

    <dl class="list">
        <dd index="4"><span class="iconfont2">&#xe628;</span>&nbsp;&nbsp;会员管理</dd>
        <?php if(check_admin_rights('user',false)): ?><dt><a href="<?php echo U('User/index');?>">会员列表</a></dt><?php endif; ?>
        <!--<dt><a href="<?php echo U('UserLevel/index');?>">会员等级</a></dt>-->
        <?php if(check_admin_rights('affiliate',false)): ?><dt><a href="<?php echo U('Affiliate/index');?>">分佣记录</a></dt><?php endif; ?>
    </dl>

    <dl class="list">
        <dd index="10"><span class="iconfont2">&#xe7c2;</span>&nbsp;&nbsp;店铺管理</dd>
        <?php if(check_admin_rights('shop',false)): ?><dt><a href="<?php echo U('Shop/index');?>">店铺列表</a></dt>
            <dt><a href="<?php echo U('Goods/shop');?>">店铺商品</a></dt>
            <dt><a href="<?php echo U('ShopType/index');?>">店铺类型</a></dt><?php endif; ?>
    </dl>

    <dl class="list">
        <dd index="9"><span class="iconfont2">&#xe628;</span>&nbsp;&nbsp;卡券管理</dd>
        <?php if(check_admin_rights('bonus',false)): ?><dt><a href="<?php echo U('Bonus/index');?>">红包</a></dt><?php endif; ?>
        <?php if(check_admin_rights('coupon',false)): ?><dt><a href="<?php echo U('Coupon/index');?>">优惠券</a></dt><?php endif; ?>
        <?php if(check_admin_rights('prepaid',false)): ?><dt><a href="<?php echo U('Prepaid/index');?>">储值卡</a></dt><?php endif; ?>
    </dl>

    <?php if(check_admin_rights('account',false)): ?><dl class="list">
        <dd index="8"><span class="iconfont2">&#xe61f;</span>&nbsp;&nbsp;财务管理</dd>
        <dt><a href="<?php echo U('Account/withdrawLog');?>">提现记录</a></dt>
        <dt><a href="<?php echo U('Account/depositLog');?>">充值记录</a></dt>
        <dt><a href="<?php echo U('Account/index');?>">资金明细</a></dt>
    </dl><?php endif; ?>

    <?php if(check_admin_rights('advert',false)): ?><dl class="list">
        <dd index="2"><span class="iconfont2">&#xe664;</span>&nbsp;&nbsp;广告管理</dd>
        <dt><a href="<?php echo U('Advert/indexBanner');?>">首页Banner</a></dt>
        <dt><a href="<?php echo U('Advert/indexFashion');?>">首页潮流趋势</a></dt>
        <dt><a href="<?php echo U('Advert/newStarting');?>">新品首发</a></dt>
        <dt><a href="<?php echo U('Advert/specialBuy');?>">特卖专区</a></dt>
        <dt><a href="<?php echo U('Advert/brandPavilion');?>">品牌馆</a></dt>
    </dl><?php endif; ?>

    <dl class="list">
        <dd index="3"><span class="iconfont2">&#xe61e;</span>&nbsp;&nbsp;文章管理</dd>
        <?php if(check_admin_rights('article',false)): ?><dt><a href="<?php echo U('Article/index');?>">文章列表</a></dt><?php endif; ?>
        <?php if(check_admin_rights('article_topic',false)): ?><dt><a href="<?php echo U('ArticleTopic/index');?>">文章分类</a></dt><?php endif; ?>
    </dl>

    <?php if(check_admin_rights('admin',false)): ?><dl class="list">
        <dd index="5"><span class="iconfont2">&#xe642;</span>&nbsp;&nbsp;系统管理</dd>
        <dt><a href="<?php echo U('Index/config');?>">基础配置</a></dt>
    </dl>
    <dl class="list">
        <dd index="6"><span class="iconfont2">&#xe64e;</span>&nbsp;&nbsp;权限管理</dd>
        <dt><a href="<?php echo U('ManagerDepart/index');?>">管理部门</a></dt>
        <dt><a href="<?php echo U('ManagerGroup/index');?>">管理组</a></dt>
        <dt><a href="<?php echo U('Manager/index');?>">管理员</a></dt>
    </dl><?php endif; ?>
</aside>
<article class="article">
<div class="art-nav">
    <h2><?php echo ($page_title); ?></h2>
    <span class="right">
        <a class="button" href="<?php echo U('index');?>">返 回</a>
    </span>
</div>
<form class="js-edit">
    <table class="tbl" width="100%">
        <tbody>
        <tr>
            <td class="label">红包名称</td>
            <td><input name="bonus_name" class="text" type="text" value="<?php echo ($edit['bonus_name']); ?>" required="required" placeholder="请输入红包名称..."></td>
        </tr>
        <tr <?php if($send_count): ?>style="display:none;"<?php endif; ?>>
            <td class="label">红包金额</td>
            <td><input name="bonus_money" class="text" type="text" value="<?php echo ($edit['bonus_money']); ?>" required="required" placeholder="请输入红包金额..."></td>
        </tr>
        <tr <?php if($send_count): ?>style="display:none;"<?php endif; ?>>
            <td class="label">发放类型</td>
            <td>
                
                <input type="radio" name="send_type" value="user">按会员发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="goods">按商品发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="amount">按订单金额发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="register">注册发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="referee">按推荐发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="share">分享商品发放&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="other">其他发放&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <tr class="js-user-id" style="display:none;">
            <td class="label">用户筛选</td>
            <td>
                <input class="text js-user-search" type="text" placeholder="用户名称...">
                <input class="text js-wechat-search" type="text" placeholder="微信用户...">
            </td>
        </tr>
        <tr class="js-user-id" style="display:none;">
            <td class="label"></td>
            <td>
                <select name="user_id" class="select js-user-search-result" multiple style="min-width:300px; min-height:200px;"></select>
            </td>
        </tr>
        <tr class="js-amount-id" style="display:none;">
            <td class="label">订单金额</td>
            <td>
                <input name="min_amount" class="text" type="text" value="<?php echo ($edit['min_amount']); ?>" placeholder="请输入订单金额下线..." style="min-width:120px;width:120px;"> -
                <input name="max_amount" class="text" type="text" value="<?php echo ($edit['max_amount']); ?>" placeholder="请输入订单金额上线..." style="min-width:120px;width:120px;">
            </td>
        </tr>
        <tr class="js-goods-id" style="display:none;">
            <td class="label">商品筛选</td>
            <td>
                <select class="select js-goods-category js-goods-category-id" _name="">
                    <option value="">—请选择—</option>
                    <?php if(is_array($goods_category)): $i = 0; $__LIST__ = $goods_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['category_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                
                <select id="" name="" onchange="" ondblclick="" class="select js-goods-brand-id" ><option value="" >—请选择—</option><?php  foreach($goods_brand as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
                <input class="text js-goods-search" type="text" placeholder="商品名称...">
            </td>
        </tr>
        <tr class="js-goods-id" style="display:none;">
            <td class="label"></td>
            <td>
                <select name="goods_id" class="select js-goods-search-result" data-rel="<?php echo ($edit['goods_id']); ?>" multiple style="min-width:300px; min-height:200px;"></select>
            </td>
        </tr>
        <tr>
            <td class="label">起用金额</td>
            <td><input name="min_order_amount" class="text" type="text" value="<?php echo ($edit['min_order_amount']); ?>" required="required" placeholder="请输入金额下限..."></td>
        </tr>
        <tr>
            <td class="label">发放时间</td>
            <td>
                <input name="send_start" class="text js-time" type="text" value="<?php echo (date('Y-m-d H:i',$edit['send_start']?:time())); ?>" required="required" placeholder="请输入开始发放时间..." style="min-width:120px;width:120px;"> -
                <input name="send_end" class="text js-time" type="text" value="<?php echo (date('Y-m-d H:i',$edit['send_end']?:time()+86400)); ?>" required="required" placeholder="请输入结束发放时间..." style="min-width:120px;width:120px;">
            </td>
        </tr>
        <tr>
            <td class="label">使用时间</td>
            <td>
                <input name="use_start" class="text js-time" type="text" value="<?php echo (date('Y-m-d H:i',$edit['use_start']?:time())); ?>" required="required" placeholder="请输入开始使用时间..." style="min-width:120px;width:120px;"> -
                <input name="use_end" class="text js-time" type="text" value="<?php echo (date('Y-m-d H:i',$edit['use_end']?:time()+86400)); ?>" required="required" placeholder="请输入结束使用时间..." style="min-width:120px;width:120px;">
            </td>
        </tr>
        <tr>
            <td class="label"></td>
            <td><button type="submit" class="submit">提 交</button></td>
        </tr>
        </tbody>
    </table>
</form>
<link rel="stylesheet" type="text/css" href="/Public/Common/DateTimePicker/datetimepicker.css" />
<script src="/Public/Common/DateTimePicker/datetimepicker.js"></script>
<script>
    $('.js-edit').on('submit',function(event){
        var data = Core.InputObj(this);

        if (data['send_type'] == 'user'){
            data['user_id'] = [];
            $('.js-edit').find('select[name="user_id"] :selected').each(function(i,e){
                data['user_id'].push(e.value);
            });
        }

        $.post('',data,function(ret){
            if ( ret.state ){
                Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                    location.href = "<?php echo U('index');?>";
                } });
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');

        return false;
    });

    $('.js-time').datetimepicker({'format':'Y-m-d H:i'});

    $(':radio[name="send_type"]').on('change',function(){
        $('.js-user-id,.js-amount-id,.js-goods-id').hide();

        if ($.inArray(this.value,['user','amount','goods']) != -1){
            $('.js-'+this.value+'-id').show();
        }
    }).filter(':checked').change();

    /* --按用户、商品发放-- */
    var gsr = $('.js-goods-search-result');
    if (gsr.attr('data-rel') > 0){
        search_goods();
    }

    $('.js-goods-search').on('keypress change',function(event){
        if(event.keyCode == 13){
            event.preventDefault();
            search_goods();
        }
    });

    function search_goods(){
        var data = {
            'goods_id':gsr.attr('data-rel')?$.parseJSON(gsr.attr('data-rel')):'',
            'words':$('.js-goods-search').val(),
            'category_id':$('.js-goods-category-id[name]').val(),
            'brand_id':$('.js-goods-brand-id').val()
        };

        gsr.attr('data-rel','');

        $.post("<?php echo U('Goods/search');?>",data,function(ret){
            if (!ret)
                return;

            var tpl = '<option value="{value}">{text}</option>';
            var html = '';

            $.each(ret,function(i,e){
                html += Core.FormatTpl(tpl,{'value':e.id,'text':e.goods_name});
            });

            gsr.html(html);
        });
    }

    var usr = $('.js-user-search-result');
    $('.js-user-search,.js-wechat-search').on('keypress',function(event){
        if(event.keyCode == 13 || event.type == 'change'){
            event.preventDefault();

            var data = {
                'user_name':$('.js-user-search').val(),
                'wechat_name':$('.js-wechat-search').val()
            };

            if (!data['user_name'] && !data['wechat_name']){
                Core.Alert({ 'text':'请输入会员名称或微信昵称','state':'err' });
                return;
            }

            $.post("<?php echo U('User/search');?>",data,function(ret){
                if (!ret)
                    return;

                var tpl = '<option value="{value}">{text}</option>';
                var html = '';

                $.each(ret,function(i,e){
                    html += Core.FormatTpl(tpl,{'value':e.id,'text':e.user_name+'【'+e.wechat_user+'】'});
                });

                usr.html(html);
            });
        }
    });
    /* --end-- */
</script>
</article>
</body>
</html>
<script>
    $(function(){
        $('.nav_in .left li').on('click',function() {
            $(this).addClass('cur1').siblings().removeClass('cur1');
            $(this).children().addClass('cur2').parent().siblings().children().removeClass('cur2');
        });

        $('.aside .list dd').on('click',function() {
            $(this).siblings().slideToggle(300).parent().siblings().children('dt').slideUp(300);
            $(this).children().addClass('cur2').parent().parent().siblings().children().children().removeClass('cur2');
            $(this).siblings().removeClass("cur3");
        });

        $('.aside .list dt').on('click',function() {
            $(this).addClass('cur3').siblings().removeClass('cur3')
        });

        if ('<?php echo ($aside_id); ?>'){
            $('.aside .list dd[index="<?php echo ($aside_id); ?>"]').click();
        }

        $('.list').each(function(i,e){
            if (!$(e).find('dt').length)
                $(e).remove();
        });
    })
</script>