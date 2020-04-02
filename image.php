<?php
require 'Upload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers:x-requested-with,content-type');
$data = $_POST;
$upload = new Upload();
//var_dump($data);
$res = $upload->upload($data['filePath']);
echo json_encode($res);
