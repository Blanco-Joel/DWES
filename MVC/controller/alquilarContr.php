<?php
require_once ("cookieContr.php");
    compCookie();
require_once ("../model/alquilarModel.php");
    $datos = getVehicles();
    $cart = "";
    $message = "";
    if (isset($_POST["agregar"]) && isset($_COOKIE["CART"]) && count(unserialize($_COOKIE["CART"])) == 3) {
        $cart = unserialize($_COOKIE["CART"]) ;
        $cart["fin"] =  "<br> NO SE PUEDEN ALQUILAR MÁS DE 3 VEHICULOS";
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"]) && (!isset($_COOKIE["CART"]) || count(unserialize($_COOKIE["CART"])) < 3))
        {
            $vehicle = $_POST["vehiculos"];
            $cart = isset($_COOKIE["CART"]) ? unserialize($_COOKIE["CART"]) : array();
            $cart[$vehicle] = !isset($cart[$vehicle]) ? $cart[$vehicle] = $vehicle: $cart[$vehicle] =$vehicle;
            makeCookie("CART",serialize($cart));
            
        }
        if (isset($_POST["alquilar"]) && (isset($_COOKIE["CART"]) ))
        {
            $cart = unserialize($_COOKIE["CART"]);
            $vehiclesClient = getVehiclesClient();
            if (count(unserialize($_COOKIE["CART"])) + $vehiclesClient[0]["matricula"] > 3) {
                $message = "YA TIENE ALQUILADOS ". $vehiclesClient[0]["matricula"] ." VEHICULO/S, NO SE PUEDEN ALQUILAR MÁS DE 3 VEHICULOS <br> VACIE SU CESTA Y SELECCIONE " . (3 - $vehiclesClient[0]["matricula"] ) . " VEHICULO/S COMO MUCHO.";
            }else
            {
                $client = $_COOKIE['USERPASS'];
                $date = date("Y-m-d h:i:s", strtotime("+1 hour"));
                foreach ($cart as $vehicle => $veh) {
                    insertRalquileres($veh,$client,$date);
                    updateRvehiculos($veh);
                    $message = "SE HAN ALQUILADO EL VEHICULO CON LA MATRICULA $veh DE LA CESTA.";
                }
                deleteCart();
            }

        }
        if (isset($_POST["vaciar"]))
            deleteCart();
        
            
    }
require_once ("../view/alquilarView.php");

    
?>