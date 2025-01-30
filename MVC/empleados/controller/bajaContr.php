<?php
require_once ("cookieContr.php");
compCookie();
compCookieRRHH();

require_once ("../model/bajaModel.php");

    $data = getEmployees();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["baja"])) {
            require_once("dataContr.php");
            $num = recogerDatos("emp");
            if(!empty($num))
                umpdateEmplpyees($num);
        }
    }    
    
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeRRHHContr.php");
require_once ("../view/BajaView.php");

    
?>