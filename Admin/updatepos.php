<?php 
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $PLATE_NUMBER = $crudapi->escape_string($_POST['PLATE_NUMBER']);
    $result = $crudapi->getData("SELECT * FROM `parking_logs` LEFT JOIN `parking_slot` ON parking_slot.PS_ID = parking_logs.PARKING_SLOT_ID WHERE PLATE_NUMBER='$PLATE_NUMBER' AND PL_STATUS!=0");
    echo json_encode($result);
?>