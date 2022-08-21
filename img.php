<?php
    include('includes/header.php');
    include('includes/navbar.php');
    include('includes/connect.php');

    $mysql="SELECT DISTINCT name_ele FROM tb_image";
    $query=mysqli_query($conn,$mysql);
?>
<!-- **************************************************************** -->
<style>
.zoom {
    width: auto;
    height: 100px;
    cursor: pointer;
    -webkit-transition-property: all;
    -webkit-transition-duration: 0.3s;
    -webkit-transition-timing-function: ease;
}

.zoom:hover {
    transform: scale(2);
}
</style>

<div class="container">
    <h2 align="center">รูปภาพช้าง</h2></br></br>
    <form>
        <div class="form-row">
            <div class="form-group col-md-2" align="left">
                <label>ช้าง:</label>
                <select name="ele_imglist" id="ele_imglist" class="form-control">
                    <option value="" selected disabled>-กรุณาเลือกช้าง-</option>
                    <?php foreach ($query as $value) { ?>
                    <option value="<?=$value['name_ele']?>"><?=$value['name_ele']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-2" align="left">
                <label>ปี:</label>
                <select name="years_imglist" id="years_imglist" class="form-control">
                </select>
            </div>
            <div class="form-group col-md-2" align="left">
                <label>เดือน:</label>
                <select name="month_imglist" id="month_imglist" class="form-control">
                </select>
            </div>
            <div class="form-group col-md-2" align="left">
                <label>วัน:</label>
                <select name="day_imglist" id="day_imglist" class="form-control">
                </select>
            </div>
            <!-- <div class="form-group col-md-2" align="left">
                <label>เวลา:</label>
                <select name="time_imglist" id="time_imglist" class="form-control">
                </select>
            </div> -->

        </div>
        <div class="table-responsive text-nowrap">
            <table id="out_imglist" class="table table-striped" border="1" cellpadding="0" cellspacing="0"
                style="text-align:center" ; "vertical-align:middle" ;>
                <thead class="thead-dark" id="out_datalist">
                </thead>
            </table>
        </div>
</div>
</form>
<!-- **************************************************************** -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>