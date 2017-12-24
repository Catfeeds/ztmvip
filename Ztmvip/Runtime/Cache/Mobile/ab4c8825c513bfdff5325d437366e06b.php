<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit">
        <title>整体美年货专场</title>
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Year/Css/base.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Year/Css/title.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/Mobile/Year/Css/year.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/Common/Images/common.css" />
        <script type="text/javascript" src="/Public/Mobile/Year/Js/jquery.js"></script>
        <script type="text/javascript" src="/Public/Common/Js/common.js"></script>
        <script type="text/javascript" src="/Public/Mobile/Year/Js/shan_year.js"></script>
        <script type="text/javascript" src="/Public/Mobile/Year/Js/more.js"></script>
        <script type="text/javascript" src="/Public/Mobile/Js//jquery.lazyload.min.js"></script>
    </head>
    <body>
        <header class="header">
            <div href="" class="title">
                <a  href="<?php echo U('Index/index');?>"   class="title_font">&#xe702;</a>
                整体美年货专场
            </div>
        </header>

        <div class="year">
            <div class="top_banner">
                <img src="/Public/Mobile/Year/Images/year_02.jpg" alt="" />
                <a href="#gift" class="gift"></a>
                <a href="#good_manners" class="food"></a>
                <a href="#food" class="specialty"></a>
                <a href="#specialty" class="decorate"></a>
                <a href="#decorate" class="mutton"></a>
            </div>

<!-- ########################################################## -->
            <div class="hongbao">
                <a href="javascript:void(0);" onclick="get_bonus(82)" class="hb_20">
                    <span class='span1' ></span><!--未领取样式-->
                    <span class="span2" style='display:none;'></span><!-- 已领取样式 -->
                </a>
                <a href="javascript:void(0);" onclick="get_bonus(81)" class="hb_50">
                    <span class='span1'></span>
                    <span class="span2" style='display:none;'></span>
                </a>
                <a href="javascript:void(0);" onclick="get_bonus(80)" class="hb_100">
                    <span class='span1' ></span>
                    <span class="span2" style='display:none;'></span>
                </a>
            </div>
   
<?php if(($flag1) == "1"): ?><script type="text/javascript">

         $('.hb_20 .span1').hide();
         $('.hb_20 .span2').show();
   </script><?php endif; ?>

<?php if(($flag2) == "1"): ?><script type="text/javascript">

         $('.hb_50 .span1').hide();
         $('.hb_50 .span2').show();
   </script><?php endif; ?>
<?php if(($flag3) == "1"): ?><script type="text/javascript">

         $('.hb_100 .span1').hide();
         $('.hb_100 .span2').show();
   </script><?php endif; ?>
<!-- ########################################################## -->

            <div class="time">
                <h1><span></span><p>距离整体美年货节抢购结束还剩</p><span></span></h1>
                <div class="timing" id="time">
                        <span>42</span><i>天</i><span>42</span><i>时</i><span>42</span><i>分</i><span>42</span><i>秒</i>
                </div>
            </div>
            <script language="javascript" type="text/javascript">
            function getTimerString(time) {
                 d = Math.floor(time / 86400000);
                 h = Math.floor((time % 86400000) / 3600000);
                 m = Math.floor(((time % 86400000) % 3600000) / 60000);
                 s = Math.floor(((time % 86400000) % 3600000 % 60000) / 1000);
                 if(h<10){h="0"+h;};
                 if(m<10){m="0"+m;};
                 if(s<10){s="0"+s;};
                 if (time > 0){
                      return "<span>"+d + "</span><i>天</i><span>" + h + "</span><i>时</i><span>" + m + "</span><i>分</i><span>" + s + "</span><i>秒</i>";
                 }else {
                      return "时间到";
                      }
            }
            function showTime() {
                 var nowdt = new Date(); //当前时间
                 var getms = new Date('2016/02/17 00:00'); //秒杀开始时间
                 var time = getTimerString(getms.getTime() - nowdt.getTime()); 
                 document.getElementById("time").innerHTML =time;
                 setTimeout("showTime();", 1000);
            }
            showTime(); 
            </script>
<!-- ========================================================================= -->
            <!-- 买满赠好礼 -->
            <a name="gift"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_022.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_03.jpg" alt="" /></div>
            <ul class="gift_con  shan_gift">  
            </ul>
            <div  class="gengduo shan_gift_b"><a href="javascript:;" onclick="get_more(<?php echo ($cats["gift"]); ?>);" >点击查看更多</a></div>
<!-- ===================================================================================== -->
<a name="good_manners"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_04.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_044.jpg" alt="" /></div>
            <ul class="gift_con shan_super">
  
            </ul>
            <div  class="gengduo shan_super_b">
                <a href="javascript:;" onclick="get_more(<?php echo ($cats["super"]); ?>);" >点击查看更多</a>
            </div>


<!-- ============================================================================================== -->
            <!-- 零食 -->
            <a name="food"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_02.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_03.png" alt="" /></div>
            <ul class="gift_con shan_hfood">
            </ul>
      <div  class="gengduo shan_hfood_b"><a href="javascript:;" onclick="get_more(<?php echo ($cats["hfood"]); ?>);" >点击查看更多</a></div>
    <!-- ======================================================== -->

            <!-- 特产 -->
            <a name="specialty"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_05.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_06.png" alt="" /></div>
            <ul class="gift_con shan_specialty">
            </ul>
 <div  class="gengduo shan_specialty_b"><a href="javascript:;" onclick="get_more(<?php echo ($cats["specialty"]); ?>);" >点击查看更多</a></div>
    <!-- =================================================== -->
            <!-- 摆件 -->
            <a name="decorate"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_08.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_09.png" alt="" /></div>
            <ul class="gift_con shan_hang">

            </ul>

<div  class="gengduo shan_hang_b"><a href="javascript:;" onclick="get_more(<?php echo ($cats["hang"]); ?>);" >点击查看更多</a></div>
<!-- ==================================================== -->

            <!-- 羊肉 -->
            <a name="mutton"></a>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_11.png" alt="" /></div>
            <div class="banner"><img src="/Public/Mobile/Year/Images/year_12.png" alt="" /></div>
            <ul class="gift_con  shan_mutton">
                  <!-- here -->

               
            </ul>
            <div  class="gengduo shan_mutton_b" ><a href="javascript:;" onclick="get_more(<?php echo ($cats["mutton"]); ?>)">点击查看更多</a></div>
    
<!-- ============================================================== -->


</div>


        <footer class="footer">
            <p><i class="title_font">&#xe611;</i>整体美商城</p>
            <p>客服电话：400-777-1225</p>
            <p>客服微信：HRlianna</p>
        </footer>
    </body>



<script type="text/javascript">


  $(function(){
      //超值礼包
       get_more(<?php echo ($cats["gift"]); ?>);
       //健康食品
       get_more(<?php echo ($cats["hfood"]); ?>);
       //各省特产
       get_more(<?php echo ($cats["specialty"]); ?>);
       //精美摆件
       get_more(<?php echo ($cats["hang"]); ?>);
       //内蒙羊肉
       get_more(<?php echo ($cats["mutton"]); ?>);
       //超级礼包
       get_more(<?php echo ($cats["super"]); ?>);

  })

</script>
</html>