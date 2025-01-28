<?php
require_once ("cookieContr.php");
compCookie();
require_once ("../model/infoDptModel.php");

$data = getDpt();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once ("dataContr.php");
        if (isset($_POST["Consultar"]))
        {
            $dpt = recogerDatos("dpt");
            if (!empty($dpt)) {
                $mess = "<hr>".getDptName($dpt)."<hr>";
                $dptData = getDptData($dpt);
                $managerMess = getMan($dpt)[0]["visual"];
            }
        }
        
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeRRHHContr.php");
        
    }
require_once ("../view/infoDptView.php");
?>