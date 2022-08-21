<?php
    require_once "includes/connect.php";
    session_start();

    $password = $confirm_password = "";
    $password_err = $confirm_password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Validate password
        if(empty(trim($_POST["Password"]))){
            $password_err = "กรุณากรอกรหัสผ่าน";     
        } elseif(strlen(trim($_POST["Password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["Password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["ConPassword"]))){
            $confirm_password_err = "กรุณายืนยันรหัสผ่าน";     
        } elseif(empty($password_err) && ($password != trim($_POST["ConPassword"]))){
            // $confirm_password_err = "รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่";
            $pass_err= "รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่";
        }else{
                $confirm_password = trim($_POST["ConPassword"]);
            }
        

        if(empty($password_err) && (empty($confirm_password_err) && empty($pass_err))){

            // Prepare an insert statement
            $sql = "UPDATE `tb_user` SET `Password`= '$password' WHERE `UserName` = '{$_SESSION["username"]}'";
            mysqli_query($conn, $sql);

            header("location: login.php");
        }else{
            // echo '<script>alert("'.$username_err.''.$password_err.''.$confirm_password_err.'");</script>';
            $confirm_password = "รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่";
        }

        // Close connection
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Register</title>
    
</head>
<body>

    <div class="forgot-photo">
        <div class="form-container">
            <div class="image-holder"></div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h2 class="text-center"><strong>เปลี่ยนรหัสผ่านใหม่</strong></h2>
                    <?php 
                        if(!empty($pass_err)){
                            echo '<div class="alert alert-danger">' . $pass_err . '</div>';
                        }        
                    ?>
                    <div class="form-group">
                        <label >รหัสผ่านใหม่</label>
                        <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="Password" name="Password" placeholder="">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label >ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="ConPassword" name="ConPassword" placeholder="">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block btn-dark">บันทึก</button>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>