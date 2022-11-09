<?php 
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $CID = $crudapi->escape_string($_POST['CID']);
    $result = $crudapi->getData("SELECT * FROM `customers` WHERE CID=$CID");
    echo json_encode($result);
?>