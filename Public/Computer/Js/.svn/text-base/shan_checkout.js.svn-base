
/* *
 * 改变红包 
 */
function change_bonus(This,bonus_id,quick)
{

    var url="/index.php?m=Computer&c=Flow&a=changeBonus";
    var send={
       'bonus_id':bonus_id,
       'quick':quick,
    };


    $.post(url,send,function(reback){
          if(reback.code=='suc'){
           //清楚优惠券的选择行头
            $('.js-bc li').removeClass('click');
            $('#shan_coupon_money').html('');

            //装饰自身
             $('.js-bc li').removeClass('click');
             $(This).addClass('click');
             $('#shan_bonus_money').html('(￥'+reback.bonus_money+')');
             $('#shan_total_amount').html(reback.amount);
             $('#shan_order_total').html(reback.content);
          }else if(reback.code=='stop'){
             alert('您的网络卡，请重试');
          }else if(reback.code=='out'){
             alert('禁止非法操作');
          }           
    })

}



/* *
 * 改变优惠券
 */
function change_coupon(This,coupon_id,quick)
{

    var url="/index.php?m=Computer&c=Flow&a=changeCoupon";
    var send={
       'coupon_id':coupon_id,
       'quick':quick,
    };

    $.post(url,send,function(reback){
          if(reback.code=='suc'){
          //清楚红包的选择行头
           $('.js-bc li').removeClass('click');
           $('#shan_bonus_money').html('');
           //装饰自身
           $(This).addClass('click');
             $('#shan_coupon_money').html('(￥'+reback.coupon_money+')');
             $('#shan_total_amount').html(reback.amount);
             $('#shan_order_total').html(reback.content);
          }else if(reback.code=='stop'){
             alert('您的网络卡，请重试');
          }else if(reback.code=='out'){
             alert('禁止非法操作');
          }           
    })

}

/*
 * 订单页面改变积分
 */
function change_integral(This,quick)
{


  var url="/index.php?m=Computer&c=Flow&a=changeIntegral";
  var integral=$(This).val();
  var send={
       'integral':integral,
       'quick':quick,
  };

 

   $.post(url,send,function(reback){ 
   
        if(reback.code=='stop'){
            alert('您的网络卡，请重试');
        }else if(reback.code=='illegal'){
            alert('请正确输入使用的积分数量');
            $('#shan_integral_input').val($('#use_integral').html());
        }else if(reback.code=='yourself'){
            alert('您没有那么多的可用积分');
           $('#shan_integral_input').val($('#use_integral').html());
        }else if(reback.code=='allow'){
             alert('对不起，您输入的积分数量超过了该笔订单允许使用的数量');
             $('#shan_integral_input').val($('#use_integral').html());
        }else if(reback.code=='suc'){
            $('#shan_total_amount').html(reback.amount);
            $('#shan_order_total').html(reback.content);
            if(integral==0){
                $('#shan_integral_input').val('');
                $('#shan_integral').html('');
            }else{
               $('#shan_integral_input').val(reback.new_integral);
               $('#shan_integral').html('(￥'+reback.new_integral+')');
            }
          
        }else if(reback.code=='minus'){
            alert('请输入合理的积分数量');
            $('#shan_integral_input').val($('#use_integral').html());
        }
   });


}




function go_make_order(quick)
{
   var url="/index.php?m=Computer&c=Flow&a=makeOrder";
   var send={
       'quick':quick,
   };
   $.post(url,send,function(reback){
         if(reback.code=='nogoods'){
            location.href="/Index/index.html";
         }else if(reback.code=='fail'){
            alert('您的网络卡，请重试');
         }else if(reback.code=='suc'){
            location.href="/Center/choose/order_id/"+reback.order_id+".html";
         }
   })
   
}



/**
 *添加地址
 */
function add_address(is_default)
{

   var url="/index.php?m=Computer&c=UserAddress&a=addConsignee";
   var send={
     'is_default':is_default,
   };

   $.post(url,send,function(reback){
        if(reback.code=='stop'){
           alert('网路数据丢失，请重试');
        }else if(reback.code=='suc'){
           $('#shan_address').html(reback.content);
           $('.shopping_alert').fadeIn();
        }

   })
}



/**
 * 改变省份的时候
 * @return {[type]} [description]
 */
function change_province(This)
{

  var url="/index.php?m=Computer&c=UserAddress&a=changeProvince";
  var send={
    'region_id':$(This).val(),
  };

  $.post(url,send,function(reback){
         if(reback.code=='stop'){
           alert('网络数据丢失，请重试');
         }else if(reback.code=='suc'){
            $('[name="city"]').html(reback.content);
            $('[name="district"]').html("<option>请选择</option>");
         }
  })

}


/**
 * 改变市的时候
 * @return {[type]} [description]
 */
function change_city(This)
{
  var url="/index.php?m=Computer&c=UserAddress&a=changeCity";
  var send={
    'region_id':$(This).val(),
  };

  $.post(url,send,function(reback){
         if(reback.code=='stop'){
           alert('网络数据丢失，请重试');
         }else if(reback.code=='suc'){
            $('[name="district"]').html(reback.content);
         }
  })

}


/**
 * 去添加地址
 * @param  {[type]} default [description]
 * @return {[type]}         [description]
 */
function do_add_consignee(is_default)
{
   var url="/index.php?m=Computer&c=UserAddress&a=doAddConsignee";
   var send={
       'is_default':is_default,
       'consignee':$('[name="consignee"]').val(),
       'province':$('[name="province"]').val(),
       'city':$('[name="city"]').val(),
       'district':$('[name="district"]').val(),
       'address':$('[name="address"]').val(),
       'mobile':$('[name="mobile"]').val(),
   };

 $.post(url,send,function(reback){

       if(reback.code=='stop'){
          alert('网络数据丢失，请重试');
       }else if(reback.code=='suc'){
        //凡是添加的就自刷新喽
         location.reload(true);
       }
 })

}


/**
 *编辑地址
 */
function editor_address(id)
{

   var url="/index.php?m=Computer&c=UserAddress&a=editorConsignee";
   var send={
     'id':id,
   };

   $.post(url,send,function(reback){
        if(reback.code=='stop'){
           alert('网路数据丢失，请重试');
        }else if(reback.code=='suc'){
           $('#shan_address').html(reback.content);
           $('.shopping_alert').fadeIn();
        }

   })
}



/**
 * 去编辑地址
 * @param  {[type]} default [description]
 * @return {[type]}         [description]
 */
function do_editor_consignee(id)
{
   var url="/index.php?m=Computer&c=UserAddress&a=doEditorConsignee";

   if ($('.gengduo_block').hasClass('gengduo_block1')) {
       var state='open';
   }else{
      var state='close';
   }
   var send={
       'consignee':$('[name="consignee"]').val(),
       'province':$('[name="province"]').val(),
       'city':$('[name="city"]').val(),
       'district':$('[name="district"]').val(),
       'address':$('[name="address"]').val(),
       'mobile':$('[name="mobile"]').val(),
       'id':id,
   };

 $.post(url,send,function(reback){
       if(reback.code=='stop'){
          alert('网络数据丢失，请重试');
       }else if(reback.code=='suc'){
          $('.shopping_alert').fadeOut();
          //编辑的如果是选中的，则下面的也要跟着改啊，shit
           $('#shan_address_list').html(reback.content_list);
          if(reback.choose==1){
           $('#shan_choose_address').html(reback.content);
           }

         if(state=='open'){
           $('.gengduo_block').addClass('gengduo_block1').text('收起地址');
           $('.address').show();
         }
          
          
       }
 })
}



/**
 * 选择地址
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function choose_address(id)
{
    var url="/index.php?m=Computer&c=UserAddress&a=chooseAddress";
    var send={
        'id':id,
    };

    if ($('.gengduo_block').hasClass('gengduo_block1')) {
        var state='open';
    }else{
       var state='close';
    }
    $.post(url,send,function(reback){
         
          if(reback.code=='stop'){
             alert('网络数据丢失，请重试');
          }else if(reback.code=='suc'){
              $('#shan_address_list').html(reback.content_list);
              $('#shan_choose_address').html(reback.content);
              if(state=='open'){
                $('.gengduo_block').addClass('gengduo_block1').text('收起地址');
                $('.address').show();
              }
          }
    })
}

/**
 * 设置默认地址
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function make_default_address(id)
{
    var url="/index.php?m=Computer&c=UserAddress&a=makeDefaultAddress";
    var send={
        'id':id,
    };

    if ($('.gengduo_block').hasClass('gengduo_block1')) {
        var state='open';
    }else{
       var state='close';
    }
    $.post(url,send,function(reback){
        
          if(reback.code=='stop'){
             alert('网络数据丢失，请重试');
          }else if(reback.code=='suc'){
              $('#shan_address_list').html(reback.content_list);
              if(state=='open'){
                $('.gengduo_block').addClass('gengduo_block1').text('收起地址');
                $('.address').show();
              }
          }
    })
}

/**
 * 删除某个地址
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function delete_address(id)
{
     var option=window.confirm('您确定要删除该地址吗');
     if(!option){return false};

     var url="/index.php?m=Computer&c=UserAddress&a=deleteAddress";
     var send={
         'id':id,
     };
     $.post(url,send,function(reback){
   
           if(reback.code=='stop'){
              alert('网络数据丢失，请重试');
           }else if(reback.code=='suc'){
               $('#shan_address_list').html(reback.content_list);
              $('.gengduo_block').addClass('gengduo_block1').text('收起地址');
              $('.address').show();
           }else if(reback.code=='cannot'){
              alert('当前地址正在使用，不能删除');
           }
     })

}


/**
 * 前端特效
 * @param  {[type]} This [description]
 * @return {[type]}      [description]
 */
function more_or_less(This)
{
   if ($(This).hasClass('gengduo_block1')) {
       $(This).removeClass('gengduo_block1').text('更多地址');
       $('.address').hide();
   }else{
       $(This).addClass('gengduo_block1').text('收起地址');
       $('.address').show();
   }
}


