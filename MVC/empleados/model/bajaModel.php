<?php
	require_once '../bbdd/connect.php';


	function getEmployees()
	{
		$connection = openConn();
	
		try {
			$obtainInfo = $connection->prepare(" SELECT emp_no, concat(first_name , ' ' , last_name) as visual from employees where baja IS NULL ; ");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 
	
		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}
	function umpdateEmplpyees($num) 
	{

		$connection = openConn();

		try {
			$insert = $connection->prepare("UPDATE employees set baja = DATE(NOW()) where emp_no = $num;");
			$insert->execute();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		closeConn($connection);
	}	


?>