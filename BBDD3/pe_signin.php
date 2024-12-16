<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<?php //INCLUSIÓN DE ERRORES-------------------------------------------------------------------------------------------------------
    include "errores.php";
    set_error_handler("error_function");
?>
<?php //INCLUSIÓN DE FUNCIONES-----------------------------------------------------------------------------------------------------
    include "funciones.php"; 
?>
<body>
    <div class="form-container">
        <h1>Sign In</h1>
        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="customerName">Customer Name:</label>
            <input type="text" id="customerName" name="customerName"><br><br>
            
            <label for="contactLastName">Contact Last Name:</label>
            <input type="text" id="contactLastName" name="contactLastName"><br><br>
            
            <label for="contactFirstName">Contact First Name:</label>
            <input type="text" id="contactFirstName" name="contactFirstName"><br><br>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br><br>
            
            <button type="submit">Sign In</button><br><br>
            <input type="button" onclick="location.href='./pe_login.php';" value="LOG IN" /><br><br>
            </form>
    </div>
    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $customerName     = recogerDatos("customerName");
                $contactLastName = recogerDatos("contactLastName");
                $contactFirstName = recogerDatos("contactFirstName");
                $telefono = recogerDatos("telefono");
                $clave = password_hash(recogerDatos("contactLastName"), PASSWORD_DEFAULT);
                crearUsuario($customerName, $contactLastName, $contactFirstName, $clave, $telefono);
                header("Location: ./pe_login.php");
            }
            ?>
</body>
</html>
