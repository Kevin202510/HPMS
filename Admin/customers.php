  <!-- PHP FUNCTION CRUD START-->
  <?php 
  
    include_once("../Classes/CRUDAPI.php");
    $crudapi = new CRUDAPI();

    if(isset($_POST['addNewCustomer'])) {	

      $C_FNAME = $crudapi->escape_string($_POST['C_FNAME']);
      $C_LNAME = $crudapi->escape_string($_POST['C_LNAME']);
      $result = $crudapi->execute("INSERT INTO customers(C_FNAME,C_LNAME) VALUES('$C_FNAME','$C_LNAME')");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: customers.php");
    }else if(isset($_POST['editCustomer'])) {	
      
      $CID = $crudapi->escape_string($_POST['CID']);
      $C_FNAME = $crudapi->escape_string($_POST['C_FNAME']);
      $C_LNAME = $crudapi->escape_string($_POST['C_LNAME']);
      $result = $crudapi->execute("UPDATE customers SET C_FNAME='$C_FNAME',C_LNAME='$C_LNAME'WHERE CID = '$CID' ");

      echo '<script>alert("ADDED SUCCESS");</script>';
      header("location: customers.php");

    }else if(isset($_POST['deleteCustomer'])){
      $result = $crudapi->delete('CID',$_POST['CID'], 'customers');
      echo '<script>alert("DELETED SUCCESS");</script>';
      header("location: customers.php");
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
                  <th scope="col">CUSTOMER ID</th>
                  <th scope="col">CUSTOMER FIRST NAME</th>
                  <th scope="col">CUSTOMER LAST NAME</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $query = "SELECT * FROM `customers`";
                  $result = $crudapi->getData($query);
                  $number = 1;
                  foreach ($result as $key => $data) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $number; ?></th>
                    <td><?php echo $data["C_FNAME"] ?></td>
                    <td><?php echo $data["C_LNAME"] ?></td>
                   
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-id="<?php echo $data['CID']; ?>" class="btn btn-primary" id="editbtn">EDIT</button>
                        <button type="button" data-id="<?php echo $data['CID']; ?>" class="btn btn-danger" id="deletebtn">DELETE</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="CID" id="CID">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Customer First Name</label>
                  <input type="text" class="form-control" name="C_FNAME" id="C_FNAME">
                </div>
                <div class="form-group col-md-6">
                  <label>Customert Last Name</label>
                  <input type="text" class="form-control" name="C_LNAME" id="C_LNAME">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addNewCustomer">Save changes</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END ADD MODAL -->

    <!-- EDIT MODAL -->

    <div class="modal fade" id="CustomerEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Parking Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="CID" id="CID_EDIT">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Customer First Name</label>
                  <input type="text" class="form-control" name="C_FNAME" id="C_FNAME_EDIT">
                </div>
                </div>
                <div class="form-group col-md-6">
                  <label>Customer Last Name</label>
                  <input type="text" class="form-control" name="C_LNAME" id="C_LNAME_EDIT">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editCustomer">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END EDIT MODAL -->

    <!-- DELETE MODAL -->

    <div class="modal fade" id="CustomerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Parking Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="CID" id="CID_Delit">
              <p>ARE YOU SURE YOU WANT TO DELETE THIS customer?</p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="deleteCustomer">Delete</button>
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
<script src="js/customers.js"></script>