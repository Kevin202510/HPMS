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
  <div class="content-wrapper" style="background:#D5D4D2;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Parking Logs Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Parking Logs</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            
          </div>
          <div class="card-body">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">PARKING SLOT</th>
                  <th scope="col">CUSTOMER FULLNAME</th>
                  <th scope="col">PLATE NUMBER</th>
                  <th scope="col">PARKING TIME</th>
                  <th scope="col">PARKING TIME OUT</th>
                  <th scope="col">PAYMENT</th>
                  <th scope="col">STATUS</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $query = "SELECT * FROM `parking_logs` LEFT JOIN parking_slot ON parking_slot.PS_ID = parking_logs.PARKING_SLOT_ID";
                  $result = $crudapi->getData($query);
                  $number = 1;
                  foreach ($result as $key => $data) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $number; ?></th>
                    <td><?php echo $data["PARKING_NAME"] ?></td>
                    <td><?php echo $data["C_FNAME"]." ".$data["C_LNAME"] ?></td>
                    <td><?php echo $data["PLATE_NUMBER"] ?></td>
                    <td><?php echo date_format(date_create($data["PARKING_TIME"]),"M-d-y H:i:s A"); ?></td>
                    <td><?php 
                          if($data["PARKING_TIME_OUT"]===null){
                            echo $data["PARKING_TIME_OUT"];
                          }else{
                            echo date_format(date_create($data["PARKING_TIME_OUT"]),"M-d-y H:i:s A");
                          }
                        ?>
                    </td>
                    <td><?php echo $data["PAYMENT"] ?></td>
                    <?php 
                        $val = "Paid";
                        if($data["PL_STATUS"]==1){
                    ?>
                    <td><p style="color:red;"><?php echo "Not Paid"; ?></p></td>
                    <?php }else{?>
                    <td><p style="color:green;"><?php echo $val; ?></p></td>
                    <?php }?>
                    <td><a href="print-receipt.php?ID=<?php echo $number;?>">Print</a>
                    
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