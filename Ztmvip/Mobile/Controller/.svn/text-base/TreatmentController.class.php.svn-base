<?php
namespace Mobile\Controller;
use   Think\Controller;

class TreatmentController extends BaseController{


	/**
	 * 可用来共同检测订单是否已经被设置成支付成功状态了
	 * @param  [type] $order_id [description]
	 * @return [type]           [description]
	 */
	public function checkPay()
	{


			  $order_id=I('get.order_id');
			  $status=I('get.status');

			  if($status)
			  {
			     $pay=D('Treatment')->displayOrder($order_id);
			     $this->assign('pay',$pay);
			     $this->display('pay_success');
			  }else{
			    $this->assign('order_id',$order_id);
			     $this->display('pay_failure');
			  }

	

	}


/**
 * 发邮件  直接投
 * @return [type] [description]
 */
public function phpMail()
{
	
    $order_sn=I('post.order_sn');
#检测是否在一天之内已经发过了该订单
  $true=D('Treatment')->sendMailed($order_sn);
  if($true)
  {
  	  $result['error']='pass';
  	  $this->ajaxReturn($result);
  }

D('Treatment')->mailLog($order_sn);



	$con='';
	$con.="订单号：<a style='color:red;text-decoration: none;font-size:40px;font-weight:bold;' href='http://admin.ztmvip.com/Order/index.html?order_sn=".$order_sn."'>$order_sn</a>";
	$con.='<br/><br/>提醒发货时间：'.date('Y-m-d H:i:s',time());



 $to  = array(
 	    '1003044154@qq.com',
 	    '695491799@qq.com',  #珠
 	    '2237943091@qq.com',  #键
 	    '1436354683@qq.com',  #川
 	    ); 
 
 $subject = '圣旨到--个人中心发货提醒';

 // Mail it
 $true=\Common\Vendor\Mail::send($to, $subject, $con);

	if($true)
	{
	  
       D('Treatment')->mailLog($order_sn);


	   $result['error']=8;
	   $this->ajaxReturn($result);
	}else{
		$result['error']=4;
		$this->ajaxReturn($result); 
	}


}







}#类尾