<?php
// including the database connection file
include_once("Classes/CRUDAPI.php");

$crudapi = new CRUDAPI();

if(isset($_POST['update']))
{	
	$id = $crudapi->escape_string($_POST['id']);
	$ROLENAME = $crudapi->escape_string($_POST['ROLENAME']);

    $result = $crudapi->execute("UPDATE roles SET ROLENAME='$ROLENAME' WHERE ID=$id");
    header("Location: roles.php");
}
?>