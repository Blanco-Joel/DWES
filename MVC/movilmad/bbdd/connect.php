<?php //CONSTANTES-----------------------------------------------------------------------------------------------------------------
    define("SERVERNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","rootroot");
    define("DBNAME","employees");
?>

<?php
    /*Abre la conexión con la base de datos. */
    function openConn()
    {
        $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME,PASSWORD); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    /*Cierra la conexión con la base de datos. */
    function closeConn(&$conn)
    {
        $conn = null;
    }
?>