<?php

namespace Computer\Model;
class UserAddressModel extends BaseModel
{

   /**
    * 取得收货人默认的收货地址
    * @return  array
    */
  function getDefaultConsignee() 
  {
   return $this->where(array('user_id'=>session('user_id'),'is_default'=>'Y'))
               ->field('id AS address_id,consignee,mobile,province,city,district,address')
               ->find();
  }


/**
 * 获取用户的选择
 * @return [type] [description]
 */
 public function getConsignee()
 {
     if(session('choose_address_id')){
        return $this->where(array('id'=>session('choose_address_id')))
                    ->field('id AS address_id,consignee,mobile,province,city,district,address')
                    ->find();
     }else{
        return $this->getDefaultConsignee();
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
   * 获取收回地址列表，默认地址是排在第一位的
   * @return [type] [description]
   */
  public function getConsigneeList()
  {
      return $address_list=$this->where(array('user_id'=>session('user_id')))
                    ->order('id desc')
                    ->select();
      // $new=array();
      // foreach ($address_list as $key => $value) {
      //     if($value['is_default']=='Y')
      //     {
      //         array_unshift($new,$value);
      //     }else{
      //        $new[]=$value;
      //     }
      // }
      // return $new;

  }

  /**
   * 
   * @param type $type  1代表省份   2代表市区  3代表地区
   * @param type $parent  来指定某个国家下的省，或者某个省下的市，以此类题
   * @return type
   */
  public function getRegions($type = 0, $parent =-1)
  {
     $condition=array('region_type'=>$type);
     if($parent>-1)
           $condition['parent_id'] = $parent;

      return M('Region')->field('region_id,region_name')->where($condition)->select();
  }

  /**
   * 以region_id换取region_name
   * @param  [type] $name [description]
   * @return [type]       [description]
   */
  public function getRegionName($region_id)
  {
       return M('Region')->where(array('region_id'=>$region_id))->getField('region_name');
  }



  /**
   * 以名换取ID号
   * @param  [type] $name [description]
   * @return [type]       [description]
   */
  public function getRegionID($name)
  {
      return M('Region')->where(array('region_name'=>trim($name)))->getField('region_id');
  }

  /**
   * 以名换取ID号
   * @param  [type] $name [description]
   * @return [type]       [description]
   */
  public function getRegionID2($name)
  {

      return M('Region')->where(array('region_name'=>trim($name)))->order('region_id desc')->getField('region_id');
  }

/**
 * 添加地址
 * @param  [type] $address [description]
 * @return [type]          [description]
 */
public function doAddConsignee($address)
{
  $address['user_id']=session('user_id');
  $address['province']=$this->getRegionName($address['province']);
  $address['city']=$this->getRegionName($address['city']);
  $address['district']=$this->getRegionName($address['district']);
  $address['add_time']=time();
  return $this->add($address);
}


/**
 *    获取某个地址记录
 */
  public function getAddress($address_id)
  {
     return $this->where(array('id'=>$address_id))
                    ->field('id,is_default,consignee,mobile,province,city,district,address')
                    ->find(); 
  }


/**
 * 编辑地址
 * @param  [type] $address [description]
 * @return [type]          [description]
 */
  public function doEditorConsignee($address)
  {
    $address['province']=$this->getRegionName($address['province']);
    $address['city']=$this->getRegionName($address['city']);
    $address['district']=$this->getRegionName($address['district']);
    $address['add_time']=time();
    return $this->save($address);

  }

/**
 * 判断是否是默认地址
 * @param  [type]  $address_id [description]
 * @return boolean             [description]
 */
public function isDefault($address_id)
{
   return $this->where(array('id'=>$address_id,'is_default'=>'Y'))->count();

}

/**
 * 设置默认地址
 * @param [type] $address_id [description]
 */
public function setDefault($address_id)
{
   $this->where(array('user_id'=>session('user_id')))->save(array('is_default'=>'N'));
   return $this->where(array('id'=>$address_id))->save(array('is_default'=>'Y'));
}


public function deleteAddress($address_id)
{
    return $this->delete($address_id);
}









#######################个人中心########################


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