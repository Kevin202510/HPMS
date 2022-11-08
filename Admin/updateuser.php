<?php 
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $USER_ID = $crudapi->escape_string($_POST['USER_ID']);
    $result = $crudapi->getData("SELECT * FROM `users` WHERE USER_ID=$USER_ID");
    echo json_encode($result);
?>