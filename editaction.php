<?php
// including the database connection file
include_once("Classes/CRUDAPI.php");

$crudapi = new CRUDAPI();

if(isset($_POST['update']))
{	
	$id = $crudapi->escape_string($_POST['id']);
	$fname = $crudapi->escape_string($_POST['fname']);
	$lname = $crudapi->escape_string($_POST['lname']);
	$address = $crudapi->escape_string($_POST['address']);

    $result = $crudapi->execute("UPDATE users SET FNAME='$fname',LNAME='$lname',ADDRESS='$address' WHERE ID=$id");
    header("Location: index.php");
}
?>