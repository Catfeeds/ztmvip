$(function(){
    $.fn.extend({
        /**
         * 文件上传绑定
         * @param param type:上传类型{image,doc,zip}
         */
        'upfile':function(param){
            var el = $(this);
            param = param ? param : {};

            var tpl = '<div class="js-upload-file-layer" style="opacity:100;position:absolute;overflow:hidden;">' +
                '<form action="/index.php?m=Computer&c=UploadFile&a=upload&type={type}" method="post" enctype="multipart/form-data" target="js-upload-file-frame" style="position:absolute;bottom:0;right:0;">' +
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

    });
});