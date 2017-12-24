<?php
/**
 * 管理员模型
 * author: Tom
 */
namespace Heals\Model;
class ManagerModel extends BaseModel
{
    //编译密码
    public function compile_password($password){
        return md5(md5($password));
    }

    //管理员登录
    public function login($manager_id){
        $manager = $this->field('id,nick_name,group_id,depart_id')->where(array('id' => $manager_id))->find();

        if ( !$manager )
            return false;

        $group = D('ManagerGroup')->field('rights')->where(array('id' => $manager['group_id']))->find();
        if ( $group ){
            $manager['rights'] = $group['rights'];
        }

        unset($manager['group_id']);
        session('manager',$manager);
        return true;
    }

    //管理员登出
    public function out(){
        session('manager',null);
    }
}