
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
require_once("includes/connect.php");
include('includes/header.php');
include('includes/navbar.php');
$sql = "SELECT * FROM `tb_user`";
$result = mysqli_query($conn,$sql);

if(isset($_GET['del'])){
    $User_ID = $_GET['del'];
    $sqldel="delete from `tb_user` where id= '$User_ID'";
	$result1=mysqli_query($conn,$sqldel);

    header("location:user.php");
    exit();
}
?>

<div class = "container">
<p align="right">
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completeModal">
    เพิ่มข้อมูล
    </button> -->
    

    <div id="displayDataTable">dd</div>
</p>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Elephant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="completename">Name</label>
            <input type="name" class="form-control" id="completename" placeholder="Enter name elephant">
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick = addElephant()>Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="text" value="1">
      </div>
    </div>
  </div>
</div> -->


<!-- update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="completename">ชื่อ-นามสกุล</label>
            <input type="name" class="form-control" id="updatename" placeholder="Enter name elephant" readonly>
        </div>
        <div class="form-group">
            <label for="completename">สถานะ</label>
            <!-- <input type="name" class="form-control" id="updatstatus" placeholder="Enter status"> -->
            <select name="" class="form-control " id="updatestatus">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
			</select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="updateDetaisls()" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        displayData();
    });
    // function add
    function addElephant(){
        var nameAdd = $('#completename').val();

        $.ajax({
            url:"display_user.php",
            type: 'post',
            data:{
                nameSend:nameAdd
            },
            success:function (data,status) {
                //console.log(status);
                $('#completeModal').modal('hide');
                displayData();
            }
        })
    }

    // function display
    function displayData(){
        var displayData = "true";
        $.ajax({
            url:"display_user.php",
            type:'post',
            data:{
                displaySend:displayData
            },
            success:function(data,status) {
                // console.log(status);
                $('#displayDataTable').html(data);
            }
        })
    }

    //function Delete
    function DeleteEle(deleteid){
        $.ajax({
            url:"display_user.php",
            type:'post',
            data:{
                deletesend:deleteid
            },
            success:function(data,status){
                displayData();
            }
        });
    }

    //function Update
    function GetDetails(updateid){
        $('#hiddendata').val(updateid);

        $.post("display_user.php",{updateid:updateid},
        function(data,status){
            var userid=JSON.parse(data);
            $('#updatename').val(userid.First_name+" "+userid.Last_name);
            $('#updatestatus').val(userid.Status);
        });
        $('#updateModal').modal('show');
        
    }

    //onclick update event function
    function updateDetaisls() {
        var updatestatus=$('#updatestatus').val();
        var hiddendata=$('#hiddendata').val();
        
        $.post("display_user.php",{
            updatestatus:updatestatus,
            hiddendata:hiddendata
        },function(data,status){
            $('#updateModal').modal('hide');
            displayData();
        });
    }
</script>

    


<?php
    // include('includes/scripts.php');
    include('includes/footer.php');
?>