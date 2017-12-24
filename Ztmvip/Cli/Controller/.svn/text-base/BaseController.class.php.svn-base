<?php
/**
 * 基础控制器
 * author: Tom
 */
namespace Cli\Controller;
class BaseController extends \Common\Controller\CommonController
{
    //空操作
    public function _empty(){
        exit;
    }

    //初始化
    public function _initialize(){
        if ( !IS_CLI )
            exit;
    }
}