<?php
require_once ("cookieContr.php");
compCookie();
compCookieRRHH();

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
            $dpt= recogerDatos("dpt");
            $title= recogerDatos("title");
            $salary= recogerDatos("salary");
            $employee = [
                'birth_date' => $birth_date,
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'gender'     => $gender,
                'dpt'        => $dpt,
                'title'      => $title,
                'salary'     => $salary
            ];
            insertAll($lastNum,$employee);
        }
    }    
    
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeRRHHContr.php");
require_once ("../view/altaEmplView.php");

    
?>