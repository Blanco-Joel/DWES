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
	function getPrice($id,$units) {

		$connection = openConn();
		try {
			$obtainInfo = $connection->prepare("SELECT unitprice*$units as amount from track where trackid = '$id' ");
			$obtainInfo->execute();
			return $obtainInfo->fetchColumn(); 

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
?>