<?php
require_once ("cookieContr.php");
compCookie();

require_once ("../model/histLaboralModel.php");
    $messDept = "<hr>Departments <hr>";
    $employee = $_COOKIE["USERPASS"];
    $employeeDpt = getDpt($employee);
    $managerMess = empty(getMan($employee)) ? "Este empleado no es manager de ningún departamento.<br> " : getMan($employee)[0]["visual"];
    
    $messSalar = "<hr style='border:1px dotted black'><hr>Salaries <hr>";
    $employeeSal = getSalary($employee);

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        if (isset($_POST["Volver"]))
            if ($_COOKIE["DEPT"] == "d003") 
                header("Location: ../controller/welcomeRRHHContr.php");
            else
                header("Location: ../controller/welcomeContr.php");        
    
require_once ("../view/histLaboralView.php");
?>