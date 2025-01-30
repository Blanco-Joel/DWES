<?php
require_once '../bbdd/connect.php';

function getEmployees() {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare(" SELECT dept_name as visual,dept_no from departments");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDepartment($department) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT departments.dept_no,dept_name,first_name, last_name from departments,dept_manager,employees where dept_manager.dept_no = departments.dept_no and dept_manager.emp_no = employees.emp_no and dept_manager.dept_no = '$department' and to_date IS NULL ; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC)[0];

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDepartmentAll($department) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT distinct employees.emp_no, concat(first_name, ' ' , last_name) as visual from employees,dept_emp where dept_emp.emp_no = employees.emp_no and employees.emp_no != (select emp_no from dept_manager where dept_manager.dept_no = '$department' and to_date IS NULL) and dept_no = '$department' and to_date is NULL; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
function updateManager($depart,$manager)
{
	$connection = openConn();

	try {
		$connection->beginTransaction();
			$update = $connection->prepare("UPDATE dept_manager SET to_date = DATE(NOW()) WHERE dept_no= '$depart' AND to_date is null; ");
			$update->execute();
			$insert = $connection->prepare("INSERT INTO `dept_manager` (`emp_no`, `dept_no`, `from_date`, `to_date`) VALUES ('$manager', '$depart', DATE(NOW()) , NULL) ");
			$insert->execute();
		$connection->commit();

	} catch (PDOException $ex) {
		echo $ex->getMessage();
	}
	closeConn($connection);
}
?>