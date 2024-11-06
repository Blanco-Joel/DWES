
<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
    define("SERVERNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","rootroot");
    define("DBNAME","empleadosnm");
?>
<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------

    /*Recibe el nombre del departamento a introducir, abre la conexion con la BBDD y lo introduce  . */
    function introducirDpto($nombre)
    {
        try {
            $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME,PASSWORD); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO dpto (cod_dpto,nombre) values  (:cod_dpto,:nombre) ");
            $cod_dpto = sacarCodDpto($conn,"SELECT cod_dpto FROM dpto ORDER BY 1 desc");
            $cod_dpto = (substr($cod_dpto,0,-1) . (substr($cod_dpto,-1) + 1) );

            $stmt->bindParam(':cod_dpto', $cod_dpto  );
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
            mensaje ($nombre,$cod_dpto);


        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    /*Recibe la conexion y la consulta y saca el último cod_dpto y lo devuelve */

    function sacarCodDpto($conn,$select)
    {
        $cod_dpto = "";
        $stmt = $conn->query($select);
        $resultado=$stmt->fetchAll();
        while (strlen($cod_dpto) == 0 )
            $cod_dpto = $resultado[0]["cod_dpto"] ;
        return $cod_dpto;
    }
?>

<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($nombre)
    {
        $valido = true;
        if (strlen($nombre) == 0) {
            trigger_error("Introduzca un nombre.");
            $valido = false;
        }
        if (!$valido) 
            die;
    }

?>

<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
    
    /*Inicio del programa recogiendo y limpiando el dato introducido. Devuelve 
    el nombre . */
    function recogerDatos()
    {   
        $nombre = limpiar($_POST["nombre"]);
        erroresDatos($nombre);
       
        return $nombre;

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


<?php //IMPRESIÓN------------------------------------------------------------------------------------------------------------------
    
    /*Recibe el nombre y el codigo del departamento e imprimie por patalla un mensaje una vez se 
    haya introducido el mismo. */
    function mensaje($nombre,$cod_dpto)
    {
        echo "Se ha introducido el departamento $nombre con el codigo $cod_dpto";
    }
?>