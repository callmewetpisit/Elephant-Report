<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script> -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

const  month_arr = ["",
                            "มกราคม",
                            "กุมภาพันธ์",
                            "มีนาคม",
                            "เมษายน",
                            "พฤษภาคม",
                            "มิถุนายน",
                            "กรกฏาคม",
                            "สิงหาคม",
                            "กันยายน",
                            "ตุลาคม",
                            "พฤศจิกายน",
                            "ธันวาคม" ] ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย

    //function Update
    // function GetDetails(updateid){
    //     $('#hiddendata').val(updateid);

    //     $.post("index.php",{updateid:updateid},
    //     function(data,status){
    //         var userid=JSON.parse(data);
    //         $('#updatename').val(userid.id);
    //     });
    //     $('#updateModal').modal('show');
            
    // }

    $('#years_datalist').change(function(){
        var years = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {years:years,function:'years_datalist'},
            success: function(data){
                $('#month_datalist').html(data);
            }
        });
    });

    $('#month_datalist').change(function(){
        var years = $('#years_datalist').val();
        var month = $('#month_datalist').val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {
                month:month,
                years:years,
                function:'show_datalist'
            },
            success: function(data){
                $('#out_datalist').html(data);
            }
        });
    });

    $("#LineNoti").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "index.php",
            data: { 
                function:'LineNoti' 
            },
        });
    });

    $('#province').change(function(){
        var id_province = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {id:id_province,function:'province'},
            success: function(data){
                $('#amphures').html(data);
            }
        });
    });

    $('#amphures').change(function() {
        var id_amphures = $(this).val();
        $.ajax({
        type: "POST",
        url: "index.php",
        data: {id:id_amphures,function:'amphures'},
        success: function(data){
            $('#districts').html(data);  
        }
        });
    });

    $('#ele_imglist').change(function(){
        var ele_img = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {ele_img:ele_img,function:'years_imglist'},
            success: function(data){
                $('#years_imglist').html(data);
            }
        });
    });

    $('#years_imglist').change(function(){
        var ele_img = $('#ele_imglist').val();
        var years = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {ele_img:ele_img,years:years,function:'month_imglist'},
            success: function(data){
                $('#month_imglist').html(data);
            }
        });
    });

    $('#month_imglist').change(function(){
        var ele_img = $('#ele_imglist').val();
        var years = $('#years_imglist').val();
        var month = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {ele_img:ele_img,years:years,month:month,function:'day_imglist'},
            success: function(data){
                $('#day_imglist').html(data);
            }
        });
    });

    // $('#day_imglist').change(function(){
    //     var ele_img = $('#ele_imglist').val();
    //     var years = $('#years_imglist').val();
    //     var month = $('#month_imglist').val();
    //     var day = $(this).val();
    //     $.ajax({
    //         type: "post",
    //         url: "index.php",
    //         data: {ele_img:ele_img,years:years,month:month,day:day,function:'time_imglist'},
    //         success: function(data){
    //             $('#time_imglist').html(data);
    //         }
    //     });
    // });

    $('#day_imglist').change(function(){
        var ele_img = $('#ele_imglist').val();
        var years = $('#years_imglist').val();
        var month = $('#month_imglist').val();
        var day = $(this).val();
        $.ajax({
            type: "post",
            url: "index.php",
            data: {ele_img:ele_img,years:years,month:month,day:day,function:'show_imglist'},
            success: function(data){
                $('#out_imglist').html(data);
            }
        });
    });

    // $('#time_imglist').change(function(){
    //     var ele_img = $('#ele_imglist').val();
    //     var years = $('#years_imglist').val();
    //     var month = $('#month_imglist').val();
    //     var day = $('#day_imglist').val();
    //     var time = $(this).val();
    //     $.ajax({
    //         type: "post",
    //         url: "index.php",
    //         data: {ele_img:ele_img,years:years,month:month,day:day,time:time,function:'show_imglist'},
    //         success: function(data){
    //             $('#out_imglist').html(data);
    //         }
    //     });
    // });
    
    function ExportToExcel(fileExtension,fileName) {
        var fileName = "รายงานช้างออกเดือน " + month_arr[$('#month_datalist').val()] + " " + (parseInt($('#years_datalist').val())+543);
        var elt = document.getElementById('tbShowData');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return XLSX.writeFile(wb, fileName+"."+fileExtension || ('MySheetName.'+(fileExtension || 'xlsx')));
    }
</script>