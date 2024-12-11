
<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
    define("SERVERNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","rootroot");
    define("DBNAME","pedidos");
?>

<?php //COOKIES------------------------------------------------------------------------------------------------------------------
     
    //Llama a la funcion busquedaBBDD y definirCookie, compara dichos resultados y crea la cookie.
    function hacerCoockie($nif)
    {    
        setcookie("USERPASS", $nif, time() + (86400 * 30), "/"); // 86400 segundos = 1 día
        header("Location: ./pe_inicio.php");
    }
    //Comprueba la cookie en cada inicio de cada página.
    function comprobarCookie()
    {    
        if(!isset($_COOKIE["USERPASS"])) {
            header("Location: ./pe_login.php");
        }

    }
    //Elimina la cookie.
    function borrarCookie()     
    {
        if(isset($_COOKIE["USERPASS"])) {
            setcookie("USERPASS", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            header("Location: ./pe_login.php");
        }

    }
    function hacerCookieCesta($linea)
    {   
        setcookie("cesta",$linea, time() + (86400 * 30), "/");

    }
    function boorarCesta()
    {
        if (isset($_COOKIE["cesta"])) {
            setcookie("cesta","0", (time() - 3600), "/");
        }
    }

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
    function comprobarStock($nombre)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare("SELECT quantityInStock as resultado FROM products where productName = '$nombre'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            imprimirCantidades($resultado[0]['resultado'],$nombre);


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    function comprobarStockLinea($nombre)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare(" SELECT quantityInStock,productName FROM products where productLine = '$nombre' order by quantityinStock desc");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $line => $value) {
                imprimirCantidades($value['quantityInStock'],$value['productName']);
            }


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

    /*Recibe los datos para la compra(nif,id_prod,localidad,cantidadCompra), abre la conexion con la BBDD y la hace. */
    function realizarCompra($nif,$id_prod,$num_almacen,$cantidadCompra)
    {
        try {
            $conn = abrirConexion();
            $id_producto = substr($id_prod,0,4);
            $id_prod = substr($id_prod,7);
            $stmt = $conn->prepare("SELECT cantidad FROM almacena,almacen where almacen.num_almacen = almacena.num_almacen and num_almacen = '$num_almacen' and id_producto = '$id_producto'");
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
    function comprobarPedidos($pedido)
    {
        try {
            $conn = abrirConexion();
            $pedido = explode(" || ",$pedido); 
            $stmt = $conn->prepare(" SELECT orders.orderNumber, orders.orderDate,orders.status,productName,quantityOrdered,orderLineNumber,priceEach
                                     FROM orders,orderdetails,products 
                                     WHERE orders.orderNumber = orderdetails.orderNumber and orderDetails.productCode = products.productCode and orders.orderNumber = '$pedido[0]' 
                                     order by orderLineNumber;");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            if(!empty($resultado))
            {
                imprimirNumeroPedido($resultado[0]['orderNumber'], $resultado[0]['orderDate'], $resultado[0]['status']);
                foreach ($resultado as $pedidos => $linea) 
                {
                    imprirmirListaPedido($linea['orderLineNumber'],$linea['productName'], $linea['quantityOrdered'], $linea['priceEach']);
                }
            }


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }

?>


<?php //LÓGICA 2-------------------------------------------------------------------------------------------------------------------
    function busquedaBBDD($dato1)
    {
        try {
            $conn = abrirConexion();
            $fecha_actual = date("Y-m-d h:i:s", strtotime("+60 minute"));
            $select = $conn->prepare("SELECT clave FROM customers WHERE customerNumber = '$dato1' and (fecha_exp_bloq <= '$fecha_actual' or fecha_exp_bloq is null )");
            $select->execute();
            $resultado = $select->fetchAll();
        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
        return $resultado;
    }

    function annadirProductoCesta($nombre,$cantidad)
    {
        try {

            $conn = abrirConexion();

            $stmt = $conn->prepare("SELECT productCode FROM products where productName = '$nombre'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $id_producto=$stmt->fetchAll();
            $id_producto = $id_producto[0]["productCode"];

            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            $cesta[$id_producto] = isset($cesta[$id_producto]) ? ['nombre' => $cesta[$id_producto]['nombre'], 'cantidad' => $cesta[$id_producto]['cantidad'] + $cantidad] : ['nombre' => $nombre, 'cantidad' => $cantidad];            hacerCookieCesta(serialize($cesta));
            foreach ($cesta as $compra) 
                imprimirCesta($compra['nombre'],$compra['cantidad']);

                
        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
            
    }
    function realizarCompraFinal($user)
    {
        try {
            $conn = abrirConexion();
            $linea = $_COOKIE["cesta"];
            $cesta = explode("##", $linea);
            for ($i=0; $i < count($cesta)-1; $i++)
            { 
                $compra = explode("|", $cesta[$i]);
                $num_almacen = comprobarAlmacen($compra[1],$compra[2]);

                if ($num_almacen != 0)
                {
                    $stmt = $conn->prepare("SELECT cantidad FROM almacena,almacen where almacen.num_almacen = almacena.num_almacen and almacena.num_almacen = '$num_almacen' and id_producto = '$compra[0]'");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $cantidad=$stmt->fetchAll();
                    $cantidad = empty($cantidad) ? $cantidad : $cantidad[0]['cantidad'];
                    $fecha_compra = date("Y-m-d h:m:s");
                    if ($cantidad >= $compra[2] &&  !empty($cantidad)) {
                        $conn->beginTransaction();
                            $stmt = $conn->prepare("INSERT INTO compra (user,id_producto,fecha_compra,unidades) values  ('$user','$compra[0]','$fecha_compra','$compra[2]')");
                            $stmt->execute();
                            $stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD = $cantidad-$compra[2] where id_producto = '$compra[0]'");
                            $stmt->execute();
                            mensajeCompraFinal($compra[1],$compra[2]);
                        $conn->commit();
                    } else 
                    {
                        $cantidad = empty($cantidad) ? 0 : $cantidad;
                        mensajeNoCompraFinal($compra[1],$cantidad,$compra[2]);
                    }
                }
            }
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }  

    function bloqueoUser($usuario)
    {
        try {
            $conn = abrirConexion();
            $conn->beginTransaction();
                $fecha_bloq = date("Y-m-d h:i:s", strtotime("+60 minute"));
                $fecha_exp = date("Y-m-d h:i:s", strtotime("+61 minute"));
                $stmt = $conn->prepare("UPDATE Customers SET fecha_exp_bloq = '$fecha_exp' where customerNumber = '$usuario'");
                $stmt->execute();
                $stmt = $conn->prepare("UPDATE Customers SET fecha_bloq = '$fecha_bloq' where customerNumber = '$usuario'");
                $stmt->execute();
            $conn->commit();
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
    }
    function  cambiarInicio($usuario)
    {
        try {
            $conn = abrirConexion();
            $conn->beginTransaction();
                $fecha_ult_ses = date("Y-m-d h:i:s", strtotime("+60 minute"));
                $stmt = $conn->prepare("UPDATE Customers SET fecha_ult_inicio = '$fecha_ult_ses' where customerNumber = '$usuario'");
                $stmt->execute();
            $conn->commit();
        }
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
    }

    function crearUsuario($customerName, $contactLastName, $contactFirstName, $clave,$telefono)
    {
        try {
            $conn = abrirConexion();
            $num_siguiente = $conn->prepare("SELECT MAX(customerNumber)+1 FROM CUSTOMERS  ");
            $num_siguiente->execute();
            $num_siguiente->setFetchMode(PDO::FETCH_NUM);
            $num_siguiente=$num_siguiente->fetchAll();
            $num_siguiente = $num_siguiente[0][0];
            $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO Customers (`customerNumber`, `customerName`, `contactLastName`, `contactFirstName`, `phone`, `addrebLine1`, `addrebLine2`, `city`, `state_code`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`, `clave`, `fecha_ult_inicio`, `fecha_bloq`, `fecha_exp_bloq`) VALUES ('$num_siguiente', '$customerName', ' $contactLastName', '$contactFirstName','$telefono', 'Calle Alcalá,1', NULL, 'Madrid', NULL, NULL, 'España', NULL, NULL, '$clave', NULL, NULL, NULL)");
                $stmt->execute();
            $conn->commit();
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
    function crearDesplegable($select,$table,$id,$where)
    {
        $conn = abrirConexion();
        imprimirInicioDesplegable($id);
        $stmt = $conn->prepare("SELECT concat($select) as resul FROM $table where $where order by 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["resul"]);

        imprimirFinalDesplegable();
        cerrarConexion($conn);
    }

    /* Crea un desplegable con las categorias de la BBDD. */
    function crearDesplegableVarios($select,$table,$id,$where,$groupBy)
    {
        $conn = abrirConexion();
        imprimirInicioDesplegable($id);
        $stmt = $conn->prepare("SELECT concat($select) as resul FROM $table where $where group by $groupBy order by 1 ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
        foreach($resultado as $linea) 
            imprimirCuerpoDesplegable($linea["resul"]);

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
    function  imprimirCantidades($cantidad,$nombre)
    {
        echo "Hay $cantidad  unidades del producto: $nombre.<br>";
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
    function imprimirMontanteFinal($precioTotal)
    {
        echo "El montate total de las compras de este cliente es de " . $precioTotal;
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

<?php //IMPRESIÓN 2----------------------------------------------------------------------------------------------------------------

    //Imprime un mensaje por pantalla con las claves del cliente junto a su nif.
    function mensajeClienteCompleto($nif,$nombre,$apellido)
    {
        echo "Las credenciales del cliente con NIF : $nif son :<br>";
        echo "USUARIO : $nombre<br>";
        echo "PASSWORD: $apellido<br>";
    }
    //Imprime un mensaje por pantalla en caso de que los datos del formulario no estén en la BBDD.
    function mensajeFallo()
    {
        echo "FALLO DE AUTENTIFICACIÓN<br>";
    }
    function mensajeFalloFinal()
    {
        echo "SE HA BLOQUEADO EL USUARIO<br>";
    }
    function mensajeNoCompraCli($nombre)
    {
        echo "No se ha podido realizar la compra del producto: $nombre, ya que no hay suficientes existencias";
    }

    function mensajeNoCompraFinal($nombre,$cantidad,$cantidadCompra)
    {
        echo "No se ha podido realizar la compra del producto: $nombre, ya que el almacen tiene $cantidad unidades y la compra es de $cantidadCompra ";
    }
    function mensajeCompraFinal($nombre,$cantidadCompra)
    {
        echo "Se ha realizado la compra al almacen de $cantidadCompra unidades del producto: $nombre. ";
    }
    function imprimirNumeroPedido($id,$fecha,$estado)
    {
        echo "<pre>ID de la pedido : $id || Fecha de la pedido : $fecha || Estado del pedido : $estado </pre><hr>";
        echo "<table border=1>";
        echo "<tr><th>Line</th><th>Product</th><th>Quantity</th><th>Price</th></tr>";
    }
    function imprirmirListaPedido($orderLineNumber,$productName, $quantityOrdered , $priceEach)
    {
        echo "<tr><th>$orderLineNumber</th><td>$productName</td><td>$quantityOrdered</td><td>$priceEach</td></tr>";
    }
    //----------------------------------------
    function imprimirInicioCesta()
    {
        echo "<table border=1><tr><th>Producto</th><th>Cantidad</th></tr> ";
    } 
    function imprimirCesta($nombre,$cantidad)
    {
        echo "<tr><td>$nombre</td><td>$cantidad</td></tr>";
    }
    function imprimirfinCesta()
    {
        echo "</table>";
    } 
    //----------------------------------------
?>