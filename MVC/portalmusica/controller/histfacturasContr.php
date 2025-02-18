<?php
require_once ("cookieContr.php");
session_start();
compCookie();

require_once ("../model/histfacturasModel.php");
$id = (string) $_COOKIE['USERPASS'];
$data = getList($id);


if (isset($_POST["Volver"])) {
    header("Location: ../controller/welcomeContr.php");
}

require_once ("../view/histfacturasView.php");
?>