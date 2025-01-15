<?php
    include_once "./funciones.php";
    include_once './apiRedsys.php';

    $miObj = new RedsysAPI;

    $montante = (intval(realizarCompraFinal())*100);
    $numOrder = recogerPedido();
    $miObj->setParameter("DS_MERCHANT_AMOUNT", $montante);
    $miObj->setParameter("DS_MERCHANT_CURRENCY", 978);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", "263100000");
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL","");
    $miObj->setParameter("DS_MERCHANT_ORDER", $numOrder);
    $miObj->setParameter("DS_MERCHANT_TERMINAL", "27");
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
    $miObj->setParameter("DS_MERCHANT_URLOK", "http://192.168.206.204/DWES/BBDD3/pe_pagado.php");
    $miObj->setParameter("DS_MERCHANT_URLKO", "http://192.168.206.204/DWES/BBDD3/pe_pagado.php");


    $params = $miObj->createMerchantParameters();
    $claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    $firma = $miObj->createMerchantSignature($claveSHA256);
    var_dump($numOrder);
?>

<form action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
    <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
    <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/>
    <input type="hidden" name="Ds_Signature" value="<?php echo $firma; ?>"/>
    <input type="submit" value="Realizar Pago"/>
</form>