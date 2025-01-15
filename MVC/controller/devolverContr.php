<?php
require_once ("cookieContr.php");
    compCookie();
require_once("../model/devolverModel.php");
    $idClient = $_COOKIE["USERPASS"];
    $data = getRentedVehicles($idClient);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["devolver"]))
            {
                include_once '../redsys/apiRedsys.php';
            
                $miObj = new RedsysAPI;
            

                $miObj->setParameter("DS_MERCHANT_AMOUNT", $montante);
                $miObj->setParameter("DS_MERCHANT_CURRENCY", 978);
                $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", "263100000");
                $miObj->setParameter("DS_MERCHANT_MERCHANTURL","");
                $miObj->setParameter("DS_MERCHANT_ORDER", $numOrder);
                $miObj->setParameter("DS_MERCHANT_TERMINAL", "10");
                $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", "0");
                $miObj->setParameter("DS_MERCHANT_URLOK", "http://192.168.206.204/DWES/BBDD3/pe_pagado.php");
                $miObj->setParameter("DS_MERCHANT_URLKO", "http://192.168.206.204/DWES/BBDD3/pe_pagado.php");
            
            
                $params = $miObj->createMerchantParameters();
                $claveSHA256 = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                $firma = $miObj->createMerchantSignature($claveSHA256);
            
            
            
            
                require_once ("dataContr.php");
                $vehicle = recogerDatos("vehiculos");
                $button = "	<form action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST' target='_blank'>
                                <input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'/>
                                <input type='hidden' name='Ds_MerchantParameters' value='$params; ?>'/>
                                <input type='hidden' name='Ds_Signature' value='$firma; ?>'/>
                                <input type='submit' value='Realizar Pago' class='btn btn-warning disabled'/>
                            </form>";
            }
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeContr.php");

        
    }
require_once ("../view/devolverView.php");

?>