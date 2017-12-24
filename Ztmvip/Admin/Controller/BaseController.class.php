<?php
/**
 * 基础控制器
 * author: Tom
 */
namespace Admin\Controller;
class BaseController extends \Common\Controller\CommonController
{
    protected $_manager_id=0; //管理员id

    //空操作
    public function _empty(){
        $this->_status(404);
    }

    //检查用户登录状态
    public function _initialize(){
        parent::_initialize();

        if ( DOMAIN_PREFIX != C('admin_domain') )
            $this->_empty();

        if ( !session('manager.id') ){
            if ( IS_AJAX ){
                $this->ajaxReturn(array(
                    'state' => false,
                    'message' => '登录超时，请重新登录系统'
                ));
            }else{
                redirect(U('Login/index') .'?ret='. base64_encode($_SERVER['REQUEST_URI']));
            }
        }

        $this->_manager_id = session('manager.id');
        $this->assign('manager_nick',session('manager.nick_name'));
        $this->assign('sitename',C('WEBSITE.NAME'));
    }

    /**
     * 分页
     * @param $count 数据总数
     * @param int $size 每页数据数
     * @return \Common\Vendor\Page 分页类
     */
    public function page($count,$size=0){
        if ( !$size && cookie('PAGESIZE') ) {
            $size = cookie('PAGESIZE');
        }else{
            $size = $size?:15;
            cookie('PAGESIZE',$size);
        }

        $page = new \Common\Vendor\Page($count,$size);
        $page->setConfig('header','<span class="total">共 %TOTAL_ROW% 条记录</span>');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
        $page->setConfig('theme','<div class="page-show">%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 每页 <input type="number" value="'.cookie('PAGESIZE').'" onchange="Core.Cookie(\''.C('COOKIE_PREFIX').'PAGESIZE\',this.value);location.reload();" style="height:26px;width:50px;"> 条</div>');
        $this->assign('page_show',$page->show());
        return $page;
    }
}