<?php
/**
 * 店铺控制器
 * author: Tom
 */
namespace Mobile\Controller;
class ShopController extends UserBaseController
{
    //报名
    public function sign38(){
        $shop_model = D('Shop');
        $extend_model = D('ShopExtend');

        if ( IS_POST && IS_AJAX ){
            $post = I('post.');

            try{
                $state = array(
                    'state' => true,
                    'message' => '恭喜，报名成功',
                );

                M()->startTrans();

                if ( !$post['shop_name'] || !$post['corp'] || !$post['tel'] || !$post['address'] )
                    E('抱歉，请完善您的资料');
                if ( !$post['tel'] || !preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i',$post['tel']) )
                    E('抱歉，请输入有效的手机号码');
                if ( !$post['province'] || !$post['city'] || !$post['district'] )
                    E('抱歉，请选择省、市、区');
                if ( $shop_model->where(array('user_id'=>$this->user_id,'tel'=>$post['tel'],'_logic'=>'OR'))->find() )
                    E('抱歉，您已经报名过');

                $data = array_intersect_key($post,array_flip(array(
                    'shop_name',
                )));
                $data['user_id'] = $this->user_id;
                $data['date_add'] = time();

                $shop_id = $shop_model->add($data);
                if ( !$shop_id )
                    E('抱歉，报名失败，请联系网站客服');

                $extend_data = array_intersect_key($post,array_flip(array(
                    'tel',
                    'province',
                    'city',
                    'district',
                    'address',
                    'corp',
                )));
                $extend_data['shop_id'] = $shop_id;
                $extend_data['country'] = '中国';
                $extend_data['service'] = '[]';

                if ( !$extend_model->add($extend_data) )
                    E('抱歉，报名失败，请联系网站客服');

                M()->commit();
            }catch (\Think\Exception $e){
                $state = array(
                    'state' => false,
                    'message' => $e->getMessage(),
                );

                M()->rollback();
            }

            $this->ajaxReturn($state);
        }

        C('layout_on',false);
        $this->display();
    }
}