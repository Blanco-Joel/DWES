<?php  

    include_once '../redsys/apiRedsys.php';

    $miObj = new RedsysAPI;

    
    $miObj->setParameter("DS_MERCHANT_AMOUNT", intval($amount));
    $miObj->setParameter("DS_MERCHANT_CURRENCY", 978);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", "263100000");
    $miObj->setParameter("DS_MERCHANT_ORDER", str_pad($payOrder, 12, "0", STR_PAD_LEFT));
    $miObj->setParameter("DS_MERCHANT_TERMINAL", "29");
    $miObj->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $vehicle);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
    $miObj->setParameter("DS_MERCHANT_URLOK", "http://192.168.206.204/DWES/MVC/controller/payedContr.php");
    $miObj->setParameter("DS_MERCHANT_URLKO", "http://192.168.206.204/DWES/MVC/controller/errorPayContr.php");

    $params = $miObj->createMerchantParameters();
    $claveSHA256 ="sq7HjrUOBfKmC576ILgskD5srU870gJ7";
    $firma = $miObj->createMerchantSignature($claveSHA256);

?>