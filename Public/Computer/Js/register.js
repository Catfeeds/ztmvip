/* 
* @Author: Marte
* @Date:   2015-12-24 15:42:31
* @Last Modified by:   Marte
* @Last Modified time: 2015-12-29 17:44:30
*/


// 注册页面


//输入框字体颜色
$('input').on('focus',function   () {
    $(this).css({"color":"#252525"});
});

$('input').on('blur',function   () {
    if($(this).val()==""){
        $(this).css({"color":"#808080"})
    }
});


//用户名
$('.he_name input').on('blur', function() {
    if($(this).val()==""){
        $('.he_name').addClass('false');
        $('.he_name p span').text('请输入用户名')
    }else{
        $('.he_name').removeClass('false');
        $('.he_name p span').text('');

    }
});

//密码格式验证
$('.he_mima1 input').on('blur', function() {
var i=/^(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9]{6,20}$/gi;
    if(i.test($(this).val())){
        $('.he_mima1').removeClass('false');
        $('.he_mima1 p span').text('');
    }else{
        $('.he_mima1').addClass('false');
        $('.he_mima1 p span').text('请输入6-20位由字母与数字混合组成的密码！')
    }
});

//密码是否相同
$('.he_mima2 input').on('blur', function() {
    he_mima1 = $('.he_mima1 input').val();
    he_mima2 = $('.he_mima2 input').val();
    if( he_mima2==""){
        $('.he_mima2').addClass('false');
        $('.he_mima2 p span').text('请输入密码');
    }else if(he_mima2!=he_mima1){
        $('.he_mima2').addClass('false');
        $('.he_mima2 p span').text('请输入相同的密码');
    }else{
        $('.he_mima2').removeClass('false');
        $('.he_mima2 p span').text('');
    }
});
//手机号码验证
$(".he_phone input").on('blur',function() {
     var tel = $("input.iphone").val();
     var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
     if (!reg.test(tel)) {
        $(".he_phone").addClass('false');
        $('.he_phone p span').text("输入的手机号码不正确");
     }else{
        $(".he_phone").removeClass('false');
        $('.he_phone p span').text("");
     }
});


//验证码

$('.yanzhengma').on('blur', function() {
    if($(this).val()==""){
        $('.he_yanzhengma span').text("请输入验证码").css({"display":"block"});
        $(this).addClass('zhuche_false');
    }else{
        $('.he_yanzhengma span').css({"display":"none"});
        $(this).removeClass('zhuche_false');

    }
});


//登陆页面

//用户名

$(".register .right input.name").on('focus',function  () {
    $(this).addClass('name_hover');
});
$(".register .right input.name").on('blur',function  () {
    $(this).removeClass('name_hover');
    if($(this).val()==""){
        $('.register .right .entry_alert').text("请输入用户名!")
        $('.register .right .entry_alert').css({"display":"block"});
    }else{
        $('.register .right .entry_alert').css({"display":"none"});
    };
});

//密码
$(".register .right input.mima").on('focus',function  () {
    $(this).addClass('mima_hover');
});
$(".register .right input.mima").on('blur',function  () {
    $(this).removeClass('mima_hover');
    var i=/^(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9]{6,20}$/gi;
    if(i.test($(this).val())){
        $('.register .right .entry_alert').css({"display":"none"});
    }else {
        if($(this).val()==""){
            $('.register .right .entry_alert').text("请输入密码!")
        }else{
            $('.register .right .entry_alert').text("密码错误!")
        }
        $('.register .right .entry_alert').css({"display":"block"});
    }

});
