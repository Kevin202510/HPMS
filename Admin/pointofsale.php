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

    if(isset($_POST['parkouthere'])) {	

      $PARKING_SLOT_ID = $crudapi->escape_string($_POST['PARKING_SLOT_ID']);
      $PARKING_LOGS_ID = $crudapi->escape_string($_POST['PARKING_LOGS_ID']);
      $PARKING_TIME_OUT = date_format(date_create($_POST['PARKING_TIME_OUT']),"Y-m-d H:i:s");
      $PAYMENT = $_POST['BALANCE_PARKOUT'];
       
      $PL_STATUS = 0;
        
      $result = $crudapi->execute("UPDATE parking_logs SET PARKING_TIME_OUT='$PARKING_TIME_OUT',PAYMENT='$PAYMENT',PL_STATUS='$PL_STATUS' WHERE PL_ID = '$PARKING_LOGS_ID' ");
      
      $result = $crudapi->execute("UPDATE parking_slot SET PS_STATUS='0' WHERE PS_ID = '$PARKING_SLOT_ID' ");
      echo '<script>alert("UPDATED SUCCESS");</script>';
      header("location: pointofsale.php");
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
            <h1 class="m-0">Point Of Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Point Of Sale</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
          <nav class="navbar navbar-light bg-light justify-content-end">
              <div class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Plate Number" name="PLATE_NUMBER" id="PLATE_NUMBER_SEARCH">
                <button class="btn btn-outline-success my-2 my-sm-0" id="parkout">Search</button>
              </div>
          </nav>
          </div>
          <div class="card-body">
          <div class="row d-flex justify-content-center">
          <?php 
                  $query = "SELECT * FROM `parking_slot`";
                  $result = $crudapi->getData($query);
                  // var_dump($result);
                  $number = 1;
                  foreach ($result as $key => $data) {
                    if($data["PS_STATUS"]==0){
              ?>
                <div class="card" style="width: 10rem; margin-right:15px;">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data["PARKING_NAME"] ?></h5>
                        <div class="justify-content-center">
                          <p class="card-text"><?php echo $data["DESCRIPTION"] ?></p>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-center">
                        <button style="background-color:#c66b3d;border:none;" type="button" class="btn btn-primary btn-sm" id="park" data-id="<?php echo $data["PS_ID"] ?>">Park</button>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="card" style="width: 10rem; margin-right:15px; background-color:#c4a35a;">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div style="color:white;"class="card-body">
                        <h5 class="card-title"><?php echo $data["PARKING_NAME"] ?></h5>
                        <div class="justify-content-center">
                          <p class="card-text"><?php echo $data["DESCRIPTION"] ?></p>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-center">
                        <p style="color:white;">Not Available</p>
                    </div>
                </div>
            <?php }$number++;}?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ADD MODAL -->

    <div class="modal fade" id="parking_logsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="formkoto">
              <input type="hidden" name="PARKING_SLOT_ID" id="PARKING_SLOT_ID">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Parking Name</label>
                  <input type="text" class="form-control" name="PARKING_NAME" id="PARKING_NAME" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Plate Number</label>
                  <input type="text" class="form-control" name="PLATE_NUMBER" id="PLATE_NUMBER">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Customer Firstname</label>
                  <input type="text" class="form-control" name="C_FNAME" id="C_FNAME">
                </div>
                <div class="form-group col-md-6">
                  <label>Customer Lastname</label>
                  <input type="text" class="form-control" name="C_LNAME" id="C_LNAME">
                </div>
              </div>

              <input type="hidden" name="parkHere">

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="savemona" class="btn btn-primary">Save changes</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END ADD MODAL -->

    <!-- PARK OUT -->

    <div class="modal fade" id="parkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Park Out</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="PARKING_SLOT_ID" id="PARKING_SLOT_ID_PARKOUT">
              <input type="hidden" name="PARKING_LOGS_ID" id="PARKING_LOGS_ID_PARKOUT">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Parking Name</label>
                  <input type="text" class="form-control" name="PARKING_NAME" id="PARKING_NAME_PARKOUT" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Plate Number</label>
                  <input type="text" class="form-control" name="PLATE_NUMBER" id="PLATE_NUMBER_PARKOUT" disabled>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Customer Firstname</label>
                  <input type="text" class="form-control" name="C_FNAME" id="C_FNAME_PARKOUT" disabled>
                </div>
                <div class="form-group col-md-6">
                  <label>Customer Lastname</label>
                  <input type="text" class="form-control" name="C_LNAME" id="C_LNAME_PARKOUT" disabled>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Parking Time</label>
                  <input type="text" class="form-control" id="PARKING_TIME_PARKOUT" disabled>
                </div>
                <div class="form-group col-md-4">
                  <label>Parking Out</label>
                  <input type="text" class="form-control" name="PARKING_TIME_OUT" id="PARKING_TIME_OUT_PARKOUT" readonly="readonly" >
                </div>
                <div class="form-group col-md-4">
                  <label>Total Hours</label>
                  <input type="number" class="form-control" id="TOTAL_HR_PARKOUT" disabled>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Total Balance</label>
                  <input type="number" class="form-control" id="BALANCE_PARKOUT" name="BALANCE_PARKOUT" readonly="readonly" >
                </div>
                <div class="form-group col-md-6">
                  <label>Payment</label>
                  <input type="number" class="form-control" name="PAYMENT" id="PAYMENT_PARKOUT">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="parkouthere" id="parkHere">Park Out</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END PARK OUT -->
  </div>
  
  <?php include("layouts/footer.php");?>
</div>
<?php include("layouts/scripts.php");?>
<script src="js/pos.js"></script>
