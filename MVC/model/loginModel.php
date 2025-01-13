<?php

function getData($email,$clave) {

	global $conection;

	try {
		$obtenerInfo = $conection->prepare("select email,idCliente from rclientes where idCliente = '$clave' and email = '$email';");
		$obtenerInfo->execute();
		return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

	} catch (PDOException $ex) {
		echo $ex->getMessage();
		return null;
	}

}

?>