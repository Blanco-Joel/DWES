<?php
require_once ("cookieContr.php");
session_start();
compCookie();
require_once ("../model/reservarModel.php");
require_once ("erroresContr.php");

set_error_handler("error_function");

    $datos = getVuelos();

    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["agregar"])) {
        require_once ("dataContr.php");
        $vuelo = recogerDatos("vuelos");
        $asientos = recogerDatos("asientos");

        //cookieContr.php
        $cart = isset($_SESSION["vuelos"]) ?  $_SESSION["vuelos"] : array();
        $cart[$vuelo] = !isset($cart[$vuelo]) ? $cart[$vuelo] = $asientos   : $cart[$vuelo] += $asientos;
        $message .= "Se han añadido : " . $cart[$vuelo] . " asientos del vuelo ". $vuelo.".<br><br>";
        saveCart($cart);
    }
        if (isset($_POST["comprar"]) && (isset($_SESSION["vuelos"]) ))
        {
            $cart = $_SESSION["vuelos"];
            $precio = 0;
            foreach ($cart as $vuelo => $asientos) 
                if (empty(getAsientos($vuelo,$asientos)))
                {
                    trigger_error("El vuelo con identificador ".$vuelo . " no tiene " .$asientos ." asientos disponibles.<br> Vuelva a alquilar un número de asientos disponible. ");
                    $cart =$_SESSION["vuelos"];
                    unset($cart[$vuelo]);
                    saveCart($cart);
                }
            $ultimoIdReserva = "R00". ((substr(getLastId(),-2))+1);
            $dni = getDni();
                $message = "";

            foreach ($cart as $vuelo => $asientos) {
                $totalPrice = getTotalPrice($vuelo,$asientos);
                insertreservas($vuelo,$asientos,$ultimoIdReserva, $dni,$totalPrice);
                updatevuelos($vuelo,$asientos);
                $message .= "SE HAN RESERVADO $asientos ASIENTOS DEL VUELO $vuelo.<br>";
            }
            deleteCart();
            

        }
        if (isset($_POST["vaciar"]))
            deleteCart();
        
        if (isset($_POST["volver"]))
            header("Location: ../controller/vinicioContr.php");
        
            
    }
require_once ("../view/vreservasView.php");

    
?>