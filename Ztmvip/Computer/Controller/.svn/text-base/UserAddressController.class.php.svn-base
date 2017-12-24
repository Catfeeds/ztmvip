<?php

namespace Computer\Controller;
class UserAddressController extends BaseController
{

 /**
  * 增加收货地址
  */
 public function addConsignee() 
 {

      $result=array('code'=>'suc');
      $default=I('post.is_default');
      $province_list=D('UserAddress')->getRegions(1);
    try{

      
            if(!$province_list || !$default)
                E('stop');
            $this->assign('province_list',$province_list);
            $this->assign('default',$default);
            $content=$this->fetch('Public/add_address');
            $result['content']=$content;
    }catch(\Think\Exception $e){
        $error=$e->getMessage();
        switch ($error) {
            case 'stop':
                 $result['code']='stop';
                break;
            default:
               $result['code']='grammar';
                break;
        }
    }

       $this->ajaxReturn($result);


 }


/**
 *新增地址处理
 */


public function doAddConsignee()
{
    
    $address=I('post.');
    $result=array('code'=>'suc');
    try{
        if (!D('UserAddress')->checkConsigneeInfo($address)) 
           E('stop');
           $add_id=D('UserAddress')->doAddConsignee($address);
          if(!$add_id)
            E('fail');
          if($address['is_default']=='Y'){
              session('choose_address_id',$address_id);
          }
          
    }catch(\Think\Exception $e){
          $error=$e->getMessage();
          switch ($error) {
              case 'stop':
                  $result['code']='stop';
                  break;
              case 'fail':
                  $result['code']='fail';
                  break;
              default:
                  $result['code']='grammar';
                  break;
          }
    }

    $this->ajaxReturn($result);

}




/**
 * 改变省份
 * @return [type] [description]
 */
public function changeProvince()
{
    $region_id=I('post.region_id');

    $result=array('code'=>'suc');

   try{

     $city_list=D('UserAddress')->getRegions(2,$region_id);

  
    if(!$city_list || !$region_id)
        E('stop');

     $this->assign('city_list',$city_list);
     $content=$this->fetch('Public/city_list');
     $result['content']=$content;
   }catch(\Think\Exception $e){

     $error=$e->getMessage();

     switch ($error) {
         case 'stop':
             $result['code']='stop';
             break;
         default:
             $result['code']='grammar';
             break;
     }
   }
   $this->ajaxReturn($result);


}


/**
 * 改变市的时候
 * @return [type] [description]
 */
public function changeCity()
{
    $region_id=I('post.region_id');
    $result=array('code'=>'suc');
   try{
     $district_list=D('UserAddress')->getRegions(3,$region_id);
    if(!$district_list || !$region_id)
        E('stop');

     $this->assign('district_list',$district_list);
     $content=$this->fetch('Public/district_list');
     $result['content']=$content;
   }catch(\Think\Exception $e){

     $error=$e->getMessage();

     switch ($error) {
         case 'stop':
             $result['code']='stop';
             break;
         default:
             $result['code']='grammar';
             break;
     }
   }
   $this->ajaxReturn($result);


}


/**
 * 编辑收货地址
 */
public function editorConsignee() 
{

     $result=array('code'=>'suc');
     $address_id=I('post.id');
     // $address_id=3276;


   try{

          $address=D('UserAddress')->getAddress($address_id);
          //省列表
          $province_list=D('UserAddress')->getRegions(1);
          //市列表
          $city_list=D('UserAddress')->getRegions(2,D('UserAddress')->getRegionID($address['province']));
         //县列表
         $district_list=D('UserAddress')->getRegions(3,D('UserAddress')->getRegionID2($address['city']));

           if(!$address_id || !$province_list || !$city_list || !$district_list || !$address )
                 E('stop');

          $this->assign('address',$address);
          $this->assign('province_list',$province_list);
          $this->assign('city_list',$city_list);
          $this->assign('district_list',$district_list);
          $content=$this->fetch('Public/editor_address');
          $result['content']=$content;
   }catch(\Think\Exception $e){
       $error=$e->getMessage();
       switch ($error) {
           case 'stop':
                $result['code']='stop';
               break;
           default:
              $result['code']='grammar';
               break;
       }
   }

      $this->ajaxReturn($result);


}


/**
 *编辑地址处理
 */


public function doEditorConsignee()
{
    
    $address=I('post.');
    $result=array('code'=>'suc');
    try{
        if (!D('UserAddress')->checkConsigneeInfo($address) || !$address['id']) 
           E('stop');
        
          if(!D('UserAddress')->doEditorConsignee($address))
            E('fail');

          $consignee_list = D('UserAddress')->getConsigneeList();
          $this->assign('consignee_list',$consignee_list);
          $consignee=D('UserAddress')->getConsignee();
          $this->assign('consignee',$consignee);
          $content_list=$this->fetch('Public/address_list');
          $result['content_list']=$content_list;
          
          if(session('choose_address_id')==$address['id']){
             $content=$this->fetch('Public/choose_address');
             $result['content']=$content;
             $result['choose']=1;
          }


    }catch(\Think\Exception $e){
          $error=$e->getMessage();
          switch ($error) {
              case 'stop':
                  $result['code']='stop';
                  break;
              case 'fail':
                  $result['code']='fail';
                  break;
              default:
                  $result['code']='grammar';
                  break;
          }
    }

    $this->ajaxReturn($result);

}


/**
 * 用户选择地址
 * @return [type] [description]
 */
public function chooseAddress()
{
    $address_id=I('post.id');

    $result=array('code'=>'suc');
    try{
         if(!$address_id)
            E('stop');
         if(session('choose_address_id') && session('choose_address_id')==$address_id)
           E('again');
         session('choose_address_id',$address_id);
         $consignee_list = D('UserAddress')->getConsigneeList();
         $this->assign('consignee_list',$consignee_list);
         $consignee=D('UserAddress')->getConsignee();
         $this->assign('consignee',$consignee);
         $content_list=$this->fetch('Public/address_list');
         $content=$this->fetch('Public/choose_address');
         $result['content_list']=$content_list;
         $result['content']=$content;
    }catch(\Think\Exception $e){
         $error->$e->getMessage();
  
         switch ($error) {
           case 'stop':
             $result['code']='stop';
             break;
           case 'again':
              $result['code']='again';
              break;
           default:
             $result['code']='grammar';
             break;
         }
    }

     $this->ajaxReturn($result);

}


/**
 * 用户选择地址
 * @return [type] [description]
 */
public function makeDefaultAddress()
{
    $address_id=I('post.id');


    $result=array('code'=>'suc');
    try{
         if(!$address_id)
            E('stop');
        
          if(D('UserAddress')->isDefault($address_id))
            E('again');
         
          if(!D('UserAddress')->setDefault($address_id))
             E('fail');


         $consignee_list = D('UserAddress')->getConsigneeList();
         $this->assign('consignee_list',$consignee_list);
         $consignee=D('UserAddress')->getConsignee();
         $this->assign('consignee',$consignee);
         $content_list=$this->fetch('Public/address_list');

         $result['content_list']=$content_list;
 

    }catch(\Think\Exception $e){
         $error=$e->getMessage();
  
         switch ($error) {
           case 'stop':
             $result['code']='stop';
             break;
           case 'again':
              $result['code']='again';
              break;
           default:
             $result['code']='grammar';
             break;
         }
    }

     $this->ajaxReturn($result);

}



public function deleteAddress()
{
    $address_id=I('post.id');


    $result=array('code'=>'suc');
    try{
         if(!$address_id)
            E('stop');

         if(session('choose_address_id') && session('choose_address_id')==$address_id)
           E('cannot');
        
         
          if(!D('UserAddress')->deleteAddress($address_id))
             E('fail');


         $consignee_list = D('UserAddress')->getConsigneeList();
         $this->assign('consignee_list',$consignee_list);
         $consignee=D('UserAddress')->getConsignee();
         $this->assign('consignee',$consignee);
         $content_list=$this->fetch('Public/address_list');

         $result['content_list']=$content_list;
    

    }catch(\Think\Exception $e){
         $error=$e->getMessage();
    
         switch ($error) {
           case 'stop':
             $result['code']='stop';
             break;
           case 'again':
              $result['code']='again';
              break;
           case 'cannot':
              $result['code']='cannot';
              break;
           default:
             $result['code']='grammar';
             break;
         }
    }

     $this->ajaxReturn($result);
}



}#类尾