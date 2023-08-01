<?php  

/*
* Connection Database Class
*/


class Connection
{
	protected $connect;

	public function __construct()
	{
		$this->connect = $this->connect();
	}

	private function connect()
	{
		$servername = "localhost";
		$dbname = "ecommerce_php";
		$username = "root";
		$password = "";

		try {
			$connect = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $connect;
	}
}

?>