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
    <script type="text/javascript" src="/Public/Computer/Js//shan_cart.js"></script>
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
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a>
                    </dd>

                    <dl class="nav2">
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a></dt>
                        <dd>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1149));?>">寸衫</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1161));?>">T恤</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1162));?>">毛织</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1188));?>">打底衫</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1158));?>">短裤</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1159));?>">长裤</a>
                        </dd>

                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a></dt>
                        <dd>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1155));?>">连衣裙</a>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1156));?>">半身裙</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1007));?>">休闲包</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1168));?>">时装包</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1176));?>">丝巾</a>
                        </dd>
                    </dl>
                </dl>
            </li>
<!-- ################# 贰 ######################################### -->
<li>
    <dl class="nav1">
        <dt>容颜美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>425));?>">美妆</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">美妆</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>448));?>">底妆</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>450));?>">眼部</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>449));?>">腮红</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>451));?>">唇部</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>421));?>">面部</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1193));?>">身体</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>447));?>">香水</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################## 叁 ####################### -->
<li>
    <dl class="nav1">
        <dt>健康美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>876));?>">葡萄酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>877));?>">起泡酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>878));?>">水</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1192));?>">啤酒</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>923));?>">油</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>924));?>">调味</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>925));?>">五谷杂粮</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1090));?>">维生素</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1106));?>">蛋白质</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1135));?>">鱼油磷脂</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1136));?>">葡萄籽</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1137));?>">酵素</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>935));?>">饼干</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1138));?>">糖</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1194));?>">巧克力</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1195));?>">休闲小吃</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- #################### 肆  #################################     -->
<li>
    <dl class="nav1">
        <dt>心灵美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1183));?>">励志</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1184));?>">旅游</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1132));?>">育儿</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a></dt>
            <dd>
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
          
 <div class="bg_h"> <div class="shopping"> <ul class="title"> <li class="li1"> <label  onclick="select_all();"  class="js_all <?php if(($all_flag) == "1"): ?>click<?php endif; ?>">全选</label> </li> <li class="li2">商品信息</li> <li class="li3">单价（元）</li> <li class="li4">数量</li> <li class="li5">金额（元）</li> <li class="li6">操作</li> </ul> <?php if(!empty($cart_list)): ?><ul class="container"> <?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li> <div class="label"> <label onclick="change_selected(this,<?php echo ($value["id"]); ?>);"  <?php if(($value["selected"]) == "Y"): ?>class="click"<?php endif; ?>></label> </div> <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>" alt="" /></div> <dl> <dd class="dd1"><?php echo ($value["goods_name"]); ?></dd> <dd class="dd2" id="perunit<?php echo ($value["id"]); ?>"><?php echo ($value["goods_price"]); ?></dd> <dd class="dd3"> <i  onclick="change_goods_number('1',<?php echo ($value["id"]); ?>)"></i> <input type="hidden" id="back_number<?php echo ($value["id"]); ?>" value="<?php echo ($value["goods_number"]); ?>" /> <input type="text" id="goods_number<?php echo ($value["id"]); ?>" onblur="change_goods_number('2',<?php echo ($value["id"]); ?>)" onfocus="back_goods_number(<?php echo ($value["id"]); ?>)" value="<?php echo ($value["goods_number"]); ?>" class="js-number" /> <i onclick="change_goods_number('3',<?php echo ($value["id"]); ?>)"></i> </dd> <dd class="dd4" id="small_total<?php echo ($value["id"]); ?>"><?php echo ($value["small_total"]); ?></dd> <dd class="dd5 js-shanchu"> <span onclick="alert_delete(this)">删除</span> <div> <p>您确定要删除吗？</p> <span class="js-ok" onclick="drop_cart_goods(this,<?php echo ($value["id"]); ?>)">确定</span> <span class='span1 js-no' onclick="cancle(this)">取消</span> </div> </dd> </dl> <p class="class"> <?php if(is_array($value["goods_attr"])): $i = 0; $__LIST__ = $value["goods_attr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i;?><span class="span1"><?php echo ($attr[0]); ?>：<?php echo ($attr[1]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?> </p> </li><?php endforeach; endif; else: echo "" ;endif; ?> </ul> <?php else: ?> <div class="kong"><i class="gouwuche">&#xe653;</i> <p>购物车没有商品哦!<a href="">快去购物吧～</a></p> </div><?php endif; ?>
 </div> <div class="shopping_bottom"> <p class="p1"> <label  onclick="select_all();" class="js_all <?php if(($all_flag) == "1"): ?>click<?php endif; ?>">全选</label> <span>已选择 <i id="shan_go_number"><?php echo ((isset($total["go_number"]) && ($total["go_number"] !== ""))?($total["go_number"]):0); ?></i> 件商品</span></p> <p class="p2">总价（不含运费）：<span>￥<span id="shan_goods_price"><?php echo ((isset($total["goods_price"]) && ($total["goods_price"] !== ""))?($total["goods_price"]):0); ?></span></span></p> <p class="p3"><a href="javascript:;" onclick="history.go(-1);">继续购物</a><button onclick="go_checkout()">立即结算</button></p> </div> </div>



    </div>
</body>
</html>
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