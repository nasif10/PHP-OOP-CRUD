<?php

class Config{
	
	public $id, $name, $phone, $address, $image, $cid;
	private $conn = null;
	private $result = array();

    public function __construct()
	{
		$this->conn = new mysqli("localhost", "root", "", "ecrud") or die("Connection Failed");

        $this->id = $this->name = $this->phone = $this->address = $this->image = $this->cid = '';	   
	}

	public function insert($var)
	{
		$sql = "INSERT INTO employee (`name`, `phone`, `address`, `image`, `cid`) VALUES ('$var->name', '$var->phone', '$var->address', '$var->image', '$var->cid')";

		if($this->conn->query($sql)){
            return true;
		}else 
			return false;	
	}

	public function update($var)
	{
		$sql = "UPDATE employee SET `name` = '$var->name', `phone` = '$var->phone', `address` = '$var->address', `image` = '$var->image', `cid` = '$var->cid' WHERE `id` = '$var->id'";
			
		if($this->conn->query($sql)){
            return true;
		}else 
			return false;
	}

	public function delete($where = null)
	{
		$sql = "DELETE FROM employee";
		
		if($where != null){
			$sql .= " WHERE $where";
		}

		if($this->conn->query($sql)){
            return true;
		}else 
			return false;
	}

	public function select($table, $join = null, $where = null, $order = null, $limit = null)
	{
		$sql = "SELECT * FROM $table";
			
		if($join != null){
				$sql .= " JOIN $join";
		}
		if($where != null){
			$sql .= " WHERE $where";
		}
		if($order != null){
			$sql .= " ORDER BY $order";
		}
		if($limit != null){
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$start = ($page-1) * $limit;
			$sql .= " LIMIT $start, $limit";
		}
			
		$res = $this->conn->query($sql);

		if($res){
			$this->result = $res->fetch_all(MYSQLI_ASSOC);
            return true;
		}else{
			array_push($this->result, $this->conn->error);
			return false;
		} 
	}
	
	public function pagination($join = null, $where = null, $limit = null)
	{
		if($limit != null){
			$sql = "SELECT COUNT(*) FROM employee";
			if($join != null){
				$sql .= " JOIN $join";
			}
			if($where != null){
				$sql .= " WHERE $where";
			}
				
			$res = $this->conn->query($sql);
			$total = $res->fetch_array() ;
			$total = $total[0];
			$total_page = ceil($total / $limit);
			return $total_page;	
		}
		else{
            return false;
		}
	}

	public function sql($sql)
	{
		$result = $this->conn->query($sql);
		if($result){
			$this->result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
		}
		else{
			array_push($this->result, $this->conn->error);
			return false;
		}
		
	}
	
	public function getResult(){
		$val = $this->result;
		$this->result = array();
		return $val;
	}


	public function __destruct(){
		$this->conn->close();
	}
	
}

?>
