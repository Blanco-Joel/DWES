<?php
	require_once '../bbdd/connect.php';

	function getDpt() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("select dept_no, dept_name from departments;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getLastNo() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("select MAX(emp_no)+1 as num from employees;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	
	function insertEmpl($lastNum,$birth_date,$first_name,$last_name,$gender) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `employees` (`emp_no`, `birth_date`, `first_name`, `last_name`, `gender`, `hire_date`) VALUES ('$lastNum', '$birth_date', '$first_name', '$last_name', '$gender', DATE(NOW()));");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

	function insertEmplDpt($lastNum,$dpt) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `dept_emp` (`emp_no`, `dept_no`, `from_date`, `to_date`) VALUES ('$lastNum', '$dpt', DATE(NOW()), NULL);");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	
	function insertEmplTitle($lastNum,$title) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `titles` (`emp_no`, `title`, `from_date`, `to_date`) VALUES ('$lastNum', '$title', DATE(NOW()), NULL);");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	
	function insertEmplSalary($lastNum,$salary) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `salaries` (`emp_no`, `salary`, `from_date`, `to_date`) VALUES ('$lastNum', '$salary', DATE(NOW()), NULL);");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

?>