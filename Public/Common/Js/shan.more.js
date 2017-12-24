/*延时加载ajax*/

var page=1;
var lock=false;
var scroll=false;




function ajax_cat_goods(cat_id)
{
   
    $(window).on('scroll',function(){
         if (($(window).scrollTop() == $(document).height() - $(window).height()) && lock==false) 
         {     
               scroll=true;
               $('#loader').show();
               get_more(cat_id);     
              
         }

    })

    if(scroll==false)
    {
       get_more(cat_id);
    }

}


function get_more(cat_id)
{


  lock = true;
   url="/index.php?m=Mobile&c=Index&a=getAjaxGoods";
   send={
     'page':page,
     'cat_id':cat_id,
   };

   $.post(url,send,function(reback){
      
         if(reback.error==8)
         {     

                  $('#loader').hide();
                  $('.goods_box').append(reback.content);  

                  $("img.lazy").lazyload({'threshold':400});
              page++;
              lock=false;
       
         }else if(reback.error==4)
         {
             // page--;
              $('#loader').hide();
              // $('#shan_out').fadeIn();
              // $('#shan_out').fadeOut(1000);
               

         }
   });
}


function test()
{
    alert(page);
    alert(lock);
}

