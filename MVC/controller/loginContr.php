<?php
require_once ("controller/dataContr.php");
require_once ("controller/cookieContr.php");
require_once ("model/loginModel.php");
require_once ("view/loginView.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = recogerDatos("email");
    $clave = recogerDatos("password");
    
    $datos = getData($email,$clave);
    if (!empty($datos)) {
        makeCookie($datos);    
        header("Location: view/welcomeView.php");
    }
    else {
        # error.
    }
}


?>