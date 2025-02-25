<?php
	require_once '../bbdd/connect.php';


	// Obtiene la información considerada importante para mostrarla en el desplegable. 
	function getAllData($id){

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT origen, destino, fechahorasalida, fechahorallegada, nombre_aerolinea, num_asientos from vuelos,aerolineas,reservas where aerolineas.id_aerolinea = vuelos.id_aerolinea and vuelos.id_vuelo = reservas.id_vuelo  and id_reserva = '$id'order by fechahoraSalida;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getIds() {

		$connection = openConn();
		try {
			$client = $_COOKIE["USERPASS"];
				$obtenerInfo = $connection->prepare("SELECT distinct id_reserva, fecha_reserva FROM reservas,clientes where clientes.dni = reservas.dni_cliente and email = '$client ' ");
				$obtenerInfo->execute();
				return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);				


	}	
?>