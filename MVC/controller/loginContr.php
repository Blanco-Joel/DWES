<?php
require_once ("controller/dataContr.php");
require_once ("controller/cookieContr.php");
require_once ("model/loginModel.php");
require_once ("view/login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = recogerDatos("email");
    $clave = recogerDatos("password");
    
    $datos = getData($email,$clave);
    var_dump($datos[0]['email']);
    makeCookie($datos);    

}


?>