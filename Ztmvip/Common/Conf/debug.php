<?php
return array(

    'DB_PWD' => 'root',
    'DB_HOST' => '127.0.0.1',

    //MongoDB连接配置
    'MONGO' => array(
        'DB_TYPE' => 'mongo',
        'DB_HOST' => '127.0.0.1',
        'DB_NAME' => 'ztmvip', //数据库名
        'DB_PORT' => '27017', // 端口
    ),


    'MEMCACHED' => array(
        'prefix'=>"pc_",
         'host'=>'127.0.0.1',
         'port' => '11211',
         'expire'=>60,
        ),

    //Sphinx
    'SPHINX' => array(
        'host' => '192.168.0.11',
        'port' => '9312',
    ),
);