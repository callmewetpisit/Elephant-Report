   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<?php
  if($_SESSION['status'] == 'Admin'){
?>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">

<?php
  }else{
    ?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="add_data.php">
<?php
  }
?>
  <div class="sidebar-brand-icon">
  <i class='bx bxl-postgresql'></i>
  <!-- <img class="img-profile rounded-circle" src="img/Khaoyai-Logo.ico"> -->
  
  </div>
  <!-- <div class="sidebar-brand-text mx-3">FUNDA <sup>WEB IT</sup></div> -->
  <div class="sidebar-brand-text mx-3">รายงานช้างออกนอกพื้นที่</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<div class="sidebar-heading">
  Interface
</div>

<?php
  if($_SESSION['status'] == 'Admin'){
    
?>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="home.php">
        <i class='bx bx-table'></i>
        <span class="links_name">ตารางข้อมูล</span>
    </a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="img.php">
        <i class='bx bx-image-alt'></i>
        <span class="links_name">ตารางภาพช้าง</span>
    </a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="editlinenoti.php">
      <i class='bx bxs-notification'></i>
        <span class="links_name">การจัดการ Token Line</span>
    </a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="manageuser.php">
        <i class='bx bx-file'></i>
        <span class="links_name">การจัดการผู้ใช้งาน</span>
    </a>
</li>

<?php
  }
?>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="add_data.php">
        <i class='bx bxs-file-plus'></i>
        <span class="links_name">เพิ่มข้อมูล</span>
    </a>
</li>

<!-- Divider -->
<!-- <hr class="sidebar-divider my-0"> -->

<!-- Nav Item - Dashboard -->
<!-- <li class="nav-item active">
    <a class="nav-link" href="logout.php">
        <i class='bx bx-log-out'></i>
        <span class="links_name">ออกจากระบบ</span>
    </a>
</li> -->


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
               <?=$_SESSION["fname"];?>
                  
                </span>
                <?php
                  if($_SESSION['status'] == 'Admin'){
                    ?>
                    <img class="img-profile rounded-circle" src="img/profile/alpha_a_circle_icon_136977.png">
                <?php
                  }else{
                    ?>
                    <img class="img-profile rounded-circle" src="img/profile/alpha_u_circle_icon_136964.png">
                <?php
                  }
                ?>
                
              </a>
              <!-- Dropdown - User Information -->
              <?php
                echo '<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EditModal" onclick="GetEditDetail('.$_SESSION["id"].')">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  แก้ไขโปรไฟล์
                </a>';
                ?>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  ออกจากระบบ
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">คุณต้องการออกจากระบบใช่หรือไม่?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>

          <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">ออกจากระบบ</button>

          </form>


        </div>
      </div>
    </div>
  </div>


  <!-- update Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขโปรไฟล์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="completename">ชื่อ</label>
            <input type="name" class="form-control" id="Editname"  >
        </div>
        <div class="form-group">
            <label for="completename">นามสกุล</label>
            <input type="name" class="form-control" id="EditSname"  >
        </div>
        <div class="form-group">
            <label for="completename">หน่วยงาน</label>
            <input type="name" class="form-control" id="EditAgency"  >
        </div>
        <div class="form-group">
            <label for="completename">ตำแหน่ง</label>
            <input type="name" class="form-control" id="EditRank" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="EditDetail()" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" id="hiddenEditData">
      </div>
    </div>
  </div>
</div>

<script>
  //function Update
  function GetEditDetail(updateid){
        $('#hiddenEditData').val(updateid);

        $.post("display_user.php",{updateid:updateid},
        function(data,status){
            var userid=JSON.parse(data);
            $('#Editname').val(userid.First_name);
            $('#EditSname').val(userid.Last_name);
            $('#EditAgency').val(userid.Agency);
            $('#EditRank').val(userid.Rank);
        });
        $('#EditModal').modal('show');
        
    }

  //onclick update event function
  function EditDetail() {
        var Editname=$('#Editname').val();
        var EditSname=$('#EditSname').val();
        var EditAgency=$('#EditAgency').val();
        var EditRank=$('#EditRank').val();
        var hiddenEditData=$('#hiddenEditData').val();
        
        $.post("display_user.php",{
            Editname:Editname,
            EditSname:EditSname,
            EditAgency:EditAgency,
            EditRank:EditRank,
            hiddenEditData:hiddenEditData
        },function(data,status){
          $('#EditModal').modal('hide');
        });
        location.reload();
    }

</script>