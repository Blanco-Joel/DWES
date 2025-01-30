<?php
require_once '../bbdd/connect.php';

function getEmployees() {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare(" SELECT emp_no, concat(first_name , ' ' , last_name) as visual from employees where emp_no not in (Select emp_no from dept_manager); ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDepartment($employee) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT departments.dept_no,dept_name,first_name, last_name from departments,dept_emp,employees where dept_emp.dept_no = departments.dept_no and dept_emp.emp_no = employees.emp_no and dept_emp.emp_no = '$employee' and to_date IS NULL ; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC)[0];

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDepartmentAll($employee) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT distinct departments.dept_no,dept_name from departments,dept_emp where dept_emp.dept_no = departments.dept_no and departments.dept_no != (select dept_no from dept_emp where dept_emp.emp_no = '$employee' and to_date IS NULL); ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
function updateDepartment($employee,$dept)
{
	$connection = openConn();

	try {
		$connection->beginTransaction();
			$update = $connection->prepare("UPDATE dept_emp SET to_date = DATE(NOW()) WHERE emp_no = '$employee' AND to_date is null; ");
			$update->execute();
			$insert = $connection->prepare("INSERT INTO `dept_emp` (`emp_no`, `dept_no`, `from_date`, `to_date`) VALUES ('$employee', '$dept', DATE(NOW()) , NULL) ");
			$insert->execute();
		$connection->commit();

	} catch (PDOException $ex) {
		echo $ex->getMessage();
	}
	closeConn($connection);
}
?>