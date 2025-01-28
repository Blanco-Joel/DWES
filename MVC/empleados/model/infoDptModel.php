<?php
require_once '../bbdd/connect.php';

function getDpt() {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT dept_no, dept_name as visual from departments; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
function getDptName($dpt) {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT dept_name as visual from departments where dept_no = '$dpt' ; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC)[0]["visual"]; 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getMan($dpt)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',first_name, ' ', last_name, '. Desde ' , from_date, ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from employees,departments,dept_manager where departments.dept_no = dept_manager.dept_no and employees.emp_no = dept_manager.emp_no and departments.dept_no = '$dpt' order by from_date; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDptData($dpt)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',employees.emp_no, ': ' , first_name, ' ' , last_name, ' | Desde ',from_date , ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from employees,dept_emp where employees.emp_no = dept_emp.emp_no and dept_emp.dept_no = '$dpt' ; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
?>