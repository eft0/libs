<?php
/*
 * @internal php5-mysqli
 * @author eft0 <esteban@fernandez.cl>
 * @version 2.0
 */
class MySQL 
{	
	private static $conn;
	
	function __construct($host, $user, $pass, $db = false)
	{	
		self::$conn = mysqli_connect($host, $user, $pass, $db);
		if (mysqli_connect_errno())
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		else
			return $this->conn;
	}	
	
	public static function query($query)
	{
		$result = mysqli_query(self::$conn, $query);
		if (!$result) {
			echo "<pre>" . $query . "</pre>";
			die (mysqli_error(self::$conn) ." ". mysqli_errno(self::$conn));
		} else {		
			return $result;
		}
	}
	
	public static function affected_rows()
	{
		return mysqli_affected_rows(self::$conn);
	}
	
	public static function fetch_object($result)
	{
		$data = mysqli_fetch_object($result);
		return $data;
	}
	
	public static function last_id($result) {
		return mysqli_insert_id(self::$conn);
	}
	
	function __destruct()
	{
		if (self::$conn) {
			mysqli_close(self::$conn);
		}
	}	
}
?>