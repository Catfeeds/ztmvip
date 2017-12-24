 
     /* *
      * 添加商品到收藏夹
      * shanbumin
      */
     function collect(goods_id) 
     {


        var url="/index.php?m=Mobile&c=Goods&a=addCollection";
        var send={'goods_id':goods_id};
        $.get(url,send,function(reback){
           
  
               if (reback.status == 8) {

                 $('#shan_collect').html(reback.content);
                 $('#shan_collect').fadeIn();
                 setTimeout(function(){
                      $('#shan_collect').fadeOut();
                 },1000);
                    
                     if(reback.action=='add')
                     {

                        $('.collect').attr('src','/Public/Mobile/Images/xin2.png');
                     }else{
                       $('.collect').attr('src','/Public/Mobile/Images/xin.png');
                     }
               }else if (reback.status == 2) {
                     $('#shan_collect').html('未登录不能收藏');
                     $('#shan_collect').fadeIn();
                     setTimeout(function(){
                          $('#shan_collect').fadeOut();
                     },1000)
               }
        
        })
     
     }


/**
 * 获取最终价格
 * @return {[type]} [description]
 */
function final_price(goods_id)    
{
   
 
         var goods = new Object();
         var formBuy = document.forms['ZTM_FORMBUY'];
         str = getSelectedAttributes(formBuy);  
        if(str)
        {
           var spec_arr = str.split(',');
           goods.spec = spec_arr;//用户选择的属性
        }

         goods.goods_id =goods_id;

          var stringGoods=JSON.stringify(goods);



          var url="/index.php?m=Mobile&c=Flow&a=price";
          var send={
             'goods':stringGoods,

          };

         $.post(url,send,function(reback){
    
             if(reback.error==8)  
             {
                 $('#shan_final').html(reback.final_price);
             }
         })

}

/**
 * 点可选属性或改变数量时修改商品价格的函数
 */
function changePrice(type,goods_id)
{
  
  var qty = document.forms['ZTM_FORMBUY'].elements['number'].value;
  if(type == 1){qty--; }
  if(type == 3){qty++; }
  if(qty <=0 ){ qty=1; }


  if(!/^[0-9]*$/.test(qty))
    { 
       document.getElementById('goods_number').value =1;
   }else{
       document.getElementById('goods_number').value = qty;
   }

//额外添加的按钮
  var last_num=document.getElementById('goods_number').value;
   if(last_num==1){
     $('.cut').css('color', '#999');
   }else{
     $('.cut').css('color', '#252525');
   }



}

/**
 *
 * 获得选定的商品属性
 * 这个函数非常好，只要前台配合布局，让属性对应的表单的name值都是spec_打头的
 * 这样我们获取表单中的元素就可以筛选找到对应的属性表单控件了
 * 然后我们再判断哪些被选中了，将选中的value值给装进数组里，返回出去即可。
 */

function getSelectedAttributes(formBuy) {
    var spec_arr = new Array();
    var j = 0;

    for (i = 0; i < formBuy.elements.length; i++) {
        var prefix = formBuy.elements[i].name.substr(0, 5);

        if (prefix == 'spec_'
                && (((formBuy.elements[i].type == 'radio' || formBuy.elements[i].type == 'checkbox') && formBuy.elements[i].checked) || formBuy.elements[i].tagName == 'SELECT')) {
            spec_arr[j] = formBuy.elements[i].value;
            j++;
        }
    }
//join() 方法用于把数组中的所有元素放入一个字符串。
//元素是通过指定的分隔符进行分隔的。
//这里很作死了，PC端返回值就是数组，这里不知道搞什么非要拼接成字符串返回回去
    spec_arr = spec_arr.join(",");
    return spec_arr;
}

/**
 * 添加购物车
 * @param {[type]} goods_id [description]
 */
function add_cart(goods_id,quick) 
{
  
    if (typeof(quick) == 'undefined')
      quick = '';
    var goods = new Object();
    var formBuy = document.forms['ZTM_FORMBUY'];

  //返回值是字符串，可能为了速度吧，我们再变成数组吧
  str = getSelectedAttributes(formBuy); 

   //属性
    var spec_arr = str.split(',');
    if(str)
    {
       goods.spec = spec_arr;//用户选择的属性
    }
  //购买数量
    if (formBuy.elements['number'])
    {
       var number = formBuy.elements['number'].value;
       goods.number = number;
    }

    goods.goods_id =goods_id;
    if(quick==1)
    {
       goods.quick=1;
    }


   var stringGoods=JSON.stringify(goods)

 

     var url="/index.php?m=Mobile&c=Flow&a=addToCart";
     var send={
        'goods':stringGoods,

     };

     $.post(url,send,function(reback){
             
            if(reback.error==8){

              if(quick==1)
              {
                   window.location.href ="/index.php?m=Mobile&c=Quick&a=checkout"; 
              }else{
                    setTimeout(function(){
                    $('div.num').html(reback.count);
                    },1300); 
              }
           
                    

          }

     });




}


