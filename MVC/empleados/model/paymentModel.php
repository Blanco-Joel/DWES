<?php
	require_once '../bbdd/connect.php';

	function updateRalquileres($veh,$client,$amount,$order) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("UPDATE `ralquileres` SET fecha_devolucion = NOW(), preciototal = '$amount',  fechahorapago = NOW(), num_pago = $order where matricula = '$veh' and fecha_devolucion IS NULL ");
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
				$update = $connection->prepare("UPDATE rvehiculos SET disponible = 'S' where matricula =
				 '$veh'");

				$update->execute();
			$connection->commit();


		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}

		closeConn($connection);

	}
?>