var Core = (function(){
    var _timeout = {}
        ,_tpl_background = '<div class="core-background"></div>';

    var set_middle_position = function(obj,mode,top,left) {
        var _ww = $(window).outerWidth();
        var _wh = $(window).outerHeight();

        top = top ? top : 0;
        left = left ? left : 0;

        switch (mode) {
            case 'top':
                break;
            case 'left':
                break;
            case 'middle':
                $(obj).css('left',(_ww - $(obj).outerWidth()) / 2 + left).css('top',(_wh - $(obj).outerHeight()) / 2 + $(document).scrollTop() + top);
                break;
            case 'right':
                break;
            case 'bottom':
                break;
        }
    }

    return {
        /**
         * 模版格式化
         * Core.formatTpl('<p>{text}</p>',{'text':'赋值内容'});
         * @param str
         * @param data
         * @returns {XML|string|void}
         */
        'FormatTpl':function(str, data) {
            return str.replace(/{(.*?)}/igm, function(strs,key) {
                    var keys = key.split(':'),
                        str = data[keys[0]];
                    if (keys.length == 1) {
                        return str ? str : '';
                    }else{
                        var fns = keys[1].split('.'),
                            fn = window;
                        for (var i = 0; i < fns.length; i++) {
                            fn = fn[fns[i]];
                        }
                        return fn(str);
                    }
                });
        },
        /**
         * 格式化日期时间
         * @param format
         * @param time
         */
        'FormatDate':function(format,time){
            var _ret = ''
                ,_format_word = ['d','D','j','l','N','S','w','z','W','F','m','M','n','t','L','o','Y','y','a','A','B','g','G','h','H','i','s','u','e','I','O','P','T','Z','c','r','U']
                ,_weekday = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
                ,_month = ['January','February','March','April','May','June','July','August','September','October','November','December']
                ,_format = format.split('')
                ,_time = new Date(time ? parseInt(time) : (new Date().getTime()));

            $.each(_format,function(i,e){
                if ($.inArray(e,_format_word) == -1 || (_format[i-1] && _format[i-1] == '\\')){
                    _ret += e;
                    return;
                }

                switch (e){
                    case 'd':
                        _ret += ('0'+ _time.getDate().toString()).substr(-2);
                        break;
                    case 'D':
                        _ret += Core.FormatDate('l',time).substr(0,3);
                        break;
                    case 'j':
                        _ret += _time.getDate().toString();
                        break;
                    case 'l':
                        _ret += _weekday[_time.getDay()];
                        break;
                    case 'N':
                        _ret += _time.getDay() === 0 ? '7' : _time.getDay().toString();
                        break;
                    case 'S':
                        _ret += '';
                        break;
                    case 'w':
                        _ret += _time.getDay().toString();
                        break;
                    case 'z':
                        var now = Date.UTC(_time.getFullYear(),_time.getMonth(),_time.getDate());
                        var first_day = Date.UTC(_time.getFullYear(),0,1);
                        _ret += ((now - first_day) / 86400000).toString();
                        break;
                    case 'W':
                        var now_num = parseInt(Core.FormatDate('z',time));
                        var first_day_week = parseInt(Core.FormatDate('N',Date.UTC(_time.getFullYear(),0,1)));
                        _ret += ('0'+ (Math.ceil((now_num + first_day_week) / 7)).toString()).substr(-2);
                        break;
                    case 'F':
                        _ret += _month[_time.getMonth()];
                        break;
                    case 'm':
                        _ret += ('0'+ (_time.getMonth() + 1).toString()).substr(-2);
                        break;
                    case 'M':
                        _ret += Core.FormatDate('F',time).substr(0,3);
                        break;
                    case 'n':
                        _ret += (_time.getMonth() + 1).toString();
                        break;
                    case 't':
                        var first_day = Date.UTC(_time.getFullYear(),_time.getMonth(),1);
                        var last_day = _time.getMonth() == 11 ? Date.UTC(_time.getFullYear() + 1,0,1) : Date.UTC(_time.getFullYear(),_time.getMonth() + 1,1);
                        _ret += (last_day - first_day) / 86400000;
                        break;
                    case 'L':
                        var year = _time.getFullYear();
                        _ret += year % 4 == 0 && (year % 100 != 0 || year % 400 == 0) ? '1' : '0';
                        break;
                    case 'o':
                        _ret += '';
                        break;
                    case 'Y':
                        _ret += _time.getFullYear().toString();
                        break;
                    case 'y':
                        _ret += _time.getFullYear().toString().substr(-2);
                        break;
                    case 'a':
                        _ret += _time.getHours() < 12 ? 'am' : 'pm';
                        break;
                    case 'A':
                        _ret += Core.FormatDate('a',time).toUpperCase();
                        break;
                    case 'B':
                        _ret += '';
                        break;
                    case 'g':
                        _ret += _time.getHours() < 12 ? _time.getHours().toString() : (_time.getHours() - 12).toString();
                        break;
                    case 'G':
                        _ret += _time.getHours().toString();
                        break;
                    case 'h':
                        _ret += ('0'+ Core.FormatDate('g',time)).substr(-2);
                        break;
                    case 'H':
                        _ret += ('0'+ Core.FormatDate('G',time)).substr(-2);
                        break;
                    case 'i':
                        _ret += ('0'+ _time.getMinutes().toString()).substr(-2);
                        break;
                    case 's':
                        _ret += ('0'+ _time.getSeconds().toString()).substr(-2);
                        break;
                    case 'u':
                        _ret += _time.getMilliseconds().toString();
                        break;
                }
            });

            return _ret;
        },
        /**
         * 设置获取Cookie
         * Core.Cookie('member','Tom',2);
         * @param name
         * @param value
         * @param hours
         * @returns {string}
         */
        'Cookie':function(name,value,hours){
            if (typeof(value) != 'undefined') {
                var expire = '';

                if (typeof(hours) != 'undefined') {
                    if (hours == -1 || value == '') {
                        expire = '; expires=-1';
                    } else {
                        expire = new Date((new Date()).getTime() + hours * 3600000);
                        expire = '; expires=' + expire.toUTCString();
                    }
                }

                document.cookie = name +'='+ encodeURIComponent(value) + expire +'; path=/';
            }

            var cookieValue = '';
            var search = name + '=';

            if (document.cookie.length > 0) {
                var offset = document.cookie.indexOf(search);

                if (offset != -1) {
                    offset += search.length;
                    var end = document.cookie.indexOf(';', offset);
                    if (end == -1) end = document.cookie.length;
                    cookieValue = decodeURIComponent(document.cookie.substring(offset, end));
                }
            }

            return cookieValue;
        },
        /**
         * 获取表单数据
         * @param self
         * @returns {{}}
         * @constructor
         */
        InputObj:function(self) {
            var obj = {};

            $(self).find(':input[name],select[name],textarea[name]').each(function(i,e) {
                var name = e.name,
                    type = e.type;

                if (type == 'hidden')
                    type = 'text';

                if (type == 'file')
                    return;

                switch (type) {
                    case 'radio':      //单选框
                        if (e.checked)
                            obj[name] = e.value;
                        break;
                    case 'checkbox':    //复选框数组
                        if (!e.checked)
                            break;
                    default:
                        if ($(self).find(':input[name="'+ name +'"],select[name="'+ name +'"],textarea[name="'+ name +'"]').length > 1) {
                            if (!obj[name])
                                obj[name] = [];

                            obj[name].push(e.value);
                        }else{
                            obj[name] = e.value;
                        }
                }
            });

            return obj;
        },
        /**
         * Core.Alert({'text':'消息内容','state':'suc','timeout':2000,'callback':function(){}});
         * @param param
         */
        'Alert':function(param){
            var tpl = '<div class="core-alert">' +
                '<div class="{state}">{state_str}</div>' +
                '<p>{text}</p>' +
                '</div>' +
                _tpl_background;

            var _state = ['info','notic','load','suc','err'];
            var _state_str = ['&iexcl;','!','','&radic;','&times;'];

            var text = param['text'] ? param['text'] : '';
            var state = param['state'] && $.inArray(param['state'],_state) != -1 ? param['state'] : 'suc';
            var timeout = param['timeout'] ? param['timeout'] : 2000;
            var callback = param['callback'] ? param['callback'] : function(){};

            if (typeof(set_middle_position['Alert']) != 'undefined') {
                clearTimeout(_timeout['Alert']);
            }

            $('body > .core-alert,body > .core-alert + .core-background').remove();
            $(document.body).append(Core.FormatTpl(tpl,{ 'text':text,'state':state,'state_str':_state_str[$.inArray(state,_state)] }));
            set_middle_position($('body > .core-alert'),'middle',-100);

            _timeout['Alert'] = setTimeout(function(){
                $('body > .core-alert,body > .core-alert + .core-background').remove();
                callback();
            },timeout);
        },
        /**
         * Core.Confirm({'text':'窗口内容','callback':function(){}});
         * @param param 'callback'为真时不关闭窗口
         */
        'Layout':function(param){
            var tpl = '<div class="core-layer core-layout">' +
                '<div class="content">{text}</div>' +
                '</div>' +
                _tpl_background;

            var text = param['text'] ? param['text'] : '';
            var callback = param['callback'] ? param['callback'] : function(){};

            $('body > .core-layout,body > .core-layout + .core-background').remove();
            var layer = $(Core.FormatTpl(tpl,{ 'text':text })).appendTo(document.body);
            set_middle_position($('body > .core-layout'),'middle');

            $('body > .core-layout + .core-background').on('click',function(){
                callback();
                $('body > .core-layout,body > .core-layout + .core-background').remove();
            });

            return layer;
        },
        /**
         * Core.Confirm({'title':'窗口标题','text':'窗口内容','callback':function(confirm,content){}});
         * @param param 'callback'为真时不关闭窗口
         */
        'Confirm':function(param){
            var tpl = '<form class="core-confirm core-layer" onsubmit="return false;">' +
                '<div class="close">x</div>' +
                '<h1>{title}</h1>' +
                '<div class="content">{text}</div>' +
                '<div class="ctrl"><button class="submit" type="submit">确 认</button> <button class="button" type="button">取 消</button></div>' +
                '</form>' +
                _tpl_background;

            var title = param['title'] ? param['title'] : '';
            var text = param['text'] ? param['text'] : '';
            var callback = param['callback'] ? param['callback'] : function(confirm){};

            $('body > .core-confirm,body > .core-confirm + .core-background').remove();
            var layer = $(Core.FormatTpl(tpl,{ 'title':title, 'text':text })).appendTo(document.body);
            set_middle_position($('body > .core-confirm'),'middle');

            layer.on('click','.close,.ctrl .button',function(){
                callback($(this).is('.submit'),layer.find('.content'));
                $('body > .core-confirm,body > .core-confirm + .core-background').remove();
            });

            layer.on('submit',function(){
                if ( !callback(true,layer.find('.content')) )
                    $('body > .core-confirm,body > .core-confirm + .core-background').remove();
            });

            return layer;
        },
        /**
         * //调用
         * Core.Frame({'title':'窗口标题','url':'网页地址','width':'宽度','height':'高度'});
         * //移除
         * Core.Frame({'close':true});
         * @param param
         */
        'Frame':function(param){
            if (param['close']){
                $('body > .core-frame,body > .core-frame + .core-background').remove();
                return;
            }

            var tpl = '<div class="core-frame core-layer">' +
                '<div class="close">x</div>' +
                '<h1>{title}</h1>' +
                '<iframe class="frame" src="{url}" width="{width}" height="{height}"></iframe>' +
                '</div>' +
                _tpl_background;

            var title = param['title'] ? param['title'] : '';
            var url = param['url'] ? param['url'] : 'about:blank';
            var width = param['width'] ? param['width'] : 'auto';
            var height = param['height'] ? param['height'] : 'auto';

            $('body > .core-frame,body > .core-frame + .core-background').remove();
            var layer = $(Core.FormatTpl(tpl,{ 'title':title, 'url':url, 'width':width, 'height':height })).appendTo(document.body);
            set_middle_position($('body > .core-frame'),'middle');

            layer.on('click','.close',function(){
                $('body > .core-frame,body > .core-frame + .core-background').remove();
            });

            return layer;
        }
    };
})();