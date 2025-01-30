<?php
require_once ("view/loginView.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once ("dataContr.php");
        $user = recogerDatos("user");
        $clave = recogerDatos("password");

        require_once ("model/loginModel.php");
        $datos = getData($user,$clave);
        if (!empty($datos)) {
            
            require_once ("cookieContr.php");

            makeCookie("USERPASS",$datos[0]['emp_no']);    
            makeCookie("NAME",$datos[0]['nombre']);    
            $dept = getDept($user);
            makeCookie("DEPT",$dept);    
            if ($dept == "d003") {
                header("Location: controller/welcomeRRHHContr.php");
            }else
                header("Location: controller/welcomeContr.php");
            
        }
        else {
            echo "ERROR DE INICIO SESIÓN";
        }
    }
    



?>