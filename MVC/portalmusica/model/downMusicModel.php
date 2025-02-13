<?php
	require_once '../bbdd/connect.php';

	function getList() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT name, concat(name , ' || Price : ' , unitPrice)as visual  from track limit 10;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function insertRalquileres($veh,$client,$date) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `ralquileres` (`idcliente`, `matricula`, `fecha_alquiler`, `fecha_devolucion`, `preciototal`, `fechahorapago`,`num_pago`) 
													VALUES ('$client', '$veh', '$date', NULL, NULL, NULL,0);");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

	function updateRvehiculos($veh) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$update = $connection->prepare("UPDATE rvehiculos SET disponible = 'N' where matricula =
				 '$veh'");

				$update->execute();
			$connection->commit();


		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}

		closeConn($connection);

	}
?>