<?php
    require_once "includes/connect.php";
    

    $username = $password = $Firstname = $Lastname = $Agency = $Rank = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Validate username
        if(empty(trim($_POST["Usertname"]))){
            $username_err = "Please enter a username.";
        }
        // elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["Usertname"]))){
        //     $username_err = "Username can only contain letters, numbers, and underscores.";
        // }
         else{
            // Prepare a select statement
            $sql = "SELECT id FROM tb_user WHERE UserName = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["Usertname"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["Usertname"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["Password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["Password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["Password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["ConPassword"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["ConPassword"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

            $Firstname =trim($_POST["Firstname"]);
            $Lastname = trim($_POST["Lastname"]);
            // $Email = trim($_POST["Email"]);
            $Agency = trim($_POST["Agency"]);
            $Rank = trim($_POST["Rank"]);
            // $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Prepare an insert statement
            $sql = "INSERT INTO tb_user (First_name, Last_name, UserName, Password, Agency, Rank, Status) VALUES ('$Firstname', '$Lastname', '$username', '$password', '$Agency', '$Rank', 'User')";
            mysqli_query($conn, $sql);

            // $sql = "INSERT INTO `tb_user`(`First_name`, `Last_name`, `UserName`, `Password`, `Agency`, `Rank`, `Status`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])"

            header("location: login.php");
            
        }else{
            // echo '<script>alert("'.$username_err.''.$password_err.''.$confirm_password_err.'");</script>';
            $password_err = "รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่";
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


        <div class="register-photo">
            <div class="form-container">
                <div class="image-holder"></div>
                <!-- <h2>ลงทะเบียน</h2>
                <p>กรุณากรอกแบบฟอร์มนี้เพื่อสร้างบัญชี</p> -->
                
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class=" needs-validation" novalidate>
                    <h2 class="text-center"><strong>ลงทะเบียน</strong></h2>
                    <?php 
                        if(!empty($password_err)){
                            echo '<div class="alert alert-danger">' . $password_err . '</div>';
                        }        
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >ชื่อ</label>
                            <input type="text" class="form-control" id="Firstname" name="Firstname" aria-describedby="emailHelp" placeholder="" required>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อ
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label >นามสกุล</label>
                            <input type="text" class="form-control" id="Lastname" name="Lastname" aria-describedby="emailHelp" placeholder="" required>
                            <div class="invalid-feedback">
                                กรุณากรอกนามสกุล
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label >อีเมล</label>
                        <input type="email" class="form-control" id="Usertname" name="Usertname" aria-describedby="emailHelp" placeholder="" required>
                        <div class="invalid-feedback">
                            กรุณากรอกอีเมล
                        </div>
                    </div>
                    <div class="form-group">
                        <label >รหัสผ่าน</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="" required>
                        <div class="invalid-feedback">
                            กรุณากรอกรหัสผ่าน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="ConPassword" name="ConPassword" placeholder="" required>
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        <div class="invalid-feedback">
                            กรุณากรอกยืนยันรหัสผ่าน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >หน่วยงาน</label>
                        <input type="text" class="form-control" id="Agency" name="Agency" placeholder="" required>
                        <div class="invalid-feedback">
                            กรุณากรอกหน่วยงาน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >ตำแหน่ง</label>
                        <input type="text" class="form-control" id="Rank" name="Rank" placeholder="" required>
                        <div class="invalid-feedback">
                            กรุณากรอกตำแหน่ง
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-block btn-dark" value="ลงทะเบียน">
                    </div>

                    <!-- <button type="submit" class="btn btn-primary">ยืนยัน</button><br><br> -->
                    <p><center>มีบัญชีอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a></center></p>
                </form>
            
        </div>
    </div>



    
</body>
</html>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>