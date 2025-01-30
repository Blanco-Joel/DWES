<?php
require_once ("cookieContr.php");
compCookie();

require_once ("../model/nominaModel.php");
    $messDept = "<hr style='border:1px dotted black'><hr>Departments <hr>";
    $employee = $_COOKIE["USERPASS"];
    $employeeDpt = getDpt($employee);
    $managerMess = empty(getMan($employee)) ? "Este empleado no es manager de ningún departamento.<br> " : getMan($employee)[0]["visual"];
    
    $messPdata = "<hr>Personal Data <hr>";
    $employeeData = getPersonalData($employee);
    $messTitl = "<hr style='border:1px dotted black'><hr>Titles <hr>";
    $employeeTitle = getTitle($employee);
    
    $salaryNoImp = getsalary($employee);
    
    
    $seg = $salaryNoImp*0.075;
    $irpf = $salaryNoImp <= 40000 ? $salaryNoImp*0.1: $salaryNoImp < 70000 ? $salaryNoImp*0.2 : $salaryNoImp*0.3;
    $salary = getTitleEng($employee) == "SI" ? ($salaryNoImp+10000-$seg-$irpf) :  ($salaryNoImp-$seg-$irpf);
    $messSalar = "<hr style='border:1px dotted black'><hr>Nomina <hr>Salario Bruto...............................$salaryNoImp € <br>Impuestos SS...............................$seg €<br>Impuestos IRPF..........................$irpf €<br> Bonus por Ingeniería...........................".getTitleEng($employee)."<br>Salario Neto................................$salary €<br>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        if (isset($_POST["Volver"]))
            if ($_COOKIE["DEPT"] == "d003") 
                header("Location: ../controller/welcomeRRHHContr.php");
            else
                header("Location: ../controller/welcomeContr.php");
        
    
require_once ("../view/nominaView.php");
?>