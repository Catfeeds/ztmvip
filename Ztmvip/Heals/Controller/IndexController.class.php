<?php
/**
 * 首页控制器
 * author: Tom
 */
namespace Heals\Controller;
class IndexController extends BaseController
{
    //清除缓存
    public function clean(){
        $state = array(
            'state' => true,
            'message' => '恭喜，缓存清除成功',
        );

        try{
            $path = realpath(APP_PATH) . DIRECTORY_SEPARATOR .'Runtime'. DIRECTORY_SEPARATOR;

            if ( IS_WIN ){
                exec('rd /s/q '. $path .'Cache');
                exec('rd /s/q '. $path .'Data');
                exec('rd /s/q '. $path .'Logs');
                exec('rd /s/q '. $path .'Temp');
            }else{
                exec('rm -d '. $path .'*');
            }
        }catch (\Think\Exception $e){
            $state = array(
                'state' => false,
                'message' => $e->getMessage(),
            );
        }

        $this->ajaxReturn($state);
    }


    public function index(){
        $user_examine_model = D('UserExamine');

        $examine_count = array(
            //今日提交检测用户
            'today' => $user_examine_model->where(array('date_add'=>array('egt',strtotime(date('Y-m-d 0:00:00')))))->count(),
            //待处理用户信息
            //'new' => $user_examine_model->where(array('payment_state'=>in_array('new','paying')))->count(),
            //已处理用户信息
            //'confirm' => $user_examine_model->where(array('order_state'=>'new','payment_state'=>'payed'))->count(),
        );
        $this->assign('examine_count',$examine_count);

        $server = $_SERVER;
        $server['mysql_version'] = M()->query("select version() as ver");
        $server['mysql_version'] = $server['mysql_version'][0]['ver'];
        $this->assign('server',$server);

        $this->assign('page_title','全局信息');
        $this->display();
    }
}