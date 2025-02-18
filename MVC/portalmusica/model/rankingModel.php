<?php
	require_once '../bbdd/connect.php';

	function getList($index,$firstDate,$secondDate) {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT concat(track.trackid,') ',name , ' || Author: ',COALESCE(composer,'desconocido'), '|| Times downloaded : ', sum(quantity)) as visual  from track,invoiceLine,invoice where track.trackid = invoiceline.trackid and invoice.invoiceid = invoiceline.invoiceid and invoicedate >= '$firstDate 00:00:00' and invoicedate <= '$secondDate 23:59:59' group by invoiceLine.trackid order by sum(quantity) desc limit 10 offset $index ;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
	function getTotalSongs($firstDate,$secondDate) {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT count(*) from (SELECT count(trackid) from invoiceline,invoice where invoice.invoiceid = invoiceline.invoiceid and  invoicedate >= '$firstDate 00:00:00' and invoicedate <= '$secondDate 23:59:59' group by invoiceLine.trackid ) as selected;");
			$obtenerInfo->execute();
			return $obtenerInfo->fetchColumn(); 

		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return null;
		}
		
		closeConn($connection);

	}
?>