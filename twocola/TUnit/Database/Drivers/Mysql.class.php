<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ More Teamwork ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola STudio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** Mysql数据库操作类
** Version 2.6
*/
namespace TUnit\Database\Drivers;
class Mysql{
	public $Database;
	public $Prefix = "";
	protected $Sql = "";
	protected $sql_prefix = "";
	protected $sql_table = "";
	protected $sql_where = "";
	protected $sql_data = "";
	protected $sql_order = "";
	protected $sql_group = "";
	protected $sql_limit = "";
	protected $sql_filter = false;
	public $errno = 0;
	public $error = "";
	public function __construct($host,$username,$password,$dbname,$port,$charset="utf8"){
		$this->Database = @new mysqli($host,$username,$password,$dbname,$port);
		//判断是否连接成功
		if($this->Database->connect_errno){
			$this->errno = $this->Database->connect_errno;
			$this->error = $this->Database->connect_error;
			$this->Database = false;
			return false;	//连接失败
		}else{
			$this->Database->set_charset($charset);
		}
	}
	//通用查询
	public function query($sql){
		return $this->Database->query($sql);
	}
	//选择表
	public function table($table,$multi=false){
		$this->sql_table = "";	//清除table数据
		if($multi===false){
			$this->sql_table = " {$this->Prefix}"."{$table}";
			return $this;
		}
		//xxx as x|xxx as x
		if($multi===true){
			$table = explode("|",$table);
			for($i=0;$i<count($table);$i++){
				if($i+1==count($table)){
					$delimiter = "";
				}else{
					$delimiter = ",";
				}
				$this->sql_table .= " {$this->Prefix}"."{$table[$i]}{$delimiter}";
			}
			return $this;
		}

	}
	//设置条件
	public function where($sql){
		$this->sql_where = " where {$sql}";
		return $this;
	}
	public function order($sql){
		$this->sql_order = " order by {$sql}";
		return $this;
	}
	public function group($sql){
		$this->sql_group = " group by {$sql}";
		return $this;
	}
	public function limit($start,$end){
		$this->sql_limit = " limit {$start},{$end}";
		return $this;
	}
	//查询条件
	public function find($sql="select * from",$debug=false){
		$this->sql_limit = " limit 0,1";
		if($sql!="select * from"){
			$sql = "select ".$sql." from";
		}
		$this->sql_prefix = $sql;
		$this->combination($debug);
		$res = $this->Database->query($this->Sql);
		if(!$res){
			return false;
		}else{
			return $res->fetch_assoc();
		}
	}
	public function select($sql="select * from",$debug=false){
		if($sql!="select * from"){
			$sql = "select ".$sql." from";
		}
		$this->sql_prefix = $sql;
		$this->combination($debug);
		$res = $this->Database->query($this->Sql);
		if(!$res){
			return false;
		}else{
			$result = "";
			while($row = $res->fetch_assoc()){
				$result[] = $row;
			}
			return $result;
		}
	}

	public function add($data,$debug=false){
		$this->sql_prefix = "insert into";
		$sql = " set ";
		$all_count = count($data);
		$count = 0;
		foreach($data as $key=>$value){
			$count ++;
			$value = str_replace("'","\'",$value);
			if($count === $all_count){
				$sql .= "{$key}='{$value}'";
			}else{
				$sql .= "{$key}='{$value}',";
			}
		}
		$this->sql_data = $sql;
		$this->combination($debug);
		$res = $this->Database->query($this->Sql);
		if(!$res){
			return false;
		}else{
			return $this->Database->insert_id;	//返回主键值
		}
	}

	public function save($data,$debug=false){
		$this->sql_prefix = "update";
		$all_count = count($data);
		$count = 0;
		$sql = " set ";
		foreach($data as $key=>$value){
			$value = str_replace("'","\'",$value);
			$count ++;
			if($count === $all_count){
				$sql .= "{$key}='{$value}'";
			}else{
				$sql .= "{$key}='{$value}',";
			}
		}
		$this->sql_data = $sql;
		$this->combination($debug);
		return $this->Database->query($this->Sql);
	}
	public function delete($debug=false){
		$this->sql_prefix = "delete from";
		$this->combination($debug);
		return $this->Database->query($this->Sql);
	}
	//优化表
	public function optimize($debug=false){
		$this->sql_prefix = "optimize table";
		$this->combination($debug);
		$res = $this->Database->query($this->Sql);
		$res = $res->fetch_assoc();
		if($res['Msg_text']=="OK" || $res['Msg_text']=="Table is already up to date"){
			return true;
		}else{
			return false;
		}
	}
	//安全
	public function filter(){
		$this->sql_filter = true;
		return $this;
	}
	//组合句式
	public function combination($debug=false){
		$this->Sql = $this->sql_prefix.$this->sql_table.$this->sql_data.$this->sql_where.$this->sql_group.$this->sql_order.$this->sql_limit;
		if($this->sql_filter===true){
			$this->Sql = strip_tags($this->Sql);
		}
		if($debug===false){
			$this->clear();
		}else{
			return $this;
		}
	}
	//清除数据
	private function clear(){
		$this->sql_prefix = "";
		$this->sql_where = "";
		$this->sql_data = "";
		$this->sql_order = "";
		$this->sql_group = "";
		$this->sql_limit = "";
		$this->sql_filter = "";
	}
	//释放资源
	public function __destruct(){
		if($this->Database!=false){
			$this->Database->close();
		}
	}
}
?>
