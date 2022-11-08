<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HPMS</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Username</th>
            </tr>
        </thead>
            <?php 
                include_once("Classes/CRUDAPI.php");
                $crudapi = new CRUDAPI();
                $query = "SELECT * FROM `users` LEFT JOIN roles ON roles.ID = users.ROLE_ID where users.ROLE_ID != 1";
                $result = $crudapi->getData($query);
                $index = 1;
                foreach ($result as $key => $data) {
            ?>

                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $data["FNAME"]." ".$data["LNAME"]; ?></td>
                    <td><?php echo $data["ADDRESS"] ?></td>
                    <td><?php echo $data["CONTACT"] ?></td>
                    <td><?php echo $data["USERNAME"] ?></td>
                    <td><a href="edituser.php?id= <?php $data["ID"]; ?>">Edit</a></td>
                </tr>

            <?php 
                } 
            ?>
    </table>
    
</body>
</html>