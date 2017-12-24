<?php
/**
 * 公共基础控制器
 * author: Tom
 */
namespace Common\Controller;
class CommonController extends \Think\Controller
{
    public function _initialize(){
    }

    //空操作
    public function _empty(){
        $this->_status(404);
    }

    //返回状态标识
    protected function _status($code){
        switch ( intval($code) ){
            case 404:
                header('HTTP/1.1 404 Not Found');
                header('status: 404 Not Found');
                break;
            case 403:
                header('HTTP/1.1 403 Forbidden');
                header('status: 403 Forbidden');
                break;
        }

        exit;
    }
}