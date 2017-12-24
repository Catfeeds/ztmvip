<?php
/**
 * 二维码控制器
 * author: Tom
 */
namespace Computer\Controller;
class QrcodeController extends BaseController
{
    public function index(){
        $text = I('get.text','','base64_decode');
        \Common\Vendor\QRcode::png($text);
    }



}