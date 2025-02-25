<?php
require_once ("cookieContr.php");
    compCookie();
require_once ("../view/vinicioView.php");
require_once ("dataContr.php");


    if (isset($_POST["reservar"])) {
        header("Location: ../controller/reservarContr.php");

    }
    if (isset($_POST["consultar"])) {
        header("Location: ../controller/consultarContr.php");

    }
    if (isset($_POST["salir"])) {
        header("Location: ../controller/logoutContr.php");
    }

?>