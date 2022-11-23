<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../dist/img/parking_PNG81.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Parking Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background:#0E1319;">
      <!-- Sidebar user panel (optional) -->
   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
    <img src="../dist/img/Person Icon_12.webp" class="img-square elevation-3"  alt="User Image">   </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['fullname'];?> </a>
        </div>

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link" id="dashsidebtn">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usermanagement.php" class="nav-link" id="usersidebtn">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
               User Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="parkingslot.php" class="nav-link" id="pssidebtn">
              <i class="nav-icon fas fa-parking"></i>
              <p>
                Parking Slots
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="parkinglogs.php" class="nav-link" id="plsidebtn">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Parking Logs
              </p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="pointofsale.php" class="nav-link" id="possidebtn">
              <i class="nav-icon fas fa-vote-yea"></i>
              <p>
               Point Of Sale
              </p>
            </a>
          </li>

          <br>
          <div class="row justify-content-center" >
            <form method="post">
            <input type="submit" class="nav-link" style="background-color:red; color:white; border:none;" name="logout" value="logout">
          </form>
          </div>

          


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>