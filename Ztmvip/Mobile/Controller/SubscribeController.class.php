<?php
namespace Mobile\Controller;
class SubscribeController extends BaseController
{
 
    private $weObj;
    public  $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content>%s</Content>
                        </xml>";
    public $newsTpl="<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[news]]></MsgType>
                      <ArticleCount>1</ArticleCount>
                      <Articles>
                      <item>
                      <Title><![CDATA[%s]]></Title>
                      <Description><![CDATA[%s]]></Description>
                      <PicUrl><![CDATA[%s]]></PicUrl>
                      <Url><![CDATA[%s]]></Url>
                      </item>
                      </Articles>
                      <FuncFlag>0</FuncFlag>
                      </xml>";
    public $openid;
    public $orginID;


    public function __construct(){
        parent::__construct();
        $this->weObj = new \Common\Vendor\Wechat();

    }

    //微信服务器默认访问的方法
    public function index(){
       
        if ( $_GET['echostr'] )
            $this->weObj->valid();
        else
            $this->responseMsg();
    }

    //对信息与事件的响应
    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        // file_put_contents('/home/wwwroot/ztmvip2/Ztmvip/Runtime/shanbumin.txt',$postStr);
        
        try{

            if (empty($postStr))
                E('empty');

                $postdata=json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                $this->openid=$postdata['FromUserName'];
                $this->orginID=$postdata['ToUserName'];
              


                if($postdata['MsgType']=='text'){
                    $response='&lt;a href=&quot;'.__HOST__.'&quot;&gt;【进入整体美商城】&lt;/a&gt;';
                    $resultStr=sprintf($this->textTpl,$this->openid,$this->orginID,time(),$response);
                    echo $resultStr;
                    exit();
                }else if($postdata['MsgType']=='event'){
                      switch ($postdata['Event']) {
                          case 'subscribe':
                              $back=D('Subscribe')->subscribe($this->openid);

                              if($back['code']=='registered')
                              {
                                 $response='尊敬的整体美用户，您于'.$back['date_add'].'已注册成为第'.$back['id'].'位会员。感谢您的关注与支持。';
                                
                              }elseif($back['code']=='success')
                              {
                                  $response='恭喜您于'.$back['date_add'].'成功注册成为整体美商城第'.$back['id'].'位会员。';
                                  $response.="\n190元注册红包已入账，马上进入";
                                  $response.='&lt;a href=&quot;'.__HOST__.'&quot;&gt;【整体美商城】&lt;/a&gt;';
                                  $response.='疯狂选购吧！';
                              }
                              $resultStr=sprintf($this->textTpl,$this->openid,$this->orginID,time(),$response);
                               echo $resultStr;
                               exit();
                              break;
                          case 'unsubscribe':
                              D('Subscribe')->unsubscribe($this->openid);  
                              break; 
                          case  'SCAN':
                            $response='&lt;a href=&quot;'.__HOST__.'&quot;&gt;【进入整体美商城】&lt;/a&gt;';
                            $resultStr=sprintf($this->textTpl,$this->openid,$this->orginID,time(),$response);
                            echo $resultStr;
                            exit();
                               
                             break;                   
                          default:
                              # code...
                              break;
                      }

                }else{
                      E('empty');
                }
     

        }catch(\Think\Exception $e)
        {
           $error=$e->getMessage();
           switch ($error) {
               case 'empty':
                   echo '';     
                   break;
               default:
                   # code...
                   break;
           }
        }


       

}



/**
 * 测试
 * @return [type] [description]
 */
public function qcodeSubscribe($user_id='')
{
  
  $true=is_wechat_browser();
  if(!$true)
    die('此控制器方法禁止线下调试，否则造成线上缓存access_token失效');

    $data=array(
            'action_name'=>'QR_LIMIT_SCENE',
            'action_info'=>array(
                      'scene'=>array(
                            'scene_id'=>$user_id
                            ),
                   ),
        );
   $url=$this->weObj->foreoverTicket($data);
   echo $url;

}


/**
 * 开发者模式创建自定义菜单
 * @return [type] [description]
 */
public function createMenus()
{

  $true=is_wechat_browser();
  if(!$true)
    die('此控制器方法禁止线下调试，否则造成线上缓存access_token失效');
 
          $data=array(
              array('type'=>'view','name'=>'商城首页','url'=>__HOST__.U('Index/index')),
              array('type'=>'view','name'=>'健康减重','url'=>__HOST__.U('Health/special_register')),
              array(
                   'name'=>'服务中心',
                   'sub_button'=>array(
                                   array('type'=>'view','name'=>'个人中心','url'=>__HOST__.U('User/index')),
                                   array('type'=>'view','name'=>'我的订单','url'=>__HOST__.U('User/order','state=payed')),
                                   array('type'=>'view','name'=>'我的佣金','url'=>__HOST__.U('Affiliate/index')),
                                   array('type'=>'view','name'=>'快递查询','url'=>__HOST__.U('User/order','state=send')),
                               ),
                  ),
           );


           $this->weObj->createMenus(array('button'=>$data));
      
}

   

}#类尾