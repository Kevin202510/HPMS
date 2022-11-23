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

    if(isset($_POST['addNewPS'])) {	

      $PARKING_NAME = $crudapi->escape_string($_POST['PARKING_NAME']);
      $DESCRIPTION = $crudapi->escape_string($_POST['DESCRIPTION']);
        
      $result = $crudapi->execute("INSERT INTO parking_slot(PARKING_NAME,DESCRIPTION) VALUES('$PARKING_NAME','$DESCRIPTION')");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: parkingslot.php");
    }else if(isset($_POST['editPS'])) {	

      $PARKING_NAME = $crudapi->escape_string($_POST['PARKING_NAME']);
      $DESCRIPTION = $crudapi->escape_string($_POST['DESCRIPTION']);
      $PS_ID = $crudapi->escape_string($_POST['PS_ID']);
        
      $result = $crudapi->execute("UPDATE parking_slot SET PARKING_NAME='$PARKING_NAME',DESCRIPTION='$DESCRIPTION' WHERE PS_ID = '$PS_ID' ");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: parkingslot.php");
    }else if(isset($_POST['deletePS'])){
      $result = $crudapi->delete('PS_ID',$_POST['PS_ID'], 'parking_slot');
      echo '<script>alert("DELETED SUCCESS");</script>';
      header("location: parkingslot.php");
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
            <h1 class="m-0">Parking Slot</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Parking Slot</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#parkingslotModal" style="float:right;">ADD</button>
          </div>
          <div class="card-body">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">PARKING NAME</th>
                  <th scope="col">DESCRIPTION</th>
                  <th scope="col">STATUS</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $query = "SELECT * FROM `parking_slot`";
                  $result = $crudapi->getData($query);
                  $number = 1;
                  foreach ($result as $key => $data) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $number; ?></th>
                    <td><?php echo $data["PARKING_NAME"] ?></td>
                    <td><?php echo $data["DESCRIPTION"]; ?></td>
                    <td><?php
                        $status = "Available"; 
                        if($data["PS_STATUS"]==1){
                          $status = "Not Available";
                        }
                        echo $status ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-id="<?php echo $data['PS_ID']; ?>" class="btn btn-primary" id="editbtn">EDIT</button>
                        <button type="button" data-id="<?php echo $data['PS_ID']; ?>" class="btn btn-danger" id="deletebtn">DELETE</button>
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

    <div class="modal fade" id="parkingslotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Slot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="PS_ID" id="PS_ID">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>PARKING NAME</label>
                  <input type="text" class="form-control" name="PARKING_NAME" id="PARKING_NAME">
                </div>
                <div class="form-group col-md-6">
                  <label>DESCRIPTION</label>
                  <textarea class="form-control" name="DESCRIPTION" id="DESCRIPTION" rows="3"></textarea>
                </div>
              </div>

             

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addNewPS">Save changes</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END ADD MODAL -->

    <!-- EDIT MODAL -->

    <div class="modal fade" id="parkingslotEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Slot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="PS_ID" id="PS_ID_EDIT" >
             

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Parking Name</label>
                  <input type="text" class="form-control" name="PARKING_NAME" id="PARKING_NAME_EDIT">
                </div>
                <div class="form-group col-md-6">
                  <label>Description</label>
                  <textarea class="form-control" name="DESCRIPTION" id="DESCRIPTION_EDIT" rows="3"></textarea>
                </div>
              </div>

             

            

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editPS">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END EDIT MODAL -->

    <!-- DELETE MODAL -->

    <div class="modal fade" id="parkingslotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Slot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="PS_ID" id="PS_ID_DELETE">
              <p>ARE YOU SURE YOU WANT TO DELETE THIS SLOT?</p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="deletePS">Delete</button>
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
<script src="js/parkingslot.js"></script>