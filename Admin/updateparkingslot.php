<?php 
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $PS_ID = $crudapi->escape_string($_POST['PS_ID']);
    $result = $crudapi->getData("SELECT * FROM `parking_slot` WHERE PS_ID=$PS_ID");
    echo json_encode($result);
?>