
<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
    define("SERVERNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","rootroot");
    define("DBNAME","empleadosnm");
?>


<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------

    /*Abre la conexión con la base de datos. */
    function abrirConexion()
    {
        $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME,PASSWORD); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    /*Cierra la conexión con la base de datos. */
    function cerrarConexion(&$conn)
    {
        $conn = null;
    }

    /*Recibe el nombre del departamento a introducir, abre la conexion con la BBDD y lo introduce  . */
    function introducirDpto($nombre)
    {
        try {
            $conn = abrirConexion();

            $stmt = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) values  (:cod_dpto,:nombre) ");
            $cod_dpto = sacarCodDpto($conn,"SELECT max(cod_dpto) FROM dpto");
        
            $cod_dpto = (substr($cod_dpto,0,-1) . (substr($cod_dpto,-1) + 1) );

            $stmt->bindParam(':cod_dpto', $cod_dpto  );
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
            mensajeDpto ($nombre,$cod_dpto);


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

    /*Recibe la conexion y la consulta y saca el último cod_dpto y lo devuelve */

    function sacarCodDpto($conn,$select)
    {
        $stmt = $conn->query($select);
        $resultado=$stmt->fetchAll();
        while (empty($cod_dpto) )
            $cod_dpto = $resultado[0][0] ;
        return $cod_dpto;
    }

    /*Recibe los datos a introducir en la tabla empleados, abre la conexion con la BBDD y lo introduce  . */
    function introducirEmple($nombre,$ape,$dni,$salario,$cod_dpto,$fecha_nac)
    {
        try {
            $conn = abrirConexion();
            $fecha_ini = date('Y-m-d');
            $cod_dpto = substr($cod_dpto,0,4);
            $stmt = $conn->prepare("INSERT INTO emple (nombre,apellidos,dni,salario,fecha_nac) values  ('$nombre','$ape','$dni','$salario','$fecha_nac') ");
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) values  ('$dni','$cod_dpto','$fecha_ini') ");
            $stmt->execute();
            
        
            mensajeEmple($dni,$cod_dpto);

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

    /*Recibe los datos a cambiar en la tabla emple_dpto, abre la conexion con la BBDD y lo modifica. */
    function cambiarEmpleDpto($dni,$cod_dpto)
    {
        try {
            $conn = abrirConexion();
            $fecha_ini = date('Y-m-d'); 
            $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE emple_dpto SET fecha_fin = '$fecha_ini' WHERE dni = '$dni'");
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) values  ('$dni','$cod_dpto','$fecha_ini') ");
                $stmt->execute();
                mensajeEmple($dni,$cod_dpto);
            $conn->commit();
        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
            $conn->rollback();
        }
        cerrarConexion($conn);

    }

    function listarEmplesDpto($cod_dpto)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare("SELECT emple.nombre FROM emple,emple_dpto WHERE emple.dni = emple_dpto.dni AND emple_dpto.cod_dpto = '$cod_dpto' AND fecha_fin IS NULL");
            $stmt->execute();
            $resultado=$stmt->fetchAll();
            imprimirDpto($cod_dpto);
            imprimirInicioLista();
            foreach ($resultado as $linea ) 
            {
                if(!empty($linea["nombre"]))
                    imprimirEmple($linea["nombre"]);
                else 
                    imprimirEmple("Ningún trabajador está en este departamento.");
            }   
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
        imprimirFinLista();
    }

?>


<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($nombre,$campo)
    {
        if (empty($nombre)) {
            trigger_error("Introduzca un $campo.");
            muerte();
        }

    }

    /*Tratamiento de excepciones recibiendo los el error de la consulta de la BBDD. En caso de fallo
    mata el programa  */
    function erroresBBDD($error)
    {
        if (substr($error,0,15) == "SQLSTATE[23000]") 
            trigger_error("No se puede repetir la clave primaria.");
        muerte();
    }

    /*Mata el programa.  */
    function muerte()
    {
        die;
    }

?>


<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
    
    /*Inicio del programa recogiendo y limpiando el dato introducido. Devuelve 
    el nombre . */
    function recogerDatos($campo)
    {   
        $dato = limpiar($_POST["$campo"]);
        erroresDatos($dato,$campo);
       
        return $dato;
    }

?>


<?php //LIMPIEZA-------------------------------------------------------------------------------------------------------------------
    
    /*Recibe una String y la limpia los datos introducidos por el usuario. Devuelve el mismo dato
    limpio.*/
    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

?>


<?php //CREAR OPTIONS-----------------------------------------------------------------------------------

    /* Crea un desplegable con los departamentos de la BBDD. */
    function crearDesplegableDpto()
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable("cod_dpto");
        $stmt = $conn->prepare("SELECT concat(cod_dpto,' | ', nombre) as cod_dpto FROM dpto order by 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["cod_dpto"]);

        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }

    /* Crea un desplegable con los empleados de la BBDD. */
    function crearDesplegableEmple()
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable("DNI");
        $stmt = $conn->prepare("SELECT concat( emple_dpto.dni,' | ',nombre,' | ', cod_dpto ) as DNI FROM emple,emple_dpto where emple.dni = emple_dpto.dni AND fecha_fin is NULL order by 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["DNI"]);
        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }
?>


<?php //IMPRESIÓN------------------------------------------------------------------------------------------------------------------
    
    /*Recibe el nombre y el codigo del departamento e imprimie por patalla un mensaje una vez se 
    haya introducido el mismo. */
    function mensajeDpto($nombre,$cod_dpto)
    {
        echo "Se ha introducido el departamento $nombre con el codigo $cod_dpto";
    }
    function mensajeEmple($dni,$cod_dpto)
    {
        echo "Se ha introducido el empleado con el DNI $dni en el departamento $cod_dpto ";
    }
    function imprimirInicioDesplegable($name)
    {
        echo "<select name=\"" . $name . "\">";
    }

    function imprimirCuerpoDesplegable($dato)
    {
        echo "<option value=\"" . $dato . "\">". $dato ."</option>";
    }
    
    function imprimirFinalDesplegable()
    {
        echo "</select>";
    }
    function imprimirDpto($cod_dpto)
    {
        echo "Empleados del departamento $cod_dpto ";
    }
    function imprimirInicioLista()
    {
        echo "</ul>";
    }
    function imprimirEmple($nombre)
    {
        echo "<li> $nombre </li>";
    }
    function imprimirFinLista()
    {
        echo "</ul>";
    }
?>