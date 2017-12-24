function get_bonus(bonus_id)
{

    var url="/index.php?m=Mobile&c=Year&a=getBonus";
    var send={
       'bonus_id':bonus_id,
    };

    $.post(url,send,function(reback){

             if(reback.code=='suc'){
                  Core.Alert({'text':'恭喜您，领取成功，请在活动时间内使用','state':'suc','timeout':1000,'callback':function(){
                        if(reback.bonus_id==82){
                           $('.hb_20 .span1').hide();
                           $('.hb_20 .span2').show();
                        }else if(reback.bonus_id==81){
                             $('.hb_50 .span1').hide();
                             $('.hb_50 .span2').show();
                        }else if(reback.bonus_id==80){
                              $('.hb_100 .span1').hide();
                              $('.hb_100 .span2').show();
                        }
                  }});
             }else if(reback.code=='stop'){
              Core.Alert({'text':'您自身的网络卡，导致数据丢失','state':'notic','timeout':1000,'callback':function(){}});
             }else if(reback.code=='out'){
               Core.Alert({'text':'请勿进行非法操作','state':'notic','timeout':1000,'callback':function(){}});
             }else if(reback.code=='fail'){

                 Core.Alert({'text':'领取失败，请重新领取','state':'err','timeout':1000,'callback':function(){}});
             }else if(reback.code=='geted'){
        
                 Core.Alert({'text':'您已经领取过了，不可以重复领取','state':'notic','timeout':1000,'callback':function(){}});
             }else if(reback.code=='login'){
                Core.Alert({'text':'未登录不能领取红包','state':'notic','timeout':1000,'callback':function(){}});
             }
    })


}

