<?php //COOKIES------------------------------------------------------------------------------------------------------------------
     
     //Llama a la funcion busquedaBBDD y definirCookie, compara dichos resultados y crea la cookie.
     function hacerCoockie()
     {    
          
          $resultado = busquedaBBDD();

          $COOKIE_NAME  = limpiar($_POST["usuario"]);
          $COOKIE_VALUE = limpiar($_POST["passw"]);
          
          foreach ($resultado as $datos ) {
               if ($COOKIE_NAME == $datos["USUARIO"] && $COOKIE_VALUE == $datos["CONTRASENIA"]) {
                    setcookie("USER", $COOKIE_NAME . "\\" . $COOKIE_VALUE, time() + (86400 * 30), "/"); // 86400 segundos = 1 día
                    cambiarAcceso();
                    header("Location: ./menu.php");
               }
          }
          if(!isset($_COOKIE[$COOKIE_NAME])) {
               mensajeFallo();
          }
     }

     //Elimina la cookie.
     function borrarCookie()     
     {
          if(isset($_COOKIE["USER"])) {
               setcookie("USER", $COOKIE_NAME . "|" . $COOKIE_VALUE, (time() - 3600), "/"); // 86400 segundos = 1 día
               header("Location: ./formulario.php");
          }
     }

?>

<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
     define("SERVERNAME","localhost");
     define("USERNAME","root");
     define("PASSWORD","rootroot");
     define("DBNAME","coockies");
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

    /*Hace la consulta a la base de datos : abre la conexion con la BBDD, la hace y cierra la conexión. */
    function busquedaBBDD()
    {
          try {
               $conn = abrirConexion();

               $select = $conn->prepare("SELECT USUARIO,CONTRASENIA FROM USUARIOS");
               $conn->beginTransaction();
                    $select = $conn->prepare("SELECT USUARIO,CONTRASENIA FROM USUARIOS");
                    $select->execute();
               $conn->commit();
               $resultado = $select->fetchAll();
          }   
          catch(PDOException $e) {
               erroresBBDD($e->getMessage());
          }

          cerrarConexion($conn);
          return $resultado;
    }

    //Cambia el ultimo acceso del usuario de la BBDD.
    function cambiarAcceso()
    {
          try {
               $conn = abrirConexion();
               $fecha = date('Y-m-d h:m:s');
               $conn->beginTransaction();
                    $update = $conn->prepare("UPDATE USUARIOS SET ACCESO = '" . $fecha . "' WHERE USUARIO = '" .$COOKIE_NAME."'");
                    $update->execute();
               $conn->commit();
          }   
          catch(PDOException $e) {
               erroresBBDD($e->getMessage());
          }

          cerrarConexion($conn);
    }


?>

<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------


     /*Tratamiento de excepciones recibiendo los el error de la consulta de la BBDD. En caso de fallo
     mata el programa  */
     function erroresBBDD($error)
     {
          if (substr($error,48,5) == "1062") 
          trigger_error("No se puede repetir la clave primaria.");
          muerte();
     }

     /*Mata el programa.*/
     function muerte()
     {
          die;
     }

?>
<?php //LIMPIEZA -------------------------------------------------------------------------------------------------------------------

     //Limpia los datos introducidos por el usuario.
     function limpiar($data)
     {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
     }
?>

<?php //IMPRESION ------------------------------------------------------------------------------------------------------------------

     //Imprime un mensaje por pantalla en caso de que los datos del formulario no estén en la BBDD.
     function mensajeFallo()
     {
          echo "FALLO DE AUTENTIFICACIÓN<br>";
     }


?>