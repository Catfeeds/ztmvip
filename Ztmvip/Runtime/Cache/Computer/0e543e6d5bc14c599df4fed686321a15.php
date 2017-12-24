<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($page_title); echo ($sitename); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/core.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/base.css" />
    <script type="text/javascript" src="/Public/Computer/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Common/Js/common.js"></script>
    <script type="text/javascript" src="/Public/Computer/Js/shan_common.js"></script>







<link rel="stylesheet" type="text/css" href="/Public/Computer/Css//goods_list.css" />
<style type="text/css">
    .index_top .nav li.li1 ul{ background:#bfbfbf;}
</style>
</head>
<body>
<div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="<?php echo U('Cart/cart');?>">购物车<span>(<?php if($Think.session.cnumber): ?><span id="shan_cnumber"><?php echo (session('cnumber')); else: ?>0<?php endif; ?></span>)</span></a></li>
        <?php if($user_info): ?><li class="li2"><i></i><a href="<?php echo U('User/order');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/logout');?>">退出</a></li>
            <li class="li4"><i></i><a href="<?php echo U('User/order');?>"><?php echo ($user_info["user_name"]); ?></a></li>
            <?php else: ?>
            <li class="li2"><i></i><a href="<?php echo U('Login/index');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/index');?>">登录</a></li>
            <li class="li4"><i></i><a href="<?php echo U('Register/index');?>">注册</a></li><?php endif; ?>
        <li class="li5">欢迎光临整体美</li>
    </ul>
</div>
<div class="index_top">
    <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Public/Computer/Images/index_logo.png" alt="" /></a></div>
    <div class="search">
        <div id="add">
            <form action="<?php echo U('Search/index');?>">
                <input type="text" name="word" value="<?php echo ($_GET['word']); ?>" maxlength="20" />
                <button type="submit"></button>
            </form>
        </div>
     
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
  
    </div>
    <!-- <div class="weixin"><img src="/Public/Computer/Images/index_02_10.jpg" /></div> -->
    <div class="weixin">
        <p>整体美微信</p>
        <img src="/Public/Computer/Images/gif128_03.gif" />
    </div>
    <ul class="nav">
        <li class="li1"><a href="">全部商品</a>
        <ul>

        <!-- #################### 壹 ############################# -->
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
                    </dd>

                    <dl class="nav2">
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
                        <dd>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
                        </dd>

                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
                        <dd>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
                        </dd>
                    </dl>
                </dl>
            </li>
<!-- ################# 贰 ######################################### -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################## 叁 ####################### -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- #################### 肆  #################################     -->
<li>
    <dl class="nav1">
        <dt>形象美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">包包1</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲包</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">时尚包</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大牌原创</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">围巾</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">丝巾</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羊毛围巾</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣/外套</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">羽绒</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">大衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童下装</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童鞋子</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童围巾/配饰</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童外套</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">儿童上衣</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">裙装</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">连衣裙</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">半身裙</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################################################# -->
         
        </ul>
        </li>
        <li ><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li ><a href="<?php echo U('Index/newGoodsList');?>">新品首发</a></li>
        <li ><a href="<?php echo U('Index/specialBuy');?>">特卖专场</a></li>
        <li ><a href="<?php echo U('Health/special');?>">贵宾尊享</a></li>
    </ul>
</div>




<div class="goods_deta_bg">
    <div style="height:10px;"></div>
    <div class="goods_li">
        <h2><?php echo ($page_title); ?></h2>
        <form id="js-form" action="" method="get">
            <ul class="nav3">
                <li class="li1 js-order" data="">默认</li>
                <li class="li2 js-order" data="click">人气</li>
                <li class="li3 js-order" data="sales">销量</li>
                <li class="js-order li4" data="spup">价格</li>
                <li class="li5"><input name="min_price" type="text" value="<?php echo ($_GET['min_price']); ?>" /></li>
                <li class="li6"></li>
                <li class="li7"><input name="max_price" type="text" value="<?php echo ($_GET['max_price']); ?>" /></li>
                <li class="li8"><button type="submit">确定</button></li>
                <li class="li9 js-price" data="-">不限</li>
                <li class="li9 js-price" data="100-200">100-200</li>
                <li class="li9 js-price" data="200-300">200-300</li>
                <li class="li9 js-price" data="300-400">300-400</li>
                <li class="li9 js-price" data="400-">400以上</li>
                <li class="li12"></li>
            </ul>
            <input name="order" type="hidden" value="<?php echo ($_GET['order']); ?>" />
            <input name="word" type="hidden" value="<?php echo ($_GET['word']); ?>" />
        </form>
        <?php if($goods): ?><ul class="g_list">
                <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo U('Goods/detail','goods_id='.$val['id']);?>">
                            <div class="img"><img src="http://www.ztmvip.com/<?php echo ($val['goods_thumb']); ?>_250x250.jpg" alt="" /></div>
                            <p class="p1"><?php echo (subtext($val['goods_name'],35)); ?></p>
                        </a>
                        <p class="p2"><span class="span1">￥</span><?php echo ($val['shop_price']); ?><span class="span2">￥<?php echo ($val['market_price']); ?></span></p>
                        <p class="p3"><span class="span3 <?php if(!empty($val["collect"])): ?>hover<?php endif; ?>" onclick="collect(<?php echo ($val['id']); ?>)">收藏</span></p>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <?php else: ?>
            <div style="font-size:24px;width:100%;text-align:center;line-height:400px;"><?php echo ($error); ?></div><?php endif; ?>
        <div class="yeshu">
            <?php echo ($page_show); ?>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        var form = $('#js-form');

        $('.js-order').on('click',function(){
            form.find(':hidden[name="order"]').val($(this).attr('data'));
            form.submit();
        });

        $('.js-price').on('click',function(){
            var price = $(this).attr('data').split('-');
            form.find(':text[name="min_price"]').val(price[0]);
            form.find(':text[name="max_price"]').val(price[1]);
            form.submit();
        });

        $('.js-order[data="<?php echo ($_GET['order']); ?>"]').addClass('hover');
        $('.js-price[data="<?php echo ($_GET['min_price']); ?>-<?php echo ($_GET['max_price']); ?>"]').addClass('hover');

        if ('<?php echo ($_GET['order']); ?>' == 'spup')
            $('.js-order[data="spup"]').attr('data','spdown').addClass('hover li4_2');
        else if ('<?php echo ($_GET['order']); ?>' == 'spdown')
            $('.js-order[data="spup"]').addClass('hover li4_1');
    });

    /**
     * 添加商品到收藏夹
     * @param goods_id
     */
    function collect(goods_id) {
        $.post("<?php echo U('Goods/addCollection');?>",{ 'goods_id':goods_id },function(ret){
            switch(ret.code){
                case 'sadd':
                    $('#shan_collect').addClass('hover');
                    Core.Alert({ 'text':'添加收藏成功' });
                    break;
                case 'sdel':
                    $('#shan_collect').removeClass('hover');
                    Core.Alert({ 'text':'取消收藏成功' });
                    break;
                case 'fadd':
                    Core.Alert({ 'text':'添加收藏失败','state':'err'});
                    break;
                case 'fdel':
                    Core.Alert({ 'text':'取消收藏失败','state':'err' });
                    break;
                case 'login':
                    Core.Alert({ 'text':'未登录不可以添加收藏','state':'err' });
                    break;
                default:
                    break;
            }
        });
    }
</script>
<?php if(!in_array(CONTROLLER_NAME,array('Login','Register'))): ?><a name="maodian"></a>
<!-- 侧边栏 -->
<div class="index_right_nav">
    <div class="personal_nav">
        <ul>
            <li class="li1">
                <div class="denglu">
                    <?php if($user_info): ?><p class="p1">您好！<?php echo ($user_info["user_name"]); ?></p>
                        <a target="_blank" href="<?php echo U('User/order');?>" class="a3">我的订单</a>
                        <?php else: ?>
                        <p class="p1">您好！请 <a target="_blank" href="<?php echo U('Login/index');?>">登录</a><span></span><a target="_blank" href="<?php echo U('Register/index');?>">注册</a></p>
                        <a target="_blank" href="<?php echo U('Login/index');?>" class="a3">我的订单</a><?php endif; ?>
                </div>
                <input type="hidden" name="islogin" value="<?php echo ($islogin); ?>"/>
            </li>
            <li class="li2"><div class="hover">返利中心</div></li>
            <li class="li3"><div class="hover">余额</div></li>
            <li class="li4"><div class="hover">红包</div></li>
            <li class="li5"><div class="hover">优惠券</div></li>
            <li class="li6"><div class="hover">储值卡</div></li>
            <li class="li7"><div class="hover">我的收藏</div></li>
            <li class="li8"><div class="hover">购物车</div><span><?php if($Think.session.cnumber): echo (session('cnumber')); else: ?>0<?php endif; ?></span></li>
            <li class="li9"> <a href="#maodian" class="maodian"></a></li>
        </ul>
    </div>
    <div class="right">
        <!-- 返利中心 -->
        <div class=" rebate">
        </div>
        <!-- 返利中心结束 -->
        <!-- 我的余额 -->
        <div class="recharge" style="display:none;">
        </div>
        <!-- 我的余额结束 -->
        <!-- 红包 -->
        <div class="hongbao js_hongbao_display"  style="display:none;">
        </div>
        <!-- 红包结束 -->
        <!-- 我的优惠券 每个分类又有三个卡片样式 -->
        <div class="hongbao js_coupon"  style="display:none;">
        </div>
        <!-- 我的优惠券结束 -->
        <!-- 储值卡 -->
        <div class="save" style="display:none;" >
        </div>
        <!-- 储值卡结束 -->
        <!-- 我的收藏 -->
        <div class="collect" style="display:none;">
        </div>
        <!-- 收藏结束 -->
        <!-- 我的购物车 -->
        <div class="trade" style="display:none;">
        </div>
        <!-- 我的购物车结束 -->
    </div>
</div>
<!-- 侧边栏结束 --><?php endif; ?>

<div class="index_footer">
    <div class="footer1">
        <ul class="container">
            <li><a href=""><div class="img1"></div>100%正品</a></li>
            <li><a href=""><div class="img2"></div>7天放心退</a></li>
            <li><a href=""><div class="img3"></div>分享就赚钱</a></li>
            <li><a href=""><div class="img4"></div>买贵返差额</a></li>
        </ul>

    </div>
    <div class="footer2">

        <dl class="dl1">
            <dd>客服电话:400-777-1225</dd>
            <dd>ICP备案号：沪ICP备15011936号</dd>
            <dd>COPYRIGHT©整体美商城</dd>
        </dl>

        <dl>
            <dt>公司</dt>
            <dd><a href="">关于我们</a></dd>
            <dd><a href="">加盟合作</a></dd>
            <dd><a href="">联系我们</a></dd>
        </dl>
        <dl>
            <dt>消费者</dt>
            <dd><a href="">帮助中心</a></dd>
            <dd><a href="">意见反馈</a></dd>
        </dl>
        <dl>
            <dt>售后服务</dt>
            <dd><a href="">售后说明</a></dd>
            <dd><a href="">售后质询</a></dd>
        </dl>
        <dl>
            <dt>安全中心</dt>
            <dd><a href="">绑定手机</a></dd>
            <dd><a href="">绑定银行卡</a></dd>
            <dd><a href="">设置支付密码</a></dd>
            <dd><a href="">设置安全问题</a></dd>
            <dd><a href="">忘记密码</a></dd>
        </dl>

        <div class="weixin">
            <div class="weixin_fenxiang">
                <img src="/Public/Computer/Images/weixin.png" alt="" />
                <p>关注注册送红包，分享购买返佣金！</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Computer/Js//index.js"></script>
<script type="text/javascript" src="/Public/Computer/Js//lhf_index.js"></script>
</body>
</html>