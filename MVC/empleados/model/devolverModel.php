<?php
	require_once '../bbdd/connect.php';

	function getRentedVehicles($idClient) {

		$connection = openConn();
		try {
			$obtainInfo = $connection->prepare("SELECT ralquileres.matricula, concat(marca, ' ' , modelo ,' (',ralquileres.matricula,')') as visual from ralquileres,rvehiculos where ralquileres.matricula = rvehiculos.matricula and idCliente = '$idClient' and fecha_devolucion IS NULL;");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getPrice($vehicle) {

		$connection = openConn();
		try {
			$obtainInfo = $connection->prepare("SELECT ROUND((TIMESTAMPDIFF(MINUTE,fecha_alquiler , NOW())*preciobase),2) as amount from ralquileres,rvehiculos where ralquileres.matricula = rvehiculos.matricula and ralquileres.matricula = '$vehicle' AND fecha_devolucion IS NULL ");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getPayOrder() {

		$connection = openConn();
		try {
			$obtainInfo = $connection->prepare("SELECT max(NUM_PAGO)+1 AS NUM FROM RALQUILERES");
			$obtainInfo->execute();
			$number = $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 
			return $number[0]['NUM'];
		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}


?>