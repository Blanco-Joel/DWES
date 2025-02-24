<?php
require_once ("cookieContr.php");
session_start();
compCookie();
require_once ("../model/consultaModel.php");
require_once ("erroresContr.php");

set_error_handler("error_function");
    $data = getIds();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["consultar"])) {
        require_once ("dataContr.php");
        $id = recogerDatos("reserva");
        $data2 = getAllData($id);
        }
        
        if (isset($_POST["volver"]))
            header("Location: ../controller/vinicioContr.php");
        
            
    }
require_once ("../view/vconsultasView.php");

    
?>