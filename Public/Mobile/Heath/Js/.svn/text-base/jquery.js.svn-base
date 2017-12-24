//必须只能在head引入  判断浏览器内核版本<=ie8使用jquery-1.11.3.min.js否则使用jquery-2.1.4.min.js
var public_path = document.getElementsByTagName('head')[0].getElementsByTagName('script');

for (var i = 0; i < public_path.length; i++){
    if (public_path[i].src.indexOf('jquery.js') > 0){
        public_path = public_path[i].src.replace(/(.*?)\/jquery\.js/i,'$1/');
        break;
    }
}

if (navigator.userAgent.toLowerCase().indexOf('msie') > -1 && navigator.userAgent.toLowerCase().match(/msie ([\d.]+)/)[1] <= '8.0'){
    document.write('<script type="text/javascript" src="'+ public_path +'jquery-1.11.3.min.js"></script>');
}else{
    document.write('<script type="text/javascript" src="'+ public_path +'jquery-2.1.4.min.js"></script>');
}