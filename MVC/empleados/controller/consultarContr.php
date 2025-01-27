<?php
require_once ("cookieContr.php");
compCookie();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Consultar"]))
            {
                require_once ("dataContr.php");
                $firstDate = recogerDatos("fechadesde");
                $secondDate = recogerDatos("fechahasta");
                
                if (!empty($firstDate) && !empty($secondDate))
                {
                    require_once ("../model/consultarModel.php");
                    $idClient = $_COOKIE["USERPASS"];
                    $rentedVehicles = getRented($idClient,$firstDate,$secondDate);
                    
                    
                }
                
            }
            if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeContr.php");
        
    }
require_once ("../view/consultarView.php");
?>