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







<link rel="stylesheet" type="text/css" href="/Public/Computer/Css//shopping.css" />
  </head>
  <body>

<div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="<?php echo U('Cart/cart');?>">购物车<span>(<?php if($Think.session.cnumber): ?><span id="shan_cnumber"><?php echo (session('cnumber')); else: ?>0<?php endif; ?></span>)</span></a></li>
        <?php if($user_info): ?><li class="li2"><i></i><a href="<?php echo U('User/order');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/logout');?>">退出</a></li>
            <li class="li4"><i></i><a href=""><?php echo ($user_info["user_name"]); ?></a></li>
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



<div class="bg_h">
    <div class="success">
        <p class="p1">订单提交成功，请您尽快付款！订单号：<?php echo ($order_sn); ?> <span>应付金额 <i><?php echo ($amount); ?></i> 元</span></p>
        <p class="p2">请您在提交订单后<i>7天内</i>完成支付，否则订单会自动取消。<span class="js-dispaly">查看详情</span></p>
        <div class="xiangqing">
            <p>收货地址：广东广州市天河区老师看到那个粉丝看到那个粉丝都看了那个了<span>收货人：老赵</span><span>134****1397</span></p>
            <p>商品名称：健康是打发你不是的健康妇女不是看见的那个风打开手机那个女生的十分大概多少分若干…</p>
        </div>
    </div>
    <div class="success_con">
        <p class="p1">选择支付方式</p>
        <ul>
            <li class="js_li1"><a href="">支付宝支付</a></li>
            <li class="js_li2"><a href="javascript:;">余额支付</a></li>
            <li class="js_li3"><a href="javascript:;">储值卡支付</a></li>
            <li class="weixin js_li4">
            <a href="javascript:;">微信扫码支付</a>
            <div class="img"><img src="/Public/Computer/Images/success_20.gif" alt="" /></div>
            </li>
        </ul>
        <form action="">
            <div class="balance js_con2">
                <div class="password">
                    <span>请输入支付密码</span>
                    <div class=""></div>
                    <div class="input"><input type="password" maxlength="6" /></div>
                </div>
                <button type="button" class="but1">取消</button>
                <button type="button">确定</button>
            </div>



            <div class="store js_con3">
                <ul class="">
                    <li>
                        <label for="checkbox1" class="ture"></label><input type="checkbox" id="checkbox1" />
                        <span>卡号：0001</span>可用余额：¥3000
                    </li>
                    <li>
                        <label for="checkbox1"></label><input type="checkbox" id="checkbox1" />
                        <span>卡号：0001</span>可用余额：¥3000
                    </li>
                    <li>
                        <label for="checkbox1"></label><input type="checkbox" id="checkbox1" />
                        <span>卡号：0001</span>可用余额：¥3000
                    </li>
                    <li>
                        <label for="checkbox1"></label><input type="checkbox" id="checkbox1" />
                        <span>卡号：0001</span>可用余额：¥3000
                    </li>
                </ul>
                <button type="button" class="but1">取消</button>
                <button type="button">确定</button>
            </div>



        <div class="shaoyishao js_con4">
            <p class="p2">二维码已过期，<span>刷新</span> 页面重新获取二维码。</p>
            <div class="img"><img src="/Public/Computer/Images/weix_07.jpg" alt="" /></div>
            <p class="p3">请使用微信扫一扫<br />扫描二维码支付</p>
        </div>

        </form>





    </div>
</div>

<script type="text/javascript">
    $('.js-dispaly').on('click', function() {
        $(this).toggleClass("click");
        $('.xiangqing').slideToggle();
        if($(this).hasClass('click')){
            $(this).text("收起详情")
        }else{
            $(this).text("查看详情")
        }
    });

$('.js_li2').on('click',  function(event) {
    $(this).siblings().removeClass('this');
    $(this).addClass('this');
    $('.js_con2').siblings().hide();
    $('.js_con2').show();
});
$('.js_li3').on('click',  function(event) {
    $(this).siblings().removeClass('this');
    $(this).addClass('this');
    $('.js_con3').siblings().hide();
    $('.js_con3').show();
});
$('.js_li4').on('click',  function(event) {
    $(this).siblings().removeClass('this');
    $(this).addClass('this');
    $('.js_con4').siblings().hide();
    $('.js_con4').show();
});







</script>














  </body>
</html>
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