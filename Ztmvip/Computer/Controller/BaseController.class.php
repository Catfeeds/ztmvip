<?php
/**
 * 基础控制器
 * author: Tom
 */
namespace Computer\Controller;
class BaseController extends \Common\Controller\CommonController
{
    /**
     * 空操作
     * @param int $state HTTP状态
     * @param string $message 页面消息
     * @param string $url 跳转网址
     */
    public function _empty($state=404,$message='',$url=''){
        C('layout_on',false);

        switch ( $state ){
            case 404:
                $this->display('/404');
                break;
            case 302:
                $this->assign('message',$message);
                $this->assign('url',$url);
                $this->display('/302');
                break;
        }

        exit;
    }

    public function _initialize(){
        parent::_initialize();

        defined('__HOST__') or define('__HOST__', get_domain());

        if ( cookie('isMobile') != 'pc' ){
            if ( $this->isMobile() ){
                header('Location: '. preg_replace('/\/\/(\w+\.)+(\w+\.\w+)/i','//mobile.$2',__HOST__) . $_SERVER['REQUEST_URI']);
            }else{
                cookie('isMobile','false');
            }
        }

        $this->assign('sitename',' - '. C('WEBSITE.NAME'));

        #=================================================================
        
         # 判断是否存在商品推荐人
        if ( I('get.guser') )
            cookie('affiliate_guser',I('get.guser'),172800);


        if ( cookie('cart_key') ){
            //不为空，则刷新时间
            $sesskey = cookie('cart_key');
            cookie('cart_key',$sesskey,2592000);
        }else{
            $sesskey = md5(uniqid(mt_rand(), true));
            cookie('cart_key',$sesskey,2592000);
        }

        define('CART_KEY',cookie('cart_key'));
        D('Cart')->cartBuyNumber();
      #===============================================================
        //头部需要的数据输出==============================

           //用户登录信息
       $user_model = D('User');
       if($user_model->isLogin()){
           $user_info = $user_model->field('id,mobile,user_money,user_name')->find(session('user_id'));
           $this->assign('user_info',$user_info);
           $this->assign('islogin','true');
       }

       //===========================================================
    
    }

    // 是否手机移动设备访问
    private function isMobile(){
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if ( isset($_SERVER['HTTP_X_WAP_PROFILE']) )
            return true;

        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if ( isset($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT'] )
            return true;

        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        //找不到为false,否则为true
        if ( isset($_SERVER['HTTP_VIA']) )
            return stristr($_SERVER['HTTP_VIA'],'wap') ? true : false;

        //判断手机发送的客户端标志,兼容性有待提高
        if ( isset($_SERVER['HTTP_USER_AGENT']) ){
            $clientkeywords = array(
                'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            );

            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if ( preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])) )
                return true;
        }

        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ( (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))) )
                return true;
        }

        return false;
    }

    /**
     * 分页
     * @param $count 数据总数
     * @param int $size 每页数据数
     * @return \Common\Vendor\Page 分页类
     */
    public function page($count,$size=15){
        $page = new \Common\Vendor\Page($count,$size);
        $page->setConfig('header','<span class="total">共 %TOTAL_ROW% 条记录</span>');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
        // $page->setConfig('theme','<div class="page-show">%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</div>');
        $this->assign('page_show',$page->show());
        return $page;
    }
}