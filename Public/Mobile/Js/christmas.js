///-------------------------------///
$(function(){
	//用法  程序会为选中项添加类adcls
	luckDraws($('.container > ul'),{  //程序块
		click:".js-draw-run" //开始按钮
	});

	function luckDraws(ob,data){
		var anc = ob; //祖父元素
		var list = anc.children("li");
		var click; //点击对象
		if(data.click==null){return;}else{click=data.click;}
		var all= 12;//选择总数
		var ix = 0;
		var speed = 500;
		var Countdown = 200; //倒计时
		var isRun = false;
		var dgTime = 120;

		var im = new Image();
		im.src = $('.jiangpin .hb img').attr('osrc').replace(/(\.\w+)$/ig,'_30$1');
		var im = new Image();
		im.src = $('.jiangpin .hb img').attr('osrc').replace(/(\.\w+)$/ig,'_50$1');
		var im = new Image();
		im.src = $('.jiangpin .hb img').attr('osrc').replace(/(\.\w+)$/ig,'_100$1');

		// 生成随机数shu
		$(click).on('click',function(){
			if (parseInt($(this).attr('data-rel')) >= 3)
				return;

			if(isRun){
				return;
			}else{
	            var shu = Math.floor(Math.random()*all+1);
				if(shu % 2 == 1){
					shu=shu+1;
				}
				var stime = shu;
				// alert("程序开始:生成的随机数是"+stime);
				// $(".bt").append("<br />"+stime);
			    $(".zhongjianghao").val(stime);
				dgTime += stime*10 + 80;
				speedUp();
			}
		});
		function speedUp(){ //加速
			isRun = true;
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			speed -= 50;
			if(speed == 100){
				clearTimeout(stop);
				uniform();
			}else{
				var stop = setTimeout(speedUp,speed);
			}
		}
		function uniform(){ //匀速
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			Countdown -= 50 ;
			if(Countdown == 0){
				clearTimeout(stop);
				speedDown();
			}else{
				var stop = setTimeout(uniform,speed);
			}
		}
		function speedDown(){ //减速
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			speed += 10;
			if(speed == dgTime+20){
				clearTimeout(stop);
				end();
			}else{
				var stop = setTimeout(speedDown,speed);
			}
		} 
		function end(){
			if(ix == 0){
				ix = 12;
			}
			// alert("恭喜  "+ix+"  号中奖了");
			// $(".bt").append("<br />"+ix);
			//
			var draw = parseInt($(ob).children().eq(ix-1).attr('data-rel'));
			$(".jiangpin").css({"display":"block"});
			var im = $('.jiangpin .hb img');
			im.attr('src',im.attr('osrc').replace(/(\.\w+)$/ig,'_'+ Math.abs(draw) +'$1'));

			$.post(draw_link,{'draw':$('.container .adcls').attr('data-rel')},function(ret){
				if (ret.state){
					$(click).find('em').html(parseInt($(click).find('em').text())-1);
					$(click).attr('data-rel',parseInt($(click).attr('data-rel'))+1);
				}else{
					alert(ret.message);
				}
			},'json');

            $("#audio2")[0].pause();//停止
            $("#audio1")[0].play();//播放
			initB();
		}
		///--归0
		function init(o){
			if(o == all){
				ix = 0;	
			}
		}
		function initB(){ //程序结束进行初始化
			ix = 0;
			dgTime = 200;
			speed = 500;
			Countdown = 1000;
			isRun = false;

		}
	}
});
