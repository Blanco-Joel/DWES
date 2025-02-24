<?php
	require_once '../bbdd/connect.php';


	// Obtiene la información considerada importante para mostrarla en el desplegable. 
	function getVuelos() {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT id_Vuelo, origen, destino, fechahorasalida, fechahorallegada, nombre_aerolinea, asientos_disponibles,precio_asiento from vuelos,aerolineas where aerolineas.id_aerolinea = vuelos.id_aerolinea and asientos_disponibles > '0' order by id_vuelo;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}

	function getAsientos($id, $asientos) {

		$connection = openConn();
		try {
			$client = $_COOKIE['USERPASS'];
			$obtenerInfo = $connection->prepare("select asientos_disponibles from vuelos where id_vuelo = '$id' and asientos_disponibles >= $asientos  ;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}

	function getLastId() {

		$connection = openConn();
		try {
				$obtenerInfo = $connection->prepare("SELECT MAX(id_reserva) FROM reservas");
				$obtenerInfo->execute();
				return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);				


	}	
	function getDni() {

		$connection = openConn();
		try {
				$obtenerInfo = $connection->prepare("Select dni from clientes where  email = '" . $_COOKIE["USERPASS"]."'");
				$obtenerInfo->execute();
				return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);				


	}	
	function getTotalPrice($vuelo,$asientos) {

		$connection = openConn();
		try {
				$obtenerInfo = $connection->prepare("select '$asientos'*precio_asiento from vuelos where id_vuelo = '$vuelo'");
				$obtenerInfo->execute();
				return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);				


	}	
	function insertreservas($vuelo,$asientos,$ultimoId,$dni,$totalPrice) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO reservas (id_reserva, id_vuelo, dni_cliente, fecha_reserva, `num_asientos`, preciototal) 
												VALUES               ('$ultimoId', '$vuelo', '$dni', NOW(), '$asientos','$totalPrice')");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	
	function updatevuelos($vuelo,$asientos) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$update = $connection->prepare("UPDATE vuelos SET asientos_disponibles = asientos_disponibles-$asientos where id_vuelo = '$vuelo'");

				$update->execute();
			$connection->commit();


		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}

		closeConn($connection);

	}
?>