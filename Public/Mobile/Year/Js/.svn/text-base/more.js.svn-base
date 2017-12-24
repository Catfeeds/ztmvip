/*延时加载ajax*/

var page_gift=1;
var page_hfood=1;
var page_specialty=1;
var page_hang=1;
var page_mutton=1;
var page_super=1;

var lock_gift=false;
var lock_hfood=false;
var lock_specialty=false;
var lock_hang=false;
var lock_mutton=false;
var lock_super=false;



 function get_more(cat_id)
 {


     url="/index.php?m=Mobile&c=Year&a=getAjaxGoods";
     send={
       'cat_id':cat_id,
     };
//触发就先锁死
   switch(cat_id)
   {
      
       case 1214:
         lock_gift=true;
         send.page=page_gift;
       break;
       case 1210:
          lock_hfood=true;
          send.page=page_hfood;
       break;
       case 1211:
          lock_specialty=true;
          send.page=page_specialty;
       break;
       case 1212:
         lock_hang=true;
         send.page=page_hang;
       break;
       case 1213:
         lock_mutton=true;
         send.page=page_mutton;
       break;
       case 1209:
        lock_super=true;
        send.page=page_super;

   };


   $.post(url,send,function(reback){
         //ajax只要返回回来就应该解锁

         switch(reback.cat_id)
         {
             case '1214':
               lock_gift=false;
               if(reback.code=='suc'){
                       $('.shan_gift').append(reback.content);  
                       $("img.lazy").lazyload({'threshold':400});
                       page_gift++;             
               }else if(reback.code=='stop'){
                    Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
               }else if(reback.code=='empty'){
                     $('.shan_gift_b').hide();
               }
             
             break;
             case '1210':
                lock_hfood=false;
                if(reback.code=='suc'){
                        $('.shan_hfood').append(reback.content);  
                        $("img.lazy").lazyload({'threshold':400});
                        page_hfood++;             
                }else if(reback.code=='stop'){
                     Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
                }else if(reback.code=='empty'){
                      $('.shan_hfood_b').hide();
                }
                
             break;
             case '1211':
                lock_specialty=false;
                if(reback.code=='suc'){
                        $('.shan_specialty').append(reback.content);  
                        $("img.lazy").lazyload({'threshold':400});
                        page_specialty++;             
                }else if(reback.code=='stop'){
                     Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
                }else if(reback.code=='empty'){
                      $('.shan_specialty_b').hide();
                }
               
             break;
             case '1212':
               lock_hang=false;
               if(reback.code=='suc'){
                       $('.shan_hang').append(reback.content);  
                       $("img.lazy").lazyload({'threshold':400});
                       page_hang++;             
               }else if(reback.code=='stop'){
                    Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
               }else if(reback.code=='empty'){
                     $('.shan_hang_b').hide();
               }
              
             break;
             case '1213':
               lock_mutton=false;

               if(reback.code=='suc'){
                       $('.shan_mutton').append(reback.content);  
                       $("img.lazy").lazyload({'threshold':400});
                       page_mutton++;             
               }else if(reback.code=='stop'){
                    Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
               }else if(reback.code=='empty'){
                     $('.shan_mutton_b').hide();
               }
           

             break;

             case '1209':
               lock_mutton=false;

               if(reback.code=='suc'){
                       $('.shan_super').append(reback.content);  
                       $("img.lazy").lazyload({'threshold':400});
                       page_super++;             
               }else if(reback.code=='stop'){
                    Core.Alert({'text':'您自身的网络卡，导致加载数据丢失','state':'notic','timeout':1000,'callback':function(){}});  
               }else if(reback.code=='empty'){
                     $('.shan_super_b').hide();
               }
             

             break;
         }

      

   });
   




}

 
 










