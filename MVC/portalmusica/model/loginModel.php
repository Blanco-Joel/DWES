<?php
require_once 'bbdd/connect.php';

	function getData($email,$clave) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare("select CustomerId,Lastname,concat(firstname, ' ' , Lastname) nombre from customer where lastname = '$clave' and email = '$email';");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}

?>