<?php
require 'Upload.php';
require 'SqlHelper.php';
$data = $_POST;
$upload = new Upload();
$uploadRes = $upload->upload($data['filePath'],$data['extension']);
$imgUrl = 'http://qdu17zs.com/' . $uploadRes['key'];
$create_time = time();
$db = array(
	'host'  =>  '47.105.85.102',
	'user' =>   'user',
	'pass'  =>  '990608zs',
	'dbname'    =>  'imgtransport'
);
$conn = new SqlHelper($db);
$sql = "insert into file value('".$imgUrl."',".$create_time.");";
$res = $conn->sql_exec($sql);
if ($res == 1){
	echo json_encode($uploadRes);
}else{
	echo new Error('上传失败');
}
//echo json_encode($res);