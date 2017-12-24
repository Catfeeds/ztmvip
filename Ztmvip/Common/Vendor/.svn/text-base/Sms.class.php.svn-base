<?php
/**
 * 短信类
 * author: Tom
 */
namespace Common\Vendor;
include('Sms/sms.inc.php');
class Sms
{
    private $sms;

    public function __construct(){
        $this->sms = new \SMS();
    }

    /**
     * 发送短信
     * @param $mobile 接收手机号
     * @param $msg 短信内容
     * @param string $time 发送时间
     * @param int $apitype 发送通道 0：默认通道； 2：通道2； 3：即时通道
     * @return mixed
     */
    function send($mobile,$msg,$time='',$apitype=0)
    {
        return $this->sms->sendSMS($mobile,mb_convert_encoding($msg,'gbk','utf-8'),$time,$apitype);
    }
}