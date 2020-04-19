<?php

class SqlHelper {
    private $host;
    private $port = 3360;
    private $user;
    private $pass;
    private $dbname;

    //初始化构造方法
	public function __construct(array $info = array())
	{
		$this->host = isset($info['host']) ? $info['host'] : 'localhost';
		$this->port = isset($info['port']) ? $info['port'] : '3306';
		$this->user = isset($info['user']) ? $info['user'] : 'root';
		$this->pass = isset($info['pass']) ? $info['pass'] : 'pass';
		$this->dbname = isset($info['dbname']) ? $info['dbname'] : 'my_databsse';

		//连接认证
		$this->sql_connect();
	}

	//数据库连接认证
	//增加一个属性保存mysqli的连接对象，需要跨方法使用
	private $conn;
	private function sql_connect(){
		//利用mysqli初始化
		$this->conn = @new mysqli($this->host,$this->user,$this->pass,$this->dbname,$this->port);
		//验证是否连接成功
		if($this->conn->connect_error){
			die('Connect Error (' . $this->conn->connect_errno . ')' . $this->conn->connect_error);
		}
		else{
//			echo '连接成功';
		}
	}

	//写操作
	//记录当前受影响的行数
	public $affected_rows;
	public function sql_exec($sql) {
		$res = $this->conn->query($sql);
		if (!$res){
			die('Sql Error(' . $this->conn->connect_errno . ')' . $this->conn->connect_error);
		}
		$this->affected_rows = $this->conn->affected_rows;
		return $res;
	}

	//读操作
	//记录当前返回数据条数
	public $num_rows;
	public  function sql_query($sql,$all = false){
		$res = $this->conn->query($sql);
		if(!$res){
			die('Sql Error (' . $this->conn->connect_errno . ')' . $this->conn->connect_error);
		}
		$this->num_rows = $res->num_rows;
		if ($all){
			return $res->fetch_all(MYSQLI_ASSOC);
		}else{
			return $res->fetch_assoc();
		}
	}

	//获取自增id
	public function get_insert_id(){
		return $this->conn->insert_id;
	}
}


//$db = array(
//	'host'  =>  '47.105.85.102',
//	'user' =>   'user',
//	'pass'  =>  '990608zs',
//	'dbname'    =>  'account'
//);
//$conn = new SqlHelper($db);
//$sql = 'insert into test value(1,"zs")';
//$res = $conn->sql_exec($sql);
//var_dump($res);