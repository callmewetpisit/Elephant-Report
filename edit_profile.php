<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Register</title>
    <style>
        body{ font: 14px sans-serif; }
        .wrappers{ width: 360px; padding: 30px; }
        
    </style>
</head>
<body>

<div class="d-flex justify-content-center">
    <div class="wrappers">
        <div class="card bg-light">
            <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class=" needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >ชื่อ</label>
                            <input type="text" class="form-control" id="Firstname" name="Firstname" aria-describedby="emailHelp" placeholder="ชื่อ" required>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อ
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label >นามสกุล</label>
                            <input type="text" class="form-control" id="Lastname" name="Lastname" aria-describedby="emailHelp" placeholder="นามสกุล" required>
                            <div class="invalid-feedback">
                                กรุณากรอกนามสกุล
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label >ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="Usertname" name="Usertname" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้" required>
                        <div class="invalid-feedback">
                            กรุณากรอกชื่อผู้ใช้
                        </div>
                    </div>
                    <div class="form-group">
                        <label >รหัสผ่าน</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="รหัสผ่าน" required>
                        <div class="invalid-feedback">
                            กรุณากรอกรหัสผ่าน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="ConPassword" name="ConPassword" placeholder="ยืนยันรหัสผ่าน" required>
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        <div class="invalid-feedback">
                            กรุณากรอกยืนยันรหัสผ่าน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >หน่วยงาน</label>
                        <input type="text" class="form-control" id="Agency" name="Agency" placeholder="ชื่อหน่วยงาน" required>
                        <div class="invalid-feedback">
                            กรุณากรอกหน่วยงาน
                        </div>
                    </div>
                    <div class="form-group">
                        <label >ตำแหน่ง</label>
                        <input type="text" class="form-control" id="Rank" name="Rank" placeholder="ตำแหน่ง" required>
                        <div class="invalid-feedback">
                            กรุณากรอกตำแหน่ง
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">ยืนยัน</button><br><br>
                    
                </form>
            </div>
        </div>
    </div>
</div>


    
</body>
</html>