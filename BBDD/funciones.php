

<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------
function introducirDpto$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnm";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT cod_dpto FROM dpto order by 1 desc");
    $stmt->execute();
    $linea = "";
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultado=$stmt->fetchAll();
    
    while (strlen($linea) == 0 )
        $linea = $resultado[0]["cod_dpto"] ;
    
}   
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

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
    
    /*Inicio del programa recogiendo y limpiando los datos introducidos. Devuelve 
    todos los datos . */
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
