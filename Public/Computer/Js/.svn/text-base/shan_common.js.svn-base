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
        if(inputs[i].type=='radio')
        {
           console.log(inputs[i].checked);
        }

      if(((inputs[i].type=='radio'|| inputs[i].type=='checkbox') && inputs[i].checked) || inputs[i].type=='hidden'||inputs[i].type=='text')
        {
             person[inputs[i].name]=inputs[i].value;
        }
        
    }

   var stringPerson=JSON.stringify(person);
    return stringPerson;

}