<?php
/**
 * 基础控制器
 * author: Tom
 */
namespace Mobile\Controller;
class BaseController extends \Common\Controller\CommonController
{
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
        $page->setConfig('theme','<div class="page-show">%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</div>');
        $this->assign('page_show',$page->show());
        return $page;
    }

    /**
     * 空操作
     * @param int $state HTTP状态
     * @param string $message 页面消息
     * @param string $url 跳转网址
     */
    public function _empty($state=404,$message='',$url=''){
        C('layout_on',false);

        switch ( $state ){
            case 302:
                $this->assign('message',$message);
                $this->assign('url',$url);
                $this->display('/302');
                break;
            default:
                $this->display('/404');
                break;
        }

        exit;
    }

    public function _initialize(){
        parent::_initialize();

        #定义一个常量
        defined('__HOST__') or define('__HOST__', get_domain());

        # 判断是否存在商品推荐人(有效时间2天)
        if ( I('get.guser') )
            cookie('affiliate_guser',I('get.guser'),172800);

        #判断是否存在扫描推荐人
        if ( I('get.u') )
            cookie('parent_id',I('get.u'),604800);

        ###########客户端打上购物车烙印##########################
        if ( cookie('cart_key') ){
            //不为空，则刷新时间
            $sesskey = cookie('cart_key');
            cookie('cart_key',$sesskey,2592000);
        }else{
            $sesskey = md5(uniqid(mt_rand(), true));
            cookie('cart_key',$sesskey,2592000);
        }

        define('CART_KEY',cookie('cart_key'));

        D('Flow')->cartBuyNumber();
        ######################################

        $this->assign('sitename',' - '. C('WEBSITE.NAME'));
    }

    //判断是否微信浏览器
    public function is_wechat(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false )
            return true;
        else
            return false;
    }
}