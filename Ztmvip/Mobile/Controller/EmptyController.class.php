<?php
/**
 * 空控制器
 * author: Tom
 */
namespace Mobile\Controller;
class EmptyController extends \Common\Controller\CommonController
{
    public function _empty(){
        C('layout_on',false);
        $this->display('/404');
        exit;
    }
}