
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
            $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO categoria (id_categoria,nombre) values  (:id_cat,:nombre) ");
                $stmt->bindParam(':id_cat', $id_cat  );
                $stmt->bindParam(':nombre', $nombre);
                $stmt->execute();
            $conn->commit();

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
            $id_prod = $id_prod->fetchColumn();

            $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO Producto (id_producto,nombre,precio,id_categoria) values  ('$id_prod','$nombre','$precio','$id_categoria') ");
                $stmt->execute();
            $conn->commit();

        
            mensajeProd($nombre,$id_prod,$id_categoria);

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    /*Recibe los datos a introducir en la tabla almacen, abre la conexion con la BBDD y lo introduce  . */
    function introducirAlm($localidad)
    {
        try {
            $conn = abrirConexion();
            $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO Almacen (localidad) values  ('$localidad')");
                $stmt->execute();
            $conn->commit();

        
            mensajeAlm($localidad);

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    
    /*Recibe los datos a introducir en la tabla almacena, abre la conexion con la BBDD y lo introduce  . */
    function introducirCantProd($id_prod,$num_almacen,$cantidad)
    {
        try {
            $conn = abrirConexion();
            $id_producto = substr($id_prod,0,4);
            $stmt = $conn->prepare("SELECT id_producto from producto where id_producto = '$id_producto' ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            if (!empty($resultado)) 
            {
                $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO Almacena (num_almacen,id_producto,cantidad) values  ('$num_almacen','$id_producto','$cantidad')");
                    $stmt->execute();
                $conn->commit();
            }
            else 
            {
                $conn->beginTransaction();
                    $stmt = $conn->prepare("UPDATE Almacena set cantidad = cantidad + $cantidad where  id_producto = '$id_producto'");
                    $stmt->execute();
                $conn->commit();
            }

            $id_prod = substr($id_prod,7);
            mensajeCantProd($num_almacen,$id_prod,$cantidad);

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    /*Recibe el nombre y el id del productoa listar de la tabla almacena, abre la conexion con la BBDD y lo imprime  . */
    function listarCantProd($id_producto)
    {
        try {
            $id_prod = substr($id_producto,0,4);
            $id_producto = substr($id_producto,7);
            $conn = abrirConexion();
            $stmt = $conn->prepare("SELECT concat(cantidad,'|',num_almacen) as resultado FROM almacena,almacen where almacen.num_almacen = almacena.num_almacen and id_producto = '$id_prod'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $almacen => $linea) {
                $cantidad = explode("|",$linea['resultado']);
                imprimirCantidades($cantidad[0],$cantidad[1],$id_producto);
            }

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    /*Recibe el nombre y el id del productoa listar de la tabla almacena, abre la conexion con la BBDD y lo imprime  . */
    function listarProdAlm($num_almacen)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare("SELECT concat(cantidad,'|',nombre) as resultado FROM almacena,producto,almacen where almacen.num_almacen = almacena.num_almacen and almacena.id_producto = producto.id_producto ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $almacen => $linea) {
                $cantidad = explode("|",$linea['resultado']);
                imprimirCantidades($cantidad[0],$num_almacen,$cantidad[1]);
            }

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    /*Recibe los datos a introducir en la tabla cliente, abre la conexion con la BBDD y lo introduce  . */
    function introducirCliente($nif)
    {
        try {
            $conn = abrirConexion();
            $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO Cliente (NIF) values  ('$nif')");
                $stmt->execute();
            $conn->commit();

        
            mensajeCliente($nif);

        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

    /*Recibe los datos para la compra(nif,id_prod,localidad,cantidadCompra), abre la conexion con la BBDD y la hace. */
    function realizarCompra($nif,$id_prod,$localidad,$cantidadCompra)
    {
        try {
            $conn = abrirConexion();
            $id_producto = substr($id_prod,0,4);
            $id_prod = substr($id_prod,7);
            $stmt = $conn->prepare("SELECT cantidad FROM almacena,almacen where almacen.num_almacen = almacena.num_almacen and localidad = '$localidad' and id_producto = '$id_producto'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $cantidad=$stmt->fetchAll();
            $cantidad = empty($cantidad) ? $cantidad : $cantidad[0]['cantidad'];

            $stmt = $conn->prepare("SELECT  nif FROM cliente where nif = '$nif'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $existe=$stmt->fetchAll();
            
            $fecha_compra = date("Y-m-d h:m:s");
            if (empty($existe)) {
                mensajeErrorCliente($nif);
            }else
                if ($cantidad >= $cantidadCompra &&  !empty($cantidad)) {
                    $conn->beginTransaction();
                        $stmt = $conn->prepare("INSERT INTO compra (nif,id_producto,fecha_compra,unidades) values  ('$nif','$id_producto','$fecha_compra','$cantidadCompra')");
                        $stmt->execute();
                        $stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD = $cantidad-$cantidadCompra where id_producto = '$id_producto'");
                        $stmt->execute();
                        mensajeCompra($id_prod,$localidad,$cantidadCompra);
                    $conn->commit();
                } else 
                {
                    $cantidad = empty($cantidad) ? 0 : $cantidad;
                    mensajeNoCompra($id_prod,$localidad,$cantidad,$cantidadCompra);
                }




        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }  
    function comprobarCompras($NIF,$fecha_inicio,$fecha_final)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare(" SELECT producto.id_producto, producto.nombre, (precio*unidades) FROM compra,producto WHERE producto.id_producto = compra.id_producto and fecha_compra >= concat('$fecha_inicio',' 00:00:00') AND fecha_compra <= concat('$fecha_final',' 23:59:59')  AND nif = '$NIF'");
            
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            if(!empty($resultado))
                foreach ($resultado as $almacen => $linea) 
                    imprirmirListaCompras($linea['id_producto'], $linea['nombre'], $linea['(precio*unidades)']);
            else
                mensajeNoHaComprado();

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
    //Tratamiento de excepcion del campo NIF.
    function comprobarNIF($nif)
    {
        if (!(preg_match("/^[0-9]{8}[a-z]{1}$/i", $nif))) {
            trigger_error("Introduzca un nif con el formato adecuado [00000000A].");
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
        if ($campo == "NIF")
            comprobarNIF($dato);
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

    /* Crea un desplegable con las categorias de la BBDD. */
    function crearDesplegable($select,$table,$id)
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable($id);
        $stmt = $conn->prepare("SELECT concat($select) as resul FROM $table order by 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["resul"]);

        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }

    /* Crea un desplegable con los almacenes de la BBDD. */
    function crearDesplegableAlm()
    {
        $conn = abrirConexion();

        imprimirInicioDesplegable("localidad");
        $stmt = $conn->prepare("SELECT localidad FROM almacen order by localidad");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["localidad"]);

        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }


?>


<?php //IMPRESIÓN------------------------------------------------------------------------------------------------------------------
    
    function mensajeCat($nombre,$id_cat)
    {
        echo "Se ha introducido la Categoria $nombre con el codigo $id_cat";
    }
    function mensajeProd($nombre,$id_prod,$id_categoria)
    {
        echo "Se ha introducido el producto $nombre con el codigo: $id_prod en la categoria con código: $id_categoria ";
    }
    function mensajeAlm($localidad)
    {
        echo "Se ha introducido el almacen de la localidad $localidad ";
    }
    function mensajeCantProd($localidad,$id_producto,$cantidad)
    {
        echo "Se han introducido $cantidad unidades del producto: $id_producto en el almacen de la localidad $localidad ";
    }
    function  imprimirCantidades($cantidad,$localidad,$id_producto)
    {
        echo "En el almacen de $localidad hay $cantidad unidades del producto: $id_producto.<br>";
    }
    function mensajeCliente($nif)
    {
        echo "Se ha introducido cliente con NIF : $nif ";
    }
    function mensajeNoCompra($id_producto,$localidad,$cantidad,$cantidadCompra)
    {
        echo "No se ha podido realizar la compra del producto: $id_producto, ya que el almacen de $localidad tiene $cantidad unidades y la compra es de $cantidadCompra ";
    }
    function mensajeCompra($id_producto,$localidad,$cantidadCompra)
    {
        echo "Se ha realizado la compra al almacen de $localidad de $cantidadCompra unidades del producto: $id_producto. ";
    }
    function mensajeErrorCliente($nif)
    {
        echo "No se ha podido realizar la compra del producto, ya que el cliente con NIF $nif no está registrado. ";
    }
    function imprirmirListaCompras($id,$nombre,$precio)
    {
        echo "ID del Producto     : $id <br>";
        echo "Nombre del Producto : $nombre <br>";
        echo "Precio de la compra : $precio <br><hr>";
    }
    function mensajeNoHaComprado()
    {
        echo "Este cliente no ha comprado nada.";
    }
    //---------------------------------------
    function imprimirInicioDesplegable($dato)
    {
        echo "<select name='$dato'>";
    }
    function imprimirCuerpoDesplegable($dato)
    {
        echo "<option value=\"" . $dato . "\">". $dato ."</option>";
    }
    function imprimirFinalDesplegable()
    {
        echo "</select>";
    }
    //---------------------------------------

?>