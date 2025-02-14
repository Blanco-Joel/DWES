<?php
	require_once '../bbdd/connect.php';

	function getList($index) {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT trackid, concat(trackid,') ',name , ' || Author: ',COALESCE(composer,'desconocido'), ' || Price : ' , unitPrice)as visual  from track limit 20 offset $index;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getTotalSongs() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT max(trackid) from track;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getPrice($id) {

		$connection = openConn();
		try {
			$obtainInfo = $connection->prepare("SELECT unitprice as amount from trackid = '$id' ");
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
			$obtainInfo = $connection->prepare("SELECT max(invoiceid)+1 AS NUM FROM invoice");
			$obtainInfo->execute();
			$number = $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 
			return $number[0]['NUM'];
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