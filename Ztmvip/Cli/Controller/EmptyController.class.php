<?php
/**
 * 空控制器
 * author: Tom
 */
namespace Cli\Controller;
class EmptyController extends \Common\Controller\CommonController
{
    public function _empty(){
        if ( !IS_CLI )
            exit;
    }
}