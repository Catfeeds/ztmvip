<?php

namespace Mobile\Model;
class RegionModel extends BaseModel
{

   /**
    * 取得收货人默认的收货地址
    * @return  array
    */
   function getConsignee() 
   {


       if (session('default_consignee')) 
       {
           return  session('default_consignee');
       }else 
       {

             #如果session中没有则去表中找喽
           $where['user_id']=session('user_id');
           $where['is_default']='Y';
           $res=M('user_address')->where($where)
                ->field('id AS address_id,consignee,mobile,province,city,district,address')
                ->find();
          return $res;
       }
   }


   /**
    * 检查收货人信息是否完整
    * @param   array   $consignee  收货人信息
    * @return  bool    true 完整 false 不完整
    */
   function checkConsigneeInfo($consignee) 
   {
           $res =  !empty($consignee['consignee']) &&
                   !empty($consignee['mobile'])  &&
                   !empty($consignee['province']) &&
                   !empty($consignee['city']) &&
                   !empty($consignee['district']) &&
                   !empty($consignee['address']);

          return $res;
   
   }


   


  /**
   * 
   * @param type $type  1代表省份   2代表市区  3代表地区
   * @param type $parent  来指定某个国家下的省，或者某个省下的市，以此类题
   * @return type
   */
  public function getRegions($type = 0, $parent =-1)
  {
      $condition['region_type'] = $type;
      if($parent>-1)
      {
           $condition['parent_id'] = $parent;
      }
    
      return $this->field('region_id,region_name')->where($condition)->select();
  }

/**
 *    获取某个地址记录
 */
  public function getAddress($address_id)
  {
      $where['id']=$address_id;
      $address=$this->table('ztm_user_address')->where($where)
                    ->field('id,is_default,consignee,mobile,province,city,district,address')
                    ->find();
      return $address;
  }

/**
 * 以名换取ID号
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
public function getRegionID($name)
{
    $region_name=trim($name);
    $where['region_name']=$region_name;
    $res=$this->where($where)->field('region_id')->find();
    return $res['region_id'];

}

/**
 * 以名换取ID号
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
public function getRegionID2($name)
{
    $region_name=trim($name);
    $where['region_name']=$region_name;
    $res=$this->where($where)->field('region_id')->order('region_id desc')->find();
    return $res['region_id'];

}



#######################个人中心########################
/**
 * 获取收回地址列表，默认地址是排在第一位的
 * @return [type] [description]
 */
public function getConsigneeList()
{
    $where['user_id']=session('user_id');
    $address_list=M('user_address')->where($where)
                  ->order('add_time desc')
                  ->select();
    $new=array();
    foreach ($address_list as $key => $value) {
        if($value['is_default']=='Y')
        {
            array_unshift($new,$value);
        }else{
           $new[]=$value;
        }
    }
    return $new;

}

/**
 * 获取用户的地址数量
 * @return [type] [description]
 */
public function getAddressCount()
{
   $condition['user_id']=session('user_id');
   return $count=M('user_address')->where($condition)->count();
}


   

}#类尾部