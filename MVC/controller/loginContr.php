<?php
require_once ("dataContr.php");
require_once ("view/loginView.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = recogerDatos("email");
        $clave = recogerDatos("password");
require_once ("model/loginModel.php");
        $datos = getData($email,$clave);
        if (!empty($datos)) {
require_once ("cookieContr.php");
            makeCookie("USERPASS",$datos[0]['idCliente']);    
            makeCookie("NAME",$datos[0]['nombre']);    
            header("Location: controller/welcomeContr.php");
        }
        else {
            echo "ERROR DE INICIO SESIÓN";
        }
}



?>