<?php //COOKIES------------------------------------------------------------------------------------------------------------------
     
     //Llama a la funcion busquedaBBDD y definirCookie, compara dichos resultados y crea la cookie.
     function hacerCoockie($dato1,$dato2)
     {    

          setcookie("USERPASS", $dato1 . "\\" . $dato2, time() + (86400 * 30), "/"); // 86400 segundos = 1 día
          header("Location: ./menu.php");
          

     }
     //Comprueba la cookie en cada inicio de cada página.
     function comprobarCookie()
     {      
          if(!isset($_COOKIE["USERPASS"])) {
               header("Location: ./formulario.php");
          }

     }
     //Elimina la cookie.
     function borrarCookie()     
     {
          if(isset($_COOKIE["USERPASS"])) {
               setcookie("USERPASS", $dato1 . "|" . $dato2, (time() - 3600), "/"); // 86400 segundos = 1 día
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
    function busquedaBBDD($dato1,$dato2)
    {

          try {
               $conn = abrirConexion();

               $select = $conn->prepare("SELECT USUARIO,CONTRASENIA FROM USUARIOS WHERE USUARIO = '$dato1' AND CONTRASENIA = '$dato2'");
               $conn->beginTransaction();
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
    function cambiarAcceso($dato1)
    {
          try {
               $conn = abrirConexion();
               $fecha = date('Y-m-d h:m:s');
               $conn->beginTransaction();
                    $update = $conn->prepare("UPDATE USUARIOS SET ACCESO = '" . $fecha . "' WHERE USUARIO = '" .$dato1."'");
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

     //Tratamiento de errores en los campos a rellenar del usuario.
     function erroresDatos($dato,$campo)
     {
          if (empty($dato))
          {    
               trigger_error("Introduzca un valor en el campo de " . $campo);
               muerte();
          }
     }

     /*Mata el programa.*/
     function muerte()
     {
          die;
     }

?>
<?php //RECOGIDA DE DATOS ----------------------------------------------------------------------------------------------------------
    function recogerDatos($campo)
    {   
          $dato = limpiar($_POST[$campo]);
          erroresDatos($dato, $campo);
          return $dato;
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