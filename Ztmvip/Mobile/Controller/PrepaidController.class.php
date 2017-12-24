<?php
/**
 * 储值卡控制器
 * author: Tom
 */
namespace Mobile\Controller;

class PrepaidController extends BaseController
{
    protected $prepaid_model;

    public function _initialize()
    {
        parent::_initialize();

        $this->prepaid_model = D('Prepaid');
    }

    //储值卡详情
    public function details()
    {
        $id = I('id', 0, 'intval');
        $prepaid = $this->prepaid_model->where(array('on_sale' => 'Y', 'disabled' => 'N', 'id' => $id))->find();
        //储值卡分享 S
        $true = is_wechat_browser();
        if ($true) {
            $prepaid_rebate_user = I('get.pre_user', 0, 'intval');
            if ($prepaid_rebate_user > 0) {
                cookie('prepaid_rebate_user', $prepaid_rebate_user, 3600 * 24 * 2);
            }
            $share = array(
                'id' => $prepaid['id'],
                'pre_user' => session('user_id') ? session('user_id') : 0,
            );
            $url = __HOST__ . U('Prepaid/details', $share);
            $weObj = new \Common\Vendor\Wechat();
            //签名地址必须和当前地址一样
            $signPackage = $weObj->getJsSign(__HOST__ . $_SERVER['REQUEST_URI']);
            $this->assign('signPackage', $signPackage);
            //对分享的储值卡进行描述
            $this->assign('title', '分享就能赚钱');
            $this->assign('desc', $prepaid['prepaid_name']);
            $this->assign('link', $url);
            $this->assign('imgUrl', __HOST__ . $prepaid['prepaid_image']);
        }
        //储值卡分享 E
        $this->assign('prepaid', $prepaid);
        $this->assign('page_title', $prepaid['prepaid_name']);
        $this->display();
    }

    public function index()
    {
        $prepaid = $this->prepaid_model->where(array('on_sale' => 'Y', 'disabled' => 'N'))->order('rank DESC')->select();
        $this->assign('prepaid', $prepaid);

        $this->assign('page_title', '贵宾尊享');
        $this->display();
    }
}
