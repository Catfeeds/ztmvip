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
        <form class="js-register" action="">
            <!--             <div class="he_name">
                            <p>用户名<span></span></p>
                            <input type="text" class="reg_name"  />
                        </div> -->
            <div class="he_phone">
                <p>手机号码<span>错误提示语</span></p>
                <input name="mobile" type="text" class="iphone" />
            </div>
            <div class="he_mima1">
                <p>密码<span>错误提示语</span></p>
                <input name="password" type="password"  />
            </div>
            <div class="he_mima2">
                <p>确认密码<span>错误提示语</span></p>
                <input name="repassword" type="password" />
            </div>
            <p class="he_yanzhengma"><span>请输入验证码</span>验证码</p>
            <input name="sms_code" class="yanzhengma" type="text"   />
            <button type="button" class="js-sms-code" data-rel="new">点击获取验证码</button>
            <button class="zhuche js-submit-register" type="button">立即注册</button>
            <input name="agree" type="hidden" value="ok">
            <p class="checkbox">
                <span><i class="ok"></i>
                我已阅读并同意</span><a target="_blank" href="http://www.ztmvip.com/Article/show/id/99.html">《整体美用户注册协议》</a>
            </p>
            <p class="denglu">已经是整体美会员？<a href="<?php echo U('Login/index');?>">立即登录</a></p>
        </form>
    </div>
</div>

<script src="/Public/Computer/Js/register.js"></script>
<script src="/Public/Computer/Js/lhf_register.js"></script>
<script type="text/javascript">
    $('.checkbox').on('click','span',function () {
        if($(':hidden[name=agree]').val()=="ok"){
            $(':hidden[name=agree]').val("");
            $('.register .right .checkbox i').removeClass('ok');
        }else{
            $(':hidden[name=agree]').val("ok");
            $('.register .right .checkbox i').addClass('ok');
        }
    })

    $('.js-submit-register').on('click',function(){
        if(!checkRegister()){
            return;
        }
        $.post("<?php echo U('');?>",Core.InputObj('.js-register'),function(ret){
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

    $('.js-sms-code').on('click',function(){
        if(!checkPhone()){
            return;
        }
        if ($(this).prop('disabled'))
            return;
        $(this).prop('disabled',true);
        var timeout = 60;
        var el = $(this);
        $.post("<?php echo U('Sms/userRegister');?>",{ 'topic':el.attr('data-rel'),'mobile':$('input[name="mobile"]').val() },function(ret){
            if (ret.state){
                Core.Alert({ 'text':ret.message });
                sms_time(el,timeout);
            }else{
                Core.Alert({ 'text':ret.message,'state':'err' });
            }
        },'json');
    });

    function sms_time(el,timeout){
        if (timeout == 0) {
            el.css('background-color','').prop('disabled',false).html('点击获取验证码');
        }else{
            el.css('background-color','#ccc').prop('disabled',true).html('重新发送('+ timeout +')');
            timeout--;
            setTimeout(function(){
                sms_time(el,timeout);
            },1000);
        }
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
<script type="text/javascript" src="/Public/Computer/Js//index.js"></script>
<script type="text/javascript" src="/Public/Computer/Js//lhf_index.js"></script>
</body>
</html>