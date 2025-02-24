<?php
require_once ("view/loginView.php");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once ("dataContr.php");
        $email = recogerDatos("usuario");
        $clave = recogerDatos("password");

        require_once ("model/loginModel.php");
        $datos = getData($email,$clave);
        if (!empty($datos)) {
            
            require_once ("cookieContr.php");
            makeCookie("USERPASS",$datos[0]['email']);    
            makeCookie("NAME",$datos[0]['nombre']);    
            header("Location: controller/vinicioContr.php");
        }
        else {
            require_once("erroresContr.php");
            set_error_handler("error_function");
            errorLogin();
        }
    }
    



?>