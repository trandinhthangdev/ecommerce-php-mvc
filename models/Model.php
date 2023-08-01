<?php  

/*
* 	Model Class
*/

require_once 'Connection.php';

class Model extends Connection
{
	protected $table;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	*	Get All Rows In A Table
	*
	*	@param 
	*	@return $data - array
	*/
	public function all()
	{
		$data = array();
		$query = "SELECT * FROM ".$this->table;
		$stmt = $this->connect->prepare($query);

		if($stmt->execute())
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function limit($start, $offset)
	{
		$data = array();
		$query = "SELECT * FROM ".$this->table  . " ORDER BY id DESC " . " LIMIT " . $offset . " OFFSET " . $start ;
		$stmt = $this->connect->prepare($query);

		if($stmt->execute())
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}



	public function multiple($condition)
	{
		$query = "SELECT * FROM " . $this->table . " " . $condition;
		$stmt = $this->connect->prepare($query);
		$data = array();
		if($stmt->execute())
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	/**
	*	Get A Row In A Table
	*
	*	@param 
	*	@return $data - array
	*/
	public function find($id)
	{
		$query = "SELECT * FROM ".$this->table . " WHERE id=:id";
		$stmt = $this->connect->prepare($query);

		$stmt->bindValue(':id', $id);

		if($stmt->execute())
		{
			$result = $stmt->fetch();
			$data = $result;
			return $data;
		}
		return false;
	}


	/**
	*	Create A New Row To A Table
	*
	*	@param $data - array
	*	@return $result - boolean
	*/
	public function create($data)
	{
		$implodeColumns = implode(', ', array_keys($data));
		$implodePlaceHolder = implode(', :', array_keys($data));
		$query = "INSERT INTO ".$this->table."(".$implodeColumns.") VALUES (:".$implodePlaceHolder.")";

		$stmt = $this->connect->prepare($query);

		foreach ($data as $key => $value) {
			$stmt->bindValue(":".$key, $value);
		}

		if($stmt->execute())
		{
			return $this->connect->lastInsertId();;
		}
		else
		{
			return false;
		}
	}

	/**
	*	Create A New Row To A Table
	*
	*	@param $data - array
	*	@return $result - boolean
	*/
	public function update($id, $data)
	{
		$set = "";
		$count = count($data);
		foreach ($data as $key => $value) {
			if($count > 1)
		    {
		    	$set .= $key . "=:" . $key . ",";
		    }
		    else
		    {
		    	$set .= $key . "=:" .$key;
		    }
		    $count--;
		}

		$query = "UPDATE ".$this->table." SET " . $set . " WHERE id = :id";
		$stmt = $this->connect->prepare($query);
		foreach ($data as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}

		$stmt->bindValue(':id',$id);

		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function destroy($id)
	{
		$query = "DELETE FROM " . $this->table . " WHERE id=:id";
		$stmt = $this->connect->prepare($query); 
		$stmt->bindValue(':id', $id);

		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	*	Get Row By Where A Table
	*
	*	@param $condition - string 
	*	@return data - array 
	*/
	public function where($condition)
	{
		$query = "SELECT * FROM " . $this->table . " WHERE ". $condition;
		$stmt = $this->connect->prepare($query);
		$data = array();
		if($stmt->execute())
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	*	Create A New Row To A Table
	*
	*	@param $column - string 
	*   @param $sort - string ASC|DESC
	*	@return data - array 
	*/
	public function sort($column, $sort = "ASC")
	{
		$query = "SELECT * FROM " . $this->table . " ORDER BY " .$column . " " . $sort;

		$stmt = $this->connect->prepare($query);
		if($stmt->execute())
		{
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		} 
		else
		{
			return false;
		}
	}

}

// $model = new Model();
// $model->table = 'categories';
// $data = [
// 	'name' => 'Tony Tran',
// 	'slug' => 'tony-tran',
// 	'status' => 0
// ];
// echo $model->create($data);

?>


