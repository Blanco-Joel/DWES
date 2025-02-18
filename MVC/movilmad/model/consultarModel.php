<?php
require_once '../bbdd/connect.php';

	function getRented($idClient,$firstDate,$secondDate) {

		$connection = openConn();

		try {
			$obtainInfo = $connection->prepare("select concat('(',ralquileres.matricula, ') ',marca,' ' , modelo, ', ', fecha_alquiler,' - ',fecha_devolucion,' PRECIO TOTAL: ', preciototal) as linea from ralquileres,rvehiculos where ralquileres.matricula = rvehiculos.matricula and fecha_devolucion IS NOT NULL and idcliente = '$idClient' and fecha_alquiler >= '$firstDate 00:00:00' and fecha_alquiler <= '$secondDate 23:59:59';");
			$obtainInfo->execute();
			return $obtainInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		closeConn($connection);
	}

?> 