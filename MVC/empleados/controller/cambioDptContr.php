<?php
require_once ("cookieContr.php");
compCookie();
compCookieRRHH();

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
                $restDepart = getDepartmentAll($employee);
                $actualDepart = "<label for='actual'>Actual Department of " . $department['first_name']." " . $department['last_name'] . " : " .$department['dept_name']."</label><select name='actual' id='actual' class='form-control'>";
                foreach ($restDepart as $d ) {
                    $actualDepart .="<option value='" . $d['dept_no'] . "'>" . $d['dept_name'] . "</option>";
                }
                $actualDepart .= "</select>";
                $button = "<input type='submit' value='Cambiar Departamento' name='cambiar' class='btn btn-warning disabled'>";
            }
        }
        if (isset($_POST["cambiar"]))
        {
            $dept = recogerDatos("actual");
            $employee = $_COOKIE["deptEmployee"];
            updateDepartment($employee,$dept);
            deleteEmp();
        }
        
        if (isset($_POST["Volver"])){
            header("Location: ../controller/welcomeRRHHContr.php");
            deleteEmp();
        }
    }
require_once ("../view/cambioDptView.php");
?>