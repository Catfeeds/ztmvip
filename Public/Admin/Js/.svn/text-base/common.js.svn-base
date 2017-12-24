$(function(){
    //异步链接
    $('a.js-ajax').click(function(event){
        $.get(this.href,function(ret){
            if (ret.state){
                if (ret.message){
                    Core.Alert({'text':ret.message,'callback':function(){
                        if (ret.callback)
                            eval(ret.callback);
                    }});
                }else{
                    if (ret.callback)
                        eval(ret.callback);
                }
            }else{
                Core.Alert({'text':ret.message,'state':'err'});
            }
        },'json');

        event.preventDefault();
    });

    $('table.js-list').on('click','thead :checkbox',function(event){
        $(event.delegateTarget).find('tbody :checkbox').prop('checked',this.checked).prop('indeterminate',false);
    }).on('click','tbody :checkbox',function(event){
        var length = $(event.delegateTarget).find('tbody :checkbox').length;
        var checked = $(event.delegateTarget).find('tbody :checked').length;
        $(event.delegateTarget).find('thead :checkbox')
            .prop('checked',checked == length)
            .prop('indeterminate',checked && checked != length);
    });

    $.fn.extend({
        /**
         * 文件上传绑定
         * @param param type:上传类型{image,doc,zip}
         */
        'upfile':function(param){
            var el = $(this);
            param = param ? param : {};

            var tpl = '<div class="js-upload-file-layer" style="opacity:100;position:absolute;overflow:hidden;">' +
                '<form action="/index.php?m=Admin&c=UploadFile&a=upload&type={type}" method="post" enctype="multipart/form-data" target="js-upload-file-frame" style="position:absolute;bottom:0;right:0;">' +
                '<input name="file" type="file" style="font-size:9999px;cursor:pointer;" onchange="this.form.submit();">' +
                '</form>' +
                '<iframe name="js-upload-file-frame" id="js-upload-file-frame" frameborder="0" src="about:blank" style="display:none;"></iframe>' +
                '</div>';

            $('.js-upload-file-layer').remove();
            $(document.body).append(Core.FormatTpl(tpl,{'type':param['type']?param['type']:'image'}));

            $('.js-upload-file-layer').css('height',el.outerHeight())
                .css('width',el.outerWidth())
                .css('left',el.offset().left)
                .css('top',el.offset().top);
        },
        'selfile':function(param){
            param = param ? param : {};

            Core.Frame({'title':'文件浏览','url':'/index.php?m=Admin&c=UploadFile&a=lists&type='+ (param['type']?param['type']:'image') +'&time='+ (new Date()).getTime(),'width':'1020','height':'560'});
        }
    });

    $('.js-upimg-box').on('mouseenter','.up a',function(event){
        $(this).upfile();
    }).on('mousemove','.up img',function(event){
        var el = $(this);

        if (event.pageX < el.offset().left + el.outerWidth() / 2){
            el.parent().find('span').hide().eq(0).show();
        }else if(event.pageX > el.offset().left + el.outerWidth() / 2){
            el.parent().find('span').hide().eq(1).show();
        }
    }).on('mouseleave','.up',function(event){
        $(this).parent().find('span').hide();
    }).on('click','.up .prev,.up .next',function(event){
        var el = $(this);
        var ul = $(this).closest('ul');

        if (el.hasClass('prev') && ul.prev('ul:not(.upimg-new)').length)
            ul.prev('ul').before(ul);
        else if (el.hasClass('next') && ul.next('ul:not(.upimg-new)').length)
            ul.next('ul').after(ul);
    }).on('click','.s',function(){
        $(this).selfile();
    }).on('mouseenter','.e',function(event){
        $(this).upfile();
    }).on('click','.d',function(event){
        $(this).closest('ul').remove();
    });

    $('select[name][option]').each(function(i,e){
        if ($(e).attr('option'))
            $(e).val($(e).attr('option'));

        $(e).change();
    });

    $('body').on('change','select.js-goods-category',function(){
        var el = $(this);
        var val = (el.val() == 'reload' ? 0 : parseInt(el.val()));

        el.nextAll('select.js-goods-category').remove();
        el.removeAttr('name').siblings('select.js-goods-category').removeAttr('name');

        if (!el.val()){
            el.prev('select.js-goods-category').attr('name',el.prev('select.js-goods-category').attr('_name'));
            return;
        }

        if (!window._goods_category)
            window._goods_category = [];

        if (!window._goods_category[val]){
            $.ajaxSetup({ 'async':false });
            $.post('/index.php?c=GoodsCategory&a=search',{ 'parent_category':val },function(ret){
                window._goods_category[val] = ret;
            });
            $.ajaxSetup({ 'async':true });
        }

        if (window._goods_category[val].length){
            var option = '<option value="">—请选择—</option>';
            $.each(window._goods_category[val],function(i,e){
                option += '<option value="'+e.id+'">'+e.category_name+'</option>';
            });
            el.after(el.clone().html(option));
        }

        el.attr('name',el.attr('_name'));

        if (el.val() == 'reload')
            el.remove();
    });

    $('select.js-goods-category[option]').each(function(i,e){
        var el = $(this);

        if (!el.attr('option'))
            return;

        $.post('/index.php?c=GoodsCategory&a=search',{ 'category_id':$(this).attr('option') },function(ret){
            if (ret.length){
                var option = '<option value="reload">重新选择</option>';
                $.each(ret,function(i,e){
                    option += '<option value="'+e.id+'" selected>'+e.category_name+'</option>';
                });
                el.attr('name',el.attr('_name')).html(option);
            }
        });
    });
});