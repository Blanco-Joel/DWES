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
	function insertRalquileres($veh,$client,$date) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `ralquileres` (`idcliente`, `matricula`, `fecha_alquiler`, `fecha_devolucion`, `preciototal`, `fechahorapago`) 
													VALUES ('$client', '$veh', '$date', NULL, NULL, NULL);");
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