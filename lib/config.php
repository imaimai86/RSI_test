<?php
$settingVar = array('DB_HOST'=>'localhost',
    'DB_USERNAME'=>'root',
    'DB_NAME'=>'db_university',
    'DB_PASS'=>'',
    'SITE_URL'=> 'http://'.$_SERVER['HTTP_HOST'].'/',
);

if($settingVar && count($settingVar) > 0){
	foreach ($settingVar as $key => $val){
		define($key,$val);
	}
}

$allowedImageTypes = array('jpg', 'jpeg', 'gif', 'png');
$upload_dir = 'images/';