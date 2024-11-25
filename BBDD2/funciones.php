
<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
    define("SERVERNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","rootroot");
    define("DBNAME","comprasweb");
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

    /*Recibe el nombre de la categoria a introducir, abre la conexion con la BBDD y lo introduce  . */
    function introducirCat($nombre)
    {
        try {
            $conn = abrirConexion();

            $id_cat = $conn->query("SELECT IFNULL(CONCAT('C00',CAST(SUBSTR(MAX(ID_CATEGORIA), 2) AS UNSIGNED) + 1),'C001') as COD FROM CATEGORIA ");
            $id_cat=$id_cat->fetchColumn();
            $stmt = $conn->prepare("INSERT INTO categoria (id_categoria,nombre) values  (:id_cat,:nombre) ");


            $stmt->bindParam(':id_cat', $id_cat  );
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
            mensajeCat ($nombre,$id_cat);


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

    /*Recibe los datos a introducir en la tabla producto, abre la conexion con la BBDD y lo introduce  . */
    function introducirProd($nombre,$precio,$id_categoria)
    {
        try {
            $conn = abrirConexion();
            $id_categoria = substr($id_categoria,0,4);
            $id_prod = $conn->query("SELECT IFNULL(CONCAT('P00',CAST(SUBSTR(MAX(ID_PRODUCTO), 2) AS UNSIGNED) + 1),'P001') as COD FROM PRODUCTO");
            $id_prod = $id_cat->fetchColumn();
            $stmt = $conn->prepare("INSERT INTO Producto (nombre,precio,) values  ('$nombre','$ape','$dni','$salario','$fecha_nac') ");
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) values  ('$dni','$cod_dpto','$fecha_ini') ");
            $stmt->execute();
            
        
            mensajeProd($dni,$cod_dpto);

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
                $stmt = $conn->prepare("UPDATE emple_dpto SET fecha_fin = '$fecha_ini' WHERE dni = '$dni' AND fecha_fin IS NULL ");
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) values  ('$dni','$cod_dpto','$fecha_ini') ");
                $stmt->execute();
            $conn->commit();
                mensajeEmple($dni,$cod_dpto);
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
                imprimirEmple($linea["nombre"]);
            if(empty($resultado))
                imprimirEmple("Ningún trabajador está en este departamento.");
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
        imprimirFinLista();
    }
    
    function listarHistoricoDpto($cod_dpto)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare("SELECT emple.nombre FROM emple,emple_dpto WHERE emple.dni = emple_dpto.dni AND emple_dpto.cod_dpto = '$cod_dpto' AND fecha_fin IS NOT NULL");
            $stmt->execute();
            $resultado=$stmt->fetchAll();
            imprimirDpto($cod_dpto);
            imprimirInicioLista();
            foreach ($resultado as $linea ) 
                imprimirEmple($linea["nombre"]);
            if(empty($resultado))
                imprimirEmple("Ningún trabajador ha estado en este departamento.");
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
        imprimirFinLista();
    }
    
    function cambiarSalar($dni,$porcentaje)
    {
        try {
            $conn = abrirConexion();
            $conn->beginTransaction();
                $stmt = $conn->prepare("SELECT salario FROM emple WHERE dni = '$dni'");
                $stmt->execute();
                $resultado=$stmt->fetchAll();
                foreach ($resultado as $linea ) 
                    $salario = $linea["salario"];

                $salario = $salario +($salario * floatval($porcentaje/100));
                $stmt = $conn->prepare("UPDATE emple SET salario = $salario WHERE dni = '$dni'");
                $stmt->execute();
            $conn->commit();
            mensajeSalar($dni);
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
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
        if (substr($error,48,5) == "1062") 
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
    function crearDesplegableCat()
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable("id_categoria");
        $stmt = $conn->prepare("SELECT concat(id_categoria,' | ', nombre) as id_categoria FROM categoria order by id_categoria");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["id_categoria"]);

        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }

    /* Crea un desplegable con los empleados de la BBDD. */
    function crearDesplegableEmpleDpto()
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

    /* Crea un desplegable con los empleados de la BBDD. */
    function crearDesplegableEmple()
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable("DNI");
        $stmt = $conn->prepare("SELECT concat( dni,' | ',nombre) as DNI FROM emple order by 1");
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
    function mensajeCat($nombre,$cod_dpto)
    {
        echo "Se ha introducido la Categoria $nombre con el codigo $cod_dpto";
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
    function mensajeSalar($dni)
    {
        echo "se ha actualizado el salario del empleado con dni $dni";
    }

?>