<?php
/**
 * 邮件发送类
 * author: Tom
 */
namespace Common\Vendor;
class Mail
{
    /**
     * 发送邮件
     * @param $to
     * @param $subject
     * @param $message
     * @return bool
     */
    public function send($to,$subject,$message){
        $to = is_array($to) ? $to : array($to);
        $to_str = '';

        foreach ( $to as $val ){
            $to_str .= substr($val,0,stripos($val,'@')-1)." <$val>,";
        }
        $to = substr($to_str,0,-1);
        unset($to_str);

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        //$headers .= "To: $to\r\n";
        $headers .= "From: =?UTF-8?B?".base64_encode('整体美商城')."?= <server@ztmvip.com>\r\n";
        //$headers .= "Cc: birthdayarchive@example.com\r\n";
        //$headers .= Bcc: birthdaycheck@example.com\r\n";

        return mail($to,$subject,$message,$headers);
    }
}