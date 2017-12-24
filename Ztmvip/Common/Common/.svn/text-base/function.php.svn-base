<?php
/**
 * 数组构造
 * @param $arr 数组
 * @param $key_index 数组索引
 * @param $val_index 数组值
 * @return array
 */
function make_array($arr,$key_index,$val_index){
    $tmp = array();
    foreach ( $arr as $val ){
        $tmp[$val[$key_index]] = $val[$val_index];
    }
    return $tmp;
}

/**
 * 查询物流信息
 * @param $express_name 物流名称
 * @param $express_no 物流单号
 * @return array 物流信息
 */
function express_info($express_name,$express_no){
    $express = array(
        'shentong' => '申通快递',
        'yuantong' => '圆通快递',
        'zhongtong' => '中通快递',
        'yunda' => '韵达快递',
        'debangwuliu' => '德邦快递',
        'shunfeng' => '顺丰快递',
        'huitongkuaidi' => '百事汇通',
        'ems' => '邮政EMS',
        'tiantian' => '天天快递',
    );

    //获取快递类型
    $type = array_search($express_name,$express);
    $express_no = preg_replace('#\s+#','',$express_no);

    //获取物流信息
    switch ( $type ){
        case 'zhongtong':
            $info = http('http://www.zto.com/GuestService/BillNew',array(
                'txtbill' => $express_no,
            ),'get');
            preg_match_all('#<div class="state">.*?<ul>.*?</ul>.*?</div>#is',$info,$info);

            if ( $info[0] ){
                preg_match_all('#<div class="o?n?">(.*?)</div>.*?(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})#is',$info[0][0],$info);

                foreach ( $info[0] as $key => &$val ){
                    $val = array(
                        'time' => trim(preg_replace('#(\r|\n|\s)+#i',' ',strip_tags($info[2][$key]))),
                        'context' => trim(preg_replace('#(\r|\n|\s)+#i',' ',strip_tags($info[1][$key]))),
                    );
                }
                unset($val);

                $info = $info[0];
            }else{
                $info = array();
            }

            break;
        default:
            $info = json_decode(substr(mb_convert_encoding(http('http://biz.trace.ickd.cn/'.$type.'/'.$express_no,array(),'get'),'utf-8','gbk'),15,-1),true);
            $info = $info['data'];
            break;
    }

    return $info;
}

/**
 * 发送HTTP请求
 * @param $url 请求URL
 * @param $params 请求参数
 * @param string $method 请求方法GET/POST
 * @param array $option 传输选项
 * @param bool|false $multi 传输文件
 * @return mixed 响应数据
 */
function http($url,$params,$method='GET',$option=array(),$multi=false){
    $opts = array(
        CURLOPT_TIMEOUT => 30,
        CURLOPT_AUTOREFERER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
    );

    if ( $option ){
        $opts = array_merge($opts,$option);
    }

    //根据请求类型设置特定参数
    switch ( strtoupper($method) ){
        case 'GET':
            $opts[CURLOPT_URL] = $url . ($params ? '?'.http_build_query($params) : '');
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            E('不支持的请求方式！');
    }

    //初始化并执行curl请求
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ( $error )
        E('请求发生错误：'. $error);
    else
        return $data;
}

##################### sansheng ################################################################
/**
 * 判断当前浏览器是否是微信自带浏览器
 * @return boolean [description]
 */
function is_wechat_browser(){
    if ( stripos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') === false )
        return false;
    else
        return true;
}

/**
 * 取得当前的域名
 * @return string
 */
function get_domain(){
    /* 协议 */
    $protocol = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';

    /* 域名或IP地址 */
    if ( isset($_SERVER['HTTP_X_FORWARDED_HOST']) ){
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }elseif ( isset($_SERVER['HTTP_HOST']) ){
        $host = $_SERVER['HTTP_HOST'];
    }else{
        /* 端口 */
        if ( isset($_SERVER['SERVER_PORT']) ){
            $port = ':' . $_SERVER['SERVER_PORT'];

            if ( (':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol) )
                $port = '';
        }else{
            $port = '';
        }

        if ( isset($_SERVER['SERVER_NAME']) )
            $host = $_SERVER['SERVER_NAME'] . $port;
        elseif ( isset($_SERVER['SERVER_ADDR']) )
            $host = $_SERVER['SERVER_ADDR'] . $port;
    }

    return $protocol . $host;
}

/**
 * 得到新订单号
 * @return  string
 */
function get_order_sn(){
    #函数str_pad会将某个值填充到指定的长度，如这里不足5位数的时候，会在左边填充0的
    return date('Ymd') . str_pad(mt_rand(1, 99999),5,'0',STR_PAD_LEFT);
}

/**
 * 截取中文字符
 * @param $text 要截取的字符串
 * @param $length 截取长度
 * @return string 返回截取后的字符串
 */
function subtext($text,$length){
    if( mb_strlen($text,'utf8') > $length )
        return mb_substr($text,0,$length,'utf8').'...';
    else
        return $text;
}

/**
 * 返回cat_ids
 * @param  [type] $cat_tree [description]
 * @return [type]           [description]
 */
function get_cat_ids($cat_tree)
{

     $cat_ids=array();
      foreach ($cat_tree as $key => $value) {
         $cat_ids[]=$value['cat_id'];
         if($value['son'])
         {
             $cat_ids=array_merge($cat_ids,get_cat_ids($value['son']));
         }
      }

      return $cat_ids;
}








function show_bug($arr)
{
       echo '<pre>';
         print_r($arr);
       echo '</pre>';
}