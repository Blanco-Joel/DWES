<?php
require_once ("cookieContr.php");
compCookie();
session_start();

	require_once '../bbdd/connect.php';

	function insertPayed($client,$amount,$order,$card_country) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insertInvoice = $connection->prepare("INSERT INTO `invoice`
				(`InvoiceId`	  , `CustomerId`, `InvoiceDate`   , `BillingAddress`, `BillingCity`, `BillingState`, `BillingCountry`, `BillingPostalCode`, `Card_Country`, `Total`) 
				select  '$order',customerid   ,NOW(), address          ,city           , COALESCE(state,NULL), country, COALESCE(postalcode,NULL), $card_country, '$amount' from customer where customerid = $client");

				$insertInvoice->execute();
				$cont = 1;

				foreach($_SESSION["SONGS".$_COOKIE['USERPASS']]  as $song => $units) {
					$insertInvoiceLine = $connection->prepare("INSERT INTO `invoiceline` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`)
					select (select  max(invoiceLineId)+$cont from invoiceline),$order,$song,track.unitprice,$units from track where track.trackid = '$song'");

					$cont +=1;
					$insertInvoiceLine->execute();
				}		
				$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

?>