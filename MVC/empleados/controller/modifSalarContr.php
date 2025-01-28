<?php
require_once ("cookieContr.php");
compCookie();
require_once ("../model/modifSalarModel.php");

$data = getEmployees();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once ("dataContr.php");
        if (isset($_POST["Consultar"]))
        {
            $employee = recogerDatos("emp");
            if (!empty($employee)) {
                makecookie("salarEmployee",$employee);
                $salary = getSalary($employee);
                $actualSalar = "<label for='actual'>Actual Salary of " . $salary['first_name']." " . $salary['last_name'] . " :</label><input class='form-control' value='". $salary['salary']."' placeholder='".$salary['salary']."'  type='text' id='actual' name='actual'>";
                $button = "<input type='submit' value='Cambiar salario' name='cambiar' class='btn btn-warning disabled'>";
            }
        }
        if (isset($_POST["cambiar"]))
        {
            $sal = recogerDatos("actual");
            $employee = $_COOKIE["salarEmployee"];
            updateSalary($employee,$sal);
            deleteEmp();
        }
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeRRHHContr.php");
        
    }
require_once ("../view/modifSalarView.php");
?>