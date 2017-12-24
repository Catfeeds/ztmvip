<?php
return array(
  'URL_MODEL' => 2,
	//'配置项'=>'配置值'
    'LAYOUT_ON' => true, //启用布局
    ############connor add ############
    #定义模板中可以直接使用的常量
      'TMPL_PARSE_STRING'=>array(
          '__CSS__'=>'/Public/Mobile/Css/',
          '__PCSS__'=>'/Public/Common/Css/',
          '__JS__'=>'/Public/Mobile/Js/',
          '__PJS__'=>'/Public/Common/Js/',
          '__IMG__'=>'/Public/Mobile/Images/',
          '__PIMG__'=>'/Public/Common/Images/',

          '__HEATH__'=>'/Public/Mobile/Heath/',
          '__YEAR__'=>'/Public/Mobile/Year/',
         
		 
        ),

      'COOKIE_PREFIX'=>  'ZTM_',      // Cookie前缀 避免冲突
##############################################################
);


