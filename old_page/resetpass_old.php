<?php 

session_start();

require "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(300,"login.php",null,$_SESSION['idno'],true);
error_reporting(E_ALL ^ E_WARNING); 

?>

<!DOCTYPE html>
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
    <link rel="stylesheet" href="style.css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
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
<header>
    <div class="top">
        <div class="logo">
            <img src="./images/logoheader.jpg" />
        </div>
    </div>
</header>

<body>
    <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
        style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
        <thead style="width: 90%; height: auto; ">
        <tbody>

            <tr style="padding: 5%;">
                <!------------------------------------------------------>
                <td style="width: 15%; padding-bottom: 10px;"></td>
                <!------------------------------------------------------>
                <form method="POST" id="form1" action="resetpassck.php" enctype="multipart/form-data">
                    <?php
                        $noman = mysqli_real_escape_string($connect, $_GET['noman']);

                        $query = "SELECT * FROM tbmain WHERE noman = '$noman' ";
                        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                        $row = mysqli_fetch_array($result);
                        extract($row);
                        ?>
                    <input type="hidden" name="noman" value="1" />
                    <td style="width: 40%; padding-bottom: 1%; padding-top: 1%;"><span
                            style="font-size: 20px; font-weight: 600;">รีเซ็ตรหัสผ่านใหม่ (Reset Password)
                            สำหรับเปลี่ยนรหัสคืนค่าให้ผู้ใช้</span><br><br>
                        <li><?php if(isset($message)) { echo $message; } ?></li><br>
                        <li style="margin-left: 15%; text-align: left; font-size: 16px; display: flex; width: 55%;">
                            <span style="font-weight: 600; width: 35%; ">รหัสบัตรประชาชน :
                            </span>
                            <span style="width: 40%; text-align: left; padding-left: 2%; "><?php echo $row['idno']; ?>
                            </span>

                        </li><br>
                        <li style="margin-left: 15%; text-align: left; font-size: 16px; display: flex; width: 55%;">
                            <span style="font-weight: 600; width: 20%; ">ชื่อ - สกุล :
                            </span>
                            <span style="width: 90%; text-align: left; padding-left: 2%; "><?php echo $row['nname']; ?>
                            </span>
                        </li><br>


                        <li
                            style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; padding-right: 14%;">
                            กำหนดรหัสผ่านใหม่ : <span style="padding-left: 19px;"><input class="txtidcard"
                                    type="password" name="resetPassword[<?php echo $noman ?>]" maxlength="20" /></span>
                        </li><br>
                        <li
                            style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; padding-right: 14%;">
                            ยืนยันรหัสผ่านอีกครั้ง : <span style="padding-left: 10px;"><input class="txtpass "
                                    type="password" name="confirm_reset[<?php echo $noman ?>]" maxlength="20"
                                    required /></span><br><b
                                style="color: red; padding-left: 30%">*ใส่รหัสเหมือนช่องบน*</b></li><br>

                        <li><input class="btnaddata" type="submit" name="reset_password" onclick="update()"
                                value="เเก้ไขรหัสผ่าน"
                                style="cursor: pointer; border: 1px solid #000; background-color: #68DD00; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                            <span style="margin-left: 3%;"><input class="btnaddata" type="button" name="" id="butcancel"
                                    value="ยกเลิก" onclick="funClear()"
                                    style="cursor: pointer; border: 1px solid #000; background-color: #DD3600; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                            </span>

                        </li><br>
                        <!--
                            <li style="color: red; font-size: 20px;"><i class="em em-x" aria-role="presentation"
                                    aria-label="CROSS MARK"></i>
                                <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');"><b
                                        style="text-decoration: underline;">กลับหน้า</b></a><i class="em em-x"
                                    aria-role="presentation" aria-label="CROSS MARK"></i>
                            </li>
-->
                    </td>
                    <script>
                    function update() {
                        var x;
                        if (confirm("Updated data Sucessfully") == true) {
                            x = "update";
                        }
                    }
                    </script>
                </form>
                <!------------------------------------------------------>
                <td style="width: 15%;"><span style="font-size: 20px; font-weight: 600;"></td>
            </tr>
        </tbody>
        </thead>

    </table>

    <footer style="height: 5%;"></footer>
</body>

</html>