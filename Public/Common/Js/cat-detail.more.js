/**
 * 延时加载ajax
 * author: lihongfu
 */
var lock=false;
var scroll=false;
var url="/index.php?m=Mobile&c=Category&a=getCatGoods";
var goods_params = {};

function ajaxCatGoods(params)
{
	
    goods_params = params;
    $(window).on('scroll',function(){
         if (($(window).scrollTop() == $(document).height() - $(window).height()) && lock==false) 
         {     
               scroll=true;             
               get_more();             
         }
    })

    if(scroll==false)
    {
       get_more();
    }

}
function resetLock()
{
    lock = false;
    scroll = false;
}

function get_more()
{
	$('#loader').show();
  lock = true;
   $.post(url,goods_params,function(reback){
      
         if(reback.state==8)
         {
              $('#loader').fadeOut();
              $('.con1').append(reback.content);
              $("img.lazy").lazyload({'threshold':400});
             goods_params.page++;
              lock=false;
       
         }else {
             if(goods_params.page==1) {
                 if (reback.state == 2) {
                     var div = '<div class="icon_CableNull"><i class="icon_CableNull_font">&#xe628;</i><p>请输入至少2个汉字或6个英文字母</p></div>';
                 } else {
                     var div = '<div class="icon_CableNull"><i class="icon_CableNull_font">&#xe628;</i><p>暂无结果</p></div>';
                 }
                 $('.con1').html(div);
             }
             goods_params.page--;
             $('#loader').hide();
         }
   },'json');
}


function test()
{
    alert(goods_params);
    alert(lock);
}

