<?php
require_once ("cookieContr.php");
compCookie();
compCookieRRHH();

require_once ("../model/vidaLaboralModel.php");

$data = getEmployees();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Consultar"]))
        {
            require_once ("dataContr.php");
            $employee = recogerDatos("emp");
            $option = recogerDatos("options");
            if (!empty($employee) && !empty($option)) {
                switch ($option) {
                    case 'departments':
                        $mess = "<hr>Departments <hr>";
                        $employeeData = getDpt($employee);
                        $managerMess = empty(getMan($employee)) ? "Este empleado no es manager de ningún departamento.<br> " : getMan($employee)[0]["visual"];
                        break;
                    case 'salaries':
                        $mess = "<hr>Salaries <hr>";
                        $employeeData = getSalary($employee);
                        break;
                    case 'personalData':
                        $mess = "<hr>Personal Data <hr>";
                        $employeeData = getPersonalData($employee);

                        break;
                    case 'titles':
                        $mess = "<hr>Titles <hr>";
                        $employeeData = getTitle($employee);
                        break;
                    default:
                        $employeeData[0] = "Error";
                        break;
                }
                
            }
        }
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeRRHHContr.php");
        
    }
require_once ("../view/vidaLaboralView.php");
?>