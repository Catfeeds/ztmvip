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
            <!--<dt><a href="<?php echo U('Order/index','shop=ztm');?>">商城订单</a></dt>
            <dt><a href="<?php echo U('Order/index','shop=shop');?>">店铺订单</a></dt>--><?php endif; ?>
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
<style type="text/css">
    .tbl .success,.tbl .error{ cursor:pointer; font-weight:bold;}
    .tbl .success{ color:#42C32C;}
    .tbl .error{ color:#f00; font-size:18px;}
</style>
<div class="art-nav">
    <h2><?php echo ($page_title); ?></h2>
    <span class="right">
        <form method="get" action="<?php echo U('');?>">
            <input name="goods_name" class="text" type="text" value="<?php echo ($_GET['goods_name']); ?>" placeholder="ID/商品名称搜索...">
            <select class="select js-goods-category" _name="category_id" option="<?php echo ($_GET['category_id']); ?>">
                <option value="">—请选择—</option>
                <?php if(is_array($goods_category)): $i = 0; $__LIST__ = $goods_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['category_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            
            <select id="" name="brand_id" onchange="" ondblclick="" class="select" ><option value="" >—请选择—</option><?php  foreach($goods_brand as $key=>$val) { if(!empty($_GET['brand_id']) && ($_GET['brand_id'] == $key || in_array($key,$_GET['brand_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
            <select name="on_sale" class="select" option="<?php echo ($_GET['on_sale']); ?>">
                <option value="">—请选择—</option>
                <option value="Y">上架商品</option>
                <option value="N">下架商品</option>
            </select>
            <button class="button" type="submit">搜 索</button>
        </form>
        <a class="button" href="<?php echo U('edit');?>">新 增</a>
    </span>
</div>
<table class="tbl js-list" width="100%">
    <thead>
    <tr>
        <th width="20"><input type="checkbox"></th>
        <th width="60">ID</th>
        <th>商品</th>
        <th>分类</th>
        <th>品牌</th>
        <th>市场价</th>
        <th>商城价</th>
        <th>特卖</th>
        <th>新品</th>
        <th>精品</th>
        <th width="80">排序</th>
        <th width="250">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if($list): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input name="id" type="checkbox" value="<?php echo ($vo['id']); ?>"></td>
                <td align="center"><?php echo ($vo['id']); ?></td>
                <td><a href="http://www.online.com<?php echo U('Goods/detail','goods_id='.$vo['id']);?>" target="_blank"><?php echo ($vo['goods_name']); ?></a></td>
                <td><?php echo ($vo['category_name']); ?></td>
                <td><?php echo ($vo['brand_name']); ?></td>
                <td><del><?php echo ($vo['market_price']); ?></del></td>
                <td><?php echo ($vo['shop_price']); ?></td>
                <td align="center">
                    <?php if($vo['hot'] == 'Y'): ?><span class="js-hot success" data-rel="N" title="取消特卖">√</span>
                        <?php else: ?>
                        <span class="js-hot error" data-rel="Y" title="设为特卖">×</span><?php endif; ?>
                </td>
                <td align="center">
                    <?php if($vo['new'] == 'Y'): ?><span class="js-new success" data-rel="N" title="取消新品">√</span>
                        <?php else: ?>
                        <span class="js-new error" data-rel="Y" title="设为新品">×</span><?php endif; ?>
                </td>
                <td align="center">
                    <?php if($vo['best'] == 'Y'): ?><span class="js-best success" data-rel="N" title="取消精品">√</span>
                        <?php else: ?>
                        <span class="js-best error" data-rel="Y" title="设为精品">×</span><?php endif; ?>
                </td>
                <td align="center">
                    <input class="text js-rank" value="<?php echo ($vo['rank']); ?>" style="min-width:50px;width:50px;">
                </td>
                <td align="center">
                    <a href="<?php echo U('GroupGoods/index','goods_id='.$vo['id']);?>">组合商品</a>
                    <a href="<?php echo U('Comment/goods','goods_id='.$vo['id']);?>">评论</a>
                    <?php if($vo['on_sale'] == 'Y'): ?><a class="js-saledown" href="javascript:;">下架</a>
                        <?php else: ?>
                        <a class="js-saleup" href="javascript:;">上架</a><?php endif; ?>
                    <a href="<?php echo U('edit','id='.$vo['id']);?>">修改</a>
                    <a class="js-delete" href="javascript:;">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <tr>
            <td colspan="12" align="center">暂无数据</td>
        </tr><?php endif; ?>
    </tbody>
</table>
<footer class="footer">
    <button class="button js-saleup-submit">批量上架</button>
    <button class="button js-saledown-submit">批量下架</button>
    <button class="button js-delete-submit">批量删除</button>
    <?php echo ($page_show); ?>
</footer>
<link rel="stylesheet" type="text/css" href="/Public/Common/DateTimePicker/datetimepicker.css" />
<script src="/Public/Common/DateTimePicker/datetimepicker.js"></script>
<script>
    $('.js-list').on('click','.js-hot,.js-new,.js-best',function(event){
        var data = {
            'id':$(this).closest('tr').find(':checkbox').val(),
            'action':$(this).hasClass('js-hot')?'hot':($(this).hasClass('js-new')?'new':'best'),
            'state':$(this).attr('data-rel')
        };

        $.post("<?php echo U('prop');?>",data,function(ret){
            if ( ret.state ){
                Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                    location.reload();
                } });
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    }).on('click','.js-saleup,.js-saledown',function(event){
        $(event.delegateTarget).find('tbody :checkbox').prop('checked',false);
        $(this).closest('tr').find(':checkbox').click();
        $('.'+ $(this).attr('class') +'-submit').click();
    }).on('click','.js-delete',function(event){
        $(event.delegateTarget).find('tbody :checkbox').prop('checked',false);
        $(this).closest('tr').find(':checkbox').click();
        $('.js-delete-submit').click();
    }).on('change','.js-rank',function(event){
        var data = {
            'id':$(this).closest('tr').find(':checkbox').val(),
            'action':'rank',
            'rank':$(this).val()
        };
        $.post("<?php echo U('prop');?>",data,function(ret){
            if ( ret.state ){
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });

    $('.art-nav form input[name]').on('keypress',function(event){
        if(event.keyCode == 13){
            this.form.submit();
            event.preventDefault();
        }
    });

    $('.js-saleup-submit,.js-saledown-submit').on('click',function(){
        var data = Core.InputObj($('.js-list'));
        data['action'] = $(this).attr('class').indexOf('saleup') != -1 ? 'saleup' : 'saledown';

        $.post("<?php echo U('prop');?>",data,function(ret){
            if ( ret.state ){
                Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                    location.reload();
                } });
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });

    $('.js-delete-submit').on('click',function(){
    	Core.Confirm({ 'title':'操作确认','text':'确认要删除选中数据？','callback':function(confirm){
			if (!confirm)
				return;

			var data = Core.InputObj($('.js-list'));
	        data['action'] = 'delete';
	
	        $.post("<?php echo U('prop');?>",data,function(ret){
	            if ( ret.state ){
	                Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
	                    location.reload();
	                } });
	            }else{
	                Core.Alert({ 'text':ret.message,'state':'err' });
	            }
	        },'json');
		} });
    });
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