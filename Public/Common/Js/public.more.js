/**
 * 延时加载ajax
 * author: lihongfu
 */
var lock = false;
var scroll = false;
//var url="/index.php?m=Mobile&c=Category&a=getCatGoods";
var goods_params = {};
/*
 @params{
 url:‘ajax获取商品的地址’,
 cat_id:‘分类id’,
 brand_id:‘品牌id’
 }
 */
function moreGoods(params) {
    goods_params = params;
    goods_params.page = 1;
    goods_params.pageSize = 10;
    $(window).on('scroll', function () {
        if (($(window).scrollTop() == $(document).height() - $(window).height()) && lock == false) {
            scroll = true;
            get_more();
        }
    })

    if (scroll == false) {
        get_more();
    }

}
function resetLock() {
    lock = false;
    scroll = false;
}

function get_more() {
    $('#loader').show();
    lock = true;
    var url = goods_params.url;
    var data = {
        cat_id: goods_params.cat_id,
        brand_id: goods_params.brand_id,
        page: goods_params.page,
        pageSize: goods_params.pageSize
    }
    $.post(url, data, function (reback) {

        if (reback.state == 8) {
            $('#loader').fadeOut();
            $('.goods_box').append(reback.content);
            $("img.lazy").lazyload({'threshold': 400});
            goods_params.page++;
            lock = false;

        } else {
            if (goods_params.page == 1) {
                if (reback.state == 2) {
                    var div = '<div class="icon_CableNull"><i class="icon_CableNull_font">&#xe628;</i><p>暂无结果</p></div>';
                }
                $('.goods_box').html(div);
            }

            goods_params.page--;
            $('#loader').hide();
        }
    }, 'json');
}


function test() {
    alert(goods_params);
    alert(lock);
}

