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







    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/user.css" />
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




<div class="user_bg">
    <div class="user">
        <div class="user_left">
    <dl class="nav">
        <dt class="dt1"><a href="<?php echo U('User/order/index');?>">个人中心</a></dt>
        <dd><a href="<?php echo U('User/order',array('state'=>'new'));?>">待付款</a></dd>
        <dd><a href="<?php echo U('User/order',array('state'=>'payed'));?>">待发货</a></dd>
        <dd><a href="<?php echo U('User/order',array('state'=>'receive'));?>">待评价</a></dd>
        <dd><a href="<?php echo U('Account/deposit');?>">充值</a></dd>
        <dd><a href="<?php echo U('Account/withdraw');?>">申请提现</a></dd>

        <dt>个人信息</dt>
        <dd><a href="<?php echo U('User/info');?>">基本信息</a></dd>
        <dd><a href="<?php echo U('Region/address');?>">收货地址</a></dd>

        <dt>安全中心</dt>
        <dd><a href="<?php echo U('User/mobile');?>">绑定手机</a></dd>
        <dd><a href="<?php echo U('User/bank');?>">绑定银行卡</a></dd>
        <dd><a href="<?php echo U('User/payword');?>">设置支付密码</a></dd>
        <dd><a href="<?php echo U('User/question');?>">设置安全问题</a></dd>
        <dd><a href="<?php echo U('User/password');?>">修改/忘记密码</a></dd>
    </dl>
</div>
<script>
    $(function(){
        //左边导航样式
        $('.user_left .nav').find('a').each(function(i,item){
            var href = $(this).attr('href');
            if(href.indexOf('.html')>0){
                href = href.substr(0,href.indexOf('.html'));
            }
            var reg = new RegExp(href,'gim');
            if(reg.test(String(window.location))){
                $(this).parent().addClass('cur');
            }
        });
    });
</script>
        <div class="user_right">
            <form action="">
                <div class="user_top">
    <div class="img"><img src="<?php echo ($this_user["avatar"]); ?>" alt="" /></div>
    <dl class="dl1">
        <dd class="dd1"><?php echo ($this_user["user_name"]); ?></dd>
        <dd class="dd2"><?php echo ((isset($this_user["parent_name"]) && ($this_user["parent_name"] !== ""))?($this_user["parent_name"]):'官网'); ?>推荐会员</dd>
        <dd class="dd3"><a href="<?php echo U('User/password',array('redirect'=>base64_encode($_SERVER['REQUEST_URI'])));?>">修改登录密码</a><a href="<?php echo U('User/payword',array('redirect'=>base64_encode($_SERVER['REQUEST_URI'])));?>">修改支付密码</a></dd>
    </dl>
    <dl class="dl2">
        <dt>我的余额：</dt>
        <dd>余额：<span>￥<?php echo ((isset($this_user["real_money"]) && ($this_user["real_money"] !== ""))?($this_user["real_money"]):0); ?></span></dd>
        <dd><a href="<?php echo U('Account/deposit');?>" class="a1">充值</a><a href="<?php echo U('Account/withdraw');?>" class="a2">申请提现</a></dd>
    </dl>
    <dl class="dl3">
        <dt>其他信息：</dt>
        <dd>我的红包:<span>（<?php echo ($card_coupons["bonus"]); ?>）</span>我的优惠券:<span>（<?php echo ($card_coupons["coupon"]); ?>）</span></dd>
        <dd>我的积分:<span><?php echo ((isset($this_user["integral"]) && ($this_user["integral"] !== ""))?($this_user["integral"]):0); ?></span>我的储值卡:<span>（<?php echo ($card_coupons["prepaid"]); ?>）</span></dd>
    </dl>
</div>

                <div class="order_deta">
                    <span class="tishi">订单详情</span>
                    <p class="p1">收货地址：</span><?php echo ($order["consignee"]); ?>，<?php echo ($order["mobile"]); ?>，<?php echo ($order["province"]); ?>  <?php echo ($order["city"]); ?>  <?php echo ($order["district"]); if($order["zipcode"] != ''): ?>，<?php echo ($order["zipcode"]); endif; ?></p>
                    <p class="p2">订单信息</p>
                    <p class="p3">订单编号：<?php echo ($order["order_sn"]); ?></p>
                    <p class="p3">创建时间：<?php echo (date('Y-m-d H:i:s',$order["date_add"])); ?></p>
                    <?php if($order["date_pay"] > 0): ?><p class="p3">成交时间：<?php echo (date('Y-m-d H:i:s',$order["date_pay"])); ?></p><?php endif; ?>
                    <?php if(!in_array($order['payment_state'],array('new','paying'))): ?><p class="p4">支付方式：<?php echo ($order['payment_name']); ?><br /></p><?php endif; ?>
                    <p class="p4">订单金额：￥<?php echo (sprintf('%.2f',$order['goods_fee'])); ?></p>
                    <?php if($order["shipping_fee"] > 0): ?><p class="p4">运费：￥<?php echo ((isset($order["shipping_fee"]) && ($order["shipping_fee"] !== ""))?($order["shipping_fee"]):0.00); ?></p><?php endif; ?>
                    <?php if($order['bonus_id']): ?><p class="p4">使用红包：-￥<?php echo ($order['bonus_amount']); ?></p><?php endif; ?>
                    <?php if($order['coupon_id']): ?><p class="p4">使用优惠券：-￥<?php echo ($order['coupon_amount']); ?></p><?php endif; ?>
                    <?php if($order['integral']): ?><p class="p4">使用积分：-￥<?php echo ($order['integral'] * 1/100); ?></p><?php endif; ?>
                    <?php if(in_array($order['payment_state'],array('new','paying'))): ?><p class="p5">应付款：￥<?php echo (sprintf('%.2f',$order['goods_fee']+$order['shipping_fee']-$order['payment_amount']-$order['surplus_amount']-$order['prepaid_amount']-$order['integral_amount']-$order['bonus_amount']-$order['coupon_amount'])); ?></p>
                    <?php else: ?>
                        <p class="p5">实付款：￥<?php echo (sprintf('%.2f',$order['surplus_amount']+$order['payment_amount']+$order['prepaid_amount'])); ?></p><?php endif; ?>

                    <div class="order_deta_con js-order" data-rel="<?php echo ($order["id"]); ?>" data-sn="<?php echo ($order["order_sn"]); ?>">
                        <ul class="title">
                            <li class="li1">商品</li>
                            <li class="li2">单价</li>
                            <li class="li3">数量</li>
                            <li class="li4">交易状态</li>
                            <li class="li5">交易操作</li>
                        </ul>
                        <?php if(is_array($order["goods"])): $i = 0; $__LIST__ = $order["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="con1">
                            <div class="img"><img src="<?php echo ($v["goods_thumb"]); ?>" alt="" /></div>
                            <ul class="text">
                                <li class="li1"><?php echo ($v["goods_name"]); ?></li>
                                <li class="li2"><?php echo ($v["goods_price"]); ?></li>
                                <li class="li3"><?php echo ($v["goods_number"]); ?></li>
                            </ul>
                            <p>
                                <?php $v['skus'] = json_decode($v['skus'],true); ?>
                                <?php if(is_array($v["skus"])): $i = 0; $__LIST__ = $v["skus"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$skus_val): $mod = ($i % 2 );++$i;?><span><?php echo ($skus_val[0]); ?>：<?php echo ($skus_val[1]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        <ul class="action">
                            <?php if(($state == 'new') or ($state == '')): ?><li class="li4"><a href="">待付款</a></li>
                                <li class="li5">
                                    <a class="" href="<?php echo U('Center/choose');?>?order_id=<?php echo ($order["id"]); ?>">付款</a>
                                    <a class="a2 js-delete" href="javascript:;">删除</a>
                                </li>
                                <?php elseif($state == 'payed'): ?>
                                <li class="li4"><a href=""><?php if($order["shipping_state"] == 'stock'): ?>配货中<?php else: ?>待发货<?php endif; ?></a></li>
                                <li class="li5"><a class="js-send" href="javascript:;">提醒发货</a></li>
                                <?php elseif($state == 'send'): ?>
                                <li class="li4"><a href="">已发货</a><a href="javascript:;">查看物流</a></li>
                                <li class="li5"><a class="js-receive" href="javascript:;">确认收货</a></li>
                                <?php elseif($state == 'receive'): ?>
                                <li class="li4"><a href="javascript:;">待评价</a></li>
                                <li class="li5"><a href="<?php echo U('Order/comment',array('order_id'=>$order['id']));?>">马上评价</a><a href="<?php echo U('Order/refund',array('order_id'=>$order['id']));?>" class="a2">申请售后</a></li>
                                <?php elseif($state == 'refund'): ?>
                                <li class="li4"><a href="javascript:;">订单已完成</a></li>
                                <li class="li5"><?php if($order["order_state"] == 'refund'): ?>退款中<?php elseif($order["order_state"] == 'refunded'): ?>已退款<?php else: ?>已完成<?php endif; ?></li>
                                <?php elseif($state == 'recycle'): ?>
                                <li class="li4"><a href="javascript:;">已删除</a></li>
                                <li class="li5"><a class="js-restore" href="javascript:;">还原</a></li>
                                <?php elseif($state == 'stock'): ?>
                                <li class="li4"><a href="">配货中</a></li>
                                <li class="li5"><a class="js-send" href="javascript:;">提醒发货</a></li>
                                <?php elseif($state == 'cancled'): ?>
                                <li class="li4"><a href="javascript:;">已取消</a></li>
                                <li class="li5">已取消</li>
                                <?php elseif($state == 'finished'): ?>
                                <li class="li4"><a href="javascript:;">订单已完成</a></li>
                                <li class="li5">已完成</li>
                                <?php elseif($state == 'refunding'): ?>
                                <li class="li4"><a href="javascript:;">订单已完成</a></li>
                                <li class="li5">退款中</li><?php endif; ?>
                        </ul>
                    </div>

                </div>
            </form>
            <div class="height46"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.js-order').on('click','.js-delete',function(){
        var el = $(this);
        Core.Confirm({ 'title':'操作确认','text':'确认要删除选中数据？','callback':function(confirm){
            if (!confirm)
                return;

            $.post("<?php echo U('Order/delete');?>",{ 'order_id':el.closest('.js-order').attr('data-rel') },function(ret){
                if ( ret.state ){
                    Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                        el.closest('.js-order').remove();
                        window.location.href='/User/order';
                    } });
                }else{
                    Core.Alert({ 'text':ret.message,'state':'err' });
                }
            },'json');
        } });
    }).on('click','.js-send',function(){ //提醒发货
        $.post("<?php echo U('Order/sendMail');?>",{ 'order_sn':$(this).closest('.js-order').attr('data-sn') },function(ret){
            if(ret.error == 8)
                Core.Alert({ 'text':'发货提醒成功' });
            else if(ret.error == 4)
                Core.Alert({ 'text':'服务器繁忙...','state':'notic' });
            else if(ret.error == 'pass')
                Core.Alert({ 'text':'您的提醒我们已经收到了，整体美商城会尽快帮您发货' });
        });
    }).on('click','.js-receive',function(){ //确认收货
        var el = $(this);
        if (el.attr('disabled'))
            return;
        el.attr('disabled','disabled');
        $.post("<?php echo U('Order/state');?>",{ 'order_id':el.closest('.js-order').attr('data-rel'),'state':'receive' },function(ret){
            if (ret.state){
                Core.Alert({ 'text':ret.message });
                el.css({'border':'1px solid #ADADAD','background-color':'#BFBEBA'}).attr('disabled','disabled').text('已 收 货');
            } else {
                Core.Alert({ 'text':ret.message,'state':'err' });
                el.attr('disabled','');
            }

        },'json');
    }).on('click','.js-finish',function(){
        var el = $(this);
        if (el.attr('disabled'))
            return;
        el.attr('disabled','disabled');
        $.post("<?php echo U('Order/state');?>",{ 'order_id':el.closest('.js-order').attr('data-rel'),'state':'finish' },function(ret){
            if (ret.state){
                Core.Alert({ 'text':ret.message });
                el.css({'border':'1px solid #ADADAD','background-color':'#BFBEBA'}).attr('disabled','disabled').text('已 完 成');
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
                el.attr('disabled','');
            }
        },'json');
    }).on('click','.js-soft-deletion',function(){
        var el = $(this);
        Core.Confirm({ 'title':'操作确认','text':'确认要删除选中数据？','callback':function(confirm){
            if (!confirm)
                return;

            $.post("<?php echo U('Order/softDelOrRestore');?>",{ 'order_id':el.closest('.js-order').attr('data-rel'),'action':'softDel' },function(ret){
                if ( ret.state ){
                    Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                        el.closest('.js-order').remove();
                    } });
                }else{
                    Core.Alert({ 'text':ret.message,'state':'err' });
                }
            },'json');
        } });
    }).on('click','.js-restore',function(){
        var el = $(this);
        $.post("<?php echo U('Order/softDelOrRestore');?>",{ 'order_id':el.closest('.js-order').attr('data-rel'),'action':'restore' },function(ret){
            if ( ret.state ){
                Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                    el.closest('.js-order').remove();
                } });
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });


</script>
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
            <dd>ICP备案号：123456789</dd>
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
</body>
</html>