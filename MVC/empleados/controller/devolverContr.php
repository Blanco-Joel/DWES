<?php
require_once ("cookieContr.php");
    compCookie();
require_once("../model/devolverModel.php");
    $idClient = $_COOKIE["USERPASS"];
    $data = getRentedVehicles($idClient);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["devolver"]))
            {
                require_once ("dataContr.php");
                $vehicle = recogerDatos("vehiculos");
                makecookie("VEHICLE",$vehicle);
                $visualAmount = getTotalAmount($vehicle);
                $amount = $visualAmount*100;
                $message = "EL PRECIO A PAGAR SON ".$visualAmount. "<br><br>";
                $payOrder = getPayOrder();

                require_once ("payContr.php");
                $button = "<form action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST' target='_blank'>
                                <input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'/>
                                <input type='hidden' name='Ds_MerchantParameters' value='$params'/>
                                <input type='hidden' name='Ds_Signature' value='$firma'/>
                                <input type='submit' value='Realizar Pago' class='btn btn-warning disabled'/>
                            </form>";
                
            }
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeContr.php");
       
    }
require_once ("../view/devolverView.php");

    function getTotalAmount($vehicle)
    {
        $amount = getPrice($vehicle);

        return $amount[0]["amount"];
    }
?>