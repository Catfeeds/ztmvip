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
<table class="tbl" width="100%">
    <thead>
    <tr>
        <th colspan="4">订单统计信息</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="label">今日订单</td>
        <td><?php echo ($order_count['today']); ?></td><td class="label">待支付订单</td>
        <td><?php echo ($order_count['new']); ?></td>
    </tr>
    <tr>
        <td class="label">待发货订单</td>
        <td><?php echo ($order_count['payed']); ?></td>
        <td class="label">备货中订单</td>
        <td><?php echo ($order_count['stock']); ?></td>
    </tr>
    <tr>
        <td class="label">待收货订单</td>
        <td><?php echo ($order_count['send']); ?></td>
        <td class="label">待评价订单</td>
        <td><?php echo ($order_count['receive']); ?></td>
    </tr>
    <tr>
        <td class="label">退款申请</td>
        <td><?php echo ($order_count['refund']); ?></td>
        <td class="label">退款成功</td>
        <td><?php echo ($order_count['refunded']); ?></td>
    </tr>
    </tbody>
</table>
<br>
<table class="tbl" width="100%">
    <thead>
    <tr>
        <th colspan="4">系统信息</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="label">服务器操作系统</td>
        <td><?php echo php_uname('s');?></td>
        <td class="label">Web 服务器</td>
        <td><?php echo ($server['SERVER_SOFTWARE']); ?></td>
    </tr>
    <tr>
        <td class="label">PHP 版本</td>
        <td><?php echo phpversion();?></td>
        <td class="label">MySQL 版本</td>
        <td><?php echo ($server['mysql_version']); ?></td>
    </tr>
    <tr>
        <td class="label">文件上传的大小</td>
        <td><?php echo ini_get('upload_max_filesize');?></td>
        <td class="label">服务器时间</td>
        <td><?php echo date('Y-m-d H:i:s');?></td>
    </tr>
    </tbody>
</table>
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