<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Binario</h1>
    <?php
        function imprimirDatos($nombre,$ape1,$ape2,$email,$sexo)
        {
            echo "<table border=1>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th></tr>";
            echo "<tr><td>$nombre</td><td>$ape1 "."$ape2</td><td>$email</td><td>$sexo</tD></tr>";
            echo "</table>";
        }
        
        function fileDatos($nombre,$ape1,$ape2,$email,$sexo)
        {
            $txt = "\nNombre : ". $nombre;
            $txt .="\nApellidos : ".$ape1 . " " . $ape2;
            $txt .="\nEmail : ".$email;
            $txt .="\nSexo : ".$sexo;
            $archivo = fopen("../datos.txt", "w");
            fwrite($archivo,$txt);
            fclose($archivo);   
        }

        function recogerDatos ()
        {   
            $nombre = limpiar($_POST["nombre"]);
            $ape1 = limpiar($_POST["ape1"]);
            $ape2 = limpiar($_POST["ape2"]);
            $email = limpiar($_POST["email"]);
            $sexo = limpiar($_POST["sexo"]);
            imprimirDatos($nombre,$ape1,$ape2,$email,$sexo);
            fileDatos($nombre,$ape1,$ape2,$email,$sexo);
        }
        
        function limpiar($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        recogerDatos();
        
        ?>
</body>
</html>
