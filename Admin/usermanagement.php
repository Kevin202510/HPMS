  <!-- PHP FUNCTION CRUD START-->
  <?php 
  
  if (!session_id()) session_start();
if (!$_SESSION['logon']){ 
    echo "<script>alert('Unable To Access This Page Pls Login First!');</script>";
    header("Location:../index.php");
    die();
}

    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();

    if(isset($_POST['addNewEmployee'])) {	

      $FNAME = $crudapi->escape_string($_POST['FNAME']);
      $LNAME = $crudapi->escape_string($_POST['LNAME']);
      $ADDRESS = $crudapi->escape_string($_POST['ADDRESS']);
      $CONTACT = $crudapi->escape_string($_POST['CONTACT']);
      $USERNAME = $crudapi->escape_string($_POST['USERNAME']);
      $PASSWORD = $crudapi->escape_string($_POST['PASSWORD']);
      $ROLE_ID = $crudapi->escape_string($_POST['ROLE_ID']);
        
      $result = $crudapi->execute("INSERT INTO users(ROLE_ID,FNAME,LNAME,ADDRESS,CONTACT,USERNAME,PASSWORD) VALUES('$ROLE_ID','$FNAME','$LNAME','$ADDRESS','$CONTACT','$USERNAME','$PASSWORD')");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: usermanagement.php");
    }else if(isset($_POST['editEmployee'])) {	

      $FNAME = $crudapi->escape_string($_POST['FNAME']);
      $LNAME = $crudapi->escape_string($_POST['LNAME']);
      $ADDRESS = $crudapi->escape_string($_POST['ADDRESS']);
      $CONTACT = $crudapi->escape_string($_POST['CONTACT']);
      $USERNAME = $crudapi->escape_string($_POST['USERNAME']);
      $PASSWORD = $crudapi->escape_string($_POST['PASSWORD']);
      $ROLE_ID = $crudapi->escape_string($_POST['ROLE_ID']);
      $USER_ID = $crudapi->escape_string($_POST['USER_ID']);
        
      $result = $crudapi->execute("UPDATE users SET ROLE_ID='$ROLE_ID',FNAME='$FNAME',LNAME='$LNAME',ADDRESS='$ADDRESS',CONTACT='$CONTACT',USERNAME='$USERNAME',PASSWORD='$PASSWORD' WHERE USER_ID = '$USER_ID' ");

      echo '<script>alert("UPDATED SUCCESS");</script>';
      header("location: usermanagement.php");
    }else if(isset($_POST['deleteEmployee'])){
      $result = $crudapi->delete('USER_ID',$_POST['USER_ID'], 'users');
      echo '<script>alert("DELETED SUCCESS");</script>';
      header("location: usermanagement.php");
    }


  ?>
  <!-- PHP FUNCTION CRUD END -->

<?php include("layouts/header.php");?>
<div class="wrapper">
  <?php include("layouts/navigationbar.php");?>
  <?php include("layouts/sidebar.php");?>
  <div class="content-wrapper" style="background:#D5D4D2;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#usersModal" style="float:right;">ADD</button>
          </div>
          <div class="card-body">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ROLENAME</th>
                  <th scope="col">FULLNAME</th>
                  <th scope="col">ADDRESS</th>
                  <th scope="col">CONTACT</th>
                  <th scope="col">USERNAME</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $query = "SELECT * FROM `users` LEFT JOIN roles ON roles.ID = users.ROLE_ID where users.ROLE_ID != 1";
                  $result = $crudapi->getData($query);
                  // var_dump($result);
                  $number = 1;
                  foreach ($result as $key => $data) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $number; ?></th>
                    <td><?php echo $data["ROLENAME"] ?></td>
                    <td><?php echo strtoupper($data["FNAME"]." ".$data["LNAME"]); ?></td>
                    <td><?php echo strtoupper($data["ADDRESS"]) ?></td>
                    <td><?php echo $data["CONTACT"] ?></td>
                    <td><?php echo $data["USERNAME"] ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-id="<?php echo $data['USER_ID']; ?>" class="btn btn-primary" style="background:#c4a35a; border:none;" id="editbtn">EDIT</button>
                        <button type="button" data-id="<?php echo $data['USER_ID']; ?>" class="btn btn-danger" style="background:#234E57; border:none;" id="deletebtn">DELETE</button>
                      </div>
                    </td>
                  </tr>
                <?php $number++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <!-- ADD MODAL -->

    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="ROLE_ID" id="ROLE_ID" value="2">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Firstname</label>
                  <input type="text" class="form-control" name="FNAME" id="FNAME">
                </div>
                <div class="form-group col-md-6">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="LNAME" id="LNAME">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Address</label>
                  <input type="text" class="form-control" name="ADDRESS" id="ADDRESS">
                </div>
                <div class="form-group col-md-6">
                  <label>Contact</label>
                  <input type="text" class="form-control" name="CONTACT" id="CONTACT">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Username</label>
                  <input type="text" class="form-control" name="USERNAME" id="USERNAME">
                </div>
                <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="password" class="form-control" name="PASSWORD" id="PASSWORD">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addNewEmployee">Save changes</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END ADD MODAL -->

    <!-- EDIT MODAL -->

    <div class="modal fade" id="usersEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="editemployee">
              <input type="hidden" name="ROLE_ID" id="ROLE_ID_EDIT" value="2">
              <input type="hidden" name="USER_ID" id="USER_ID_EDIT">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Firstname</label>
                  <input type="text" class="form-control" name="FNAME" id="FNAME_EDIT">
                </div>
                <div class="form-group col-md-6">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="LNAME" id="LNAME_EDIT">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Address</label>
                  <input type="text" class="form-control" name="ADDRESS" id="ADDRESS_EDIT">
                </div>
                <div class="form-group col-md-6">
                  <label>Contact</label>
                  <input type="text" class="form-control" name="CONTACT" id="CONTACT_EDIT">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Username</label>
                  <input type="text" class="form-control" name="USERNAME" id="USERNAME_EDIT">
                </div>
                <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="password" class="form-control" name="PASSWORD" id="PASSWORD_EDIT">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editEmployee">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END EDIT MODAL -->

    <!-- DELETE MODAL -->

    <div class="modal fade" id="usersDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="USER_ID" id="USER_ID_DELETE">
              <p>ARE YOU SURE YOU WANT TO DELETE THIS EMPLOYEE?</p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="deleteEmployee">Delete</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END DELETE MODAL -->
    

    

  </div>
  
  <?php include("layouts/footer.php");?>
</div>
<?php include("layouts/scripts.php");?>
<script src="js/usermanagement.js"></script>
