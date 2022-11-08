<?php
    include_once("Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $id = $crudapi->escape_string($_GET['id']);
    $result = $crudapi->getData("SELECT * FROM `roles` WHERE ID=$id");

    foreach ($result as $res) {
        $ROLENAME = $res['ROLENAME'];
    }
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<br/><br/>
	
	<form name="form1" method="post" action="rolesaction.php">
		<table border="0">
			<tr> 
				<td>FName</td>
				<td><input type="text" name="ROLENAME" value="<?php echo $ROLENAME;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>