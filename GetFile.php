<?php
require 'SqlHelper.php';
$db = array(
	'host'  =>  '47.105.85.102',
	'user' =>   'user',
	'pass'  =>  '990608zs',
	'dbname'    =>  'imgtransport'
);
$conn = new SqlHelper($db);
$sql = 'select * from file order by create_time desc limit 1';
//$res = $conn->sql_exec($sql);
$res = $conn->sql_query($sql);
echo json_encode($res);