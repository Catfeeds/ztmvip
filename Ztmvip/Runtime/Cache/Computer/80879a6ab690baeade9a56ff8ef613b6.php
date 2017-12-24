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







<link rel="stylesheet" type="text/css" href="/Public/Computer/Css/register.css" />
</head>
<body>

<div class="register">
    <div class="left">
        <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Public/Computer/Images/index_logo.png" alt="" /></a></div>
        <div class="banner"><img src="/Public/Computer/Images/register_06.jpg" alt="" /></div>
    </div>
    <div class="right">
        <p class="title">欢迎登录</p>
        <form class="js-login" action="">
            <p style="display: none;" class="entry_alert">手机号码或密码不正确！</p>
            <input name="mobile" class="name" type="text" placeholder="手机号码"   />
            <input name="password" class="mima" type="password" placeholder="密码"   />
            <input name="remember" type="hidden" value="">
            <input name="ret" type="hidden" value="<?php echo ($ret); ?>">
            <p class="checkbox">
                <i class=""></i>
                记住密码
            </p>
            <button class="zhuche js-submit-login" type="button">立即登录</button>
            <p class="ptishi">你也可以使用以下账号登录</p>
            <div class="weixin"><a href="<?php echo U('Login/wechatOem');?>"><img src="/Public/Computer/Images/register.jpg" alt="" /></a></div>
            <p class="denglu">还不是整体美会员？<a href="<?php echo U('Register/index');?>">快速注册</a><a class="wangji" href="<?php echo U('Login/findPwd');?>">忘记密码?</a></p>
        </form>
    </div>
</div>

<script src="/Public/Computer/Js/register.js"></script>
<script src="/Public/Computer/Js/lhf_register.js"></script>
<script type="text/javascript">
    $('.checkbox').on('click',function () {
        if($(':hidden[name=remember]').val()=="ok"){
            $(':hidden[name=remember]').val("");
            $('.register .right .checkbox i').removeClass('ok');
        }else{
            $(':hidden[name=remember]').val("ok");
            $('.register .right .checkbox i').addClass('ok');
        }
    })
    $('.js-submit-login').on('click',function(){
        if(!checkLogin()){
            return;
        }
        $.post("<?php echo U('');?>",Core.InputObj('.js-login'),function(ret){
            if (ret.state){
                Core.Alert({ 'text':ret.message });
                if(ret.uri){
                    window.location.href=ret.uri;
                }
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });

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