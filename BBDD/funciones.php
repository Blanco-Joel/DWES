
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
            echo "Error: " . $e->getMessage();
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
            var_dump($cod_dpto);
            $stmt = $conn->prepare("INSERT INTO emple (nombre,apellidos,dni,salario,fecha_nac) values  ('$nombre','$ape','$dni','$salario','$fecha_nac') ");
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) values  ('$dni','$cod_dpto','$fecha_ini') ");
            $stmt->execute();
            
        
            mensajeEmple ($nombre,$ape,$dni,$cod_dpto);

        }   
        catch(PDOException $e) {
            trigger_error("Error: " . $e->getMessage());
        }

        cerrarConexion($conn);
    }

?>


<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($nombre,$campo)
    {
        $valido = true;
        if (empty($nombre)) {
            trigger_error("Introduzca un $campo.");
            $valido = false;
        }
        if (!$valido) 
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

    function crearDesplegable()
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
?>


<?php //IMPRESIÓN------------------------------------------------------------------------------------------------------------------
    
    /*Recibe el nombre y el codigo del departamento e imprimie por patalla un mensaje una vez se 
    haya introducido el mismo. */
    function mensajeDpto($nombre,$cod_dpto)
    {
        echo "Se ha introducido el departamento $nombre con el codigo $cod_dpto";
    }
    function mensajeEmple($nombre,$ape,$dni,$cod_dpto)
    {
        echo "Se ha introducido el empleado $nombre $ape con el DNI $dni en el departamento $cod_dpto ";
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
?>