
<?php
    include('includes/header.php');
    include('includes/connect.php');
    include('includes/navbar.php');

    $sql_nameele = "SELECT * FROM `tb_elephant`";
	$resele = mysqli_query($conn, $sql_nameele);
		
	$sql_provinces = "SELECT * FROM `tb_province`";
	$query = mysqli_query($conn, $sql_provinces);

	$sql_damage = "SELECT * FROM `tb_damage`";
	$query1 = mysqli_query($conn, $sql_damage);

	$sql_user = "SELECT * FROM `tb_user`";
	$query2 = mysqli_query($conn, $sql_user);

	// $sql_user = "SELECT * FROM `tb_agency`";
	// $query3 = mysqli_query($conn, $sql_user);

	date_default_timezone_set("Asia/Bangkok");
    ?>
    <div class="container">
        <section class="mt-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">วันที่</label>
                                <input type="date"  class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time">เวลา</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_ele">ชื่อช้าง</label>
                                <select name="name_ele[]" class="form-control selectpicker" multiple data-live-search="true">
                                    <option value="ไม่ทราบ">ไม่ทราบ</option>
                                    <?php foreach ($resele as $value) { ?>
										<option value="<?=$value['name']?>"><?=$value['name']?></option>
									<?php } ?>
								</select>
                                <!-- <input list="name_ele" name="name_ele" class="form-control" placeholder="ช้าง"/>
                                <datalist id="name_ele">
                                    <select name="name_ele[]" id="name_ele" class="form-control" multiple>
                                        <option value="ไม่ทราบ">ไม่ทราบ</option>
                                        <?php foreach ($resele as $value) { ?>
                                            <option value="<?=$value['name']?>"><?=$value['name']?></option>
                                        <?php } ?>
                                    </select>
                                </datalist> -->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="num_ele">จำนวน</label>
                                <input type="text" class="form-control" id="num_ele" name="num_ele" placeholder="กรอกจำนวน">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    *หากเลือกช้างมากกว่า 1 ตัวให้กรอกจำนวนตัวที่ออก อย่างเช่น เลือก 3 ชื่อออกชื่อละ 1 ตัวให้กรอก 1
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_ele">เพิ่มช้าง</label>
                                <input type="text" class="form-control" name="insert_ele" id="insert_ele" placeholder="เพิ่มชื่อช้าง">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    *หากช้างไม่มีชื่อช้างสามารถกรอกเพิ่มชื่อตรงช่องนี้
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="num_ele">จำนวน</label>
                                <input type="text" class="form-control" id="inset_num_ele" name="inset_num_ele" placeholder="กรอกจำนวน">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">ช้างเข้า</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="E" id="location_in_E" name="location_in_E">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="N" id="location_in_N" name="location_in_N">
                            </div>
                            <div class="col">
                                <input type="button" onclick="convertLatLngtoUTM(1)" value="ยืนยันพิกัดช้างเข้า">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">ช้างออก</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="E" id="location_out_E" name="location_out_E">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="N" id="location_out_N" name="location_out_N">
                            </div>
                            <div class="col">
                                <input type="button" onclick="convertLatLngtoUTM(2)" value="ยืนยันพิกัดช้างออก">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">พิกัดความเสียหาย</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="E" id="E" name="E">                                
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="N" id="N" name="N">
                            </div>
                            <div class="col">
                                <input type="button" onclick="convertLatLngtoUTM(3)" value="พิกัดความเสียหาย">                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="map_canvas"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">ความเสียหาย</div>
                            <div class="col-sm-10">
                            <?php foreach ($query1 as $value) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="<?=$value['id']?>" id="<?=$value['id']?>">
                                    <label class="form-check-label" for="che_<?=$value['id']?>">
                                    <?=$value['damage']?>
                                    </label>
                                    <?php
                                        if($value['id'] == '1'){
                                            echo "<input type='text' class='form-control' name='text_{$value['id']}' id='text_{$value['id']}' readonly >";
                                        }
                                        elseif($value['id'] != '9'){
                                            echo "<input type='text' class='form-control' name='text_{$value['id']}' id='text_{$value['id']}' >";
                                        }
                                        else{
                                            echo "<textarea name='text_{$value['id']}' id='text_{$value['id']}' cols='30 rows='10' class='form-control'></textarea>";
                                        }
                                    ?>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">สถานที่</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="กรอกสถานที่" id="location" name="location" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="province">จังหวัด</label>
                                <select name="province" id="province" class="form-control" required>
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php foreach ($query as $value) { ?>
                                        <option value="<?=$value['id']?>"><?=$value['name_pr']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphures">อำเภอ</label>
                                <select name="amphures" id="amphures" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphures">ตำบล</label>
                                <select name="districts" id="districts" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="upload">รูปภาพ</label>
                            <input type="file" class="form-control-file" name="upload[]" id="upload" multiple="multiple">
                        </div>
                        
                        <div class="form-group">
                            <div class="text-center">
                                <input type="submit" name="submit" id="submit" value="บันทึก" class="btn btn-primary" onclick="" data-toggle="modal" data-target="#PopupModal"></input>
                                <input type="button" onclick="document.referrer ? window.location = document.referrer : history.back()" value="ย้อนกลับ" class='btn btn-danger btn-xs'>
                            </div>
                        </div>

                        <!-- POPUP Modal-->
                        <!-- <div class="modal fade" id="PopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">รูปแบบรายงาน</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                    </div>
                                    <div class="modal-body"><p id="ShowMessage"></p></div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                                        <button class="btn btn-danger btn-xs" type="button" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>       

        var positon_lat;
        var positon_lng;
        
        $(document).ready(txt);

        function txt() {
            getLocation();
            document.getElementById("text_1").value =  "/";
            for (let i = 1; i < 10; i++) {
                $("input#text_"+i).hide();
                $("textarea#text_"+i).hide();
                $(":checkbox").click(countChecked);   
            }
        }

        function countChecked() {
            for (let i = 1; i < 10; i++) {
                if ($("input#"+i).is(':checked')) {
                    $("input#text_"+i).show();
                    $("textarea#text_"+i).show();         
                }
                else {
                    $("input#text_"+i).hide();
                    $("textarea#text_"+i).hide();
                } 
            }
        }

        // $("#submit").click(function () {
        //     var date = date_thai($('#date').val());
        //     var province = $('#province').val();
        //     var subarea;
        //     var area;
        //     console.log(province);
        //     var location = $('#location').val() + " ต." +$('#districts').val();
        //     var message = "เรียนหัวหน้าอุทยานแห่งชาติเขาใหญ่ <br><br>";
        //     message +="หน่วย <?=$_SESSION["agency"]?> เมื่อวันที่ "+ date +" ออกตรวจเฝ้าระวังและผลักดันช้างป่าออกหากินออกนอกเขตพื้นที่อุทยานแห่งชาติเขาใหญ่";
            
        //     <?php
        //         $idpro = "<script>document.writeln(province);</script>";
        //         $sqlprovinces = "SELECT `name_pr` FROM `tb_province` WHERE `id` = '$idpro'";
        //         $res = mysqli_query($conn, $sqlprovinces);
        //         foreach ($res as $value){
        //     ?>
        //         message += "บริเวณท้องที่ "+ $('#location').val() + " ต.<?=$value['name_pr'];?>";
        //     <?php
        //         }
        //         ?>
        //     <?php
        //         $sqlarea = "SELECT `name_ar` FROM `tb_area` WHERE `id` = '$area_id'";
        //         $res = mysqli_query($conn, $sqlarea);
        //         $area="";
        //         foreach ($res as $value){
        //             $area = $value['name_ar'];
        //         }
        //         $sqlsubarea = "SELECT `name_sub` FROM `tb_subarea` WHERE `id` = '$subarea_id'";
        //         $res = mysqli_query($conn, $sqlsubarea);
        //         $subarea="";
        //         foreach ($res as $value){
        //             $subarea = $value['name_sub'];
        //         }
        //     ?>
        //     document.getElementById("ShowMessage").innerHTML = message;
        // });
    
		/////////									
		function getLocation() {
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
		function showPosition(position) {

			// computation test
            positon_lat = position.coords.latitude;
            positon_lng = position.coords.longitude;
		}

        var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
        var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
        var geocoder; // กำหนดตัวแปร สำหรับใช้งานข้อมูลสถานที่จาก Google Map
        function initialize() { // ฟังก์ชันแสดงแผนที่
            GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
            // กำหนดจุดเริ่มต้นของแผนที่
            var my_Latlng  = new GGM.LatLng(positon_lat,positon_lng);
            
            // เรียกใช้งานข้อมูล Geocoder ของ Google Map
            geocoder = new GGM.Geocoder();
            
            var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
            // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
            var my_DivObj=$("#map_canvas")[0]; 
            // กำหนด Option ของแผนที่
            var myOptions = {
                zoom: 10, // กำหนดขนาดการ zoom
                center: my_Latlng , // กำหนดจุดกึ่งกลาง
                mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
            };
            map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
            
            var my_Marker = new GGM.Marker({ // สร้างตัว marker
                position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
                title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
            });
            
            // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
            GGM.event.addListener(my_Marker, 'dragend', function() {
                var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker		
                
                // เรียกขอข้อมูลสถานที่จาก Google Map
                geocoder.geocode({'latLng': my_Point}, function(results, status) {
                if (status == GGM.GeocoderStatus.OK) {
                    if (results[1]) {
                        // แสดงข้อมูลสถานที่ใน textarea ที่มี id เท่ากับ place_value
                    $("#place_value").val(results[1].formatted_address); // 
                    }
                } else {
                    // กรณีไม่มีข้อมูล
                    // alert("Geocoder failed due to: " + status);
                }
                });
                positon_lat = my_Point.lat();
                positon_lng = my_Point.lng();
                // $("#location_in_N").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                // $("#location_in_E").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
                // $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
            });		

            // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
            GGM.event.addListener(map, 'zoom_changed', function() {
                $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value 	
            });

        }
        $(function(){
            // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
            // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
            // v=3.2&sensor=false&language=th&callback=initialize
            //	v เวอร์ชัน่ 3.2
            //	sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
            //	language ภาษา th ,en เป็นต้น
            //	callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
            $("<script/>", {
            "type": "text/javascript",
            src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
            }).appendTo("body");	
        });

        function convertLatLngtoUTM(num) {
            // computation test
            let lon_input = positon_lng;
            let lat_input = positon_lat;
            console.log("Input (long,lat):", lon_input, lat_input);
            const azone = utmzone_from_lon(lon_input);
            console.log(`UTM zone from longitude: ${azone}`);
            console.log("AUTO projection definition:", proj4_setdef(lon_input));

            // define proj4_defs for easy uses
            // "EPSG:4326" for long/lat degrees, no projection
            // "EPSG:AUTO" for UTM 'auto zone' projection
            proj4.defs([
            [
                "EPSG:4326",
                "+title=WGS 84 (long/lat) +proj=longlat +ellps=WGS84 +datum=WGS84 +units=degrees"
            ],
            ["EPSG:AUTO", proj4_setdef(lon_input)]]);

            // usage:
            // conversion from (long/lat) to UTM (E/N)
            const en_m = proj4("EPSG:4326", "EPSG:AUTO", [lon_input, lat_input]);
            const e4digits = en_m[0].toFixed(4); //easting
            const n4digits = en_m[1].toFixed(4); //northing
            console.log(`Zone ${azone}, (E,N) m: ${e4digits}, ${n4digits}`);

            // inversion from (E,N) to (long,lat)
            const lonlat_chk = proj4("EPSG:AUTO", "EPSG:4326", en_m);
            console.log("Inverse check:", lonlat_chk);

            if(num == 1){
                document.getElementById("location_in_N").value =  n4digits;
                document.getElementById("location_in_E").value =  e4digits;
            } else if (num == 2){
                document.getElementById("location_out_N").value =  n4digits;
                document.getElementById("location_out_E").value =  e4digits;
            }else if (num == 3){
                document.getElementById("N").value =  n4digits;
                document.getElementById("E").value =  e4digits;
            }


            function utmzone_from_lon(lon_deg) {
                //get utm-zone from longitude degrees
                return parseInt(((lon_deg+180)/6)%60)+1;
            }

            function proj4_setdef(lon_deg) {
                //get UTM projection definition from longitude
                const utm_zone = utmzone_from_lon(lon_deg);
                const zdef = `+proj=utm +zone=${utm_zone} +datum=WGS84 +units=m +no_defs`;
                return zdef;
            }
        }
        
        function date_thai(date_in){
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
            
            var year = date_in.substr(0, 4);
            var month = date_in.substr(5, 2);
            var day;
            if((date_in.substr(8, 1)) == "0")
                day = date_in.substr(9, 1);
            else
                day = date_in.substr(8, 2);
            month = month_arr[parseInt(month)];
            var date = day + " " + month + " " + (parseInt(year)+543);
            return date;
        }
	</script>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>