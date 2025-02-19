<?php
	require_once '../bbdd/connect.php';

	function getList($id,$firstDate,$secondDate) {
		
		$connection = openConn();
		try {
			$obtenerInfo = $connection->prepare("SELECT tables.invoiceDate,tables.invoiceid,invoicelineid,vista,vista2 from (select a.invoiceDate,a.invoiceid,invoicelineid,customerid,concat(a.invoiceId,' ) ', invoiceDate, ' TOTAL : ', total) as vista, concat(invoicelineid-(select min(invoicelineid) from invoiceline where invoiceid=a.invoiceid and a.invoiceid = invoiceline.invoiceid)+1,' )&emsp; Track ID : ', track.trackid, ' &emsp;Name :',name, ' | Composer : ', COALESCE(composer,'desconocido') ) as vista2 from invoice a,invoiceline,track where a.invoiceid = invoiceline.invoiceid and track.trackid = invoiceline.trackid) as tables where customerid = $id and invoiceDate >= '$firstDate 00:00:00' and invoicedate <= '$secondDate 23:59:59' order by invoiceid,invoicelineid ");
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