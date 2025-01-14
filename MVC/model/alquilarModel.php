<?php
	require_once '../bbdd/connect.php';

	function getVehicles() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("select matricula, concat(marca, ' ' , modelo , ' | KMs : ' , kms) as visual from rvehiculos where disponible = 'S';");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}

?>