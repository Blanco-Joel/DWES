<?php
require_once 'bbdd/connect.php';

	function getData($user,$clave) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare("select emp_no,Last_name,concat(first_name, ' ' , Last_name) nombre from employees where last_name = '$clave' and emp_no = '$user' and baja is NULL;");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}
	function getDept($user) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare("select dept_no from dept_emp where  emp_no = '$user';");
			$obtainInfo->execute();
			return $obtainInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}

?>