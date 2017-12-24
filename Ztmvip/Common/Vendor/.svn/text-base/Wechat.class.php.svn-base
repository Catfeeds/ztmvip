<?php

namespace Common\Vendor;
#切记不可以将ROOT_PATH定义成http://www.ztmvip/mobile/
#则文件操作函数is_file、file_put_file等将报错，则一直就没有读取缓存值了
#对于linux与unix一定要从根上写过来  如/home/.......
#这个目录的定义可得注意了，最好是一个全新的目录，不要使用已经存在的
// define('ROOT_PATH','/home/wwwroot/ztmvip2/Ztmvip/Runtime/Temp/');

define('ROOT_PATH',dirname(dirname(dirname(__FILE__))).'/Runtime/Temp/');

class Wechat
{

   #类常量
   const MSGTYPE_TEXT = 'text';
   const MSGTYPE_IMAGE = 'image';
   const MSGTYPE_LOCATION = 'location';
   const MSGTYPE_LINK = 'link';
   const MSGTYPE_EVENT = 'event';
   const MSGTYPE_MUSIC = 'music';
   const MSGTYPE_NEWS = 'news';
   const MSGTYPE_VOICE = 'voice';
   const MSGTYPE_VIDEO = 'video';
   const EVENT_SUBSCRIBE = 'subscribe';       //订阅
   const EVENT_UNSUBSCRIBE = 'unsubscribe';   //取消订阅
   const EVENT_SCAN = 'SCAN';                 //扫描带参数二维码
   const EVENT_LOCATION = 'LOCATION';         //上报地理位置
   const EVENT_MENU_VIEW = 'VIEW';                     //菜单 - 点击菜单跳转链接
   const EVENT_MENU_CLICK = 'CLICK';                   //菜单 - 点击菜单拉取消息
   const EVENT_MENU_SCAN_PUSH = 'scancode_push';       //菜单 - 扫码推事件(客户端跳URL)
   const EVENT_MENU_SCAN_WAITMSG = 'scancode_waitmsg'; //菜单 - 扫码推事件(客户端不跳URL)
   const EVENT_MENU_PIC_SYS = 'pic_sysphoto';          //菜单 - 弹出系统拍照发图
   const EVENT_MENU_PIC_PHOTO = 'pic_photo_or_album';  //菜单 - 弹出拍照或者相册发图
   const EVENT_MENU_PIC_WEIXIN = 'pic_weixin';         //菜单 - 弹出微信相册发图器
   const EVENT_MENU_LOCATION = 'location_select';      //菜单 - 弹出地理位置选择器
   const EVENT_SEND_MASS = 'MASSSENDJOBFINISH';        //发送结果 - 高级群发完成
   const EVENT_SEND_TEMPLATE = 'TEMPLATESENDJOBFINISH';//发送结果 - 模板消息发送结果
   const EVENT_KF_SEESION_CREATE = 'kfcreatesession';  //多客服 - 接入会话
   const EVENT_KF_SEESION_CLOSE = 'kfclosesession';    //多客服 - 关闭会话
   const EVENT_KF_SEESION_SWITCH = 'kfswitchsession';  //多客服 - 转接会话
   const EVENT_CARD_PASS = 'card_pass_check';          //卡券 - 审核通过
   const EVENT_CARD_NOTPASS = 'card_not_pass_check';   //卡券 - 审核未通过
   const EVENT_CARD_USER_GET = 'user_get_card';        //卡券 - 用户领取卡券
   const EVENT_CARD_USER_DEL = 'user_del_card';        //卡券 - 用户删除卡券
   const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
   const AUTH_URL = '/token?grant_type=client_credential&';
   const MENU_CREATE_URL = '/menu/create?';
   const MENU_GET_URL = '/menu/get?';
   const MENU_DELETE_URL = '/menu/delete?';
   const GET_TICKET_URL = '/ticket/getticket?';
   const CALLBACKSERVER_GET_URL = '/getcallbackip?';
   const QRCODE_CREATE_URL='/qrcode/create?';
   const QR_SCENE = 0;
   const QR_LIMIT_SCENE = 1;
   const QRCODE_IMG_URL='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';
   const SHORT_URL='/shorturl?';
   const USER_GET_URL='/user/get?';
   const USER_INFO_URL='/user/info?';
   const USER_UPDATEREMARK_URL='/user/info/updateremark?';
   const GROUP_GET_URL='/groups/get?';
   const USER_GROUP_URL='/groups/getid?';
   const GROUP_CREATE_URL='/groups/create?';
   const GROUP_UPDATE_URL='/groups/update?';
   const GROUP_MEMBER_UPDATE_URL='/groups/members/update?';
   const GROUP_MEMBER_BATCHUPDATE_URL='/groups/members/batchupdate?';
   const CUSTOM_SEND_URL='/message/custom/send?';
   const MEDIA_UPLOADNEWS_URL = '/media/uploadnews?';
   const MASS_SEND_URL = '/message/mass/send?';
   const TEMPLATE_SET_INDUSTRY_URL = '/message/template/api_set_industry?';
   const TEMPLATE_ADD_TPL_URL = '/message/template/api_add_template?';
   const TEMPLATE_SEND_URL = '/message/template/send?';
   const MASS_SEND_GROUP_URL = '/message/mass/sendall?';
   const MASS_DELETE_URL = '/message/mass/delete?';
   const MASS_PREVIEW_URL = '/message/mass/preview?';
   const MASS_QUERY_URL = '/message/mass/get?';
   const UPLOAD_MEDIA_URL = 'http://file.api.weixin.qq.com/cgi-bin';
   const MEDIA_UPLOAD_URL = '/media/upload?';
   const MEDIA_GET_URL = '/media/get?';
   const MEDIA_VIDEO_UPLOAD = '/media/uploadvideo?';
   const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';
   const OAUTH_AUTHORIZE_URL = '/authorize?';
   const API_BASE_URL_PREFIX = 'https://api.weixin.qq.com'; //以下API接口URL需要使用此前缀
   const OAUTH_TOKEN_URL = '/sns/oauth2/access_token?';
   const OAUTH_REFRESH_URL = '/sns/oauth2/refresh_token?';
   const OAUTH_USERINFO_URL = '/sns/userinfo?';
   const OAUTH_AUTH_URL = '/sns/auth?';
   ///多客服相关地址
   const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
   const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
   const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getonlinekflist?';
   const CUSTOM_SEESSION_CREATE = '/customservice/kfsession/create?';
   const CUSTOM_SEESSION_CLOSE = '/customservice/kfsession/close?';
   const CUSTOM_SEESSION_SWITCH = '/customservice/kfsession/switch?';
   const CUSTOM_SEESSION_GET = '/customservice/kfsession/getsession?';
   const CUSTOM_SEESSION_GET_LIST = '/customservice/kfsession/getsessionlist?';
   const CUSTOM_SEESSION_GET_WAIT = '/customservice/kfsession/getwaitcase?';
   const CS_KF_ACCOUNT_ADD_URL = '/customservice/kfaccount/add?';
   const CS_KF_ACCOUNT_UPDATE_URL = '/customservice/kfaccount/update?';
   const CS_KF_ACCOUNT_DEL_URL = '/customservice/kfaccount/del?';
   const CS_KF_ACCOUNT_UPLOAD_HEADIMG_URL = '/customservice/kfaccount/uploadheadimg?';
   ///卡券相关地址
   const CARD_CREATE                     = '/card/create?';
   const CARD_DELETE                     = '/card/delete?';
   const CARD_UPDATE                     = '/card/update?';
   const CARD_GET                        = '/card/get?';
   const CARD_BATCHGET                   = '/card/batchget?';
   const CARD_MODIFY_STOCK               = '/card/modifystock?';
   const CARD_LOCATION_BATCHADD          = '/card/location/batchadd?';
   const CARD_LOCATION_BATCHGET          = '/card/location/batchget?';
   const CARD_GETCOLORS                  = '/card/getcolors?';
   const CARD_QRCODE_CREATE              = '/card/qrcode/create?';
   const CARD_CODE_CONSUME               = '/card/code/consume?';
   const CARD_CODE_DECRYPT               = '/card/code/decrypt?';
   const CARD_CODE_GET                   = '/card/code/get?';
   const CARD_CODE_UPDATE                = '/card/code/update?';
   const CARD_CODE_UNAVAILABLE           = '/card/code/unavailable?';
   const CARD_TESTWHILELIST_SET          = '/card/testwhitelist/set?';
   const CARD_MEMBERCARD_ACTIVATE        = '/card/membercard/activate?';      //激活会员卡
   const CARD_MEMBERCARD_UPDATEUSER      = '/card/membercard/updateuser?';    //更新会员卡
   const CARD_MOVIETICKET_UPDATEUSER     = '/card/movieticket/updateuser?';   //更新电影票(未加方法)
   const CARD_BOARDINGPASS_CHECKIN       = '/card/boardingpass/checkin?';     //飞机票-在线选座(未加方法)
   const CARD_LUCKYMONEY_UPDATE          = '/card/luckymoney/updateuserbalance?';     //更新红包金额
   const SEMANTIC_API_URL = '/semantic/semproxy/search?'; //语义理解

#静态变量
   //数据分析接口
   static $DATACUBE_URL_ARR = array(        //用户分析
       'user' => array(
           'summary' => '/datacube/getusersummary?',      //获取用户增减数据（getusersummary）
           'cumulate' => '/datacube/getusercumulate?',        //获取累计用户数据（getusercumulate）
       ),
       'article' => array(            //图文分析
           'summary' => '/datacube/getarticlesummary?',       //获取图文群发每日数据（getarticlesummary）
           'total' => '/datacube/getarticletotal?',       //获取图文群发总数据（getarticletotal）
           'read' => '/datacube/getuserread?',            //获取图文统计数据（getuserread）
           'readhour' => '/datacube/getuserreadhour?',        //获取图文统计分时数据（getuserreadhour）
           'share' => '/datacube/getusershare?',          //获取图文分享转发数据（getusershare）
           'sharehour' => '/datacube/getusersharehour?',      //获取图文分享转发分时数据（getusersharehour）
       ),
       'upstreammsg' => array(        //消息分析
           'summary' => '/datacube/getupstreammsg?',      //获取消息发送概况数据（getupstreammsg）
           'hour' => '/datacube/getupstreammsghour?', //获取消息分送分时数据（getupstreammsghour）
           'week' => '/datacube/getupstreammsgweek?', //获取消息发送周数据（getupstreammsgweek）
           'month' => '/datacube/getupstreammsgmonth?',   //获取消息发送月数据（getupstreammsgmonth）
           'dist' => '/datacube/getupstreammsgdist?', //获取消息发送分布数据（getupstreammsgdist）
           'distweek' => '/datacube/getupstreammsgdistweek?', //获取消息发送分布周数据（getupstreammsgdistweek）
           'distmonth' => '/datacube/getupstreammsgdistmonth?',   //获取消息发送分布月数据（getupstreammsgdistmonth）
       ),
       'interface' => array(        //接口分析
           'summary' => '/datacube/getinterfacesummary?', //获取接口分析数据（getinterfacesummary）
           'summaryhour' => '/datacube/getinterfacesummaryhour?', //获取接口分析分时数据（getinterfacesummaryhour）
       )
   );

   #私有属性
   
   private $token;
   private $encodingAesKey;
   private $encrypt_type;
   private $appid;
   private $appsecret;
   private $access_token;
   private $jsapi_ticket;
   private $user_token;   #特殊的网页授权凭证
   private $partnerid;
   private $partnerkey;
   private $paysignkey;
   private $postxml;
   private $_msg;
   private $_funcflag = false;
   private $_receive;
   private $_text_filter = true;
   public $debug =  false;
   public $errCode = 40001;
   public $errMsg = "no access";
   public $logcallback;

  #构造方法
  
  public function __construct()
  {

      $this->token ='xJ4EPvdb7Pk8bm85y8JN';
      $this->appid ='wxe5217a5151d9abd4';
      $this->appsecret ='72a99df3fea298745b70ba72551cdb93';

      $this->encodingAesKey ='';
      $this->debug =false;
      $this->logcallback =false;
  }

##########################接入指南################################################
  public function valid()
  {
      $echoStr = $_GET["echostr"];


      if($this->checkSignature()){
        #如果检验通过，则返回参数$echoStr
          echo $echoStr;
          exit;
      }
  }

  /*
     判断是否是微信服务器发过来的消息，从而认证成为开发者
   */
    private function checkSignature()
    {
        define("TOKEN", "shanbumin");
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        // sort函数对数组进行排序。当本函数结束时数组单元将被从最低到最高重新安排。
        //SORT_STRING - 单元被作为字符串来比较
        //加密/校验流程如下：
        // 1. 将token、timestamp、nonce三个参数进行字典序排序
        // 2. 将三个参数字符串拼接成一个字符串进行sha1加密
        // 3. 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
#######################微信认证#####################################################################
  /**
   * @param string $callback 回调URI
   * @return string   返回引导用户进入授权页面的url
   * shanbumin
   */
  public function getOauthRedirect($callback,$state='',$scope='snsapi_userinfo')
  {

      return self::OAUTH_PREFIX.self::OAUTH_AUTHORIZE_URL.'appid='.$this->appid.'&redirect_uri='.urlencode($callback).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
  }

  /**
   * 用户同意授权之后
   * 通过code换取网页授权access_token的值
   * @return array {access_token,expires_in,refresh_token,openid,scope}
   *  shanbumin
   */
  public function getOauthAccessToken($code)
  {
      #模拟get发送请求即可
      $json = $this->http_get(self::API_BASE_URL_PREFIX.self::OAUTH_TOKEN_URL.'appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code');
      if ($json)
      {
          $arr = json_decode($json,true);
          if (!$arr || !empty($arr['errcode'])) {
              $this->errCode = $arr['errcode'];
              $this->errMsg = $arr['errmsg'];
              return false;
          }
          #终于获得了特殊的网页凭证了
          $this->user_token = $arr['access_token'];
          return $arr;
      }
      return false;
  }

  /**
   * 获取授权后的用户资料
   * @param string $access_token
   * @param string $openid
   * @return array {openid,nickname,sex,province,city,country,headimgurl,privilege,[unionid]}
   * 注意：unionid字段 只有在用户将公众号绑定到微信开放平台账号后，才会出现。建议调用前用isset()检测一下
   * shanbumin
   */
  public function getOauthUserinfo($access_token,$openid)
  {
      #返回json格式的字符串
      $json = $this->http_get(self::API_BASE_URL_PREFIX.self::OAUTH_USERINFO_URL.'access_token='.$access_token.'&openid='.$openid);
      if ($json)
      {
          #转成php数组形式
          $arr = json_decode($json,true);
          if (!$arr || !empty($arr['errcode'])) {
              $this->errCode = $arr['errcode'];
              $this->errMsg = $arr['errmsg'];
              return false;
          }
          return $arr;
      }
      return false;
  }




######################### 获取 网页授权凭证 ##########################################
  /**
   * 这个函数就是检测有没有成功获取access_token
   * 先会去缓存中获取的
   */
  public function normalAccessToken()
  {
    
    #使用AppID和AppSecret调用指定接口链接来获取access_token的
          $appid = $this->appid;
          $appsecret = $this->appsecret;

     #缓存的文件名字
      $authname = 'normal_access_token';
      if ($rs = $this->getCache($authname))  
      {
          $this->access_token = $rs;
          return $rs;
      }


      //上述缓存中如果没有值，则会执行下面代码来获取的

      $result = $this->http_get(self::API_URL_PREFIX.self::AUTH_URL.'appid='.$appid.'&secret='.$appsecret);
      if ($result)
      {   
         //转换成数组
          $json = json_decode($result,true);
          if (!$json || isset($json['errcode'])) {
              $this->errCode = $json['errcode'];
              $this->errMsg = $json['errmsg'];
              return false;
          }
          $this->access_token = $json['access_token'];
          #在我们的服务器上缓存access_token值
          $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
          $this->setCache($authname,$this->access_token,$expire);
          return $this->access_token;
      }
      return false;
  }

       /**
        * 获取缓存，按需重载
        * @param string $cachename
        * @return mixed
        */
       protected function getCache($cachename)
    {
          
           $cache_dir = ROOT_PATH . 'data/wechatcache/';
           $file = $cache_dir . $cachename . '.cache';

  #http://www.hrliannamall.com/Public/data/wechatcache/normal_access_token.cache

     
           if(!is_file($file))
           {

               return false;
           }

           $content = file_get_contents($file);
           $data = unserialize($content);
           if (!is_array($data) || !isset($data['value']) || (!empty($data['value']) && $data['expired']<time())) {
              #如果过期了，则删除文件并返回false
               @unlink($file);
               return false;
           }
           return $data['value'];
       }

    /**
     * 设置缓存，按需重载
     * @param string $cachename
     * @param mixed $value
     * @param int $expired
     * @return boolean
     */
    protected function setCache($cachename,$value,$expired)
    {
       
        $cache_dir = ROOT_PATH . 'data/wechatcache/';

        if(!is_dir($cache_dir)){
            @mkdir($cache_dir, 0755, true);
        }
        $file = $cache_dir . $cachename . '.cache';
        $data = array(
            'value' => $value,
            'expired' => time() + $expired
        );

       #注意这个文件的所有者一定得和网站根目录的一样
        return file_put_contents( $file, serialize($data) ) ? true : false;
    }
######################客户接口##################################################
    /**
     * 发送客服消息
     * @param array $data 消息结构{"touser":"OPENID","msgtype":"news","news":{...}}
     * @return boolean|array
     */
    public function sendCustomMessage($data){
      if (!$this->access_token && !$this->normalAccessToken()) return false;
      $result = $this->http_post(self::API_URL_PREFIX.self::CUSTOM_SEND_URL.'access_token='.$this->access_token,self::json_encode($data));
      if ($result)
      {
        $json = json_decode($result,true);
        if (!$json || !empty($json['errcode'])) {
          $this->errCode = $json['errcode'];
          $this->errMsg = $json['errmsg'];
          return false;
        }
        return $json;
      }
      return false;
    }
##############  模拟请求方式  #########################################
    /**
     * GET 请求
     * @param string $url
     *  shanbumin
     */
    private function http_get($url){
        #需要php_curl扩展库的支持
        #extension=php_curl.dll
        $oCurl = curl_init(); #返回一个会话指针
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );  #returntransfer 希望获得内容但不输出,这个参数值为真
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            #返回获取的网页内容
            return $sContent;
        }else{
            return false;
        }
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     * @return string content
     */
    private function http_post($url,$param,$post_file=false){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param) || $post_file) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach($param as $key=>$val){
                $aPOST[] = $key."=".urlencode($val);
            }
            $strPOST =  join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($oCurl, CURLOPT_POST,true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }
  #######################  JS-SDK的使用  ############################################
      /**
       * jsapi_ticket的获取以及缓存方式与access_token一模一样
      * 获取JSAPI授权TICKET
      * @param string $appid 可以测试其它的公众号
      * @param string $jsapi_ticket 手动指定jsapi_ticket，非必要情况不建议用
      * author:shanbumin
      */
     public function getJsTicket($appid='',$jsapi_ticket='')
     {
         
       
    
         #获取access_token
         if (!$this->access_token && !$this->normalAccessToken()) return false;

    
         $authname = 'wechat_jsapi_ticket';
         if ($rs = $this->getCache($authname))  {
             $this->jsapi_ticket = $rs;
             return $rs;
         }
         $result = $this->http_get(self::API_URL_PREFIX.self::GET_TICKET_URL.'access_token='.$this->access_token.'&type=jsapi');
         if ($result)
         {
             $json = json_decode($result,true);
             if (!$json || !empty($json['errcode'])) {
                 $this->errCode = $json['errcode'];
                 $this->errMsg = $json['errmsg'];
                 return false;
             }
             $this->jsapi_ticket = $json['ticket'];
             $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
             $this->setCache($authname,$this->jsapi_ticket,$expire);
             return $this->jsapi_ticket;
         }
         return false;
     }



   /**
    * 生成随机字串
    * @param number $length 长度，默认为16，最长为32字节
    * @return string
    */
   public function generateNonceStr($length=16)
   {
       // 密码字符集，可任意添加你需要的字符
       $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       $str = "";
       for($i = 0; $i < $length; $i++)
       {
           $str .= $chars[mt_rand(0, strlen($chars) - 1)];
       }
       return $str;
   }


   /**
    * 获取签名 signature
    * @param array $arrdata 签名数组
    * @param string $method 签名方法
    * @return boolean|string 签名值
    */
   public function getSignature($arrdata,$method="sha1") {
       if (!function_exists($method)) return false;
       #字典排序
       ksort($arrdata);
       $paramstring = "";
       foreach($arrdata as $key => $value)
       {
           if(strlen($paramstring) == 0)
               $paramstring .= $key . "=" . $value;
           else
               $paramstring .= "&" . $key . "=" . $value;
       }
       #sha1加密
       $Sign = $method($paramstring);
       return $Sign;
   }
     /**
      * 获取JsApi使用签名中得所有配置参数
      * @param string $url 网页的URL，自动处理#及其后面部分
      * @param string $timestamp 当前时间戳 (为空则自动生成)
      * @param string $noncestr 随机串 (为空则自动生成)
      * @param string $appid 用于多个appid时使用,可空
      * @return array|bool 返回签名字串
      */
     public function getJsSign($url, $timestamp=0, $noncestr='', $appid='')
     {
         if (!$this->jsapi_ticket && !$this->getJsTicket($appid) || !$url) return false;
     
             $timestamp = time();
             $noncestr = $this->generateNonceStr();
             
         $ret = strpos($url,'#');
         if ($ret)
             $url = substr($url,0,$ret);
         $url = trim($url);
         if (empty($url))
             return false;
         $arrdata = array("timestamp" => $timestamp, "noncestr" => $noncestr, "url" => $url, "jsapi_ticket" => $this->jsapi_ticket);
         $sign = $this->getSignature($arrdata);
         if (!$sign)
             return false;
         $signPackage = array(
             "appid"     => $this->appid,
             "noncestr"  => $noncestr,
             "timestamp" => $timestamp,
             "url"       => $url,
             "signature" => $sign
         );
         #一次性返回了wx.config需要的所有参数，非常棒的
         return $signPackage;
     }

################由于微信api导致系统自带的json_encode对中文不支持,所以重新封装一个#################################################
  /**
   * 微信api不支持中文转义的json结构
   * 将数组转成json格式字符串
   * @param array $arr
   */
  static function json_encode($arr) {
    $parts = array ();
    $is_list = false;
    //Find out if the given array is a numerical array
    $keys = array_keys ( $arr );
    $max_length = count ( $arr ) - 1;
    if (($keys [0] === 0) && ($keys [$max_length] === $max_length )) { //See if the first key is 0 and last key is length - 1
      $is_list = true;
      for($i = 0; $i < count ( $keys ); $i ++) { //See if each key correspondes to its position
        if ($i != $keys [$i]) { //A key fails at position check.
          $is_list = false; //It is an associative array.
          break;
        }
      }
    }
    foreach ( $arr as $key => $value ) {
      if (is_array ( $value )) { //Custom handling for arrays
        if ($is_list)
          $parts [] = self::json_encode ( $value ); /* :RECURSION: */
        else
          $parts [] = '"' . $key . '":' . self::json_encode ( $value ); /* :RECURSION: */
      } else {
        $str = '';
        if (! $is_list)
          $str = '"' . $key . '":';
        //Custom handling for multiple data types
        if (!is_string ( $value ) && is_numeric ( $value ) && $value<2000000000)
          $str .= $value; //Numbers
        elseif ($value === false)
        $str .= 'false'; //The booleans
        elseif ($value === true)
        $str .= 'true';
        else
          $str .= '"' . addslashes ( $value ) . '"'; //All other things
        // :TODO: Is there any more datatype we should be in the lookout for? (Object?)
        $parts [] = $str;
      }
    }
    $json = implode ( ',', $parts );
    if ($is_list)
      return '[' . $json . ']'; //Return numerical JSON
    return '{' . $json . '}'; //Return associative JSON
  }
############################账户管理--生成带参数的二维码#####################################################
#获取带参数的二维码的过程包括两步，首先创建二维码ticket，然后凭借ticket到指定URL换取二维码。


  public function foreoverTicket($data)
  {

      #获取access_token
      if (!$this->access_token && !$this->normalAccessToken()) return false;
      $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->access_token;
      $json = $this->http_post($url,self::json_encode($data));

      if ($json)
      {
          $result = json_decode($json,true);

          if (!empty($result['errcode'])) {
              return false;
          }

          return $result['url'];

      }else{
         return false; 
       }
  


  }

########################生成自定义菜单#########################################################################################
  //创建自定义菜单
   function createMenus($data) {
       
    #获取access_token
    if (!$this->access_token && !$this->normalAccessToken()) return false;

    $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' .$this->access_token;

    $result= $this->http_post($url,self::json_encode($data));

    show_bug($result);

   }

####################################################################################################



}#类尾部