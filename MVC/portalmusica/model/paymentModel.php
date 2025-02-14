<?php
	require_once '../bbdd/connect.php';

	function insertPayed($client,$amount,$order,$card_country) {

		$connection = openConn();
		try {
			$connection->beginTransaction();
				$insert = $connection->prepare("INSERT INTO `invoice`
						(`InvoiceId`	  , `CustomerId`, `InvoiceDate`   , `BillingAddress`, `BillingCity`, `BillingState`, `BillingCountry`, `BillingPostalCode`, `Card_Country`, `Total`) 
				select  '$order',customerid   ,NOW(), address          ,city           , COALESCE(state,NULL), country, COALESCE(postalcountry,NULL), $card_country, '$amount' from customer where customerid = $client");
				$insert->execute();
			$connection->commit();

		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		
		closeConn($connection);

	}	

?>