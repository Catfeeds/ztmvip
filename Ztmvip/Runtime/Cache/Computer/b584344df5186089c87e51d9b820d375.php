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
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pc页面</title>

    <link rel="stylesheet" type="text/css" href="Css/base.css" />
    <link rel="stylesheet" type="text/css" href="Css/index.css" />
    <script type="text/javascript" src="Js/jquery.js"></script>
  </head>
  <body>

<a name="maodian"></a>


<!-- 侧边栏 -->
<div class="index_right_nav">
    <div class="personal_nav">
        <ul>
            <li class="li1">
                <div class="denglu">
                <p class="p1">您好！请 <a href="">登录</a><a href="">注册</a></p>
                <a href="" class="a3">我的订单</a>
                </div>
            </li>
            <li class="li2"><div class="hover">返利中心</div></li>
            <li class="li3"><div class="hover">余额</div></li>
            <li class="li4"><div class="hover">红包</div></li>
            <li class="li5"><div class="hover">优惠券</div></li>
            <li class="li6"><div class="hover">储值卡</div></li>
            <li class="li7"><div class="hover">我的收藏</div></li>
            <li class="li8"><div class="hover">购物车</div><span>8</span></li>
            <li class="li9"> <a href="#maodian" class="maodian"></a></li>
        </ul>
    </div>
    <div class="right">


<!-- 返利中心 -->
    <div class=" rebate">
            <span class="top_false"></span><p class="title">返利中心</p>
            <dl class="con1">
                <dt><a href="javascript:;" class="a2">什么是返利？</a><a href="">查看佣金明细 >></a></dt>
                <dd><a href="javascript:;">累计实际提现佣金：￥0.00</a></dd>
                <dd><a href="javascript:;">待审核提现佣金：￥0.00</a></dd>
                <dd><a href="javascript:;">可提现佣金：￥0.00</a></dd>
                <dd><a href="javascript:;">累计分享次数：0 次</a></dd>
                <dd><a href="javascript:;">累计客户购买次数：0 次</a></dd>
            </dl>
            <dl class="con2">
                <dt>我的客户（20个）</dt>
                <div class="hidden">
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                    <dd><div class="img"><img src="Images/personal2_07.jpg" alt="" /></div>三十多个飞</dd>
                </div>
            <script type="text/javascript">
              hidden_h =$('.index_right_nav').height()-344;
              $('.index_right_nav .right .rebate .con2 .hidden').height(hidden_h);
            </script>

            </dl>
            <ul class="con3">
                <li class="li1"><a href="">填写申请</a></li>
                <li class="li2"><a href="">转入余额</a></li>
            </ul>
        </div>
<!-- 返利中心结束 -->


<!-- 我的余额 -->
<div class="recharge" style="display:none;">
            <span class="top_false"></span><p class="title">我的余额</p>
            <ul class="xuanzhe">
                <li class="li1"><a href="">充值记录</a></li>
                <li class="li2"><a href="" class="on_click">提现记录</a></li>
            </ul>
            <dl class="con1">
                <div class="hidden">
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                    <dd>充值金额：100元<span>2015.12.25</span></dd>
                </div>
                <script type="text/javascript">
                  var recharge_hidden_h =$('.index_right_nav').height()-172;
                  $('.index_right_nav .right .recharge .con1 .hidden').height(recharge_hidden_h);
                </script>
            </dl>
            <div class="balance">我的余额：￥0.01</div>
            <ul class="bottom">
                <li class="li1"><a href="">申请提现</a></li>
                <li class="li2"><a href="">充值</a></li>
            </ul>
        </div>
<!-- 我的余额结束 -->

<!-- 红包 -->
        <div class="hongbao js_hongbao_display"  style="display:none;">
            <span class="top_false"></span><p class="title">我的红包</p>
            <ul class="xuanzhe">
                <li class="li1"><a href="javascript:;" class="this">未使用(3)</a></li>
                <li class="li2"><a href="javascript:;">已使用(3)</a></li>
                <li class="li3"><a href="javascript:;">已过期(3)</a></li>
            </ul>
            <div class="con1">
                <ul>
                    <li class="ajax_hongbao1_display">
                        <div class="hongbao1">
                            <span><i>6</i>元</span>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_hongbao2_display" style="display:none;">
                        <div class="hongbao2">
                            <span><i>611</i>元</span>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_hongbao3_display" style="display:none;">
                        <div class="hongbao3">
                            <span><i>6</i>元</span>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>

                </ul>
            </div>
            <p class="text"><a href="" >红包使用说明>></a></p>
        </div>
<!-- 红包结束 -->



<!-- 我的优惠券 每个分类又有三个卡片样式 -->

        <div class="hongbao js_coupon"  style="display:none;">
            <span class="top_false"></span><p class="title">我的优惠券</p>
            <ul class="xuanzhe">
                <li class="li1"><a href="javascript:;" class="this">未使用(3)</a></li>
                <li class="li2"><a href="javascript:;">已使用(3)</a></li>
                <li class="li3"><a href="javascript:;">已过期(3)</a></li>
            </ul>
            <div class="coupon">
                <ul>

                    <!-- 未使用红包3种样式 -->
                    <li class="ajax_coupon1_display" >
                        <div class="coupon_1 coupon_1_1 ">
                            <p class="p1">整体美优惠券</p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon1_display" >
                        <div class="coupon_1 coupon_1_2">
                            <p class="p1">整体美优惠券</p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon1_display" >
                        <div class="coupon_1 coupon_1_3">
                            <p class="p1">整体美优惠券</p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>

                    <!-- 已使用红包3种样式 -->
                    <li class="ajax_coupon2_display" style="display:none;">
                        <div class="coupon_2 coupon_2_1">
                            <p class="p1">整体美优惠券<span>已使用</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon2_display" style="display:none;">
                        <div class="coupon_2 coupon_2_2">
                            <p class="p1">整体美优惠券<span>已使用</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon2_display" style="display:none;">
                        <div class="coupon_2 coupon_2_3">
                            <p class="p1">整体美优惠券<span>已使用</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>

                    <!-- 过期红包3种样式 -->
                    <li class="ajax_coupon3_display" style="display:none;">
                        <div class="coupon_2 coupon_2_1">
                            <p class="p1">整体美优惠券<span>已过期</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon3_display" style="display:none;">
                        <div class="coupon_2 coupon_2_2">
                            <p class="p1">整体美优惠券<span>已过期</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                    <li class="ajax_coupon3_display" style="display:none;">
                        <div class="coupon_2 coupon_2_3">
                            <p class="p1">整体美优惠券<span>已过期</span></p>
                            <p class="p2"><span><i>1330</i>元</span><img src="Images/coupon_04.jpg" class="l" alt="" />满48元可用<img src="Images/coupon_05.gif" class="r" alt="" /></p>
                        </div>
                        <p class="date">2015.09.16—2015.09.19</p>
                    </li>
                </ul>
            </div>
            <p class="text"><a href="" >红包使用说明>></a></p>
        </div>
<!-- 我的优惠券结束 -->



<!-- 储值卡 -->
        <div class="save" style="display:none;" >
            <span class="top_false"></span><p class="title">我的储值卡</p>

            <div class="con">
                <ul>
                    <li><p>7777 22** **** ****</p></li>
                    <li><p>7777 22** **** ****</p></li>
                    <li><p>7777 22** **** ****</p></li>
                    <li><p>7777 22** **** ****</p></li>
                </ul>

                <script type="text/javascript">
                    $('.index_right_nav .right .save .con ul').height($('.index_right_nav').height()-49);
                </script>
            </div>
        </div>

<!-- 储值卡结束 -->




<!-- 我的收藏 -->


        <div class="collect" style="display:none;">
            <span class="top_false"></span><p class="title">我的收藏</p>
            <ul class="xuanzhe">
                <li class="li1"><a href="javascript:;">商品收藏</a></li>
                <li class="li2"><a href="javascript:;" class="on_click">文章收藏</a></li>
            </ul>
            <div class="con">
                <ul>
                    <li class="ajax_li1">
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2"><span>￥</span>288</p>
                        <p class="p3">删除</p>
                    </li>
                    <li class="ajax_li2" style="display:none;">
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2"></p>
                        <p class="p3">删除</p>
                    </li>
                </ul>
            </div>
        </div>

<!-- 收藏结束 -->





<!-- 我的购物车 -->
        <div class="trade" style="display:none;">
            <span class="top_false"></span><p class="title">我的收藏</p>
            <div class="con">
                <ul>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                    <li>
                        <div class="img"><img src="Images/collection_03.gif" alt="" /></div>
                        <p class="p1">香诗丽欧美大牌高端九分袖钉珠网纱拼接针织衫打底衫</p>
                        <p class="p2">尺码：M</p>
                        <p class="p3">颜色：酒红色</p>
                        <p class="p4"><span>￥<i>288</i></span> ×<input type="text" value="1" /><button type="button">删除</button></p>
                    </li>
                </ul>
                <script type="text/javascript">
                    var trade_ul_h=$('.index_right_nav').height()-115;
                    $('.index_right_nav .right .trade .con ul').height(trade_ul_h);
                </script>
            </div>
            <div class ="bottom">合计：￥576 <a href="">去购物车结算</a></div>
        </div>

<!-- 我的购物车结束 -->




    </div>
</div>
<!-- 侧边栏结束 -->










<!-- 头部横条 -->
<div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="">购物车<span>(13)</span></a></li>
        <li class="li2"><i></i><a href="">我的订单</a></li>
        <li class="li3"><i></i><a href="">登录</a></li>
        <li class="li4"><i></i><a href="">注册</a></li>
        <li class="li5">欢迎光临整体美</li>
    </ul>
</div>
<!-- 头部横条结束 -->


<!-- logo直到导航 -->
<div class="index_top">
    <div class="logo"><img src="Images/index_logo.png" alt="" /></div>
    <div class="search">
        <form action="">
            <input type="text" />
            <button type="bottom"></button>
        </form>
        <a href="">大牌/原创</a>
        <a href="">大牌/原创</a>
        <a href="">大牌</a>
        <a href="">大牌</a>
        <a href="">大牌</a>
        <a href="">大牌</a>
    </div>
    <div class="weixin"><img src="Images/index_02_10.jpg" /></div>
    <ul class="nav">
        <li class="li1"><a href="">全部商品</a>
        <ul>
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd><a href="">上衣</a><a href="">外套</a><a href="">毛织</a><a href="">连衣裙</a><a href="">毛呢/羊毛</a></dd>

                    <dl class="nav2">
                        <dt><a href="">包包</a></dt>
                        <dd><a href="">休闲包</a><a href="">时尚包</a></dd>
                        <dt><a href="">大牌原创</a></dt>
                        <dd><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a></dd>
                        <dt><a href="">围巾</a></dt>
                        <dd><a href="">丝巾</a><a href="">羊毛围巾</a></dd>
                        <dt><a href="">大衣/外套</a></dt>
                        <dd><a href="">羽绒</a><a href="">大衣</a></dd>
                        <dt><a href="">儿童</a></dt>
                        <dd><a href="">儿童下装</a><a href="">儿童鞋子</a><a href="">儿童围巾/配饰</a><a href="">儿童外套</a><a href="">儿童上衣</a></dd>
                        <dt><a href="">裙装</a></dt>
                        <dd><a href="">连衣裙</a><a href="">半身裙</a></dd>
                    </dl>
                </dl>
            </li>
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd><a href="">上衣</a><a href="">外套</a><a href="">毛织</a><a href="">连衣裙</a><a href="">毛呢/羊毛</a></dd>

                    <dl class="nav2">
                        <dt><a href="">形象美导航</a></dt>
                        <dd><a href="">休闲包</a><a href="">时尚包</a></dd>
                        <dt><a href="">大牌原创</a></dt>
                        <dd><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a></dd>
                        <dt><a href="">围巾</a></dt>
                        <dd><a href="">丝巾</a><a href="">羊毛围巾</a></dd>
                        <dt><a href="">大衣/外套</a></dt>
                        <dd><a href="">羽绒</a><a href="">大衣</a></dd>
                        <dt><a href="">儿童</a></dt>
                        <dd><a href="">儿童下装</a><a href="">儿童鞋子</a><a href="">儿童围巾/配饰</a><a href="">儿童外套</a><a href="">儿童上衣</a></dd>
                        <dt><a href="">裙装</a></dt>
                        <dd><a href="">连衣裙</a><a href="">半身裙</a></dd>
                    </dl>
                </dl>
            </li>
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd><a href="">上衣</a><a href="">外套</a><a href="">毛织</a><a href="">连衣裙</a><a href="">毛呢/羊毛</a></dd>

                    <dl class="nav2">
                        <dt><a href="">包包</a></dt>
                        <dd><a href="">休闲包</a><a href="">时尚包</a></dd>
                        <dt><a href="">大牌原创</a></dt>
                        <dd><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a></dd>
                        <dt><a href="">围巾</a></dt>
                        <dd><a href="">丝巾</a><a href="">羊毛围巾</a></dd>
                        <dt><a href="">大衣/外套</a></dt>
                        <dd><a href="">羽绒</a><a href="">大衣</a></dd>
                        <dt><a href="">儿童</a></dt>
                        <dd><a href="">儿童下装</a><a href="">儿童鞋子</a><a href="">儿童围巾/配饰</a><a href="">儿童外套</a><a href="">儿童上衣</a></dd>
                        <dt><a href="">裙装</a></dt>
                        <dd><a href="">连衣裙</a><a href="">半身裙</a></dd>
                    </dl>
                </dl>
            </li>
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd><a href="">上衣</a><a href="">外套</a><a href="">毛织</a><a href="">连衣裙</a><a href="">毛呢/羊毛</a></dd>

                    <dl class="nav2">
                        <dt><a href="">包包</a></dt>
                        <dd><a href="">休闲包</a><a href="">时尚包</a></dd>
                        <dt><a href="">大牌原创</a></dt>
                        <dd><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a><a href="">大牌原创</a></dd>
                        <dt><a href="">围巾</a></dt>
                        <dd><a href="">丝巾</a><a href="">羊毛围巾</a></dd>
                        <dt><a href="">大衣/外套</a></dt>
                        <dd><a href="">羽绒</a><a href="">大衣</a></dd>
                        <dt><a href="">儿童</a></dt>
                        <dd><a href="">儿童下装</a><a href="">儿童鞋子</a><a href="">儿童围巾/配饰</a><a href="">儿童外套</a><a href="">儿童上衣</a></dd>
                        <dt><a href="">裙装</a></dt>
                        <dd><a href="">连衣裙</a><a href="">半身裙</a></dd>
                    </dl>
                </dl>
            </li>
        </ul>
        </li>
        <li ><a href="">首页</a></li>
        <li ><a href="">新品首发</a></li>
        <li ><a href="">特卖专场</a></li>
        <li ><a href="">贵宾尊享</a></li>
    </ul>
</div>
<!-- logo直到导航  结束 -->



<!-- banner轮播 -->
<div class="index_banner">
    <div class="container">
        <div class="but">
            <div class="left"><img src="Images/index_03.png" alt="" /></div>
            <div class="right"><img src="Images/index_05.png" alt="" /></div>
        </div>
        <ul>
            <li><img  src="Images/index_02.jpg" alt="" /></li>
            <li><img  src="Images/index_02.jpg" alt="" /></li>
            <li><img  src="Images/index_02.jpg" alt="" /></li>
            <li><img  src="Images/index_02.jpg" alt="" /></li>
        </ul>
    </div>
</div>
<!-- banner轮播 -->


<!-- 圆圈导航 -->
<ul class="index_nav3">
    <li class="li1">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_03.jpg" alt="" /></a>
        <p><a href="">需求选择</a></p>
    </li>
    <li class="li2">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_05.jpg" alt="" /></a>
        <p><a href="">量身定制</a></p>
    </li>
    <li class="li3">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_07.jpg" alt="" /></a>
        <p><a href="">选择顾问</a></p>
    </li>
    <li class="li4">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_09.jpg" alt="" /></a>
        <p><a href="">解决方案</a></p>
    </li>
    <li class="li5">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_11.jpg" alt="" /></a>
        <p><a href="">产品选购</a></p>
    </li>
    <li class="li6">
        <i class="hover"></i>
        <a href=""><img src="Images/index_nav_13.jpg" alt="" /></a>
        <p><a href="">跟踪服务</a></p>
    </li>
</ul>


<div class="index_title_hr">
    <h1>健康减重方案</h1>
</div>

<!-- 减重方案 -->
<div class="weight">
    <div class="left"><a href=""><img src="Images/index_weight_03.jpg" alt="" /></a></div>
    <ul class="right">
        <li class="li1">
            <a href=""><img src=" Images/index_weight_06.png" alt="" /></a>
            <p class="p1"><a href="">巴马原生态寿源红米1公斤/袋</a></p>
            <p class="p2">
                <span class="span1">￥69.00</span>
                <span class="span2">￥118.00</span>
            </p>
        </li>
        <li class="li2">
            <a href=""><img src=" Images/index_weight_08.jpg" alt="" /></a>
            <p class="p1"><a href="">巴马原生态寿源红米1公斤/袋</a></p>
            <p class="p2">
                <span class="span1">￥69.00</span>
                <span class="span2">￥118.00</span>
            </p>
        </li>
        <li class="li3">
            <a href=""><img src=" Images/index_weight_12.jpg" alt="" /></a>
            <p class="p1"><a href="">巴马原生态寿源红米1公斤/袋</a></p>
            <p class="p2">
                <span class="span1">￥69.00</span>
                <span class="span2">￥118.00</span>
            </p>
        </li>
        <li class="li4">
            <a href=""><img src=" Images/index_weight_13.jpg" alt="" /></a>
            <p class="p1"><a href="">巴马原生态寿源红米1公斤/袋</a></p>
            <p class="p2">
                <span class="span1">￥69.00</span>
                <span class="span2">￥118.00</span>
            </p>
        </li>
    </ul>
</div>





<div class="index_title_hr">
    <h1>热点分享</h1>
</div>

<div class="hot">
    <div class="left"><a href=""><img src="Images/index_hot_03.jpg" alt="" /></a></div>
    <ul class="min_hot">
        <li class="li1"><a href=""><img src="Images/index_hot_05.jpg" alt="" /></a></li>
        <li class="li2"><a href=""><img src="Images/index_hot_07.jpg" alt="" /></a></li>
        <li class="li3"><a href=""><img src="Images/index_hot_15.jpg" alt="" /></a></li>
        <li class="li4"><a href=""><img src="Images/index_hot_17.jpg" alt="" /></a></li>
    </ul>
    <ul class="right">
        <li class="title"><span><i>热点推荐</i></span></li>  
        <li class="hover">
            <p><a href="">1.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">2.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">3.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">4.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">5.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">6.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">7.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li>
            <p><a href="">8.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
        <li class="li9">
            <p><a href="">9.街拍达人透视公式</a></p>
            <img src="Images/index_hot_10.jpg" alt="" />
        </li>
    </ul>
</div>



<!-- 潮流趋势 -->
<div class="index_title_hr">
    <h1>潮流趋势</h1>
</div>
<div class="trend">
    <div class="left">
        <div class="img1">
            <a href=""><img src=" Images/index_03.jpg" alt="" /></a>
        </div>
        <div class="img2">
            <a href=""><img src=" Images/index_16.jpg" alt="" /></a>
        </div>
    </div>
    <div class="left">
        <div class="img1">
            <a href=""><img src=" Images/index_05.jpg" alt="" /></a>
        </div>
        <div class="img2">
            <a href=""><img src=" Images/index_18.jpg" alt="" /></a>
        </div>
    </div>
    <div class="left">
        <div class="img1">
            <a href=""><img src=" Images/index_07.jpg" alt="" /></a>
        </div>
        <div class="img2">
            <a href=""><img src=" Images/index_20.jpg" alt="" /></a>
        </div>
    </div>
    <div class="right">
        <li class="title"><span><i>热门资讯</i></span></li>  
        <li class="hover">
            <p><a href="">1. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">2. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">3. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">4. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">5. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">6. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">7. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li>
            <p><a href="">8. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
        <li class="li9">
            <p><a href="">9. 从上班到下班一件切换</a></p>
            <a href=""><img src="Images/index_10.jpg" alt="" /></a>
        </li>
    </div>
</div>



<!-- 潮流趋势结束 -->



<!-- 品牌馆 -->
<div class="index_title_hr">
    <h1>品牌馆</h1>
</div>

<div class="brand">
    <ul class="left">
        <li class="li1"><a href=""><img src="Images/index_pp_08.jpg" alt="" /></a></li>
        <li class="li2"><a href=""><img src="Images/index_pp_13.jpg" alt="" /></a></li>
        <li class="li3"><a href=""><img src="Images/index_pp_15.jpg" alt="" /></a></li>
        <li class="li4"><a href=""><img src="Images/index_pp_21.jpg" alt="" /></a></li>
        <li class="li5"><a href=""><img src="Images/index_pp_22.jpg" alt="" /></a></li>
        <li class="li6"><a href=""><img src="Images/index_pp_25.jpg" alt="" /></a></li>
        <li class="li7"><a href=""><img src="Images/index_pp_26.jpg" alt="" /></a></li>
        <li class="li8"><a href=""><img src="Images/index_pp_29.jpg" alt="" /></a></li>
        <li class="li9"><a href=""><img src="Images/index_pp_30.jpg" alt="" /></a></li>
    </ul>
    <ul class="right">
        <li class="li1"><a href=""><img src="Images/index_pp_03.jpg" alt="" /></a></li>
        <li class="li2"><a href=""><img src="Images/index_pp_05.jpg" alt="" /></a></li>
        <li class="li3"><a href=""><img src="Images/index_pp_17.jpg" alt="" /></a></li>
        <li class="li4"><a href=""><img src="Images/index_pp_19.jpg" alt="" /></a></li>
    </ul>
</div>



<!-- 品牌馆单品推荐轮播 -->

<div class="banner-container js-trend" id="js-trend">
    <ul>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
    </ul>
    <span class="left"><img src="Images/index_03.png" alt="" /></span>
    <span class="right"><img src="Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>

<!-- 品牌馆单品推荐轮播结束 -->



<!-- 女装馆 -->
<div class="index_title_hr">
    <h1>女装馆</h1>
</div>
<p class="index_title_hr_a"><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a></p>
<ul class="suit-dress">
    <li class="li1"><a href=""><img src="Images/index_031.jpg" alt="" /></a></li>
    <li class="li2"><a href=""><img src="Images/index_051.jpg" alt="" /></a></li>
    <li class="li3">
        <a href=""><img src="Images/index_08.jpg" alt=""  /></a>
        <p>裙装</p>
    </li>
    <li class="li4">
        <a href=""><img src="Images/index_101.jpg" alt="" /></a>
        <p>裤装</p>
    </li>
    <li class="li5">
        <a href=""><img src="Images/index_21.jpg" alt=""  /></a>
        <p>打底类</p>
    </li>
    <li class="li6">
        <a href=""><img src="Images/index_22.jpg" alt=""  /></a>
        <p>衬衫</p>
    </li>
</ul>
<!-- 女装馆结束 -->

<!-- 女装馆单品推荐轮播 -->
<div class="banner-container js-suit-dress">
    <ul>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
    </ul>
    <span class="left"><img src="Images/index_03.png" alt="" /></span>
    <span class="right"><img src="Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>

<!-- 女装馆单品推荐轮播结束 -->


<!-- 娘们的鞋包配饰馆 -->
<div class="index_title_hr">
    <h1>鞋包配饰馆</h1>
</div>
<p class="index_title_hr_a"><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a></p>
<div class="accessories ">
    <ul class="left">
        <li class="li1"><a href=""><img src="Images/index_accessories_03.jpg" alt="" /></a></li>
        <li class="li2"><a href=""><img src="Images/index_accessories_16.jpg" alt="" /></a></li>
        <li class="li3"><a href=""><img src="Images/index_accessories_18.jpg" alt="" /></a></li>
    </ul>
    <div class="center">
        <a href=""><img src="Images/index_accessories_05.jpg" alt="" /></a>
    </div>
    <ul class="right">
        <li >
            <a href=""><img src="Images/index_accessories_08.jpg" alt="" /></a>
            <p class="p1">色非女鞋</p>
            <p class="p2">￥345.00 <span>[5.8折]</span></p>
            <p class="p3"><img src="Images/index_28.jpg" alt="" />03天19小时00分48秒</p>
        </li>
        <li >
            <a href=""><img src="Images/index_accessories_14.jpg" alt="" /></a>
            <p class="p1">色非女鞋</p>
            <p class="p2">￥345.00 <span>[5.8折]</span></p>
            <p class="p3"><img src="Images/index_28.jpg" alt="" />03天19小时00分48秒</p>
        </li>
    </ul>
</div>
<!-- 娘们的鞋包配饰馆结束 -->
<!-- 娘们的鞋包单品推荐轮播 -->
<div class="banner-container js-accessories">
    <ul>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
    </ul>
    <span class="left"><img src="Images/index_03.png" alt="" /></span>
    <span class="right"><img src="Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>

<!-- 娘们的鞋包单品推荐轮播结束 -->



<!-- 美妆馆 -->
<div class="index_title_hr">
    <h1>美妆馆</h1>
</div>
<p class="index_title_hr_a"><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a></p>


<ul class="beautiful">
    <li class="li1"><a href=""><img src="Images/index_031.jpg" alt="" /></a></li>
    <li class="li2">
        <div class="img1">
            <a href=""><img src="Images/index_33.jpg" alt="" /></a>
        </div>
        <div class="img2">
            <a href=""><img src="Images/index_33.jpg" alt="" /></a>
        </div>
    </li>
    <li class="li3">
        <a href=""><img src="Images/index_08.jpg" alt=""  /></a>
        <p>裙装</p>
    </li>
    <li class="li4">
        <a href=""><img src="Images/index_101.jpg" alt="" /></a>
        <p>裤装</p>
    </li>
    <li class="li5">
        <a href=""><img src="Images/index_21.jpg" alt=""  /></a>
        <p>打底类</p>
    </li>
    <li class="li6">
        <a href=""><img src="Images/index_21.jpg" alt=""  /></a>
        <p>打底类</p>
    </li>
</ul>



<!-- 美妆馆结束 -->
<!-- 美妆馆单品推荐轮播 -->
<div class="banner-container js-beautiful">
    <ul>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
    </ul>
    <span class="left"><img src="Images/index_03.png" alt="" /></span>
    <span class="right"><img src="Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>

<!-- 美妆馆单品推荐轮播结束 -->



<!-- 养生馆 -->
<div class="index_title_hr">
    <h1>养生馆</h1>
</div>
<p class="index_title_hr_a"><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a><a href="">分类</a></p>

<ul class="rest">
    <li class="li1">
        <a href=""><img src="Images/index_066.jpg" alt="" /></a>
        <p>家居生活</p>
        <a href=""><img src="Images/index_066.jpg" alt="" /></a>
        <p>家居生活</p>
    </li>
    <li class="li2">
        <a href=""><img src="Images/index_034.jpg" alt="" /></a>
    </li>

    <li class="li3">
        <a href=""><img src="Images/index_08.jpg" alt=""  /></a>
        <p>裙装</p>
    </li>
    <li class="li4">
        <a href=""><img src="Images/index_101.jpg" alt="" /></a>
        <p>裤装</p>
    </li>
    <li class="li5">
        <a href=""><img src="Images/index_21.jpg" alt=""  /></a>
        <p>打底类</p>
    </li>
    <li class="li6">
        <a href=""><img src="Images/index_21.jpg" alt=""  /></a>
        <p>打底类</p>
    </li>
</ul>


<!-- 养生馆结束 -->
<!-- 养生馆单品推荐轮播 -->
<div class="banner-container js-rest">
    <ul>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
        <li>
            <a href=""><img src="Images/index_980.jpg" alt="" /></a>
            <div>
                <a href="">
                    <p class="p1">弄情季2015秋新款季2015秋新款纯手…</p>
                    <p class="p2">￥1089.00</p>
                </a>
            </div>
        </li>
    </ul>
    <span class="left"><img src="Images/index_03.png" alt="" /></span>
    <span class="right"><img src="Images/index_05.png" alt="" /></span>
</div>
<div class="banner-container-title" ><span>单品推荐</span></div>

<!-- 养生馆单品推荐轮播结束 -->




<div class="top46"></div>

<div class="index_footer">
    <div class="footer1">
        <ul class="container">
            <li><a href=""><img src="Images/index_footer_03.png" alt="" />100%正品</a></li>
            <li><a href=""><img src="Images/index_footer_05.png" alt="" />7天放心退</a></li>
            <li><a href=""><img src="Images/index_footer_07.png" alt="" />分享就赚钱</a></li>
            <li><a href=""><img src="Images/index_footer_09.png" alt="" />买贵返差额</a></li>
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
    <div class="weixin"><img src="Images/register_10.jpg" alt="" /></div>
    </div>
</div>
<script type="text/javascript" src="Js/index.js"></script>






<!-- 20151228浮动搜索框 -->
<div class="pos_search" style="display:none;">
    <div class="container">
        <div class="logo"><img src="Images/index20151218_03.png" alt="" /></div>
        <form action="">
            <input type="text" />
            <button type="bottom"></button>
        </form>
    </div>
</div>

<script type="text/javascript">
    
$(window).on('scroll',function(){
    var h_top=$(window).scrollTop()+46;
    if(110<h_top){
        $('.pos_search').css({"display":"block"});
    }else{
        $('.pos_search').css({"display":"none"});
    }
});
    

</script>

  </body>
</html>
<div class="index_footer">
    <div class="footer1">
        <ul class="container">
            <li><a href=""><img src="/Public/Computer/Images/index_footer_03.png" alt="" />100%正品</a></li>
            <li><a href=""><img src="/Public/Computer/Images/index_footer_05.png" alt="" />7天放心退</a></li>
            <li><a href=""><img src="/Public/Computer/Images/index_footer_07.png" alt="" />分享就赚钱</a></li>
            <li><a href=""><img src="/Public/Computer/Images/index_footer_09.png" alt="" />买贵返差额</a></li>
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
        <div class="weixin"><img src="/Public/Computer/Images/register_10.jpg" alt="" /></div>
    </div>
</div>
</body>
</html>