<?php
require_once ("view/loginView.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once ("dataContr.php");
        $email = recogerDatos("email");
        $clave = recogerDatos("lastName");

        require_once ("model/loginModel.php");
        $datos = getData($email,$clave);
        if (!empty($datos)) {
            require_once ("controller/cookieContr.php");
            makeCookie("USERPASS",$datos[0]['CustomerId']);    
            makeCookie("NAME",$datos[0]['nombre']);    
            header("Location: controller/welcomeContr.php");
        }
        else {
            echo "ERROR DE INICIO SESIÓN";
        }
    }
    



?>