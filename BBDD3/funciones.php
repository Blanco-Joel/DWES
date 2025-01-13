<?php // INCLUSION API
    require_once('./apiRedsys.php');
?>

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
    function comprobarPedidosFecha($fecha_inicio,$fecha_final)
    {
        try {
            $conn = abrirConexion();
            $stmt = $conn->prepare(" SELECT sum(quantityOrdered), productName,orderDate From orderDetails, orders,Products where orderDate >= concat('$fecha_inicio',' 00:00:00') AND orderDate <= concat('$fecha_final',' 23:59:59') AND orders.orderNumber = orderDetails.orderNumber AND orderdetails.productCode = products.productCode group by productName order by orderDate");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            if(!empty($resultado))
            
                foreach ($resultado as $compra => $value) 
                    mensajeCompraFecha($value['sum(quantityOrdered)'],$value['productName'],$value['orderDate']);
                
            
            else
                mensajeNoHaComprado();


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    function comprobarPagosFecha($fecha_inicio,$fecha_final)
    {
        try {
            $cliente = $_COOKIE["USERPASS"];
            $montanteTotal = 0;
            $conn = abrirConexion();
            $stmt = $conn->prepare(" select paymentDate,amount from payments where customerNumber = '$cliente' and paymentDate >= '$fecha_inicio' and paymentDate <= '$fecha_final' order by paymentDate");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
            if(!empty($resultado))
            {
                foreach ($resultado as $compra => $value)
                { 
                    mensajePagoFecha($value['paymentDate'],$value['amount']);
                    $montanteTotal += $value['amount'];
                }
                imprimirMontanteFinal($montanteTotal);
            }
            else
                mensajeNoHaComprado();


        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }

        cerrarConexion($conn);
    }
    
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
            $cesta[$id_producto] = isset($cesta[$id_producto]) ? ['nombre' => $cesta[$id_producto]['nombre'], 'cantidad' => $cesta[$id_producto]['cantidad'] + $cantidad] : ['nombre' => $nombre, 'cantidad' => $cantidad];      
            hacerCookieCesta(serialize($cesta));
            foreach ($cesta as $compra) 
                imprimirCesta($compra['nombre'],$compra['cantidad']);

                
        }   
        catch(PDOException $e) {
            erroresBBDD($e->getMessage());
        }
        cerrarConexion($conn);
            
    }
    function realizarCompraFinal()
    {
        try {
            $conn = abrirConexion();
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            $stmt = $conn->prepare("SELECT max(orderNumber)+1 from orders ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $numOrder = $stmt->fetchAll();
            $numOrder = $numOrder[0]['max(orderNumber)+1'];
            $orderLine = 1;
            
            $montante = 0;

            $fecha_compra = date("Y-m-d h:m:s");
            
            $cliente = $_COOKIE["USERPASS"];


            $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,status,customerNumber) 
            values  ('$numOrder','$fecha_compra','$fecha_compra','In Process','$cliente')");
            $stmt->execute();

            foreach ($cesta as $compra => $valor)
            {
                $nombre = $valor['nombre'];

                $stmt = $conn->prepare("SELECT quantityInStock as cantidad FROM products where productName = '$nombre' ");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $cantidad = $stmt->fetchAll();
                $cantidad = empty($cantidad) ? $cantidad : $cantidad[0]['cantidad'];
                
                $cantidadCompra = $valor['cantidad'];
                

                if ($cantidad >= $cantidadCompra &&  !empty($cantidad))
                {
                    $conn->beginTransaction();
                        $stmt = $conn->prepare("SELECT buyPrice FROM products where productName = '$nombre'");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $precio = $stmt->fetchAll();
                        $precio = $precio[0]['buyPrice'];

                        $stmt = $conn->prepare("INSERT INTO `orderdetails` (`orderNumber`, `productCode`, `quantityOrdered`, `priceEach`, `orderLineNumber`) 
                                                VALUES                     ('$numOrder', '$compra', '$cantidadCompra', '$precio', '$orderLine')");
                        $stmt->execute();
                        $orderLine += 1; 

                        $stmt = $conn->prepare("UPDATE products SET quantityInStock = $cantidad-$cantidadCompra where productName = '$nombre'");
                        $stmt->execute();
                        $montante += $precio*$cantidadCompra; 
                       
                        mensajeCompraFinal($nombre,$cantidadCompra);
                    $conn->commit();
                } else 
                {
                    $cantidad = empty($cantidad) ? 0 : $cantidad;
                    mensajeNoCompraFinal($nombre,$cantidad,$cantidadCompra);
                }
            }
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        cerrarConexion($conn);
        return $montante;
    }  
    function guardarPago($respuestaPago,$montante)
    {

        try {
            $conn = abrirConexion();
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
            $stmt = $conn->prepare("SELECT max(orderNumber) from orders ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $numOrder = $stmt->fetchAll();
            $numOrder = $numOrder[0]['max(orderNumber)'];
            $orderLine = 1;
            

            $fecha_compra = date("Y-m-d h:m:s");
            
            $cliente = $_COOKIE["USERPASS"];

            if ($respuestaPago <= 99) {
                $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO payments (customerNumber,checkNumber,paymentDate,amount) 
                                            values               ('$cliente','$numOrder','$fecha_compra','$montante')");
                    $stmt->execute();     
                    mensajePagado();

                    boorarCesta();
                $conn->commit();
            }else {
                $conn->beginTransaction();
                    $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,status,customerNumber) 
                                            values             ('$numOrder','$fecha_compra','$fecha_compra','PENDING PAY','$cliente')");
                    $stmt->execute();
                $conn->commit();
                mensajeFaltaPago();
            }
    
        }
        catch(PDOException $e) {
            echo $e->getMessage();
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

    function recogerPedido()
    {
        $conn = abrirConexion();
        $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
        $stmt = $conn->prepare("SELECT max(orderNumber) from orders ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numOrder = $stmt->fetchAll();
        $numOrder = $numOrder[0]['max(orderNumber)'];
        return $numOrder;
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
    el dato . */
    function recogerDatos($campo)
    {   
        $dato = limpiar($_POST["$campo"]);
        erroresDatos($dato,$campo);
        if ($campo == "NIF")
            comprobarNIF($dato);
        return $dato;
    }
    function recogerDatosFecha($campo)
    {   
        return limpiar($_POST["$campo"]);
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
    
    function mensajeCompraFecha($cantidad,$nombre,$fecha)
    {
        echo "El día $fecha se compraron $cantidad unidades del producto $nombre.<br>";
    }
    function mensajePagoFecha($fecha,$cantidad)
    {
        echo "El día $fecha se pagó $cantidad en la compra.<br>";
    }   
    function mensajeNoHaComprado()
    {
        echo "Entre estas fechas no ha comprado nada.";
    }
    function imprimirMontanteFinal($precioTotal)
    {
        echo "<br><hr><br>El montate total de las compras de este cliente es de " . $precioTotal;
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
        echo "La compra al almacen de $cantidadCompra unidades del producto: $nombre está pendiente de pago. <br>";
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
    function mensajePagado()
    {
        echo "Se ha pagado la compra.";
    }
    function mensajeFaltaPago()
    {
        echo "NO SE HA PODIDO REALIZAR EL PAGO, EL PEDIDO ESTÁ PENDIENTE DE ESTE.";
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