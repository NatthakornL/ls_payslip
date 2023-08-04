<?php
/*
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 */

 /*
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE tbmain SET password = ? WHERE noman = ?";
        
        if($stmt = mysqli_prepare($dbo, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["noman"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connect);
}
*/

include "include/session.php";
include "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(60,"login.php",null,$_SESSION['idno'],true);


/*
setSessionTime(
    เวลาวินาทีของอายุ,
    ไฟล์ที่ต้องการลิ้งค์ไปเมื่อ session ถูกทำลาย,
    การส่งค่ากลับกรณีใช้กับ ajax,
    ตัวแปร session ที่ต้องการกำหนดสิทธิ์เข้าเพจ,
    อัพเดทเวลาล่าสุดอัตโนมัติ
    );

    ค่าที่ 2 -5 สามารถกำหนดเป็น null ถ้าไม่ต้องการใช้งาน ขึ้นกับแล้วแต่เงื่อนไข
*/


?>

<!<!DOCTYPE html>
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

    <body id="bg">
        <?php
    //print_r($_SESSION);
    require "check.php";
    ?>

        <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
            style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
            <thead style="width: 90%; height: auto; ">
            <tbody>
                <tr>
                    <form method="post" action="">
                        <td style="width: 15%; padding-bottom: 10px;"></td>
                        <td style="width: 60%; padding-bottom: 10px;">
                            <li style="font-size: 16px; font-weight: 600; text-align: center;"><i
                                    class="em em-bust_in_silhouette" aria-role="presentation"
                                    aria-label="BUST IN SILHOUETTE" style="margin-right: 10px;"></i>ยินดีต้อนรับ :
                                คุณได้เข้าสู่ระบบเรียบร้อยเเล้ว<i class="em em-bust_in_silhouette"
                                    aria-role="presentation" aria-label="BUST IN SILHOUETTE"
                                    style="margin-left: 10px;"></i></li>


                            <li
                                style="padding-left: 5%; font-size: 16px; font-weight: 600; text-align: center; width: 90%; height: auto; ">
                                คุณ
                                : <span
                                    style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 1%; width: 50%; ">
                                    <?php echo ''.$_SESSION["nname"]. ' '; ?></span>
                            </li>


                            <li style="font-size: 16px; font-weight: 600; text-align: center;">หน่วยงาน : <span
                                    style="font-size: 16px; font-weight: 600; text-align: center;">โรงพยาบาลเลิดสิน</span>
                            </li>

                            <li style="font-size: 16px; font-weight: 600; text-align: center;">
                                หน้าจอนี้สำหรับกำหนดรหัสผ่าน
                                ( Password ) เฉพาะตัวคุณในการเข้าสู่ระบบ</li>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; text-decoration: underline; color: red; padding-left: 20%;">
                                โปรดอ่าน !!!</li>
                            <li style="font-size: 16px;  text-align: left;  padding-left: 20%; padding-right: 20%;">
                                1. พิมพ์ <b>ตัวอักษรภาษาอังกฤษเเละตัวเลข</b> ลงในช่องรหัสผ่านใหม่
                                ต้อพิมพ์ให้เหมือนกันทั้ง 2
                                ช่องเพื่อเป็นการยืนยัน <b style="color: red;">(
                                    รหัสผ่านต้องเป็นภาษาอังกฤษเเละตัวเลขเท่านั้น
                                    <b style="text-decoration: underline;">ห้าม ใช้อักขระพิเศษเเละเว้นวรรค</b> )</b>
                            </li>
                            <li style="font-size: 16px;  text-align: left;  padding-left: 20%; padding-right: 20%;">2.
                                รหัสผ่านควรกำหนดจำนวน<b>ไม่น้อยกว่า 8 ตัว</b></li>
                            <li style="font-size: 16px;  text-align: left;  padding-left: 20%; padding-right: 20%;">3.
                                ต้องปกปิดรหัสผ่านเป็นความลับเฉพาะตัวของท่าน <b
                                    style="text-decoration: underline;">ห้าม</b>
                                เปิดเผยเเก่ผู้อื่น ป้องกันข้อมูลของท่านถูกนำไปใช้ในทางมิชอบ
                            </li>
                            <li style="font-size: 16px;  text-align: left;  padding-left: 20%; padding-right: 20%;">4.
                                การเข้าสู่ระบบครั้งต่อไป <b style="text-decoration: underline;">ต้องใช้</b>
                                เลขบัตรประชาชน
                                13 หลัก เป็น "ชื่อผู้ใช้ (Username)"
                                เเละใช้รหัสผ่านที่ท่านได้กำหนดใหม่ในครั้งนี้ เป็น "รหัสผ่าน (Password)"
                            </li>
                            <li style="font-size: 16px;  text-align: left;  padding-left: 20%; padding-right: 20%;">5.
                                <b>กรณีเข้าระบบไม่ได้หรือลืมรหัสผ่าน</b> โปรดติดต่อเบอร์ 9833 เเจ้งข้อมูลส่วนบุคคล
                                เพื่อให้เจ้าหน้าที่ตรวจสอบความเป็นตัวตนที่ถูกต้อง
                            </li>

                        </td>
                        <td style="width: 15%; padding-bottom: 10px;"></td>
                    </form>
                </tr>
                <tr style="padding: 5%;">
                    <!------------------------------------------------------>
                    <td style="width: 15%; padding-bottom: 10px;"></td>
                    <!------------------------------------------------------>
                    <form method="post" id="form1" action="firstloginck.php">
                        <td style="width: 40%; padding-bottom: 1%; padding-top: 1%;"><span
                                style="font-size: 20px; font-weight: 600;">กำหนดรหัสผ่าน (Password) เฉพาะตัวคุณ
                                เเละเข้าสู่ระบบอีกครั้ง</span><br><br>
                            <li><?php if(isset($message)) { echo $message; } ?></li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; padding-right: 14%;">
                                กรอกรหัสผ่านเดิม : <span style="padding-left: 33px;"><input class="txtidcard"
                                        type="password" name="old_password" maxlength="13" required /></span>
                            </li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; padding-right: 14%;">
                                กำหนดรหัสผ่านใหม่ : <span style="padding-left: 19px;"><input class="txtidcard"
                                        type="password" name="currentPassword" maxlength="20" /></span>
                            </li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; padding-right: 14%;">
                                ยืนยันรหัสผ่านอีกครั้ง : <span style="padding-left: 10px;"><input class="txtpass "
                                        type="password" name="confirm_password" maxlength="20" required /></span><br><b
                                    style="color: red; padding-left: 27%">*ใส่รหัสเหมือนช่องบน*</b></li><br>

                            <li><input class="btnaddata" type="submit" name="change_password" value="เเก้ไขรหัสผ่าน"
                                    style="cursor: pointer; border: 1px solid #000; background-color: #68DD00; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                <span style="margin-left: 2%;"><input class="btnaddata" type="button" name=""
                                        id="butcancel" value="ยกเลิก" onclick="funClear()"
                                        style="cursor: pointer; border: 1px solid #000; background-color: #DD3600; border-radius: 5px; width: 100px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                </span>
                            </li><br>
                            <li style="color: red; font-size: 20px;"><i class="em em-x" aria-role="presentation"
                                    aria-label="CROSS MARK"></i>
                                <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');"><b
                                        style="text-decoration: underline;">ออกจากระบบ</b></a><i class="em em-x"
                                    aria-role="presentation" aria-label="CROSS MARK"></i>
                            </li>
                        </td>
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