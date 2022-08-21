<?php
    include('includes/header.php');
    include('includes/navbar.php');
    include('includes/connect.php');
    

    $mysql="SELECT DISTINCT YEAR(date) FROM tb_show";
    $resyear=mysqli_query($conn,$mysql);

    $sql_nameele = "SELECT * FROM `tb_elephant`";
    $resele = mysqli_query($conn, $sql_nameele);

    $sql_provinces = "SELECT * FROM `tb_province`";
    $query = mysqli_query($conn, $sql_provinces);

    $sql_damage = "SELECT * FROM `tb_damage`";
    $query1 = mysqli_query($conn, $sql_damage);
?>

<!-- https://www.youtube.com/watch?v=ctpNfiLSrhM&list=PLRheCL1cXHrvTkUenAc5GdEvqIpVX-2JJ&index=2 -->

<div class="container">
    <h2 align="center">รายงานช้างออกนอกพื้นที่</h2></br></br>
    <form>
        <div class="form-row">
            <div class="form-group col-md-2" align="left">
                <!-- <label>ปี:</label> -->
                <select name="c" id="years_datalist" class="form-control">
                    <option value="" selected disabled>-กรุณาเลือกปี-</option>
                    <?php foreach ($resyear as $value) { ?>
                    <option value="<?=$value['YEAR(date)']?>"><?=($value['YEAR(date)']+543)?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-2" align="left">
                <!-- <label>เดือน:</label> -->
                <select name="month_datalist" id="month_datalist" class="form-control">
                </select>
            </div>

            <div class="form-group col-md-8" align="right">
                <!-- <input type="button" id="LineNoti" name="LineNoti" value="Line"> -->
                <button id="LineNoti" class="btn btn-success" name="LineNoti">
                    <span class="glyphicon glyphicon-download"></span>
                    Line
                </button>
                <button id="btnExport" class="btn btn-primary" onclick="ExportToExcel('xlsx','myfile')">
                    <span class="glyphicon glyphicon-download"></span>
                    Download list
                </button>
            </div>
        </div>
    </form>
    <div class="table-responsive text-nowrap">
        <table id="tbShowData" class="table table-striped" border="1" cellpadding="0" cellspacing="0"
            style="text-align:center" ; "vertical-align:middle" ;>
            <thead class="thead-dark" id="out_datalist">
            </thead>
        </table>
    </div>
</div>
    
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>