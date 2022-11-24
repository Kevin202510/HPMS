<?php

include_once("../Classes/CRUDAPI.php");
$crudapi = new CRUDAPI();

if(isset($_POST['parkHere'])) {	

    $C_FNAME = $crudapi->escape_string($_POST['C_FNAME']);
    $C_LNAME = $crudapi->escape_string($_POST['C_LNAME']);
    $PLATE_NUMBER = $crudapi->escape_string($_POST['PLATE_NUMBER']);
    $PARKING_SLOT_ID = $crudapi->escape_string($_POST['PARKING_SLOT_ID']);
      
    $result = $crudapi->execute("INSERT INTO parking_logs(PARKING_SLOT_ID,C_FNAME,C_LNAME,PLATE_NUMBER) VALUES('$PARKING_SLOT_ID','$C_FNAME','$C_LNAME','$PLATE_NUMBER')");

    $result = $crudapi->execute("UPDATE parking_slot SET PS_STATUS='1' WHERE PS_ID = '$PARKING_SLOT_ID' ");

    // echo '<script>alert("ADDED SUCCESS");</script>';
    // header("location: pointofsale.php");
    return 1;

  }

?>