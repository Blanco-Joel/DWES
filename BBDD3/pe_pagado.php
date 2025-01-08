<?php
    include_once('./funciones.php');
    comprobarCookie();
        /*Importar el fichero principal de la librería, tal y como se muestra
    a continuación. El comercio debe decidir si la importación desea hacerla con la
    función “include” o “required”, según los desarrollos realizados.*/
    include_once './apiRedsys.php'; 

    /*Definir un objeto de la clase principal de la librería, tal y como se
    muestra a continuación:*/
    $miObj = new RedsysAPI; 

    include_once './apiRedsys.php';

    $miObj = new RedsysAPI();
    
    // Captura los datos enviados por Redsys
    $version = $_GET['Ds_SignatureVersion'];
    $datos = $_GET['Ds_MerchantParameters'];
    $firmaRedsys = $_GET['Ds_Signature'];
    
    // Decodifica los parámetros
    $decodedParams = base64_decode($datos);
    $parametrosJSON = json_decode($decodedParams, true);
    $dsResponse = $parametrosJSON['Ds_Response'];
    $dsAmount = $parametrosJSON['Ds_Amount']/100;
    
    guardarPago($dsResponse,$dsAmount)
                      
?>
<?php //INCLUSIÓN DE ERRORES-------------------------------------------------------------------------------------------------------
    include_once "errores.php";
    set_error_handler("error_function");
?>
<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BBDD</title>
  </head>

</HEAD>

<BODY>

    <form name='comprar' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        
        <input type="button" onclick="location.href='./pe_inicio.php';" value="MENÚ" />
        <br><br>
        <input type="submit" value="Cerrar Sesion" name="cerrarSes">   
        <br><br><br>

    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {

            if (isset($_POST['cerrarSes'])) 
            {
                borrarCookie();     
                boorarCesta();
            }

        }
    ?>

</BODY>
</HTML>