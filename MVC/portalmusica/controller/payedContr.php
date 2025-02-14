<?php
require_once ("cookieContr.php");
    compCookie();
require_once ("../view/payedView.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    if (isset($_POST["Volver"]))
        header("Location: ../controller/welcomeContr.php");
?>
<?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $merchantParameters = $_GET['Ds_MerchantParameters'];
        $signature = $_GET['Ds_Signature'];
        $signatureVersion = $_GET['Ds_SignatureVersion'];
    }else
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $merchantParameters = $_POST['Ds_MerchantParameters'];
            $signature = $_POST['Ds_Signature'];
            $signatureVersion = $_POST['Ds_SignatureVersion'];
        }
    $data = base64_decode($merchantParameters);
    $decodedData = json_decode($data, true);
    $amount = number_format($decodedData['Ds_Amount']/100,2);
    $order = $decodedData['Ds_Order'];
    $card_country = $decodedData['Ds_Card_Country'];
    $idClient = $_COOKIE["USERPASS"];
    require_once("../model/paymentModel.php");

    insertPayed($idClient,$amount,$order,$card_country);
    deleteCart();
    
?>