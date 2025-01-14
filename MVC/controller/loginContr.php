<?php
require_once ("dataContr.php");
require_once ("cookieContr.php");
require_once ("model/loginModel.php");
require_once ("view/loginView.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = recogerDatos("email");
    $clave = recogerDatos("password");
    
    $datos = getData($email,$clave);
    if (!empty($datos)) {
        makeCookie("USERPASS",$datos[0]['idCliente']);    
        makeCookie("NAME",$datos[0]['nombre']);    
        header("Location: controller/welcomeContr.php");
    }
    else {
        # error.
    }
}


?>