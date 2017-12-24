/* 
 * @Author: Marte
 * @Date:   2015-12-24 15:42:31
 * @Last Modified by:   Marte
 * @Last Modified time: 2016-01-27 14:57:02
 */
//function preventScroll(className){
//    var _this = document.getElementsByClassName(className)[0];
//    if(navigator.userAgent.indexOf("Firefox")>0){
//        _this.addEventListener('DOMMouseScroll',function(e){
//            _this.scrollTop += e.detail > 0 ? 60 : -60;
//            e.preventDefault();
//        },false);
//    }else{
//        _this.onmousewheel = function(e){
//            e = e || window.event;
//            _this.scrollTop += e.wheelDelta > 0 ? -60 : 60;
//            return false;
//        };
//    }
//    return this;
//}
$(function() {
    $('.index_right_nav').on('mouseover', function(e) {
        $(document).bind('mousewheel', function() {
            if (e.stopPropagation) e.stopPropagation();
            else e.cancelBubble = true;
            if (e.preventDefault) e.preventDefault();
            else e.returnValue = false;
            return false;
        });
    }).on('mouseleave', function(e) {
        $(document).unbind('mousewheel');
    }).on('mousewheel', '.js-scroll', function(e) {
        var el = $(this);
        el.scrollTop(el.scrollTop() - e.originalEvent.wheelDelta);
    });
});
// 首页banner轮播
function indexbanner() {
    var li_img = $('.index_banner .container li').length;
    if (li_img == 1) {
        $('.index_banner .container .right,.index_banner .container .left').css({
            "display": "none"
        });
        return
    }
    var li1 = $('.index_banner .container li:eq(0)').clone()
    $('.index_banner .container ul').append(li1);
    var ul_w_banner = $('.index_banner .container li').length * 1920;
    $(".index_banner .container ul").css({
        "width": ul_w_banner
    });

    function Rclick() {
        var Left = $(".index_banner .container ul").css("left");
        var Left = parseInt(Left) - 1920;
        $(".index_banner .container ul").animate({
            "left": Left
        }, 250);
        var min = 1920 - ul_w_banner;
        if (Left <= min) {
            $(".index_banner .container ul").animate({
                "left": 0
            }, 0);
        }
    }
    $('.index_banner .container .right').on('click', function() {
            int=window.clearInterval(int);
            $(".index_banner .container ul").stop(true, true);
            Rclick();
    });
    Rclick();
    var int=self.setInterval(function() {
        Rclick();
    }, 5000)

    function Lclick() {
        var Left = $(".index_banner .container ul").css("left");
        var Left = parseInt(Left) + 1920;
        $(".index_banner .container ul").animate({
            "left": Left
        }, 250);
        var min = 1920 - ul_w_banner;
        if (Left >= 0) {
            $(".index_banner .container ul").animate({
                "left": min
            }, 0);
        }
    }
    $('.index_banner .container .left').on('click', function() {
        int=window.clearInterval(int);
        $(".index_banner .container ul").stop(true, true);
        Lclick();
    });
}
indexbanner();
// 单品推荐轮播
function min_banner(Class) {
    // var js_img1 = document.getElementsByClassName(Class)[0];
    // var li_index = js_img1.getElementsByTagName('li').length;
    
    var banner="."+Class;
    var li_index = $(banner).find('li').length;
    var ul_w = li_index * 172;
    var ul = "." + Class + " ul";
    var but_l = "." + Class + " .left";
    var but_r = "." + Class + " .right";
    $(ul).css({
        "width": ul_w
    });
    var ul_pos_left = 0;
    $(but_l).on('click', function() {
        if (ul_pos_left < 0) {
            ul_pos_left = ul_pos_left + 171;
            $(ul).animate({
                "left": ul_pos_left
            }, 200);
        }
    });
    $(but_r).on('click', function() {
        if (ul_pos_left > 1331 - ul_w) {
            ul_pos_left = ul_pos_left - 171;
            $(ul).animate({
                "left": ul_pos_left
            }, 200);
        }
    });
}
min_banner("js-trend");
min_banner("js-suit-dress");
min_banner("js-accessories");
min_banner("js-beautiful");
min_banner("js-rest");
$('.hot .right li').hover(function() {
    $('.hot .right li').removeClass("hover");
    $(this).addClass('hover');
    if ($('.hot .right li.title').hasClass('hover')) {
        $('.hot .right li:eq(1)').addClass('hover');
    }
});
$('.trend .right li').hover(function() {
    $('.trend .right li').removeClass("hover");
    $(this).addClass('hover');
    if ($('.trend .right li.title').hasClass('hover')) {
        $('.trend .right li:eq(1)').addClass('hover');
    }
});














// 首页个人中心
//返利中心
$('.index_right_nav .personal_nav ul li.li2').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li2hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.rebate').css({
        "display": 'block'
    });
});
$('.index_right_nav .personal_nav ul li.li3').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li3hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.recharge').css({
        "display": 'block'
    });
});
// 我的红包
$('.index_right_nav .personal_nav ul li.li4').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li4hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.js_hongbao_display').css({
        "display": 'block'
    });
});
$('.js_hongbao_display .xuanzhe .li1').on('click', function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({
        "display": "none"
    });
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao1_display').css({
        "display": "block"
    });
});
$('.js_hongbao_display .xuanzhe .li2').on('click', function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({
        "display": "none"
    });
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao2_display').css({
        "display": "block"
    });
});
$('.js_hongbao_display .xuanzhe .li3').on('click', function() {
    $('.js_hongbao_display .xuanzhe li a').removeClass('this');
    $(this).children('a').addClass('this');
    $('.index_right_nav .right .hongbao .con1 ul li').css({
        "display": "none"
    });
    $('.index_right_nav .right .hongbao .con1 ul li.ajax_hongbao3_display').css({
        "display": "block"
    });
});
//优惠券
$('.index_right_nav .personal_nav ul li.li5').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li5hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.js_coupon').css({
        "display": 'block'
    });
});
$('.index_right_nav .right .js_coupon .xuanzhe li.li1').on('click', function() {
    $('.index_right_nav .right .hongbao .coupon ul li').css({
        "display": 'none'
    });
    $('.ajax_coupon1_display').css({
        "display": "block"
    });
});
$('.index_right_nav .right .js_coupon .xuanzhe li.li2').on('click', function() {
    $('.index_right_nav .right .hongbao .coupon ul li').css({
        "display": 'none'
    });
    $('.ajax_coupon2_display').css({
        "display": "block"
    });
});
$('.index_right_nav .right .js_coupon .xuanzhe li.li3').on('click', function() {
    $('.index_right_nav .right .hongbao .coupon ul li').css({
        "display": 'none'
    });
    $('.ajax_coupon3_display').css({
        "display": "block"
    });
});
// 储值卡
$('.index_right_nav .personal_nav ul li.li6').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li6hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.save').css({
        "display": 'block'
    });
});
// 收藏
$('.index_right_nav .personal_nav ul li.li7').on('click', function() {
    //$('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li7hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.collect').css({
        "display": 'block'
    });
});
$(".index_right_nav .right .collect .xuanzhe li.li1").on('click', function() {
    $(".index_right_nav .right .collect .xuanzhe li").children('a').addClass('on_click');
    $(this).children('a').removeClass('on_click');
    $('.index_right_nav .right .collect .con ul li').css({
        "display": "none"
    });
    $('.index_right_nav .right .collect .con ul li.ajax_li1').css({
        "display": "block"
    });
});
$(".index_right_nav .right .collect .xuanzhe li.li2").on('click', function() {
    $(".index_right_nav .right .collect .xuanzhe li").children('a').addClass('on_click');
    $(this).children('a').removeClass('on_click');
    $('.index_right_nav .right .collect .con ul li').css({
        "display": "none"
    });
    $('.index_right_nav .right .collect .con ul li.ajax_li2').css({
        "display": "block"
    });
});
$('.index_right_nav .personal_nav ul li.li8').on('click', function() {
    $('.index_right_nav').addClass('index_right_nav_click');
    $('.index_right_nav .personal_nav ul li').removeClass('li2hover li3hover li4hover li5hover li6hover li7hover li8hover');
    $(this).addClass('li8hover');
    $('.rebate,.recharge,.js_hongbao_display,.js_coupon,.save,.collect,.trade').css({
        "display": "none"
    });
    $('.trade').css({
        "display": 'block'
    });
});
$('.index_right_nav .right .top_false').on('click', function() {
    $('.index_right_nav').removeClass('index_right_nav_click');
});