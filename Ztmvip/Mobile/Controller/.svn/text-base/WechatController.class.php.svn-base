<?php
namespace Mobile\Controller;
class WechatController extends BaseController
{
    private $weObj;

    public function __construct(){
        parent::__construct();
        $this->weObj = new \Common\Vendor\Wechat();

    }


    /**
     * 微信OAuth操作
     */
    public function do_oauth(){
        #回调地址
        $reback_url=__HOST__.U('Wechat/do_oauth');
        #返回引导用户进入授权页面的url
        $url = $this->weObj->getOauthRedirect($reback_url, 1);

        if (isset($_GET['code']) && !empty($_GET['code'])){

            $code=$_GET['code'];
            #通过code换取特殊的网页授权access_token,同时也会返回该用户的openID
            $accesstoken = $this->weObj->getOauthAccessToken($code);

            if ($accesstoken){
                $userinfo = $this->weObj->getOauthUserinfo($accesstoken['access_token'], $accesstoken['openid']);

                #==========去添加或者更新用户的信息=====================================================
                $true=D('Wechat')->update_weixin_user($userinfo);
                if($true)
                {
                    $redirect_url = session('redirect_url');
                    header('Location:' . $redirect_url, true, 302);
                    exit();
                }
                #=================================================================

            }else{
                //获取不到的话，再次重定向到引导用户进入的授权页面
                header('Location:' . $url, true, 302);
                exit();
            }
        }else{
            //重定向到引导用户进入的授权页面
            header('Location:' . $url, true, 302);
            exit();
        }
    }

#####################客服接口################################################################
    /**
     * 发送文本信息
     *
     */
    public function send_wechat_text($content)
    {

        $data = array(
            'touser' => session('openid'),
            'msgtype' => 'text',
            'text' => array(
                'content' => $content,
            )
        );
        $this->weObj->sendCustomMessage($data);
    }

    public function send_wechat_news($title,$description,$url)
    {



        $data= array(
            'touser' =>session('openid'),
            'msgtype' => 'news',
            'news' => array(
                'articles' => array(
                    array(
                        'title' =>$title,
                        'description' => $description,
                        'url' =>$url
                    )
                )
            )
        );

        $this->weObj->sendCustomMessage($data);
    }
################################################################################################
#微信支付成功回调地址
    public function wxpayReback()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];


        if (!empty($postStr))
        {
            $postdata=json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
#====先判断上述的xml信息是否是微信服务器给的，即进行签名比对==============
            $wxsign = $postdata['sign'];
            unset($postdata['sign']);#将签名先剖除
            $wxpay=new \Common\Vendor\Wxpay();
            $sign=$wxpay->getSign($postdata);
#=============================================================================

            if ($wxsign == $sign)
            {
                if ($postdata['result_code'] =='SUCCESS')
                {
                    #======================================================================
                    $out_trade_no = explode('O', $postdata['out_trade_no']);
                    $order_id=$out_trade_no[1];
                    $amount=$postdata['total_fee']/100;
                    $transaction_id=$postdata['transaction_id'];

                    $true=D('Treatment')->isOrderPayed($order_id);

                    if($true)
                    {
                        $returndata['return_code'] = 'SUCCESS';
                    }else{
                        $order_amount=D('Treatment')->orderAmount($order_id);
                        #判断付款的额度是否与应付额度相等

                        if($order_amount==$amount)
                        {
                            #修改订单状态为已经支付

                            $true=D('Treatment')->wxorderPayed($order_id,$amount,$transaction_id);

                            #赠送积分
                            D('Treatment')->giveIntegral($order_id,'wx_redirect');

                            #赠送红包
                            D('Treatment')->giveBonus($order_id);
                            #打入分销标志
                            D('Treatment')->affiliateFlag($order_id);
                            $returndata['return_code'] = 'SUCCESS';

                        }else{
                            $returndata['return_code'] = 'FAIL';
                            $returndata['return_msg'] = '金额有误'; }
                    }
                    #===============================================================================


                }#success尾巴

            }else
            {
                #签名失败的时候，给微信服务器的答复
                $returndata['return_code'] = 'FAIL';
                $returndata['return_msg'] = '签名失败';
            }
        } else {
            #当我们没有收到数据的时候，给微信服务器的答复
            $returndata['return_code'] = 'FAIL';
            $returndata['return_msg'] = '无数据返回';
        }
        // 数组转化为xml
        $xml = "<xml>";
        foreach ($returndata as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";

        echo $xml;
        exit();

    }

    // 购买储值卡异步回调
    public function prepaidNotifyUrl(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postdata = json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            #====先判断上述的xml信息是否是微信服务器给的，即进行签名比对==============
            $wxsign = $postdata['sign'];
            unset($postdata['sign']);#将签名先剖除
            $wxpay = new \Common\Vendor\Wxpay();
            $sign = $wxpay->getSign($postdata);
            #=============================================================================
            if ($wxsign == $sign) {
                if ($postdata['result_code'] == 'SUCCESS') {
                    #======================================================================
                    //$order_sn = $postdata['out_trade_no'];
                    $out_trade_no = explode('O', $postdata['out_trade_no']);
                    $order_sn=$out_trade_no[0];
                    $amount = $postdata['total_fee'] / 100;
                    $transaction_id = $postdata['transaction_id'];
                    $order = D('Prepaid')->prepaidIsPay($order_sn);
                    //dump($order);exit();
                    if ($order===true) {
                        $returndata['return_code'] = 'SUCCESS';
                    } else {
                        if ($order['amount'] == $amount) {
                            //支付成功，处理业务
                            D('Prepaid')->prepaidAfter($order,$transaction_id);
                            $returndata['return_code'] = 'SUCCESS';

                        } else {
                            $returndata['return_code'] = 'FAIL';
                            $returndata['return_msg'] = '金额有误';
                        }
                    }
                    #===============================================================================
                }#success尾巴

            } else {
                #签名失败的时候，给微信服务器的答复
                $returndata['return_code'] = 'FAIL';
                $returndata['return_msg'] = '签名失败';
            }
        } else {
            #当我们没有收到数据的时候，给微信服务器的答复
            $returndata['return_code'] = 'FAIL';
            $returndata['return_msg'] = '无数据返回';
        }
        // 数组转化为xml
        $xml = "<xml>";
        foreach ($returndata as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";

        echo $xml;
        exit();
    }

    // 充值异步回调地址
    public function depositNotifyUrl(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postdata = json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            #====先判断上述的xml信息是否是微信服务器给的，即进行签名比对==============
            $wxsign = $postdata['sign'];
            unset($postdata['sign']);#将签名先剖除
            $wxpay = new \Common\Vendor\Wxpay();
            $sign = $wxpay->getSign($postdata);
            #=============================================================================
            if ($wxsign == $sign) {
                if ($postdata['result_code'] == 'SUCCESS') {
                    #======================================================================
                    //$order_sn = $postdata['out_trade_no'];
                    $out_trade_no = explode('O', $postdata['out_trade_no']);
                    $order_sn=$out_trade_no[0];
                    $amount = $postdata['total_fee'] / 100;
                    $transaction_id = $postdata['transaction_id'];
                    $order = D('User')->UserAccountIsPay($order_sn);
                    if ($order===true) {
                        $returndata['return_code'] = 'SUCCESS';
                    } else {
                        if ($order['amount'] == $amount) {
                            D('User')->userAccountPaid($order,$transaction_id);
                            $returndata['return_code'] = 'SUCCESS';

                        } else {
                            $returndata['return_code'] = 'FAIL';
                            $returndata['return_msg'] = '金额有误';
                        }
                    }
                    #===============================================================================
                }#success尾巴

            } else {
                #签名失败的时候，给微信服务器的答复
                $returndata['return_code'] = 'FAIL';
                $returndata['return_msg'] = '签名失败';
            }
        } else {
            #当我们没有收到数据的时候，给微信服务器的答复
            $returndata['return_code'] = 'FAIL';
            $returndata['return_msg'] = '无数据返回';
        }
        // 数组转化为xml
        $xml = "<xml>";
        foreach ($returndata as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";

        echo $xml;
        exit();
    }

}