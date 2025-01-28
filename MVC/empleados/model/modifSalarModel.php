<?php
require_once '../bbdd/connect.php';

function getEmployees() {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT emp_no, concat(first_name , ' ' , last_name) as visual from employees; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getSalary($employee) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT salary, first_name, last_name from salaries,employees where salaries.emp_no = employees.emp_no and salaries.emp_no = '$employee' and to_date IS NULL; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC)[0];

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}


function updateSalary($employee,$sal)
{
	$connection = openConn();

	try {
		$connection->beginTransaction();
			$update = $connection->prepare("UPDATE salaries SET to_date = DATE(NOW()) WHERE emp_no = '$employee' AND to_date is null; ");
			$update->execute();
			$insert = $connection->prepare("INSERT INTO `salaries` (`emp_no`, `salary`, `from_date`, `to_date`) VALUES ('$employee', '$sal', DATE(NOW()) , NULL) ");
			$insert->execute();
		$connection->commit();

	} catch (PDOException $ex) {
		echo $ex->getMessage();
	}
	closeConn($connection);
}
?>