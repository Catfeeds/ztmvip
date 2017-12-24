var registerPhone = true;
var registerPwd = true;
var registerRepwd = true;
var registerSmsCode = true;

//输入框字体颜色
$('input').on('focus',function   () {
    $(this).css({"color":"#252525"});
});

$('input').on('blur',function   () {
    if($(this).val()==""){
        $(this).css({"color":"#808080"})
    }
});


//密码格式验证
$('.he_mima1 input').on('blur', function() {
    var pwd = $(this).val();
    if(pwd.length<6 || pwd.length>20){
        $('.he_mima1').addClass('false');
        $('.he_mima1 p span').text('请输入6-20位由字母与数字混合组成的密码！');
        registerPwd = false;
        return;
    }
    var level = 0;
    if(pwd.match(/[0-9]/)){
        ++level;
    }
    if(pwd.match(/[a-z]/)){
        ++level;
    }
    if(pwd.match(/[A-Z]/)){
        ++level;
    }
    if(pwd.match(/[^0-9a-zA-Z]/)){
        ++level;
    }
    //判断密码强度
    if(level<2){
        $('.he_mima1').addClass('false');
        $('.he_mima1 p span').text('密码过于简单，请尝试"数字+字母"的组合！');
        registerPwd = false;
        return;
    }

    $('.he_mima1').removeClass('false');
    $('.he_mima1 p span').text('');
    registerPwd = true;
});

//密码是否相同
$('.he_mima2 input').on('blur', function() {
    he_mima1 = $('.he_mima1 input').val();
    he_mima2 = $('.he_mima2 input').val();
    if( he_mima2==""){
        $('.he_mima2').addClass('false');
        $('.he_mima2 p span').text('请输入密码');
        registerRepwd = false;
    }else if(he_mima2!=he_mima1){
        $('.he_mima2').addClass('false');
        $('.he_mima2 p span').text('请输入相同的密码');
        registerRepwd = false;
    }else{
        $('.he_mima2').removeClass('false');
        $('.he_mima2 p span').text('');
        registerRepwd = true;
    }
});
//手机号码验证
$(".he_phone input").on('blur',function() {
    var tel = $("input.iphone").val();
    var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
    if (!reg.test(tel)) {
        $(".he_phone").addClass('false');
        $('.he_phone p span').text("输入的手机号码不正确");
        registerPhone = false;
    }else{
        $.ajax({
            async: false,
            url: "/index.php?c=Register&a=userMobileAvailable",
            type: 'post',
            data: {mobile: $('input[name = mobile]').val()},
            success:function(ret){
                if(ret.state){
                    $(".he_phone").addClass('false');
                    $('.he_phone p span').text("该手机号码未注册过");
                    registerPhone = false;
                }else{
                    $(".he_phone").removeClass('false');
                    $('.he_phone p span').text("");
                    registerPhone = true;
                }
            }
        });
    }
    console.log(registerPhone);
    if(registerPhone == false){
        $('.js-sms-code').css('background-color','#ccc').prop('disabled',true);
    }else{
        $('.js-sms-code').css('background-color','').prop('disabled',false);
    }
});

//验证码

$('.yanzhengma').on('blur', function() {
    if($(this).val()==""){
        $('.he_yanzhengma span').text("请输入验证码").css({"display":"block"});
        $(this).addClass('zhuche_false');
        registerSmsCode = false;
    }else{
        $('.he_yanzhengma span').css({"display":"none"});
        $(this).removeClass('zhuche_false');
        registerSmsCode = true;
    }
});

function checkFindPwd(){
    $(".he_phone input").blur();
    $('.yanzhengma').blur();
    if(!registerPhone || !registerSmsCode){
        return false;
    }
    return true;
}

function checkResetPwd()
{
    $('.he_mima1 input').blur();
    $('.he_mima2 input').blur();
    if( !registerPwd || !registerRepwd ){
        return false;
    }
    return true;
}

function checkPhone()
{
    $(".he_phone input").blur();
    if(!registerPhone) {
        return false;
    }
    return true;
}

