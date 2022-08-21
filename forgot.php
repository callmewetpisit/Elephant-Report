<?php

    require_once "includes/connect.php";
    $username = "";
    $username_err = $user_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "กรุณากรอกอีเมล";
        } else{
            $username = trim($_POST["username"]);
        }

        if(empty($username_err)){
            // Prepare a select statement
            $sql = "SELECT `First_name`, `Last_name`, `UserName`, `Password`, `Agency`, `Rank`, `Status` FROM tb_user WHERE UserName = ?";
    
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $First_name, $Last_name, $username, $hash_password, $Agency, $Rank, $status);
                        if(mysqli_stmt_fetch($stmt)){
                            
                                session_start();
                                
                                // Store data in session variables
                                
                                $_SESSION["username"] = $username;
                                                         
                                
                                // Redirect user to welcome page
                                header("location: reset_pass.php");
                                // Password is correct, so start a new session
                            
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $user_err = "อีเมลไม่ถูกต้อง";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }



?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/mystyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="forgot-photo">
            <div class="form-container">
                <div class="image-holder"></div>
                        <!-- <h3>ลืมรหัสผ่าน?</h3>
                        <p>กรุณากรอกอีเมลเพื่อยืนยันการเปลี่ยนรหัสผ่าน</p> -->

                        
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h2 class="text-center"><strong>ลืมรหัสผ่าน?</strong></h2>
                        <p><center>กรุณากรอกอีเมลเพื่อยืนยันการเปลี่ยนรหัสผ่าน</center></p>
                        <?php 
                        if(!empty($user_err)){
                            echo '<div class="alert alert-danger">' . $user_err . '</div>';
                        }        
                        ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" id="username" name="username" placeholder="อีเมล" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"  >
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="text-center">
                                <input type="submit" class="btn btn-dark " value="ดำเนินการต่อ">
                                <!-- <input type="button" onclick="document.referrer ? window.location = document.referrer : history.back()" value="ยกเลิก" class='btn btn-danger btn-xs'> -->
                                <a href="login.php" class="btn btn-danger " role="button" >ยกเลิก</a>
                            </div>
                            </div>
                            </form>
                    </div>
                </div>
</body>
</html>