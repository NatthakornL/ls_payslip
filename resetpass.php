<?php
session_start();
require "connect.php";
error_reporting(E_ALL ^ E_WARNING);
$noman = $_REQUEST['noman'];


?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="GENERATOR" content="Arachnophilia 4.0">
    <meta name="FORMATTER" content="Arachnophilia 4.0">
    <title>ระบบ E-PaySlip Lerdsin</title>
    <!--stylesheet-->
    <script type="text/javascript" src="scripts.js"></script>
    <link rel="stylesheet" href="style1.css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/icon.ico">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<style>
    @viewport {
        width: device-width;
        zoom: 1.0;
    }

    @-ms-viewport {
        width: device-width;
    }

    table {
        border: 1px solid #bdc3c7;
        border-collapse: collapse;
        text-align: center;
        width: 90%;
        border-color: #000;
        border-spacing: 0;
    }

    td {
        text-align: center;
        font-size: 15px;
        height: auto;
        border: 1px solid #000;
    }

    .txtidcard {
        padding: 5px;
        width: 56%;
        height: 30px;
        border: 1px solid;
        border-radius: 5px;
        font-size: 16px;
    }

    .txtpass {
        padding: 5px;
        width: 56%;
        height: 30px;
        border: 1px solid;
        border-radius: 5px;
        font-size: 16px;
    }
</style>
<script>
    function funClear() {
        document.getElementById("form1").reset();
        window.location = "admin.php";
    }
</script>
<script src="ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        //ถ้าต้องการใช้งาน auto logout ด้วย ajax  ให้เอา comment ส่วนนี้ออก    
        setInterval(function() { // กำหนดการทำงานทุกกี่วินาที
            $.post("check_session.php", function(data) { // เรียกไฟล์ตรวจสอบ session
                if (data == 1) { // เมื่อ session ถูกทำลายแล้ว
                    window.location = "login.php"; // ส่งไปหน้า login.php  
                }
            });
        }, 60000); // กำหนดวินาที ที่ต้องการ ทุก 1 นาทีหรือ 60000 ก็ได้ ตัวอย่างกำหนดแค่ทุกๆ 5 วินาที
    });
</script>
<script>
    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPassword(form) {
        resetPassword = form.resetPassword.value;
        confirm_reset = form.confirm_reset.value;

        // ถ้าช่่องรหัสผ่านไม่ถูกกรอก
        if (resetPassword == '')
            alert("กรุณาใส่รหัสผ่าน!!!");

        // ถ้าช่่องยืนยันรหัสผ่านไม่ถูกกรอก
        else if (confirm_reset == '')
            alert("กรุณาใส่รหัสผ่านอีกครั้ง!!!");

        //ถ้าทั้งสองช่องไม่ตรงกัน   ให้แจ้งผู้ใช้  และ  return false
        else if (resetPassword != confirm_reset) {
            alert("\nรหัสผ่านไม่ตรงกัน!!! กรุณาลองใหม่อีกครั้ง!!!")
            return false;
        }

        //ถ้าทั้งสองช่องตรงกัน  return true
        else {
            Swal.fire(
                'Success!!!',
                'รีเซ็ตรหัสผ่านเรียบร้อยเเล้ว!!!',
                'ตกลง'
            )
            return true;
        }
    }
</script>

<div class="background">
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body">
                    <!--card body-->
                    <header>
                        <div class="top" style="margin-bottom: 1%;">
                            <div class="logo"><img src="./images/logoheader.jpg" />
                            </div>
                        </div>
                    </header>
                    <div style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">

                        <?php
                        if (isset($_GET['noman'])) {
                            $noman = mysqli_real_escape_string($connect, $_GET['noman']);

                            $query = "SELECT * FROM tbmain WHERE noman = '" . $_GET['noman'] . "' ";
                            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                            $row = mysqli_fetch_assoc($result);

                        ?>
                            <input type="hidden" name="noman" value="'.$_GET['noman'].'" />
                            <div style="width: 100%; text-align: center;">
                                <span style="font-size: 20px; font-weight: 600;">รีเซ็ตรหัสผ่านใหม่
                                    (Reset Password)
                                    สำหรับเปลี่ยนรหัสคืนค่าให้ผู้ใช้</span><br>
                            </div>
                            <li><?php if (isset($message)) {
                                    echo $message;
                                } ?></li><br>
                            <div style="width: 100%; text-align: center;">
                                <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                    ลำดับที่ : <span style="width: 90%; text-align: left; padding-left: 1%; "><?php echo $row['noman']; ?>
                                    </span>
                                </li><br>
                                <li style="margin-left: 20%; text-align: left; font-size: 16px; display: flex; width: 55%;">
                                    <span style="font-weight: 600; width: 29%; ">รหัสบัตรประชาชน
                                        :
                                    </span>
                                    <p style="width: 40%; text-align: left; padding-left: 1%; "><?php echo $row['idno']; ?>
                                    </p>

                                </li><br>
                                <li style="margin-left: 20%; text-align: left; font-size: 16px; display: flex; width: 55%;">
                                    <span style="font-weight: 600; width: 17%; ">ชื่อ - สกุล :
                                    </span>
                                    <span style="width: 90%; text-align: left; padding-left: 1%; "><?php echo $row['nname']; ?>
                                    </span>
                                </li><br>
                            <?php

                            mysqli_close($connect);
                        }
                            ?>
                            <form method="post" id="form1" onSubmit="return checkPassword(this)" action="resetpassck.php?noman=<?php echo $noman ?>">
                                <input type="hidden" name="reset_password" value="1" />
                                <input name="noman" type="hidden" value="<?php echo $row['noman']; ?>" />
                                <?php
                                echo '<p style="color:#FF0000;">' . $status . '</p>';
                                ?>
                                <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                    กำหนดรหัสผ่านใหม่ : <span style="padding-left: 19px;"><input class="txtidcard" type="password" name="resetPassword" maxlength="16" required pattern="^[a-zA-Z0-9\s]+$" title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" /></span>
                                </li><br>
                                <!--[<?php //echo $noman 
                                        ?>]-->
                                <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                    ยืนยันรหัสผ่านอีกครั้ง : <span style="padding-left: 10px;"><input class="txtpass " type="password" name="confirm_reset" maxlength="16" required pattern="^[a-zA-Z0-9\s]+$" title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" /></span><br><b style="color: red; padding-left: 28%">*ใส่รหัสเหมือนช่องบน*</b></li><br>
                            </div>

                            <div style="width: 100%; text-align: center;">
                                <li><input class="btnaddata" type="submit" name="reset_password" onclick="//update()" value="เเก้ไขรหัสผ่าน" style="cursor: pointer; border: 1px solid #000; background-color: #68DD00; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                    <span style="margin-left: 3%;"><input class="btnaddata" type="button" name="" id="butcancel" value="ยกเลิก" onclick="funClear()" style="cursor: pointer; border: 1px solid #000; background-color: #DD3600; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                    </span>

                                </li><br>
                            </div>

                            </form>
                            <?php
                            /*
                        error_reporting(0);
                        include ('connect.php');
                        if($_GET['reset_password']){
                            $noman = $_GET["noman"];

                            $resetPassword = $_POST["resetPassword"];
                            $confirm_reset = $_POST["confirm_reset"];

                        if($resetPassword == $confirm_reset){
                            $store_password = $resetPassword;

                            $update = "UPDATE tbmain SET passc = '$store_password' , chn='0', dayup=now() WHERE
                            noman = '$noman' ";
                        $up = mysqli_query($connect, $update);
                        if($up)
                        {
                        echo "<script>
                        alert('ทำการรีเซ็ตรหัสผ่านเรียบร้อยเเล้ว!!!');
                        window.location = 'admin.php';
                </script>";
                    }
                    else
                    {
                        echo "<script>
                        alert('รีเซ็ตรหัสผ่านไม่สำเร็จ!!!');
                        
                </script>";
                    }
                }
                                        }else{
                                            echo "ไม่สามารถบันทึกข้อมูลได้!!!";
                                        }
                                        */
                            ?>
                    </div><br>
                </div>
                <!--END card body-->
            </div>
        </div>
    </div>
</div>

</html>