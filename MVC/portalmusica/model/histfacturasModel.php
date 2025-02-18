<?php
	require_once '../bbdd/connect.php';

	function getList($id) {

		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT (SELECT concat(invoiceId,' ) ', invoiceDate, ' TOTAL : ', total) from invoice,invoiceline  where invoice.invoiceid = invoiceline.invoiceid and costumerId = $id) as cabezera, trackid,unitprice,quantity from invoiceline,invoice where invoice.invoiceid = invoiceline.invoiceid and invoiceid = $index order by invoicelineid;");
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