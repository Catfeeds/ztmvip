<?php
/**
 * 首页控制器
 * author: Tom
 */
namespace Admin\Controller;
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

    /**
     * 网站设置
     */
    public function config(){
        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            $state = array(
                'state' => true,
                'message' => '恭喜，操作成功',
            );

            try{
                if ( !$post['title'] )
                    E('抱歉，请输入网站标题');
                if ( !$post['name'] )
                    E('抱歉，请输入网站名称');

                $data = array_intersect_key($post,array_flip(array(
                    'title',
                    'name',
                    'statis_code',
                )));

                foreach ( $data as $key => &$val ){
                    $val = "'". strtoupper($key) ."'=>'". $val ."',";
                }
                unset($val);

                $len = file_put_contents(CONF_PATH.'website.php','<?php
return array(
'. join("\r\n",$data) .'
);');

                if ( !$len )
                    E('抱歉，操作失败');
            }catch(\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );
            }

            $this->ajaxReturn($state);
        }

        $this->assign('edit',C('website'));

        $this->assign('aside_id',5);

        $this->assign('page_title','网站设置');
        $this->display();
    }

    public function index(){
        $order_model = D('Order');

        $order_count = array(
            //今日订单
            'today' => $order_model->where(array('order_state'=>'confirm','payment_state'=>'payed','date_add'=>array('egt',strtotime(date('Y-m-d')))))->count(),
            //待支付
            'new' => $order_model->where(array('payment_state'=>array('in',array('new','paying'))))->count(),
            //备货中
            'stock' => $order_model->where(array('order_state'=>'confirm','shipping_state'=>'stock'))->count(),
            //待发货
            'payed' => $order_model->where(array('order_state'=>'confirm','payment_state'=>'payed','shipping_state'=>'new'))->count(),
            //待收货
            'send' => $order_model->where(array('order_state'=>'confirm','shipping_state'=>'send'))->count(),
            //待评价
            'receive' => $order_model->where(array('order_state'=>'confirm','shipping_state'=>'receive'))->count(),
            //退款申请
            'refund' => $order_model->where(array('order_state'=>'refund'))->count(),
            //退款成功
            'refunded' => $order_model->where(array('order_state'=>'refunded'))->count(),
        );
        $this->assign('order_count',$order_count);

        $server = $_SERVER;
        $server['mysql_version'] = M()->query("select version() as ver");
        $server['mysql_version'] = $server['mysql_version'][0]['ver'];
        $this->assign('server',$server);

        $this->assign('page_title','全局信息');
        $this->display();
    }
}