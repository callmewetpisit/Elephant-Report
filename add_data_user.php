<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูล</title>
    <style type="text/css">
        html { height: 100% }
        body { 
            height:100%;
            margin:0;padding:0;
            font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
            font-size:12px;
        }
        /* css กำหนดความกว้าง ความสูงของแผนที่ */
        #map_canvas { 
            width:auto;
            height:300px;
            margin:auto;
        /*	margin-top:100px;*/
        }
    </style>

    <link rel="stylesheet" href="css/mystyle.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.2/proj4.js"></script>

</head>
<body>
    <?php
		include 'includes/connect.php';
		session_start();
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

    <div class="tab">
        <button class="tablinks" onclick="document.location='logout.php'">ออกจากระบบ</button>
    </div>
    <div class="container">
        <section class="mt-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">วันที่</label>
                                <input type="date"  class="form-control" id="date" name="date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time">เวลา</label>
                                <input type="time" class="form-control" id="time" name="time">
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
                                    <label class="form-check-label" for="che_<?=$value['id']?>" placeholder="กรอกจำนวน">
                                    <?=$value['damage']?>
                                    </label>
                                    <?php
                                        if($value['id'] == '1'){
                                            echo "<input type='text' class='form-control' name='text_{$value['id']}' id='text_{$value['id']}' readonly >";
                                        }
                                        else{
                                            echo "<input type='text' class='form-control' name='text_{$value['id']}' id='text_{$value['id']}' >";
                                        }
                                    ?>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">สถานที่</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="กรอกสถานที่" id="location" name="location">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="province">จังหวัด</label>
                                <select name="province" id="province" class="form-control">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php foreach ($query as $value) { ?>
                                        <option value="<?=$value['id']?>"><?=$value['name_pr']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphures">อำเภอ</label>
                                <select name="amphures" id="amphures" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amphures">ตำบล</label>
                                <select name="districts" id="districts" class="form-control">
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="upload">รูปภาพ</label>
                            <input type="file" class="form-control-file" name="upload[]" id="upload" multiple="multiple">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-1">
                                <input type="submit" value="บันทึก" class="btn btn-success"></input>
                            </div>
                            <div class="form-group col-md-1">
                                <input type="button" onclick="document.referrer ? window.location = document.referrer : history.back()" value="ย้อนกลับ" class='btn btn-danger btn-xs'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>       

        var positon_lat;
        var positon_lng;
        
        $(document).ready(txt);

        function txt() {
            getLocation();
            document.getElementById("text_1").value =  "/";
            for (let i = 1; i < 10; i++) {
                $("input#text_"+i).hide();
                $(":checkbox").click(countChecked);   
            }
        }

        function countChecked() {
            for (let i = 1; i < 10; i++) {
                if ($("input#"+i).is(':checked')) {
                    $("input#text_"+i).show();                
                }
                else {
                    $("input#text_"+i).hide(); 
                } 
            }
        }
    
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
	</script>
	<?php include('includes/scripts.php');?>
</body>
</html>