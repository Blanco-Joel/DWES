<?php
require_once ("cookieContr.php");
compCookie();
require_once ("../model/altaEmplModel.php");

    $data = getDpt();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["alta"])) {
            $lastNum = getLastNo();

            require_once ("dataContr.php");
            $birth_date= recogerDatos("birth_date");
            $first_name= recogerDatos("first_name");
            $last_name= recogerDatos("last_name");
            $gender= recogerDatos("gender");
            insertEmpl($lastNum,$birth_date,$first_name,$last_name,$gender);
            $dpt= recogerDatos("dpt");
            insertEmplDpt($lastNum,$dpt);
            $title= recogerDatos("title");
            insertEmplTitle($lastNum,$title);
            $salary= recogerDatos("salary");
            insertEmplSalary($lastNum,$salary);
        }
    }    
    
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeRRHHContr.php");
require_once ("../view/altaEmplView.php");

    
?>