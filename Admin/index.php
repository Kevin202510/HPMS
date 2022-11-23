<?php 
if (!session_id()) session_start();
if (!$_SESSION['logon']){ 
    echo "<script>alert('Unable To Access This Page Pls Login First!');</script>";
    header("Location:../index.php");
    die();
}
include_once("../Classes/CRUDAPI.php");
$crudapi = new CRUDAPI();
include("layouts/header.php");?>
<div class="wrapper">
  <?php include("layouts/navigationbar.php");?>
  <?php include("layouts/sidebar.php");?>
  <div class="content-wrapper" style="background:#D5D4D2;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboards</h1>
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6" >
            <!-- small box -->
           <div class="small-box" style="background: #26495c;" >
              <div class="inner">
           <?php  
       $query="SELECT * FROM parking_slot WHERE PS_STATUS = 0";
        $result = $crudapi->getData($query);
         ?>
         <h3 style="color: white;"><?php echo count($result); ?></h3>
                <p style="color: white;">Available Parking Slot</p>
              </div>
              <div class="icon">
                <i class="fa fa-book" style="color: white;"></i>
              </div>
              <a href="./pointofsale.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
           <div class="small-box " style="background: #c4a35a;" >
              <div class="inner">
                <h3 style="color: white;">24<sup style="font-size: 20px"></sup></h3>

                <p style="color: white;"> Parking Slot</p>
              </div>
              <div class="icon">
                <i style="color: white;" class="fa fa-parking"></i>
              </div>
              <a href="./parkingslot.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
           <div class="small-box "  style="background: #c66b3d;">
              <div class="inner">
              <?php  
       $query="SELECT * FROM parking_slot WHERE PS_STATUS = 1";
        $result = $crudapi->getData($query);
        

?>
<h3 style="color: white;"><?php echo count($result); ?></h3>

                <p style="color: white;">Vehicle Park-in</p>
              </div>
              <div class="icon">
                <i class="fa fa-car" style="color: white;"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
        
            <!-- small box -->
           <!-- <div class="small-box bg-info">
              <div class="inner">
                <h3>53<sup style="font-size: 20px"></sup></h3>

                <p>Total Vehicle Owner</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>-->
        <!-- /.row -->
        <!-- Main row -->
        <!--<div class="row">
      
     
        </div>-->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("layouts/footer.php");?>
</div>
<?php include("layouts/scripts.php");?>