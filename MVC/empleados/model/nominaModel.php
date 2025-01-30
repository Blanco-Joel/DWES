<?php
require_once '../bbdd/connect.php';

function getEmployees() {

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT emp_no, concat(first_name , ' ' , last_name,'<br><br>') as visual from employees; ");
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
		$obtainInfo = $connection->prepare("SELECT concat(' - ',salary, ' €. Desde ' , from_date, ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from salaries where emp_no = '$employee' order by from_date; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}


function getTitle($employee)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',title, '. Desde ' , from_date, ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from titles where emp_no = '$employee' order by from_date; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getDpt($employee)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',dept_name, '. Desde ' , from_date, ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from departments,dept_emp where departments.dept_no = dept_emp.dept_no and emp_no = '$employee' order by from_date; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
function getMan($employee)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',dept_name, '. Desde ' , from_date, ' hasta ', COALESCE(to_date,'la actualidad'),'<br><br>') as visual from departments,dept_manager where departments.dept_no = dept_manager.dept_no and emp_no = '$employee' order by from_date; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}

function getPersonalData($employee)
{

	$connection = openConn();

	try {
		$obtainInfo = $connection->prepare("SELECT concat(' - ',emp_no, ': ' , first_name, ' ' , last_name, ' | Birth date : ', birth_date, '| Hire Date : ', hire_date,'<br><br>') as visual from employees where emp_no = '$employee' ; ");
		$obtainInfo->execute();
		return $obtainInfo->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}
	closeConn($connection);
}
?>