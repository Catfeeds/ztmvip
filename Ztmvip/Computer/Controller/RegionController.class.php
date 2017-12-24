<?php
/**
 * Author: lihongfu
 * Date: 2016/1/23
 */

namespace Computer\Controller;


class RegionController extends UserBaseController
{
    public function address()
    {
        $user_addr_model = D('UserAddress');
        $addr_count = $user_addr_model->where(array('user_id' => $this->user_id))->count();
        $address_list = $user_addr_model->where(array('user_id' => $this->user_id))->order('id desc')->select();
        $addr_sort_list = array();
        foreach ($address_list as $val) {
            if ($val['is_default'] == 'Y') {
                array_unshift($addr_sort_list, $val);
            } else {
                $addr_sort_list[] = $val;
            }
        }
        $this->assign('addr_count', $addr_count);
        $this->assign('addr_sort_list', $addr_sort_list);
        $this->assign('page_title', '修改收货地址');
        $this->display();
    }

    public function addressEdit()
    {
        $id = I('id', 0, 'intval');
        if(IS_POST && IS_AJAX){
            $post = I('post.');
            $state = array(
                'state'=>true,
                'message'=>'恭喜，操作成功！'
            );
            try{
                if(!$post['consignee']){
                    E('抱歉，收货人不能为空！');
                }

                if (!preg_match('/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/i', $post['mobile']))
                    E('抱歉，手机号码格式错误！');

                if(!$post['address']){
                    E('抱歉，收货地址不能为空！');
                }

                if(!$post['province']){
                    E('抱歉，请选择省份');
                }

                if(!$post['city']){
                    E('抱歉，请选择城市');
                }

                if(!$post['district']){
                    E('抱歉，请选择区域');
                }

                $data = array_intersect_key($post, array_flip(array(
                    'consignee',
                    'mobile',
                    'address',
                    'province',
                    'city',
                    'district',
                )));

                $data['user_id'] = $this->user_id;
                $data['add_time'] = time();

                if($id>0){
                    if(false===D('UserAddress')->where(array('id'=>$id,'user_id'=>$this->user_id))->save($data)){
                        E('操作失败！');
                    }
                }else{
                    $count = D('UserAddress')->where(array('user_id'=>$this->user_id))->count();
                    if(!$insert = D('UserAddress')->add($data)){
                        E('操作失败！');
                    }
                    if($count<=0){
                        D('UserAddress')->where(array('id'=>$insert))->save(array('is_default'=>'Y'));
                    }
                }
            }catch (\Think\Exception $e){
                $state = array(
                    'state'=>false,
                    'message'=>$e->getMessage()
                );
            }

            $this->ajaxReturn($state);

        }

        $address = D('UserAddress')->where(array('id' => $id, 'user_id' => $this->user_id))->find();

        $this->assign('address',$address);
        $content = $this->fetch('Region/addressEdit');
        $this->ajaxReturn(array('content'=>$content));
    }

    public function addressDel()
    {
        $id =I('id',0,'intval');

        $state = array(
            'state'=>true,
            'message'=>'恭喜，操作成功！'
        );
        try{
            if($id<=0){
                E('非法操作');
            }
            if(D('UserAddress')->where(array('id'=>$id,'user_id'=>$this->user_id,'is_default'=>'Y'))->find()){
                E('默认地址不能删除');
            }
            if(!D('UserAddress')->where(array('id'=>$id,'user_id'=>$this->user_id))->delete()){
                E('操作失败！');
            }
        }catch(\Think\Exception $e){
            $state = array(
                'state'=>false,
                'message'=>$e->getMessage()
            );
        }
        $this->ajaxReturn($state);
    }

    public function addressDefault()
    {
        $id =I('id',0,'intval');
        $state = array(
            'state'=>true,
            'message'=>'恭喜，操作成功！'
        );
        try{
            if(false===D('UserAddress')->where(array('id' =>$id,'user_id'=>$this->user_id))->save(array('is_default'=>'Y'))){
                E('操作失败！');
            }
            D('UserAddress')->where(array('user_id'=>$this->user_id,'id'=>array('neq',$id)))->save(array('is_default'=>'N'));
        }catch(\Think\Exception $e){
            $state = array(
                'state'=>false,
                'message'=>$e->getMessage()
            );
        }
        $this->ajaxReturn($state);
    }
}