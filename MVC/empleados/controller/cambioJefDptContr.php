<?php
require_once ("cookieContr.php");
compCookie();
compCookieRRHH();

require_once ("../model/cambioJefDptModel.php");

$data = getEmployees();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once ("dataContr.php");
        if (isset($_POST["Consultar"]))
        {
            $dpt = recogerDatos("dept");
            if (!empty($dpt)) {
                makecookie("deptManager",$dpt);
                $department = getDepartment($dpt);
                $restDepart = getDepartmentAll($dpt);
                $actualManager = "<label for='actual'>Actual Manager of Department " .$department['dept_name']. " : "  . $department['first_name']." " . $department['last_name'] . "</label><select name='actual' id='actual' class='form-control'>";
                foreach ($restDepart as $d ) {
                    $actualManager .="<option value='" . $d['emp_no'] . "'>" . $d['visual'] . "</option>";
                }
                $actualManager .= "</select>";
                $button = "<input type='submit' value='Cambiar Departamento' name='cambiar' class='btn btn-warning disabled'>";
            }
        }
        if (isset($_POST["cambiar"]))
        {
            $manager = recogerDatos("actual");
            $depart = $_COOKIE["deptManager"];
            updateManager($depart,$manager);
            deleteEmp();
        }
        
        if (isset($_POST["Volver"]))
            header("Location: ../controller/welcomeRRHHContr.php");
        
    }
require_once ("../view/cambioJefDptView.php");
?>