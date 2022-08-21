<?php
    include ('includes/connect.php');	
    session_start();

    $month_arr = array("","มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย

    if (isset($_POST['function']) && $_POST['function'] == 'province') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_area WHERE province_id='$id'";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['id'].'">'.$value['name_ar'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM tb_subarea WHERE area_id='$id'";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกตำบล-</option>';
        foreach ($query as $value2) {
          echo '<option value="'.$value2['id'].'">'.$value2['name_sub'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'years_datalist') {
        $years = $_POST['years'];
        $sql = "SELECT DISTINCT MONTH(date) FROM tb_show WHERE YEAR(date)=$years";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกเดือน-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['MONTH(date)'].'">'.$value['MONTH(date)'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'years_imglist') {
        $ele_img = $_POST['ele_img'];
        $sql = "SELECT DISTINCT YEAR(date) FROM tb_image WHERE name_ele='$ele_img'";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกปี-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['YEAR(date)'].'">'.$value['YEAR(date)'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'month_imglist') {
        $ele_img = $_POST['ele_img'];
        $years = $_POST['years'];
        $sql = "SELECT DISTINCT MONTH(date) FROM tb_image WHERE name_ele='$ele_img' AND YEAR(date)=$years";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกเดือน-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['MONTH(date)'].'">'.$value['MONTH(date)'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'day_imglist') {
        $ele_img = $_POST['ele_img'];
        $years = $_POST['years'];
        $month = $_POST['month'];
        $sql = "SELECT DISTINCT DAY(date) FROM tb_image WHERE name_ele='$ele_img' AND YEAR(date)=$years AND MONTH(date)=$month";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกวัน-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['DAY(date)'].'">'.$value['DAY(date)'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'time_imglist') {
        $ele_img = $_POST['ele_img'];
        $years = $_POST['years'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $sql = "SELECT DISTINCT timeimg FROM tb_image WHERE name_ele='$ele_img' AND YEAR(date)=$years AND MONTH(date)=$month AND DAY(date)=$day";
        $query = mysqli_query($conn, $sql);
        echo '<option value="" selected disabled>-กรุณาเลือกเวลา-</option>';
        foreach ($query as $value) {
            echo '<option value="'.$value['timeimg'].'">'.$value['timeimg'].'</option>';
        }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'show_datalist') {
        $month = $_POST['month'];
        $years = $_POST['years'];
        $sql=" SELECT * FROM tb_show WHERE  YEAR(tb_show.date)='$years' AND MONTH(tb_show.date)='$month'";
        $query = mysqli_query($conn, $sql);
        $number = 1;
        echo '
        <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="26">
                <h5>รายงานผลการปรากฎตัวของช้างป่าออกหากินนอกพื้นที่อุทยานแห่งชาติเขาใหญ่
                    ประจำเดือน '.$month_arr[$month].' พ.ศ. '.((int)$years + 543).'</h5>
                </th>
            </tr>
            <tr style="text-align:center"; "vertical-align:middle"; >
                <th style="vertical-align:middle" scope="col"  rowspan="2" ><h7>ลำดับที่</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>ว/ด/ป</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>เวลา</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>จังหวัด</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>อำเภอ</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>ตำบล</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>จำนวน</h7>(ตัว)</th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>ชื่อช้าง</h7></th>
                <th scope="col" colspan="2" ><h7>ช้างเข้าพิกัด</h7></th>
                <th scope="col" colspan="2" ><h7>ช้างออกพิกัด</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>สถานที่</h7></th>
                <th scope="col" colspan="9" ><h7>ความเสียหาย</h7></th>
                <th scope="col" colspan="2" ><h7>พิกัดความเสียหาย</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>ผู้บันทึก</h7></th>
                <th style="vertical-align:middle" scope="col"  rowspan="2"><h7>หน่วยงาน</h7></th>
            </tr>
            <tr style="text-align:center">
                <th style="vertical-align:middle" scope="col" ><h7>E</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>N</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>E</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>N</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>ไม่พบความเสียหา</h7>ย</th>
                <th style="vertical-align:middle" scope="col" ><h7>ทรัพย์สิน</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>กล้ว</h7>ย</th>
                <th style="vertical-align:middle" scope="col" ><h7>อ้อย</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>ข้าวโพด</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>มะพร้าว</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>ขนุน</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>หมาก</h7></th>
                <th style="vertical-align:middle" scope="col" ><h7>อื่นๆ</h7></th>
                <th style="vertical-align:middle" scope="col"><h7>E</h7></th>
                <th style="vertical-align:middle" scope="col"><h7>N</h7></th>
            </tr>
        </thead>
        ';
            foreach ($query as $value)  {
                echo '<tbody>
                <tr scope="row">
                <th scope="row">'.$number.'</th>
                <td>'.show_tdate($value["date"]).'</td>
                <td>'.$value["time"].'</td>
                <td>'.$value["province_name"].'</td>
                <td>'.$value["area_name"].'</td>
                <td>'.$value["subarea_name"].'</td>
                <td>'.$value["num_ele"].'</td>
                <td>'.$value["ele_name"].'</td>
                <td>'.$value["location_in_y"].'</td>
                <td>'.$value["location_in_x"].'</td>
                <td>'.$value["location_out_y"].'</td>
                <td>'.$value["location_out_x"].'</td>
                <td>'.$value["location"].'</td>
                <td>'.$value["no_damage"].'</td>
                <td>'.$value["property"].'</td>
                <td>'.$value["banana"].'</td>
                <td>'.$value["sugarcane"].'</td>
                <td>'.$value["sweetcorn"].'</td>
                <td>'.$value["coconut"].'</td>
                <td>'.$value["jackfruit"].'</td>
                <td>'.$value["mak"].'</td>
                <td>'.$value["other"].'</td>
                <td>'.$value["location_damage_E"].'</td>
                <td>'.$value["location_damage_N"].'</td>
                <td>'.$value["name_user"].'</td>
                <td>'.$value["agency"].'</td>
                </tr></tbody>';
                ++$number;
            }
        exit();
    }

    if (isset($_POST['function']) && $_POST['function'] == 'show_imglist') {
        $ele_img = $_POST['ele_img'];
        $years = $_POST['years'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        // $timeimg = $_POST['time'];
        // $sql = "SELECT image FROM tb_image WHERE name_ele='$ele_img' AND YEAR(date)=$years AND MONTH(date)=$month AND DAY(date)=$day AND timeimg='$timeimg'";
        $sql = "SELECT * FROM tb_image WHERE name_ele='$ele_img' AND YEAR(date)=$years AND MONTH(date)=$month AND DAY(date)=$day";
        $query = mysqli_query($conn, $sql);
        $number = 1;
        echo '
        <thead class="thead-dark">
            <tr>
                <th><h6>ลำดับที่</h6></th>
                <th><h6>เวลา</h6></th>
                <th style="text-align:center" scope="col">
                    <h6>ภาพช้าง '.$ele_img.'</h6>
                </th>  
            </tr>
        </thead>
        ';
        // echo '<tbody>';
        foreach ($query as $value)  {
            echo '<tbody>
            <tr scope="row" >
            <th width="10%" >'.$number.'</th>
            <td><h7>'.$value["timeimg"].'</h7></td>
            <td><img class="zoom" src= "img/uploads/'.$value["image"].'" alt=""></td>
            </tr> </tbody>';
            ++$number;
        }
        // echo '</tbody>';
        exit();
    }

    if(isset($_POST['updateid'])){
        $User_id=$_POST['updateid'];
    
        $sql="Select * from `tb_user` where `id`='$User_id'";
        $result=mysqli_query($conn,$sql);
        $response=array();
        while($row=mysqli_fetch_assoc($result)){
            $response=$row;
        }
        echo json_encode($response);
    }else{
        $response['status']=200;
        $response['message']="Inavalid or data not found";
    }

    if(isset($_FILES['upload'])){

        $date = ($_POST['date']);
        $time = "{$_POST["time"]}น.";
        $province_id = ($_POST['province']);
        $area_id = ($_POST['amphures']);
        $subarea_id = ($_POST['districts']);
        $num_ele = ($_POST['num_ele']);
        $ele_name = ($_POST['name_ele']);
        $location_in_x = ($_POST['location_in_N']);
        $location_in_y = ($_POST['location_in_E']);
        $location_out_x = ($_POST['location_out_N']);
        $location_out_y = ($_POST['location_out_E']);
        $location = ($_POST['location']);
        $x = ($_POST['E']);
        $y = ($_POST['N']);

        // $sqlcount = "SELECT `name` COUNT FROM `tb_elephant` WHERE `name` = '$ele_name'";
        // $rescount = mysqli_query($conn, $sqlcount);
        // $count = mysqli_num_rows($rescount);
        // if($count == 0){
        //         $sqladdelephant = "INSERT INTO `tb_elephant`(`id`, `name`) VALUES (NULL,'$ele_name')";
        //         mysqli_query($conn, $sqladdelephant);
        // }

        // for ($i=1; $i < 10; $i++) { 
        //     if($_POST[$i] != 'on'){
        //         $_POST['text_'.$i.''] = "";
        //     }
        // }

        if($_POST['1'] != 'on'){
            $_POST['text_1'] = "";
        }

        $sqlprovince = "SELECT `name_pr` FROM `tb_province` WHERE id = '$province_id'";
        $resprovince = mysqli_query($conn,$sqlprovince);
        $resprovince = mysqli_fetch_assoc($resprovince);
        $province = $resprovince['name_pr'];

        $sqlamphures = "SELECT `name_ar` FROM `tb_area` WHERE id = '$area_id'";
        $resamphures = mysqli_query($conn,$sqlamphures);
        $resamphures = mysqli_fetch_assoc($resamphures);
        $amphures = $resamphures['name_ar'];

        $sqldistricts = "SELECT `name_sub` FROM `tb_subarea` WHERE id = '$subarea_id'";
        $resdistricts = mysqli_query($conn,$sqldistricts);
        $resdistricts = mysqli_fetch_assoc($resdistricts);
        $districts = $resdistricts['name_sub'];

        $nameele="";
        $damage = "";
        $numele=0;
        if($ele_name != NULL){
            foreach ($ele_name as $key => $value) {
                print_r($ele_name[$key]);
                $sql_add = "INSERT INTO `tb_show`(`id`, `name_user`, `agency`, `rank`, `date`, `time`, `province_name`, `area_name`, `subarea_name`, `num_ele`, `ele_name`, `location_in_x`, `location_in_y`, `location_out_x`, `location_out_y`, `location`, `no_damage`, `property`, `banana`, `sugarcane`, `sweetcorn`, `coconut`, `jackfruit`, `mak`, `other`, `location_damage_E`, `location_damage_N`)
                                        VALUES ( NULL, '{$_SESSION["fname"]} {$_SESSION["lname"]}', '{$_SESSION["agency"]}', '{$_SESSION["rank"]}', '$date', '$time', '$province', '$amphures', '$districts', '$num_ele', '$value', '$location_in_x', '$location_in_y', '$location_out_x', '$location_out_y', '$location', '{$_POST['text_1']}', '{$_POST['text_2']}', '{$_POST['text_3']}', '{$_POST['text_4']}', '{$_POST['text_5']}', '{$_POST['text_6']}', '{$_POST['text_7']}', '{$_POST['text_8']}', '{$_POST['text_9']}', '$y', '$x')";
                mysqli_query($conn,$sql_add) or die ("Error in query: $sql_add " . mysqli_error());

                $nameele .=" '$value' ";
                $numele+=$num_ele;
                
            }
        }
        
        if($_POST['insert_ele'] != NULL){
            $sqlcount = "SELECT `name` COUNT FROM `tb_elephant` WHERE `name` = '{$_POST['insert_ele']}'";
            $rescount = mysqli_query($conn, $sqlcount);
            $count = mysqli_num_rows($rescount);
            if($count == 0){
                    $sqladdelephant = "INSERT INTO `tb_elephant`(`id`, `name`) VALUES (NULL,'{$_POST['insert_ele']}')";
                    mysqli_query($conn, $sqladdelephant);
            }

            $sql_add = "INSERT INTO `tb_show`(`id`, `name_user`, `agency`, `rank`, `date`, `time`, `province_name`, `area_name`, `subarea_name`, `num_ele`, `ele_name`, `location_in_x`, `location_in_y`, `location_out_x`, `location_out_y`, `location`, `no_damage`, `property`, `banana`, `sugarcane`, `sweetcorn`, `coconut`, `jackfruit`, `mak`, `other`, `location_damage_N`, `location_damage_E`)
                        VALUES ( NULL, '{$_SESSION["fname"]} {$_SESSION["lname"]}', '{$_SESSION["agency"]}', '{$_SESSION["rank"]}', '$date', '$time', '$province', '$amphures', '$districts', '{$_POST['inset_num_ele']}', '{$_POST['insert_ele']}', '$location_in_x', '$location_in_y', '$location_out_x', '$location_out_y', '$location', '{$_POST['text_1']}', '{$_POST['text_2']}', '{$_POST['text_3']}', '{$_POST['text_4']}', '{$_POST['text_5']}', '{$_POST['text_6']}', '{$_POST['text_7']}', '{$_POST['text_8']}', '{$_POST['text_9']}', '$x', '$y')";
            mysqli_query($conn,$sql_add) or die ("Error in query: $sql_add " . mysqli_error());

            $nameele .= " {$_POST['insert_ele']} ";
            $numele+=$_POST['inset_num_ele'];
        }

        foreach($_FILES['upload']['tmp_name'] as $key => $value){
            $file_name = $_FILES['upload']['name'];
            $new_name = $file_name[$key];
            if(move_uploaded_file($_FILES['upload']['tmp_name'][$key],"img/uploads/".$new_name)){
                $sqlimage = "INSERT INTO `tb_image`(`id`, `name_ele`, `date`, `timeimg`, `image`)
                                    VALUES (NULL, $nameele,'{$_POST['date']}','$time', '$new_name')";
                mysqli_query($conn, $sqlimage);
            }
        }

        $date = show_tdate($date);
        if($_POST['1'] == 'on'){
            $damage = "เบื้องต้นไม่พบความเสียหาย ";
        }
        else{
            $damage = "ความเสียหายเบื้องต้นพบ";
            for ($i=2; $i < 9; $i++) { 
                if($_POST["$i"] == 'on'){
                    $sql = "SELECT `damage` FROM `tb_damage` WHERE `id` = '$i'";
                    $res = mysqli_query($conn, $sql);
                    $txt = "text_$i";
                    foreach ($res as $value)  {
                        $damage .= " {$value['damage']} {$_POST["$txt"]}";
                    }
                }
            }if($_POST['9'] == 'on'){
                $damage .= strtr ( " {$_POST['text_9']}", "\n", " " );
            }
        }
        
        $coordinates = "";
        if($x != 0 && $y != 0){
            $coordinates = "พิกัดความเสียหาย $x, $y";
        }
        
        $sqllinenoti = "SELECT * FROM `tb_linetoken` WHERE `id` = 1";
        $resLineToken = mysqli_query($conn, $sqllinenoti);
        $resLineToken = mysqli_fetch_assoc($resLineToken);
        
        $token = $resLineToken['Line_Token'] ; // LINE Token
        //Message
        $mymessage = "\nเรียนหัวหน้าอุทยานแห่งชาติเขาใหญ่\n\n"; //Set new line with '\n'
        $mymessage .= "หน่วย {$_SESSION["agency"]} เมื่อวันที่ $date ออกตรวจเฝ้าระวังและผลักดันช้างป่าออกหากินออกนอกเขตพื้นที่อุทยานแห่งชาติเขาใหญ่";
        $mymessage .= "บริเวณท้องที่ $location ต.$districts อ.$amphures จ.$province\n\n";
        $mymessage .= "เวลา $time พบช้างป้า $numele ตัว\n";
        $mymessage .= "($nameele) ออกมาหากินนอกเขตอุทยานฯบริเวณท้องที่ $location $coordinates $damage \n\n";
        $mymessage .= "{$_SESSION["fname"]} {$_SESSION["lname"]}\n";
        $mymessage .= "{$_SESSION["rank"]}\n";
        $mymessage .= "ผู้รายงาน\n";
        // $imageFile = new CURLFILE('img/uploads/2_4.png'); // Local Image file Path
        // $sticker_package_id = '2';  // Package ID sticker
        // $sticker_id = '34';    // ID sticker
        // echo $mymessage;
        $data = array (
            'message' => $mymessage
            // 'stickerPackageId' => $sticker_package_id,
            // 'stickerId' => $sticker_id
        );
        
        line_notification($token,$data);

        foreach($_FILES['upload']['tmp_name'] as $key => $value){
            $file_name = $_FILES['upload']['name'];
            $new_name = $file_name[$key];
            if(move_uploaded_file($_FILES['upload']['tmp_name'][$key],"img/uploads/".$new_name)){
                $sqlimage = "INSERT INTO `tb_image`(`id`, `name_ele`, `date`, `timeimg`, `image`)
                                    VALUES (NULL, '$nameele','{$_POST['date']}','$time', '$new_name')";
                mysqli_query($conn, $sqlimage);
                print_r(mysqli_query($conn, $sqlimage));
            }
            $imageFile = new CURLFILE('img/uploads/'.$new_name.'');
            $data = array (
                'message' => "รูป",
                'imageFile' => $imageFile
                    // 'stickerPackageId' => $sticker_package_id,
                    // 'stickerId' => $sticker_id
            );
            line_notification($token,$data);
        }

        header("Location: add_data.php");

        exit();
    }

    if(isset($_POST['function']) == 'LineNoti'){

            $sqllinenoti = "SELECT * FROM `tb_linetoken` WHERE `id` = 2";
            $resLineToken = mysqli_query($conn, $sqllinenoti);
            $resLineToken = mysqli_fetch_assoc($resLineToken);
            
            $token = $resLineToken['Line_Token'] ; // LINE Token
            //Message
            $mymessage = "\nเรียนหัวหน้าอุทยานแห่งชาติเขาใหญ่ \n\n"; //Set new line with '\n'
            $sql = "SELECT DISTINCT `date` FROM `tb_show` WHERE `date` = SUBSTRING(DATE_ADD(NOW(), INTERVAL -1 DAY), 1, 10)";
            // $sql = "SELECT DISTINCT `date` FROM `tb_show` WHERE `date` = '2022-07-03'";
            $resday = mysqli_query($conn, $sql);
            $resday = mysqli_fetch_assoc($resday);

            $sql = "SELECT DISTINCT `agency` FROM `tb_show` WHERE `date` = '{$resday['date']}'";
            $agency = mysqli_query($conn, $sql);
            
            $date = show_tdate($resday['date']);

            $mymessage .= "เมื่อวันที่ $date \n";

            foreach ($agency as $key => $agency) {
                $mymessage .= "-----------------------------------------\n";
                $mymessage .= "หน่วย {$agency['agency']}\n\n";

                $sql = "SELECT DISTINCT `time` FROM `tb_show` WHERE `date` = '{$resday['date']}' AND `agency` = '{$agency['agency']}'";
                $query = mysqli_query($conn, $sql);
                foreach ($query as $key => $data) {
                    $sql = "SELECT `num_ele`, `ele_name` FROM `tb_show` WHERE `agency` = '{$agency['agency']}' AND `date` = '{$resday['date']}' AND `time` = '{$data['time']}'";
                    $query = mysqli_query($conn, $sql);
                    $numele = 0;
                    $elename = "";
                    foreach ($query as $key => $ele) {
                        $elename .= " '{$ele['ele_name']}'";
                        $numele += (int)$ele['num_ele'];
                    }

                    $sql = "SELECT * FROM `tb_show` WHERE `agency` = '{$agency['agency']}' AND `date` = '{$resday['date']}' AND `time` = '{$data['time']}'";
                    $query = mysqli_query($conn, $sql);
                    $datareport = mysqli_fetch_assoc($query);

                    $coordinates = "";
                    if($datareport['location_damage_N'] != 0 && $datareport['location_damage_E'] != 0){
                        $coordinates = "พิกัดความเสียหาย {$datareport['location_damage_E']} {$datareport['location_damage_N']}\n";
                    }

                    $damage = "";
                    if($datareport['no_damage'] != NULL){
                        $damage = "เบื้องต้นไม่พบความเสียหาย";
                    }else{
                        $damage = "ความเสียหายเบื้องต้นพบ";
                        if($datareport['property'] != NULL){
                            $damage .=" ทรัพย์สิน {$datareport['property']}";
                        }
                        if($datareport['banana'] != NULL){
                            $damage .=" กล้วย {$datareport['banana']}";
                        }
                        if($datareport['sugarcane'] != NULL){
                            $damage .=" อ้อย {$datareport['sugarcane']}";
                        }
                        if($datareport['sweetcorn'] != NULL){
                            $damage .=" ข้าวโพด {$datareport['sweetcorn']}";
                        }
                        if($datareport['coconut'] != NULL){
                            $damage .=" มะพร้าว {$datareport['coconut']}";
                        }
                        if($datareport['jackfruit'] != NULL){
                            $damage .=" ขนุน {$datareport['jackfruit']}";
                        }
                        if($datareport['mak'] != NULL){
                            $damage .=" หมาก {$datareport['mak']}";
                        }
                        if($datareport['other'] != NULL){
                            $damage .=strtr ( " {$datareport['other']}", "\n", " " );
                        }
                    }
                    $mymessage .= "เวลา {$data['time']} พบช้างป่า $numele ตัว\n";
                    $mymessage .= "($elename )\n";
                    $mymessage .= "ออกมาหากินนอกเขตอุทยานฯบริเวณท้องที่ {$datareport['location']} ต.{$datareport['subarea_name']} อ.{$datareport['area_name']} จ.{$datareport['province_name']}\n";
                    $mymessage .= "$coordinates";
                    $mymessage .= "$damage \n\n";
                    $mymessage .= "{$datareport['name_user']}\n";
                    $mymessage .= "{$datareport['rank']}\n";
                    $mymessage .= "ผู้รายงาน\n\n";
                }
            }
            // $imageFile = new CURLFILE('uploads/2_4.png'); // Local Image file Path
            $data = array (
                'message' => $mymessage
                // 'imageFile' => $imageFile
            );
            line_notification($token,$data);

        header("Location: home.php");
    }

    function line_notification($token,$data){
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $chOne, CURLOPT_POST, 1);
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
        curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$token, );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );
        //Check error
        if(curl_error($chOne)) { 
            echo 'error:' . curl_error($chOne); 
        }
        else {
            $result_ = json_decode($result, true);
            echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
        }
        //Close connection
        curl_close( $chOne );
    }
    
    function  show_tdate($date_in) // กำหนดชื่อของฟังชั่น show_tdate และสร้างตัวแปล $date_in ในการรับค่าที่ส่งมา
    {
        $month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย

        // ใช้ฟังชั่น strtok เพื่อแยก ปี เดือน วัน
        // โดยเริ่มจาก ปีก่อน
        $tok = strtok($date_in, "-"); //สร้างตัวแปล $tok เพื่อเก็บค่าแยกของปี ออกมา
        $year = $tok ; //กำหนดค่าให้ ตัวแปล $year มีค่าเท่ากับ ปีที่ ถูกแยกออกมาจาก ตัวแปล $tok 

        //ต่อไปคือส่วนของ เดือน
        $tok  = strtok("-");// ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
        $month = $tok ;//สร้างตัวแปล$monthเพื่อเก็บค่าแยกของเดือน ออกมา
        // 

        //ต่อไปส่วนสุดท้ายคือ ส่วนของวันที่
        $tok = strtok("-");//ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
        $day = $tok ;//สร้างตัวแปล $$dayเพื่อเก็บค่าแยกของเดือน ออกมา

        //เมื่อได้ส่วนแยกของ วัน เดือน ปี มาแล้วว แต่ ปี ยังเป็นรูปแบบของ ค.ศ. ดังนั้นเราต้องแปล เป็น พ.ศ.  ก่อนด้ววิธีกรนนี้

        $year_out = $year + 543 ;// สร้างตัวแแปลขึ้นมาเพื่อเก็บค่าที่ได้จากการนำปี ค.ศ. มาบวกกับ 543  ก็จะได้ปีที่เป็น  พ.ศ. ออกมา

        $cnt = $month-1 ;// เราตัองสร้างตัวแปล มาเพื่อเก็บค่าเดือน โดยจะต้องเอาเดือนที่ได้มา ลบ 1 เพราะว่า เราจะต้องใช้ในการเทียบกับ ค่าที่อยู่ได้อาร์เรย์ เนื่องจาก อาร์เรย์จะมีค่า เริ่มจาก 0
        $month_out = $month_arr[$cnt] ;// ทำการเทียบค่าเดือนที่ได้กับเดือนที่เก็บไว้ในอาร์เรย์ แล้วเก็บลงใน ตัวแปล


        $t_date = $day." ".$month_out." ".$year_out ; // สร้างตัวแปลเก็บค่า วัน เดือน ปี ที่แปลเป็นไทยแล้ว

        return $t_date ;// ส่งค่ากลับไปยังส่วนที่ส่งมา
    }

     
    // Check if the user is logged in, if not then redirect him to login page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if($_SESSION["status"] == "User"){
            header("Location: add_data.php");
        }
        elseif($_SESSION["status"] == "Admin"){
            header("Location: home.php");
        }
        exit();
    }else {
        header("Location: login.php");
        exit();
    }

    //////////////////////////////////////////////////////////////////////
    
    

    if(isset($_POST['deletesend'])){
        $unique=$_POST['deletesend'];
    
        $sql = "DELETE FROM `tb_user` WHERE id=$unique";
        
        $result = mysqli_query($conn,$sql);
    }