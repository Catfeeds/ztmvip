
/*延时加载ajax*/


//#J_ItemList这个是商品展示部分的best new hot 的ul的id号
// function get_asynclist(url, src) {
//     $('#J_ItemList').more({'address': url, 'spinner_code': '<div style="text-align:center; margin:10px;"><img src="' + src + '" /></div>'})
//     $(window).scroll(function() {
//         if ($(window).scrollTop() == $(document).height() - $(window).height()) {
//             $('.get_more').click();
//         }
//     });
// }
/*****************************公用的js***************************************************************************************/









/*************************************礼包详情页*************************************************************/

/**
 * 礼包详情页选择属性规格
 * @param  {[type]} goods_id [description]
 * @return {[type]}          [description]
 */
function  chooseAttr(goods_id)
{
    
    var url="/index.php?m=Mobile&c=Goods&a=chooseAttr";
    var send={
       'goods_id':goods_id,

    };

    $.post(url,send,function(reback){


            if(reback.error==8)
            {
               document.getElementById('choos_attr').innerHTML=reback.content;
            }
    })
    
}
/* *
 * 添加礼包到购物车
 */


function package_to_cart(package_id)
{
    
    var package_info=new Object();
    package_info.package_id = packageId
    package_info.number = number;




}
// function addPackageToCart(packageId) {
//     var package_info = new Object();
//     var number = 1;

//     package_info.package_id = packageId
//     package_info.number = number;







//     $.post('index.php?m=default&c=flow&a=add_package_to_cart', {
//         package_info: $.toJSON(package_info)
//     }, function(data) {
//         addPackageToCartResponse(data);
//     }, 'json');
//     //Ajax.call('flow.php?step=add_package_to_cart', 'package_info=' + package_info.toJSONString(), addPackageToCartResponse, 'POST', 'JSON');
// }


  /*************************  shopping_flow   ****************************************************************/
 

/**********************region.js****************************************/
/**
 * 省的改变的ajax请求
 * @param  {[type]} This [description]
 * @return {[type]}      [description]
 */
 function change_province(This)
{    

      var region_name=$(This).next().val();
      var send={
          'region_name':region_name,
      };
        
      var orgin=$('.check1 i').text();
      if(orgin!=region_name)
      {
              var url="/index.php?m=Mobile&c=Region&a=changeProvince";
              $.post(url,send,function(reback){
                     $('.check1 i').text(region_name);
                     $('.check2 i').html('');
                     $('.check2').click(function(event) {
                         $('.city').fadeIn();
                     });
                     $('.check3 i').html('');
                     $('.check3').off();
                     $('div.city').html(reback.content);

              })
      }

       $('.province').fadeOut();
}




/**
 * 市的改变的ajax请求
 * @param  {[type]} This [description]
 * @return {[type]}      [description]
 */
function change_city(This)
{
   var region_name=$(This).next().val();
   var send={
       'region_name':region_name,
   };
     
   var orgin=$('.check2 i').text();
   if(orgin!=region_name)
   {
      var url="/index.php?m=Mobile&c=Region&a=changeCity";
      $.post(url,send,function(reback){
              $('.check2 i').text(region_name);
              $('.check3 i').html('');

              $('.check3').on('click',function(){
                  $('.area').fadeIn();
              })


              $('div.area').html(reback.content);
      })  
   }

//#########################################
   $('.city').fadeOut(); 
  
  
}


/**
 * 改变区域
 */

function change_district(This)
{
  $('.check3 i').text(This.value);
  $('.area').fadeOut();

}

/**
 * 个人中心添加地址
 */
function add_address()
{
  
  var url="/index.php?m=Mobile&c=User&a=addressCount";
  $.post(url,'',function(reback){
        
        if(reback.error==4)
        {
            alert('您的收货地址过多，不允许添加咯!');
        }else{

           window.location="/index.php?m=Mobile&c=User&a=addAddress";
        }

  })


}
/**
 *  个人中心删除地址
 */
 function delete_address(address_id)
{
    
    $(".remind_bg").fadeIn();

    $(".cancel").on('click',function(event) {
        $(".remind_bg").fadeOut();
        $(".del").removeClass('del')
    });
    $(".determine").on('click',function(event) {
        $(".remind_bg").fadeOut();
        
        var send={
            'address_id':address_id,
        };
        
        var url="/index.php?m=Mobile&c=User&a=deleteAddress";
        $.post(url,send,function(reback){

              if(reback.error==8)
              {
                 $('.list_container').html(reback.content);
              }
        })


        
    });

  

}

/**
 * 个人中心设置默认地址
 */

function make_default(This)
{

    var address_id=$(This).next().val();

   var send={
       'address_id':address_id,
   };

   var url="/index.php?m=Mobile&c=User&a=makeDefault";
   $.post(url,send,function(reback){
            
         
         if(reback.error==8) 
         {
            $('.list_container').html(reback.content);
         }

   })



}