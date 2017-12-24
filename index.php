<?php
header('content-type:text/html;charset=utf-8');

//检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

//开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

//定义应用目录(网站根目录)
define('APP_PATH','./Ztmvip/');

//定义域名变量  www
define('DOMAIN_PREFIX',strtolower(substr($_SERVER['HTTP_HOST'],0,stripos($_SERVER['HTTP_HOST'],'.'))));

//引入ThinkPHP入口文件
require('./ThinkPHP/ThinkPHP.php');
