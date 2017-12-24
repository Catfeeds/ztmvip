<?php
namespace Mobile\Controller;
use   Think\Controller;

class RegionController extends BaseController{



/**
 * 增加收货地址
 */
public function addConsignee() 
{
  if(I('get.quick'))
  $this->assign('quick',I('get.quick'));
   #省的列表
       $province_list=D('Region')->getRegions(1);
       $this->assign('province_list',$province_list);


   $this->display('add_place'); 

}


public function doAddConsignee()
{
 

 if (!D('Region')->checkConsigneeInfo($_POST)) 
 {    
  #不完整就去回头重新填写
  #这种回头可以保存用户之前填写的一些内容   

    echo '<script type="text/javascript">window.history.go(-1);</script>';
    exit;#这个必须有额
 }
    
######################### 其它的一些判断我们就留给前端吧 ######################




#=======这段是为了兼容老版本上一些多默认地址情况================================

    
    $condition['user_id']=session('user_id');
    $save['is_default']='N';
    M('user_address')->where($condition)->save($save);
#===============================================
   $data=array(
       'consignee'=>I('post.consignee'),
       'mobile'=>I('post.mobile'),
       'address'=>I('post.address'),
       'province'=>I('post.province'),
       'city'=>I('post.city'),
       'district'=>I('post.district'),
       'user_id'=>session('user_id'),
       'is_default'=>'Y',
       'add_time'=>time(),
    );

  
  
   $back_id=M('user_address')->add($data);
   if($back_id)
   {
    #成功的话，则重新保存用户对地址的选择
       $data['address_id']=$back_id;
       session('default_consignee',$data);
   }


   if(I('post.quick')==1){
        $this->redirect('Quick/checkout');
   }else if(I('post.quick')=='health'){
      $this->redirect('Health/checkout');
   }else{
      $this->redirect('Flow/checkout');
   }

    
}

/**
 * 修改收货地址
 * @return [type] [description]
 */
public function editConsignee()
{

    $address_id=I('get.address_id');
    if(I('get.quick'))
    {    
         $this->assign('quick',I('get.quick'));
    }

    $address=D('Region')->getAddress($address_id);
    $this->assign('address',$address);
#省的列表
    $province_list=D('Region')->getRegions(1);
    $this->assign('province_list',$province_list);
#该省对应的市的列表
    $region_id=D('Region')->getRegionID($address['province']);
    $city_list=D('Region')->getRegions(2,$region_id);
    $this->assign('city_list',$city_list);
#该市对应县的列表
  $region_id=D('Region')->getRegionID2($address['city']);
  $district_list=D('Region')->getRegions(3,$region_id);
  $this->assign('district_list',$district_list);
    $this->assign('page_title','女性整体美解决方案领导者');
    $this->display('edit_place');

}


/**
 * 修改地址的处理
 * @return [type] [description]
 */
public function doEditConsignee()
{



   if (!D('Region')->checkConsigneeInfo($_POST)) 
   {    
    #不完整就去回头重新填写
    #这种回头可以保存用户之前填写的一些内容   

      echo '<script type="text/javascript">window.history.go(-1);</script>';
      exit;#这个必须有额
   }

    #检测，不合法的返回回去(先放着吧)
  
 


   $data=array(
       'consignee'=>I('post.consignee'),
       'mobile'=>I('post.mobile'),
       'address'=>I('post.address'),
       'province'=>I('post.province'),
       'city'=>I('post.city'),
       'district'=>I('post.district'),
       'id'=>I('post.address_id'),#where条件必须也写在数组里头
       
    );

 
   $back=M('user_address')->save($data);
   if($back)
   {
     $data['address_id']=I('post.address_id');
     session('default_consignee',$data);
   }
   
     if(I('post.quick')==1){
          $this->redirect('Quick/checkout');
     }else if(I('post.quick')=='health'){
        $this->redirect('Health/checkout');
     }else{
        $this->redirect('Flow/checkout');
     }



 

}


/**
 * 响应ajax省的改变
 * @return [type] [description]
 */
public function changeProvince()
{
   
      $region_name=I('post.region_name');
      $region_id=D('Region')->getRegionID($region_name);
      $city_list=D('Region')->getRegions(2,$region_id);
      $this->assign('city_list',$city_list);
      $content=$this->fetch('Public/city_list');
      $result['content']=$content;
      $this->ajaxReturn($result);

}


/**
 * 响应ajax市的改变
 * @return [type] [description]
 */
public function changeCity()
{
      $region_name=I('post.region_name');
      $region_id=D('Region')->getRegionID2($region_name);
      $district_list=D('Region')->getRegions(3,$region_id);
      
      $this->assign('district_list',$district_list);
      $content=$this->fetch('Public/district_list');
      if(!$district_list[0])
      {
         $result['error']=4;
      }

      $result['content']=$content;
      $this->ajaxReturn($result);



}

###################个人中心页面############################################################################




}#类尾