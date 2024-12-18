<?php
include_once "./funciones.php";


$miObj = new RedsysAPI;



$miObj->setParameter("DS_MERCHANT_AMOUNT", 100000);
$miObj->setParameter("DS_MERCHANT_CURRENCY", 978);
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", "263100000");
$miObj->setParameter("DS_MERCHANT_ORDER", "123456789017");
$miObj->setParameter("DS_MERCHANT_TERMINAL", "10");
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
$miObj->setParameter("DS_MERCHANT_URLOK", "./ok.txt");
$miObj->setParameter("DS_MERCHANT_URLKO", "./ko.txt");


$params = $miObj->createMerchantParameters();
$claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
$firma = $miObj->createMerchantSignature($claveSHA256);
?>

<form action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
    <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
    <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/>
    <input type="hidden" name="Ds_Signature" value="<?php echo $firma; ?>"/>
    <input type="submit" value="Realizar Pago"/>
</form>