<?php
require_once ("cookieContr.php");
compCookie();
require_once ("../model/altaEmplModel.php");

    $data = getDpt();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["annadir"])) {
            require_once ("dataContr.php");
            $birth_date= recogerDatos("birth_date");
            $first_name= recogerDatos("first_name");
            $last_name= recogerDatos("last_name");
            $gender= recogerDatos("gender");
            $dpt= recogerDatos("dpt");
            $title= recogerDatos("title");
            $salary= recogerDatos("salary");

            $newEmployee = [
                                    'birth_date' => $birth_date,
                                    'first_name' => $first_name,
                                    'last_name'  => $last_name,
                                    'gender'     => $gender,
                                    'dpt'        => $dpt,
                                    'title'      => $title,
                                    'salary'     => $salary
                                ];
            if (isset($_COOKIE['EMPLOYEES'])) {
                $datas = unserialize($_COOKIE['EMPLOYEES']);
                $employees[count($datas)] = $newEmployee;
            }
                $employees[0] = $newEmployee;
            var_dump(unserialize($_COOKIE['EMPLOYEES']));
            setcookie('EMPLOYEES', serialize($employees), time() + 86400, "/");
        }
        if (isset($_POST["alta"])) {
            
            
            // foreach
            // $lastNum = getLastNo();
            // insertEmpl($lastNum,$birth_date,$first_name,$last_name,$gender);
            // insertEmplDpt($lastNum,$dpt);
            // insertEmplTitle($lastNum,$title);
            // insertEmplSalary($lastNum,$salary);
        }
    }    
    
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeRRHHContr.php");
require_once ("../view/altaEmplMasView.php");

    
?>