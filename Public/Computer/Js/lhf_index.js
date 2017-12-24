/**
 * @override index.js
 * @author lihongfu
 */

// 首页个人中心
//返利中心
$('.index_right_nav .personal_nav ul li.li2').on('click',function() {
    $.ajax({
        url:'/User/rebate.html',
        type:'get',
        chache:true,
        dataType:'json',
        success:function(ret){
            if(ret.state !== false){
                $('.rebate').html(ret.rebate);
                yesLogin();
            }else{
                noLogin();
            }
        }
    });
});


//余额
$('.index_right_nav .personal_nav ul li.li3').on('click', function() {
    $.get('/User/balance','',function(ret) {
        if(ret.state !== false) {
            $('.recharge').html(ret.balance);
            yesLogin();
        }else{
            noLogin();
        }
    },'json');
});

$('.recharge').on('click', '.xuanzhe .li1',function() {
    $('.recharge .xuanzhe li a').addClass('on_click');
    $(this).children('a').removeClass('on_click');

    $.post('/User/balance',{ 'state':'deposit' },function(ret){
        if(ret.state !== false){
            $('.recharge .con1 .hidden').html(ret.balanceContent);
        }
    },'json');
});

$('.recharge').on('click', '.xuanzhe .li2',function() {
    $('.recharge .xuanzhe li a').addClass('on_click');
    $(this).children('a').removeClass('on_click');

    $.post('/User/balance',{ 'state':'withdraw' },function(ret){
        if(ret.state !== false){
            $('.recharge .con1 .hidden').html(ret.balanceContent);
        }
    },'json');
});

// 我的红包
$('.index_right_nav .personal_nav ul li.li4').on('click', function() {
    $.get('/User/bonus','',function(ret) {
        if(ret.state !== false) {
            $('.js_hongbao_display').html(ret.bonus);
            yesLogin();
        }else{
            noLogin();
        }
    },'json');
});

$('.js_hongbao_display').on('click', '.xuanzhe .li1',function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({"display":"none"});
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao1_display').css({"display":"block"});

    $.post('/User/bonus',{ 'state':'not_used' },function(ret){
        if(ret.state !== false){
            $('.js_hongbao_display .con1 ul').html(ret.bonusContent);
        }
    },'json');
});
$('.js_hongbao_display').on('click', '.xuanzhe .li2',function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({"display":"none"});
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao2_display').css({"display":"block"});

    $.post('/User/bonus',{ 'state':'used' },function(ret){
        if(ret.state !== false){
            $('.js_hongbao_display .con1 ul').html(ret.bonusContent);
        }
    },'json');
});
$('.js_hongbao_display').on('click', '.xuanzhe .li3',function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({"display":"none"});
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao3_display').css({"display":"block"});

    $.post('/User/bonus',{ 'state':'expired' },function(ret){
        if(ret.state !== false){
            $('.js_hongbao_display .con1 ul').html(ret.bonusContent);
        }
    },'json');
});



//优惠券
$('.index_right_nav .personal_nav ul li.li5').on('click', function() {
    $.get('/User/coupon','',function(ret) {
        if(ret.state !== false) {
            $('.js_coupon').html(ret.coupon);
            yesLogin();
        }else{
            noLogin();
        }
    },'json');
});
$('.index_right_nav').on('click','.right .js_coupon .xuanzhe li.li1', function() {
    $(this).siblings('li').find('a').removeClass('this');
    $(this).find('a').addClass('this');
    $.post('/User/coupon',{ 'state':'not_used' },function(ret){
        if(ret.state !== false){
            $('.js_coupon .coupon ul').html(ret.couponContent);
        }
    },'json');
});
$('.index_right_nav').on('click', '.right .js_coupon .xuanzhe li.li2',function() {
    $(this).siblings('li').find('a').removeClass('this');
    $(this).find('a').addClass('this');
    $.post('/User/coupon',{ 'state':'used' },function(ret){
        if(ret.state !== false){
            $('.js_coupon .coupon ul').html(ret.couponContent);
        }
    },'json');
});
$('.index_right_nav').on('click', '.right .js_coupon .xuanzhe li.li3',function() {
    $(this).siblings('li').find('a').removeClass('this');
    $(this).find('a').addClass('this');
    $.post('/User/coupon',{ 'state':'expired' },function(ret){
        if(ret.state !== false){
            $('.js_coupon .coupon ul').html(ret.couponContent);
        }
    },'json');
});


// 储值卡
$('.index_right_nav .personal_nav ul li.li6').on('click', function() {
    $.get('/User/prepaid','',function(ret) {
        if(ret.state !== false) {
            $('.save').html(ret.prepaid);
            yesLogin();
        }else{
            noLogin();
        }
    },'json');
});


// 收藏
$('.index_right_nav .personal_nav ul li.li7').on('click', function() {
    $.get('/User/collection','',function(ret) {
        if(ret.state !== false) {
            $('.collect').html(ret.collection);
            yesLogin();
        }else{
            noLogin();
        }
    },'json');
});


$(".index_right_nav").on('click',' .right .collect .xuanzhe li.li1',function() {
    $(".index_right_nav .right .collect .xuanzhe li").children('a').addClass('on_click');
    $(this).children('a').removeClass('on_click');
    $('.index_right_nav .right .collect .con ul li').css({"display":"none"});
    $('.index_right_nav .right .collect .con ul li.ajax_li1').css({"display":"block"});

    $.post('/User/collection','',function(ret){
        if(ret.state !== false){
            $('.js_hongbao_display .con1 ul').html(ret.couponContent);
        }
    },'json');
});
$(".index_right_nav").on('click',' .right .collect .xuanzhe li.li2', function() {
    $(".index_right_nav .right .collect .xuanzhe li").children('a').addClass('on_click');
    $(this).children('a').removeClass('on_click');
    $('.index_right_nav .right .collect .con ul li').css({"display":"none"});
    $('.index_right_nav .right .collect .con ul li.ajax_li2').css({"display":"block"});

    $.post('/User/collection',{ 'favor_type':'article' },function(ret){
        if(ret.state !== false){
            $('.js_hongbao_display .con1 ul').html(ret.couponContent);
        }
    },'json');
});





$('.index_right_nav .personal_nav ul li.li8').on('click', function() {
    $.get('/Index/cart','',function(ret) {
        if(ret.state !== false) {
            $('.trade').html(ret.cart);
        }
    },'json');
});















$('.index_right_nav').on('click', '.right .top_false',function() {
    $('.index_right_nav').removeClass('index_right_nav_click');
});




$(function(){
    $('body').on('click',function(){
        $('.index_right_nav .personal_nav ul').removeClass('timing_click');
    });
});

function yesLogin(){
    $('.index_right_nav').addClass('index_right_nav_click');
}

function noLogin()
{
    //$('.index_right_nav').removeClass('index_right_nav_click');
    //$('.index_right_nav .personal_nav ul').addClass('timing_click');
    window.location.href='/index.php?m=Computer&c=Login&a=index';
}




// 品牌馆轮播
function brand_banner(){
    var dl_w=$('#brand_banner dd').length*112;
    $('#brand_banner').css('width',dl_w).stop(true,true);
    var dl_left=parseInt($('#brand_banner').css('left'))-224;
    $('#brand_banner').animate({'left':dl_left}, 800);
    if(dl_left<=224-dl_w){
        $('#brand_banner').animate({'left':'0px'},0);
    }

};
function he_brand(){
    var ind_dd=$('#brand_banner dd').length;
    if(ind_dd<2){
        return true;
    }
    $('#brand_banner').append($('#brand_banner dd:eq(0)').clone());
    $('#brand_banner').append($('#brand_banner dd:eq(1)').clone());

    // 鼠标悬停暂停
        int=self.setInterval("brand_banner()",4000);
    $('#brand_banner').on('mouseenter', function() {
        int=window.clearInterval(int);
    });
    $('#brand_banner').on('mouseleave', function() {
        int=self.setInterval("brand_banner()",4000);
    });
}
he_brand();






















