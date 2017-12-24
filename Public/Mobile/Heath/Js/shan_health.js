

function health_register()
{
    
 

  
       var formBuy= document.forms['shan_health'];

       var person=getInputs(formBuy);
        
        // console.log(person);

        var url="/index.php?m=Mobile&c=Health&a=do_register";
        var send={
           'person':person,

        };

        $.post(url,send,function(reback){
             
                   
               if(reback.error=="buy") {
                  $('.bg_hui').show();
                  $('#shan_error').html('请先购买整体美商城健康减重套餐');
                  $('.tishi').show();

               }else if(reback.error=='complete'){

                $('.bg_hui').show();
                $('#shan_error').html('信息不完整额');
                $('.tishi').show();

               }else if(reback.error=='success'){
                $('.bg_hui').show();
                $('#shan_error').html('恭喜您提交成功');
                $('.tishi').show();

               }else if(reback.error=='fail'){
                 $('.bg_hui').show();
                 $('#shan_error').html('很抱歉提交失败');
                 $('.tishi').show();
               }else if(reback.error=='submited')
               {
                  $('.bg_hui').show();
                  $('#shan_error').html('今日数据您已经提交过了，去商城逛逛吧');
                  $('.tishi').show();
               }

        });





}


/**
 * 获取所有的input标签属性
 * @param  {[type]} formBuy [description]
 * @return {[type]}   返回json字符串
 *
 * 数组先转成js对象，然后再转成json字符串
 */
function getInputs(formBuy) {
    
    var person={}; 
    var  inputs=formBuy.getElementsByTagName('input');

    for(i=0;i<inputs.length;i++)
    {    
          person[inputs[i].name]=inputs[i].value;
    }

   var stringPerson=JSON.stringify(person);
    return stringPerson;

}
