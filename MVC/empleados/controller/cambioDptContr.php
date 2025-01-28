<?php
require_once ("cookieContr.php");
compCookie();
require_once ("../model/cambioDptModel.php");

$data = getEmployees();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once ("dataContr.php");
        if (isset($_POST["Consultar"]))
        {
            $employee = recogerDatos("emp");
            if (!empty($employee)) {
                makecookie("deptEmployee",$employee);
                $department = getDepartment($employee);
                $actualDepart = "<label for='actual'>Actual Department of " . $department['first_name']." " . $department['last_name'] . " :</label><input class='form-control' value='". $department['dept_no']."' placeholder='".$department['dept_no']."'  type='text' id='actual' name='actual'>";
                $button = "<input type='submit' value='Cambiar Departamento' name='cambiar' class='btn btn-warning disabled'>";
            }
        }
        if (isset($_POST["cambiar"]))
        {
            $sal = recogerDatos("actual");
            $employee = $_COOKIE["salarEmployee"];
            updateDepartment($employee,$sal);
            deleteEmp();
        }
        
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeRRHHContr.php");
        
    }
require_once ("../view/cambioDptView.php");
?>