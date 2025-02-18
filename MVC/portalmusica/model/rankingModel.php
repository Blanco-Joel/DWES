<?php
	require_once '../bbdd/connect.php';

	function getList($index) {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT concat(track.trackid,') ',name , ' || Author: ',COALESCE(composer,'desconocido'), '|| Times downloaded : ', sum(quantity)) as visual  from track,invoiceLine where track.trackid = invoiceline.trackid group by invoiceLine.trackid order by sum(quantity) desc limit 20 offset $index ;");
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
			$obtenerInfo = $connection->prepare("SELECT count(*) from (SELECT count(trackid) from invoiceline group by invoiceLine.trackid ) as selected;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
?>