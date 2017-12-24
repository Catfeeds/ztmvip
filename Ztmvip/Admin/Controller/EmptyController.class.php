<?php
/**
 * 空控制器
 * author: Tom
 */
namespace Admin\Controller;
class EmptyController extends \Common\Controller\CommonController
{
    public function _empty(){
        $this->_status(404);
    }
}