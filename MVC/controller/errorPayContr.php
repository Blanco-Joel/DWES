<?php
require_once ("cookieContr.php");
    compCookie();
require_once ("../view/errorPayView.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Volver"]))
    header("Location: ../controller/welcomeContr.php");

}
deleteVehicle();

?>