<?php

    $host="localhost";
    $user="root";
    $pass="";
    $database="khao-yai_elephant";

    $conn= mysqli_connect($host,$user,$pass,$database);

    if(!$conn){
        die("ติดต่อฐานข้อมูลไม่ได้".mysqli_error($conn));
    }
    mysqli_query($conn,"SET NAMES 'utf8' ");
    error_reporting( error_reporting() & ~E_NOTICE );
    date_default_timezone_set('Asia/Bangkok');  


?>