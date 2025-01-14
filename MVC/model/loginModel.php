<?php
require_once 'bbdd/connect.php';

	function getData($email,$clave) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare("select email,idCliente,concat(nombre, ' ' , apellido) nombre from rclientes where idCliente = '$clave' and email = '$email';");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}

?>