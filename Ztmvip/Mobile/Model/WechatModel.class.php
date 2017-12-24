<?php
namespace Mobile\Model;
class WechatModel extends BaseModel
{

    protected $tableName = 'user';

/**
 * 判断该微信用户是否已经注册了
 * @param  [type]  $open_id [description]
 * @return boolean          [description]
 */
    public function isRegistered($open_id)
    {
         $where=array(
               'wu.open_id'=>$open_id,
               'wu.user_id'=>array('gt',0),
               );

         return M('user')->alias('u')->join('__WECHAT_USER__  wu ON wu.user_id=u.id')->where($where)->count();
    }

    /**
     * 注册的时机：1.第一次授权的时候 2.关注事件发生的时候
     * 关注的时候进行注册(如果是已经注册过，则就更新最后关注时间就可以了)
     * @return [type] [description]
     */
    // public function subscribe($open_id)
    // {

    //               try{
         
    //                   if($this->isRegistered($open_id))
    //                     E('registered');
    //                       $add=array('date_add' => time());
    //                       if (I('get.u')) 
    //                         $add['parent_id'] = I('get.u')?I('get.u'):0;
    //                       $user_id = M('user')->add($add);
    //                       if ($user_id) {
    //                           $add_wechat = array(
    //                               'open_id' => $open_id,
    //                               'user_id' => $user_id,
    //                               'date_follow' => time(),
    //                           );
    //                           $weid = M('wechat_user')->add($add_wechat);
    //                       }
    //                      if($weid)
    //                         E('success');
    //               }catch(\Think\Exception $e){
    //                  $error=$e->getMessage();
    //                  switch ($error) {
    //                      case 'registered':
    //                          M('wechat_user')->where(array('open_id'=>$open_id))->save(array('date_follow'=>time()));
    //                          break;
    //                      case 'success':
    //                        $true=$this->giveRegisterThings($user_id,$add['parent_id']);
    //                        if($true)
    //                         echo '送你注册豪华大礼';
    //                      default:
    //                          # code...
    //                          break;
    //                  }
    //               }
    // }



/**
 * 扫描关注二维码，送你豪华大礼额
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
public function   giveRegisterThings($user_id,$parent_id='')
{

        //开始送红包，发送4个红包
        $bonus = array(100, 50, 30, 10);
        $time = time();
        $end_time = $time + 3600 * 24 * 30;
        $user_bonus_model = D('UserBonus');

        foreach ($bonus as $val) {

            if($parent_id)
            {
                //推荐人发红包
                $next_id = $user_bonus_model->next_primary();
                $user_bonus_model->add(array(
                    'user_id' => $parent_id,
                    'bonus_name' => '推荐送红包' . $val . '元',
                    'money' => $val,
                    'bonus_sn' => 'recommend'.date('Ymd').$user_id.$next_id,
                    'min_order_amount' => $val * 10,
                    'use_start' => $time,
                    'use_end' => $end_time,
                    'date_add' => $time
                ));
            }
  
            //注册人发红包
            $next_id = $user_bonus_model->next_primary();
            $user_bonus_model->add(array(
                'user_id' => $user_id,
                'bonus_name' => '注册送红包' . $val . '元',
                'money' => $val,
                'bonus_sn' => 'register'.date('Ymd').$user_id.$next_id,
                'min_order_amount' => $val * 10,
                'use_start' => $time,
                'use_end' => $end_time,
                'date_add' => $time
            ));
        }

  return true;

}
    /**
     * 取消关注的时候将关注时间设置为0
     * @param  [type] $open_id [description]
     * @return [type]          [description]
     */
    public function unsubscribe($open_id)
    {

        $save=array('date_follow'=>0);
        return M('wechat_user')->where(array('open_id'=>$open_id))->save($save);


    }

















###################################################################################
    /**
     * 用户存在则更新微信用户信息
     * 不存在则添加用户信息
     *
     * @param array $userinfo 用户认证之后，获取的昵称等信息
     */
    public function update_weixin_user($userinfo = '')
    {



        $open_id = $userinfo['openid'];
        $sql = "SELECT wu.user_id,u.id FROM ztm_wechat_user AS wu LEFT JOIN ztm_user AS u ON wu.user_id=u.id WHERE wu.open_id='$open_id' AND wu.user_id>0";
        $res = M()->query($sql);

        if ($res[0]) {
            #该用户已经存在，则更新两表即可

            $save = array(

                'nick_name' => $userinfo['nickname'],
                'province' => $userinfo['procvince'],
                'city' => $userinfo['city'],
                'country' => $userinfo['country'],
                'avatar' => $userinfo['headimgurl'],
                'sex' => ($userinfo['sex'] == 1) ? 'male' : 'female',
                'date_authorize' => time(),
            );
            $where['open_id'] = $open_id;
            $true = M('wechat_user')->where($where)->save($save);
            #============================
            $save2 = array(
                'user_name' => $userinfo['nickname'],
                'avatar' => $userinfo['headimgurl'],
                'date_upd' => time(),
            );
            $conditon['id'] = $res[0]['user_id'];
            $true2 = M('user')->where($conditon)->save($save2);

            if ($true && $true2) {
                session('openid', $userinfo['openid']);
                session('user_id', $res[0]['user_id']);

                cookie('wechat_token',base64_encode(session_id()),86400);
                $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                $mem->set('wechat_openid_'. session_id(),session('openid'),7200);
                $mem->set('userid_'. session_id(),session('user_id'),7200);

                #刷新购物车的用户id
                $this->userToCart();

                return true;

            }

        } else {
            #添加就可以了(添加的时候判断一下是否有扫码推荐人)


            if (cookie('parent_id')) {
                $parent_id = cookie('parent_id');

            } else {

                if (cookie('affiliate_guser')) {
                    $parent_id = cookie('affiliate_guser');
                } else {
                    $parent_id = 0;
                }

            }

            $add = array(

                'user_name' => $userinfo['nickname'],
                'avatar' => $userinfo['headimgurl'],
                'date_add' => time(),
                'parent_id' => $parent_id,
            );

            $id = M('user')->add($add);
            if ($id) {
                $add_wechat = array(

                    'open_id' => $userinfo['openid'],
                    'nick_name' => $userinfo['nickname'],
                    'province' => $userinfo['procvince'],
                    'city' => $userinfo['city'],
                    'country' => $userinfo['country'],
                    'avatar' => $userinfo['headimgurl'],
                    'sex' => ($userinfo['sex'] == 1) ? 'male' : 'female',
                    'date_authorize' => time(),
                    'user_id' => $id,
                );

                $weid = M('wechat_user')->add($add_wechat);
                if ($weid) {
                    #认证就不用发送信息给客户了，没必要，况且用户要是没有关注呢，发了也是白发的
                    session('openid', $userinfo['openid']);
                    session('user_id', $res[0]['user_id']);

                    cookie('wechat_token',base64_encode(session_id()));
                    $mem = new \Think\Cache\Driver\Memcache(C('MEMCACHED'));
                    $mem->set('wechat_openid_'. session_id(),session('openid'),7200);
                    $mem->set('userid_'. session_id(),session('user_id'),7200);

                    $this->userToCart();

                    if (cookie('parent_id')) {
                        $referrer_id = cookie('parent_id');
                        //开始送红包，发送4个红包
                        $bonus = array(100, 50, 30, 10);
                        $time = time();
                        $end_time = $time + 3600 * 24 * 30;
                        $user_bonus_model = D('UserBonus');
                        $user_id = $id;
                        foreach ($bonus as $val) {
                            //推荐人发红包
                            $next_id = $user_bonus_model->next_primary();
                            $user_bonus_model->add(array(
                                'user_id' => $referrer_id,
                                'bonus_name' => '推荐送红包' . $val . '元',
                                'money' => $val,
                                'bonus_sn' => 'recommend'.date('Ymd').$user_id.$next_id,
                                'min_order_amount' => $val * 10,
                                'use_start' => $time,
                                'use_end' => $end_time,
                                'date_add' => $time
                            ));

                            //注册人发红包
                            $next_id = $user_bonus_model->next_primary();
                            $user_bonus_model->add(array(
                                'user_id' => $user_id,
                                'bonus_name' => '注册送红包' . $val . '元',
                                'money' => $val,
                                'bonus_sn' => 'register'.date('Ymd').$user_id.$next_id,
                                'min_order_amount' => $val * 10,
                                'use_start' => $time,
                                'use_end' => $end_time,
                                'date_add' => $time
                            ));
                        }
                    }

                    return true;
                }

            }

        }

    }


    /**
     * 将用户id与cart_key结合
     * @return [type] [description]
     */
    public function userToCart()
    {
        #更改
        $save['user_id'] = session('user_id');
        $where['cart_key'] = CART_KEY;
        M('cart')->where($where)->save($save);
    }
}
