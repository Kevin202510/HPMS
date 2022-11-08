  <!-- PHP FUNCTION CRUD START-->
  <?php 
  
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
        
      $result = $crudapi->execute("UPDATE users SET ROLE_ID='$ROLE_ID',FNAME='$FNAME',LNAME='$LNAME',ADDRESS='$ADDRESS',CONTACT='$CONTACT',USERNAME='$USERNAME',PASSWORD='$PASSWORD' WHERE ID = ");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: usermanagement.php");
    }


  ?>
  <!-- PHP FUNCTION CRUD END -->

<?php include("layouts/header.php");?>
<div class="wrapper">
  <?php include("layouts/navigationbar.php");?>
  <?php include("layouts/sidebar.php");?>
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
                  <th scope="col">PARKING_SLOT_ID</th>
                  <th scope="col">CUSTOMER_ID</th>
                  <th scope="col">PLATE_NUMBER</th>
                  <th scope="col">PARKING_TIME</th>
                  <th scope="col">PARKING_TIME_OUT</th>
                  <th scope="col">PAYMENT</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $query = "SELECT * FROM `parking_logs`";
                  $result = $crudapi->getData($query);
                  $number = 1;
                  foreach ($result as $key => $data) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $number; ?></th>
                    <td><?php echo $data["PARKING_SLOT_ID"] ?></td>
                    <td><?php echo $data["CUSTOMER_ID"] ?></td>
                    <td><?php echo $data["PLATE_NUMBER"] ?></td>
                    <td><?php echo $data["PARKING_TIME"] ?></td>
                    <td><?php echo $data["PARKING_TIME_OUT"] ?></td>
                    <td><?php echo $data["PAYMENT"] ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-toggle="modal" data-target="#usersEditModal" data-id="<?php echo $data['ID']; ?>" class="btn btn-primary" id="editbtn">EDIT</button>
                        <button type="button" data-toggle="modal" data-target="#usersDeleteModal" data-id="<?php echo $data['ID']; ?>" class="btn btn-danger" id="deletebtn">DELETE</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Add New Parking Logs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="ID" id="ID">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>PARKING TIME OUT</label>
                  <input type="date" class="form-control" name="PARKING_TIME_OUT" id="PARKING_TIME_OUT">
                </div>
                <div class="form-group col-md-6">
                  <label>PAYMENT</label>
                  <input type="number" class="form-control" name="PAYMENT" id="PAYMENT">
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Parking Logs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
             <input type="hidden" name="ID" id="ID">
              <input type="hidden" name="PARKING_SLOT_ID" id="PARKING_SLOT_ID">
              <input type="hidden"  name="CUSTOMER_ID" id="CUSTOMER_ID">
              
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>PARKING TIME OUT</label>
                  <input type="date" class="form-control" name="PARKING_TIME_OUT" id="PARKING_TIME_OUT">1 PARKING_SLOT_ID 2 CUSTOMER_ID 3PLATE_NUMBER 4 PARKING_TIME_OUT 5 PAYMENT
                </div>
                <div class="form-group col-md-6">
                  <label>PAYMENT</label>
                  <input type="number" class="form-control" name="PAYMENT" id="PAYMENT">
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
            <h5 class="modal-title" id="exampleModalLabel">Delete Parking Logs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="ID" id="ID">
              <p>ARE YOU SURE YOU WANT TO DELETE THIS PARKING LOGS?</p>
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

<script>
  $( window ).load(function() {
    alert("asdasd");
  });
</script>