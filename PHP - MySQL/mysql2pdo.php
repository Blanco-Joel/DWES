<?php
/*Inserción en tabla - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnm";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) VALUES ('22222222A','D001','2024-11-05')";
    // use exec() because no results are returned
    $select = "select * from emple";
    foreach ($conn->query($select) as $fila)
        echo $fila[0];
        echo $fila[1];
        echo $fila[2];
        echo $fila[3];
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>