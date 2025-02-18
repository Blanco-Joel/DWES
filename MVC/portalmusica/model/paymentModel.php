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

				foreach($_SESSION["SONGS"] as $song => $units) {
					$insertInvoiceLine = $connection->prepare("INSERT INTO `invoiceline` (`InvoiceLineId`, `InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`)
					select  max(invoiceLineId)+1,$order,$song,unitprice,$units from track,invoiceline where invoice.invoiceid = invoiceline.invoiceid and trackid = '$song'");

					$insertInvoiceLine->execute();
					$cont +=1;
				}		
				$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

?>