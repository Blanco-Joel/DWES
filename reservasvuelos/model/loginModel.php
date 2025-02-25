<?php
require_once 'bbdd/connect.php';

	function getData($email,$clave) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare(" select email,concat(nombre, ' ' , apellidos) nombre from clientes where dni LIKE '". $clave . "_____' and email = '$email';");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}

?>