<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($page_title); echo ($sitename); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/core.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css/base.css" />
    <script type="text/javascript" src="/Public/Computer/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Common/Js/common.js"></script>
    <script type="text/javascript" src="/Public/Computer/Js/shan_common.js"></script>







    <link rel="stylesheet" type="text/css" href="/Public/Computer/Css//shopping.css" />
    <script type="text/javascript" src="/Public/Computer/Js//shan_checkout.js"></script>

  </head>
  <body>
  <div class="index_header">
    <ul>
        <li class="li1"><i></i><a href="<?php echo U('Cart/cart');?>">购物车<span>(<?php if($Think.session.cnumber): ?><span id="shan_cnumber"><?php echo (session('cnumber')); else: ?>0<?php endif; ?></span>)</span></a></li>
        <?php if($user_info): ?><li class="li2"><i></i><a href="<?php echo U('User/order');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/logout');?>">退出</a></li>
            <li class="li4"><i></i><a href="<?php echo U('User/order');?>"><?php echo ($user_info["user_name"]); ?></a></li>
            <?php else: ?>
            <li class="li2"><i></i><a href="<?php echo U('Login/index');?>">我的订单</a></li>
            <li class="li3"><i></i><a href="<?php echo U('Login/index');?>">登录</a></li>
            <li class="li4"><i></i><a href="<?php echo U('Register/index');?>">注册</a></li><?php endif; ?>
        <li class="li5">欢迎光临整体美</li>
    </ul>
</div>
<div class="index_top">
    <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Public/Computer/Images/index_logo.png" alt="" /></a></div>
    <div class="search">
        <div id="add">
            <form action="<?php echo U('Search/index');?>">
                <input type="text" name="word" value="<?php echo ($_GET['word']); ?>" maxlength="20" />
                <button type="submit"></button>
            </form>
        </div>
     
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">李小龙</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">刘德华</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">秦宝贵</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">死亡公子</a>
    <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">八王爷</a>
  
    </div>
    <!-- <div class="weixin"><img src="/Public/Computer/Images/index_02_10.jpg" /></div> -->
    <div class="weixin">
        <p>整体美微信</p>
        <img src="/Public/Computer/Images/gif128_03.gif" />
    </div>
    <ul class="nav">
        <li class="li1"><a href="">全部商品</a>
        <ul>

        <!-- #################### 壹 ############################# -->
            <li>
                <dl class="nav1">
                    <dt>形象美</dt>
                    <dd>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a>
                        <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a>
                    </dd>

                    <dl class="nav2">
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1160));?>">上衣</a></dt>
                        <dd>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1149));?>">寸衫</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1161));?>">T恤</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1162));?>">毛织</a>
                             <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1188));?>">打底衫</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1157));?>">裤装</a></dt>
                        <dd>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1158));?>">短裤</a>
                          <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1159));?>">长裤</a>
                        </dd>

                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1154));?>">裙装</a></dt>
                        <dd>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1155));?>">连衣裙</a>
                            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1156));?>">半身裙</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>457));?>">包包</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1007));?>">休闲包</a>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1168));?>">时装包</a>
                        </dd>
                        <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>718));?>">围巾</a></dt>
                        <dd>
                           <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1176));?>">丝巾</a>
                        </dd>
                    </dl>
                </dl>
            </li>
<!-- ################# 贰 ######################################### -->
<li>
    <dl class="nav1">
        <dt>容颜美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>425));?>">美妆</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">美妆</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>448));?>">底妆</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>450));?>">眼部</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>449));?>">腮红</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>451));?>">唇部</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>415));?>">护肤</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>421));?>">面部</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1193));?>">身体</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>423));?>">香氛</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>447));?>">香水</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- ################## 叁 ####################### -->
<li>
    <dl class="nav1">
        <dt>健康没</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>696));?>">中外名酒</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>876));?>">葡萄酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>877));?>">起泡酒</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>878));?>">水</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1192));?>">啤酒</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>702));?>">粮油调味</a></dt>
            <dd>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>923));?>">油</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>924));?>">调味</a>
              <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>925));?>">五谷杂粮</a>
            </dd>

            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1108));?>">保健品</a></dt>
            <dd>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1090));?>">维生素</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1106));?>">蛋白质</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1136));?>">鱼油磷脂</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1136));?>">葡萄籽</a>
                <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1137));?>">酵素</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1104));?>">休闲零食</a></dt>
            <dd>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>935));?>">饼干</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1138));?>">糖</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1194));?>">巧克力</a>
               <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1195));?>">休闲小吃</a>
            </dd>
        </dl>
    </dl>
</li>

<!-- #################### 肆  #################################     -->
<li>
    <dl class="nav1">
        <dt>心灵美</dt>
        <dd>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a>
            <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a>
        </dd>

        <dl class="nav2">
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">书籍</a></dt>
            <dd>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1183));?>">励志</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1184));?>">旅游</a>
                 <a href="<?php echo U('Index/catGoodsList',array('cat_id'=>1132));?>">育儿</a>
            </dd>
            <dt><a href="<?php echo U('Index/catGoodsList',array('cat_id'=>0));?>">心灵课程</a></dt>
            <dd>
            </dd>

        </dl>
    </dl>
</li>

<!-- ################################################# -->
         
        </ul>
        </li>
        <li ><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li ><a href="<?php echo U('Index/newGoodsList');?>">新品首发</a></li>
        <li ><a href="<?php echo U('Index/specialBuy');?>">特卖专场</a></li>
        <li ><a href="<?php echo U('Health/special');?>">贵宾尊享</a></li>
    </ul>
</div>



<div class="bg_h">
    <div class="shopping_submit_gps">
        <ul>
            <li class="li1">
                 <p class="p1">1</p>
                 <p class="p2">1.我的购物车</p>
            </li>
            <li class="li2">
                 <p class="p1">2</p>
                 <p class="p2">2.填写核对订单信息</p>
            </li>
            <li class="li3">
                <p class="p1">3</p>
                <p class="p2">3.成功提交订单</p>
            </li>
        </ul>
        <p class="title">填写并核对订单信息</p>
    </div>
    <div class="shopping_submit">
      <div id="shan_address_list">
          
    <p class="p_top">收货人信息
    <?php if(!empty($consignee_list)): ?><a href="javascript:;" onclick="add_address('N');">新增收货地址</a><?php endif; ?>
    </p>
  <?php if(empty($consignee_list)): ?><ul class="address cur">
        <li class="li1">未设置</li>
        <li class="li5"><a href="javascript:;" class="js-add_address" onclick="add_address('Y');">设置</a></li>
    </ul>
 <?php else: ?>
             <?php if(is_array($consignee_list)): $i = 0; $__LIST__ = $consignee_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><ul class="address <?php if(($value["id"]) == $consignee["address_id"]): ?>cur<?php endif; ?> <?php if(($value["is_default"]) == "Y"): ?>default<?php endif; ?>">
                   <li class="li1" onClick="choose_address(<?php echo ($value["id"]); ?>)"><?php echo ($value["consignee"]); ?>&nbsp;&nbsp;&nbsp;<?php echo ($value["province"]); ?></li>
                   <li class="li2"><?php echo ($value["consignee"]); ?>&nbsp;&nbsp;<?php echo ($value["province"]); ?>  <?php echo ($value["city"]); ?> <?php echo ($value["district"]); ?>  <?php echo ($value["address"]); ?>&nbsp;&nbsp;&nbsp;<?php echo ($value["mobiel"]); ?></li>
                   <li class="li3" onclick="make_default_address(<?php echo ($value["id"]); ?>)"><?php if(($value["is_default"]) == "Y"): ?>默认地址<?php endif; ?>设置默认</li>
                   <li class="li4"><a href="javascript:;" onClick="editor_address(<?php echo ($value["id"]); ?>)">编辑</a></li>
                   <li class="li6" onclick="delete_address(<?php echo ($value["id"]); ?>)">删除</li>
               </ul><?php endforeach; endif; else: echo "" ;endif; ?>
           <?php if(!empty($consignee_list[1])): if(($less) == "1"): ?><p class="gengduo_block gengduo_block1" onclick="more_or_less(this)">收起地址</p>
              <?php else: ?>
               <p class="gengduo_block" onclick="more_or_less(this)">更多地址</p><?php endif; endif; endif; ?>
      </div>

<!--  

        <script type="text/javascript">
        $('.gengduo_block').on('click',function(){
            if ($(this).hasClass('gengduo_block1')) {
                $(this).removeClass('gengduo_block1').text('更多地址');
                $('.address').hide();
            }else{
                $(this).addClass('gengduo_block1').text('收起地址');
                $('.address').show();
            }
        });
        $('.address .li3').on('click', function() {
            $(this).parent('.address').siblings('.address').removeClass('default').show();
            $(this).parent('.address').addClass('default');
            return true;
        });
        $('.address .li1').on('click', function() {
            $(this).parent('.address').siblings('.address').removeClass('cur').show();
            $(this).parent('.address').addClass('cur');
        });
        </script> -->
        <div class="hr"></div>
        <p class="p_top">支付方式</p>
        <ul class="way">
            <li>在线支付</li>
        </ul>
        <div class="hr"></div>
        <?php if(($quick) == "N"): ?><p class="p_top">配送方式<a href="<?php echo U('Cart/cart');?>">返回修改购物车</a></p>
        <?php else: ?>
          <p class="p_top">配送方式<a href="<?php echo U('Goods/detail',array('goods_id'=>$goods_id));?>">返回重新选购</a></p><?php endif; ?>
        <div class="container">
            <ul class="left">
                <li>快递运输</li>
            </ul>
            <ul class="right">
            <?php if(is_array($goods_list)): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i; if(($value["selected"]) == "Y"): ?><li>
                    <div class="img"><img src="http://www.ztmvip.com/<?php echo ($value["goods_thumb"]); ?>_250x250.jpg" alt="" /></div>
                    <dl>
                        <dd class="dd1"><?php echo ($value["goods_name"]); ?></dd>
                        <dd class="dd2">￥<?php echo ($value["goods_price"]); ?></dd>
                        <dd class="dd3">x<?php echo ($value["goods_number"]); ?></dd>
                      <?php if(is_array($value["goods_attr"])): $i = 0; $__LIST__ = $value["goods_attr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i;?><dt>
                             <?php echo ($attr[0]); ?>:<?php echo ($attr[1]); ?> &nbsp;&nbsp;&nbsp;
                         </dt><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

            </ul>
        </div>
        <div class="hr"></div>

    <!-- ================================================================================= -->
        <p class="p_top">优惠方式</p>

        <div class="radio" >
            <p onclick="choose_coupon(this)">使用优惠券<span id="shan_coupon_money"><?php if(($order["coupon_id"]) > "0"): ?>(￥<?php echo ($order["coupon_money"]); ?>)<?php endif; ?></span></p>
            <ul class="js-bc">
             <?php if(is_array($coupon_list)): $i = 0; $__LIST__ = $coupon_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><label for="youhui1">
                    <li class='li1 <?php if(($value["coupon_id"]) == $order["coupon_id"]): ?>click<?php endif; ?>' onClick="change_coupon(this,<?php echo ($value["coupon_id"]); ?>,'<?php echo ($quick); ?>');">
                      <p><?php echo ($value["coupon_name"]); ?><span>（满<?php echo (intval($value["min_order_amount"])); ?>元可用）</span></p>
                    </li>
                </label><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>

        <script type="text/javascript">
             function choose_coupon(This){

                var coupon_exist=<?php echo ((isset($coupon_exist) && ($coupon_exist !== ""))?($coupon_exist):0); ?>;
                if(coupon_exist==1) {
                       $(This).next('ul').slideToggle();
                }else{
                    alert('当前额度下没有可用的优惠券');
                }
                     

             }
        </script>

        <div class="radio">
            <p onclick="choose_bonus(this)">使用红包<span id='shan_bonus_money'> <?php if(($order["bonus_id"]) > "0"): ?>(￥<?php echo ($order["bonus_money"]); ?>)<?php endif; ?></span></p>
            <ul class="js-bc">
              <?php if(is_array($bonus_list)): $i = 0; $__LIST__ = $bonus_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><label for="hongbao1">
                   <li class="li1 <?php if(($value["bonus_id"]) == $order["bonus_id"]): ?>click<?php endif; ?>" onClick="change_bonus(this,<?php echo ($value["bonus_id"]); ?>,'<?php echo ($quick); ?>');"><p><?php echo ($value["bonus_name"]); ?><span>（满<?php echo (intval($value["min_order_amount"])); ?>元可用）</span></p></li>
                </label><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    <script type="text/javascript">
         function choose_bonus(This){

            var bonus_exist=<?php echo ((isset($bonus_exist) && ($bonus_exist !== ""))?($bonus_exist):0); ?>;
            if(bonus_exist==1) {
                   $(This).next('ul').slideToggle();
            }else{
                alert('当前额度下没有可用的红包');
            }
                 

         }
    </script>

        <div class="radio">
            <p onclick="choose_integral(this)">使用积分<span id='shan_integral'><?php if(($order["integral"]) > "0"): ?>(￥<?php echo ($order["integral"]); ?>)<?php endif; ?></span></p>
            <ul class="jifen">
                <li>可用积分：<?php echo ($your_integral); ?></li>
                <li>本订单最多可以使用积分：<?php echo ($allow_integral); ?></li>
                <li>请输入使用的积分：<input id="shan_integral_input" onChange="change_integral(this,'<?php echo ($quick); ?>')" type="text" <?php if(($order["integral"]) > "0"): ?>value='<?php echo ($order["integral"]); ?>' <?php else: ?> value=''<?php endif; ?> class="js-jifen" /></li>
                <!-- <button type="button">使用</button> -->
            </ul>
        </div>

        <script type="text/javascript">
             function choose_integral(This){

                var integral_exist=<?php echo ((isset($your_integral) && ($your_integral !== ""))?($your_integral):0); ?>;
                if(integral_exist>0) {
                       $(This).next('ul').slideToggle();
                }else{
                    alert('您没有可用的商城积分');
                }
                     

             }
        </script>
    </div>
<!-- ==================================================================================================================== -->

    <ul class="shopping_zong" id="shan_order_total">
       

 <li><i><?php echo ($go_number); ?></i> 件商品，总商品金额：<span>¥<?php echo ($total["goods_price"]); ?></span></li>
 <?php if(($total["shipping_fee"]) > "0"): ?><li>运费：<span>¥<?php echo ($total["shipping_fee"]); ?></span></li><?php endif; ?>
 <?php if(($total["coupon_amount"]) > "0"): ?><li>使用优惠券：<span>-¥<?php echo ($total["coupon_amount"]); ?></span></li><?php endif; ?>
<?php if(($total["bonus_amount"]) > "0"): ?><li>使用红包：<span>-¥<?php echo ($total["bonus_amount"]); ?></span></li><?php endif; ?>
<?php if(($total["integral_amount"]) > "0"): ?><li>使用积分（<em id="use_integral"><?php echo ($total["integral"]); ?></em>）：<span>-¥<?php echo ((isset($total["integral_amount"]) && ($total["integral_amount"] !== ""))?($total["integral_amount"]):0); ?></span></li><?php endif; ?>

 <li>应付总额：<span>¥<?php echo ($total["amount"]); ?></span></li>








    </ul>

<?php if(!empty($consignee)): ?><ul class="dizhi" id="shan_choose_address">
         
<li>寄送至： <?php echo ($consignee["province"]); ?>省&nbsp; <?php echo ($consignee["city"]); ?>市&nbsp; <?php echo ($consignee["district"]); ?>&nbsp; <?php echo ($consignee["address"]); ?>&nbsp; 
</li> 
<li>收货人：<?php echo ($consignee["consignee"]); ?>  <?php echo ($consignee["mobile"]); ?></li>




    </ul><?php endif; ?>
    <div class="pos_r">
        <div id="pos">
            <div class="heji">
                应付总额：<span >¥<span id="shan_total_amount"><?php echo ($total["amount"]); ?></span></span><button onclick="go_make_order('<?php echo ($quick); ?>');" type="button">提交订单</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">









//     $('.radio > p').on('click', function() {
//         $(this).toggleClass('click');
       
//     });
//     $('.radio ul label').on('click', function() {
//         $(this).find('li').toggleClass('click');
//         $(this).siblings().find('li').removeClass('click');
//     });
//     $('.js-jifen').on('blur',function() {
//     var val=$(this).val();
//     if(!/^[0-9]*$/.test(val) ||val<=0){
//         $(this).val(0);
//     }
// });


$(window).on('scroll',function(){
 var h_top= $('.pos_r').offset().top-$(window).height()+62;
 var win_top=$(window).scrollTop();
 if(win_top>h_top || win_top<185){
    $('#pos').removeClass("pos");
 }else{
    $('#pos').addClass('pos');
 }

});
</script>











<!--===================== 弹窗 =============================-->

<div class="shopping_alert js-false" id="shan_address">
     
</div>














  </body>
</html>
<?php if(!in_array(CONTROLLER_NAME,array('Login','Register'))): ?><a name="maodian"></a>
<!-- 侧边栏 -->
<div class="index_right_nav">
    <div class="personal_nav">
        <ul>
            <li class="li1">
                <div class="denglu">
                    <?php if($user_info): ?><p class="p1">您好！<?php echo ($user_info["user_name"]); ?></p>
                        <a target="_blank" href="<?php echo U('User/order');?>" class="a3">我的订单</a>
                        <?php else: ?>
                        <p class="p1">您好！请 <a target="_blank" href="<?php echo U('Login/index');?>">登录</a><span></span><a target="_blank" href="<?php echo U('Register/index');?>">注册</a></p>
                        <a target="_blank" href="<?php echo U('Login/index');?>" class="a3">我的订单</a><?php endif; ?>
                </div>
                <input type="hidden" name="islogin" value="<?php echo ($islogin); ?>"/>
            </li>
            <li class="li2"><div class="hover">返利中心</div></li>
            <li class="li3"><div class="hover">余额</div></li>
            <li class="li4"><div class="hover">红包</div></li>
            <li class="li5"><div class="hover">优惠券</div></li>
            <li class="li6"><div class="hover">储值卡</div></li>
            <li class="li7"><div class="hover">我的收藏</div></li>
            <li class="li8"><div class="hover">购物车</div><span><?php if($Think.session.cnumber): echo (session('cnumber')); else: ?>0<?php endif; ?></span></li>
            <li class="li9"> <a href="#maodian" class="maodian"></a></li>
        </ul>
    </div>
    <div class="right">
        <!-- 返利中心 -->
        <div class=" rebate">
        </div>
        <!-- 返利中心结束 -->
        <!-- 我的余额 -->
        <div class="recharge" style="display:none;">
        </div>
        <!-- 我的余额结束 -->
        <!-- 红包 -->
        <div class="hongbao js_hongbao_display"  style="display:none;">
        </div>
        <!-- 红包结束 -->
        <!-- 我的优惠券 每个分类又有三个卡片样式 -->
        <div class="hongbao js_coupon"  style="display:none;">
        </div>
        <!-- 我的优惠券结束 -->
        <!-- 储值卡 -->
        <div class="save" style="display:none;" >
        </div>
        <!-- 储值卡结束 -->
        <!-- 我的收藏 -->
        <div class="collect" style="display:none;">
        </div>
        <!-- 收藏结束 -->
        <!-- 我的购物车 -->
        <div class="trade" style="display:none;">
        </div>
        <!-- 我的购物车结束 -->
    </div>
</div>
<!-- 侧边栏结束 --><?php endif; ?>

<div class="index_footer">
    <div class="footer1">
        <ul class="container">
            <li><a href=""><div class="img1"></div>100%正品</a></li>
            <li><a href=""><div class="img2"></div>7天放心退</a></li>
            <li><a href=""><div class="img3"></div>分享就赚钱</a></li>
            <li><a href=""><div class="img4"></div>买贵返差额</a></li>
        </ul>

    </div>
    <div class="footer2">

        <dl class="dl1">
            <dd>客服电话:400-777-1225</dd>
            <dd>ICP备案号：沪ICP备15011936号</dd>
            <dd>COPYRIGHT©整体美商城</dd>
        </dl>

        <dl>
            <dt>公司</dt>
            <dd><a href="">关于我们</a></dd>
            <dd><a href="">加盟合作</a></dd>
            <dd><a href="">联系我们</a></dd>
        </dl>
        <dl>
            <dt>消费者</dt>
            <dd><a href="">帮助中心</a></dd>
            <dd><a href="">意见反馈</a></dd>
        </dl>
        <dl>
            <dt>售后服务</dt>
            <dd><a href="">售后说明</a></dd>
            <dd><a href="">售后质询</a></dd>
        </dl>
        <dl>
            <dt>安全中心</dt>
            <dd><a href="">绑定手机</a></dd>
            <dd><a href="">绑定银行卡</a></dd>
            <dd><a href="">设置支付密码</a></dd>
            <dd><a href="">设置安全问题</a></dd>
            <dd><a href="">忘记密码</a></dd>
        </dl>

        <div class="weixin">
            <div class="weixin_fenxiang">
                <img src="/Public/Computer/Images/weixin.png" alt="" />
                <p>关注注册送红包，分享购买返佣金！</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Computer/Js//index.js"></script>
<script type="text/javascript" src="/Public/Computer/Js//lhf_index.js"></script>
</body>
</html>