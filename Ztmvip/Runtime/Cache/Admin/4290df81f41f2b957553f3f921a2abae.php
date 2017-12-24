<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo ($page_title); ?>-<?php echo ($sitename); ?></title>
    <link rel="sgortcut icon" href="/Public/Admin/Images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/Images/common.css" />
    <script src="/Public/Common/Js/jquery.js"></script>
    <script src="/Public/Common/Js/common.js"></script>
<style type="text/css">
a{color:#333;text-decoration:none; }
.bodybg{width:100%;height:100%;position:relative;min-width: 1300px;}
.login_box{width:540px;height:340px;background:rgba(255,255,255,0.3);border-radius: 15px;position:absolute;top:50%;margin-top: -170px;left:50%;margin-left: -270px;}
.login_box .login_boxin{width:500px;height:300px;background:-webkit-linear-gradient(top,#89ccfd,#175290);border-radius: 13px;box-shadow:0px 5px 10px #195784;margin:20px auto;overflow:hidden;}
.login_box .dec{width:100px;height:100px;background-size:cover;position:absolute;top:-20px;left:-20px;}
.login_box .login_boxin .top{font-size: 30px;font-weight: bold;width:400px;line-height:50px;margin:10px auto 0;padding-left:20px;box-sizing:border-box;border-bottom: 1px solid #fff;color:#fff;text-shadow:0px 1px 2px #215D8A;}
.login_box .login_boxin .user{width:300px;margin:20px auto 0;}
.login_box .login_boxin .user td{height:40px;}
.login_box .login_boxin .user .td1{width:100px;font-size: 20px;}
.login_box .login_boxin .user .td2 input{height:30px;font-size:16px;border-radius: 5px;}
.login_box .login_boxin .other{width:300px;margin:5px auto 5px;color:#333;position:relative;}
.login_box .login_boxin .other .remember{width:15px;height:15px;}
.login_box .login_boxin .other .rem{font-size: 14px;position:absolute;left:20px;}
.login_box .login_boxin .other a{font-size: 14px;position:absolute;left:100px;}
.login_box .login_boxin .button{width:150px;height:30px;margin:20px 175px;font-size:14px;border-radius: 10px;border:none;background:#42C32C;color:#fff;}
.login_box .login_boxin .button:hover{background:#319A1F;cursor:pointer;}
</style>
</head>
<body>
<div class="bodybg">
    <div class="login_box">
        <div class="dec"></div>
        <div class="login_boxin">
            <div class="top">用户登录</div>
            <form id="form" onsubmit="return false;">
                <table class="user">
                    <tr>
                        <td class="td1">账&nbsp&nbsp&nbsp&nbsp号:</td>
                        <td class="td2">
                            <input type="text" name="user_name" required="required" placeholder="请输入账号..." autofocus="autofocus" />
                        </td>
                    </tr>
                    <tr>
                        <td class="td1">密&nbsp&nbsp&nbsp&nbsp码:</td>
                        <td class="td2">
                            <input type="password" name="password" required="required" placeholder="请输入密码..." />
                        </td>
                    </tr>
                </table>
                <div class="other">
                    <input type="checkbox" class="remember" name="remember" value="1" id="rem" />
                    <label class="rem" for="rem">记住账号</label>
                </div>   
                <input type="submit" class="button" value="进入管理中心" />
                <input type="hidden" name="ret" value="<?php echo ($ret); ?>">
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script>
var form = $('#form');
form.on('submit',function(){
    $.post('',Core.InputObj(form),function(ret){
        if ( ret.state ){
            Core.Alert({ 'text':ret.message,'state':'suc','callback':function(){
                location.href = ret.uri;
            } });
        }else{
            Core.Alert({ 'text':ret.message,'state':'err' });
        }
    },'json');
});
</script>