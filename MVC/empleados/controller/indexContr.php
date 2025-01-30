<?php
    require_once("model/indexModel.php");
    if (isset($_COOKIE["USERPASS"])) {
        $dept = getDeptIndex($_COOKIE["USERPASS"]);
    }
    
?>