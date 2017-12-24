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
        <div class="logo"><a href=""><img src="/Public/Computer/Images/index_logo.png" alt="" /></a></div>
        <div class="banner"><img src="/Public/Computer/Images/register_06.jpg" alt="" /></div>
    </div>
    <div class="right">
        <form class="js-findpwd" action="">
            <div class="he_phone">
                <p>手机号码<span>错误提示语</span></p>
                <input name="mobile" type="text" class="iphone" />
            </div>
            <p class="he_yanzhengma"><span>请输入验证码</span>验证码</p>
            <input name="sms_code" class="yanzhengma" type="text"   />
            <button type="button" class="js-sms-code" data-rel="new">点击获取验证码</button>
            <button class="zhuche js-submit-findpwd" type="button">重置密码</button>
            <div style="padding-top: 50px;"></div>
        </form>
    </div>
</div>

<script src="/Public/Computer/Js/lhf_findPwd.js"></script>
<script type="text/javascript">

    $('.js-submit-findpwd').on('click',function(){
        if(!checkFindPwd()){
            return;
        }
        $.post("<?php echo U('');?>",Core.InputObj('.js-findpwd'),function(ret){
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
        $.post("<?php echo U('Sms/userFindPwd');?>",{ 'topic':el.attr('data-rel'),'mobile':$('input[name="mobile"]').val() },function(ret){
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
                <img src="/Public/Computer/Images/weixin.gif" alt="" />
                <p>关注注册送红包，分享购买返佣金！</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>