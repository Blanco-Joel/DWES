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
                $datas[strval(count($datas))] = $newEmployee;
            }else
                $datas[0] = $newEmployee;
                makecookie("EMPLOYEES",serialize($datas));
                $_COOKIE["EMPLOYEES"] = serialize($datas);
            }
        if (isset($_POST["alta"])) {
            if (isset($_COOKIE["EMPLOYEES"])) {
                
                $datas = unserialize($_COOKIE["EMPLOYEES"]);
                $mess = "";
                foreach ($datas as $employee) {
                    $lastNum = getLastNo();
                    insertEmpl($lastNum,$employee["birth_date"],$employee["first_name"],$employee["last_name"],$employee["gender"]);
                    insertEmplDpt($lastNum,$employee["dpt"]);
                    insertEmplTitle($lastNum,$employee["title"]);
                    insertEmplSalary($lastNum,$employee["salary"]);
                    $mess .=  "Se ha añadido al empleado con nombre " . $employee["first_name"] . " " . $employee["last_name"] .".<br><br>" ; 
                }
                deleteEmp();
            }else
                $mess = "No hay empleados para crear.<br><br>";
        }
    }    
    
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeRRHHContr.php");
require_once ("../view/altaEmplMasView.php");

    
?>