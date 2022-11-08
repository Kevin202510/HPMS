<?php
    include_once("Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();
    $id = $crudapi->escape_string($_GET['id']);
    $result = $crudapi->getData("SELECT * FROM `users` WHERE ID=$id");

    foreach ($result as $res) {
        $fname = $res['FNAME'];
        $lname = $res['LNAME'];
        $address = $res['ADDRESS'];
    }
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<br/><br/>
	
	<form name="form1" method="post" action="editaction.php">
		<table border="0">
			<tr> 
				<td>FName</td>
				<td><input type="text" name="fname" value="<?php echo $fname;?>"></td>
			</tr>
			<tr> 
				<td>LNAME</td>
				<td><input type="text" name="lname" value="<?php echo $lname;?>"></td>
			</tr>
			<tr> 
				<td>ADDRESS</td>
				<td><input type="text" name="address" value="<?php echo $address;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>