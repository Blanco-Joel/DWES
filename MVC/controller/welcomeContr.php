<?php
require_once ("controller/dataContr.php");
require_once ("controller/cookieContr.php");
require_once ("model/welcomeModel.php");
require_once ("view/welcome.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['cerrarSes'])) {
            borrarCookie();     
        }
    }
?>