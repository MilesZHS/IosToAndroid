<?php
require 'Upload.php';
require 'SqlHelper.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers:x-requested-with,content-type');
$data = $_POST;
$upload = new Upload();
$uploadRes = $upload->upload($data['filePath']);
$imgUrl = 'http://qdu17zs.com/' . $uploadRes['key'];
$create_time = time();
$db = array(
	'host'  =>  '47.105.85.102',
	'user' =>   'user',
	'pass'  =>  '990608zs',
	'dbname'    =>  'imgtransport'
);
$conn = new SqlHelper($db);
$sql = "insert into img value('".$imgUrl."',".$create_time.");";
$res = $conn->sql_exec($sql);
if ($res == 1){
    echo json_encode($uploadRes);
}else{
    echo new Error('上传失败');
}
//echo json_encode($res);