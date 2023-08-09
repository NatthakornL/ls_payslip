<?php 
include "include/session.php";
include "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(300,"login.php",null,$_SESSION['idno'],true);
error_reporting(E_ALL ^ E_WARNING); 
?>

<html lang="en">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>ระบบ E-PaySlip Lerdsin</title>
<!--stylesheet-->
<script type="text/javascript" src="scripts.js"></script>
<link rel="stylesheet" href="style1.css" />
<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
<!--======================= jQuery library ===========================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
    var btn = $('#backToTop');
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });
});
</script>
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
    width: 100%;
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
    vertical-align: top;
}

.txtpass {
    padding: 5px;
    width: 56%;
    height: 30px;
    border: 1px solid;
    border-radius: 5px;
    font-size: 16px;
    vertical-align: top;
}
</style>
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
                    <div
                        style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">

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
                            ต้องปกปิดรหัสผ่านเป็นความลับเฉพาะตัวของท่าน <b style="text-decoration: underline;">ห้าม</b>
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
                    </div>
                    <div
                        style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">

                        <form method="post" id="form1" action="firstloginck.php">

                            <li style="font-size: 16px; font-weight: 600; text-align: center;"><i
                                    class="em em-bust_in_silhouette" aria-role="presentation"
                                    aria-label="BUST IN SILHOUETTE" style="margin-right: 10px;"></i>ยินดีต้อนรับ :
                                คุณได้เข้าสู่ระบบเรียบร้อยเเล้ว<i class="em em-bust_in_silhouette"
                                    aria-role="presentation" aria-label="BUST IN SILHOUETTE"
                                    style="margin-left: 10px;"></i></li><br>
                            <li
                                style=" font-size: 16px; font-weight: 600;  width: 100%; height: auto; text-align: center;">
                                คุณ
                                : <span
                                    style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 1%; width: 50%; ">
                                    <?php echo ''.$_SESSION["nname"]. ' '; ?></span>
                                <b style="margin-left: 3%;">ตำเเหน่ง
                                    : </b><span
                                    style=" font-size: 16px; font-weight: 600; text-align: left; padding-left: 1%; width: 50%; ">
                                    <?php if($_SESSION["noffice"]=='0'){
                                echo "พนักงานราชการ";
                            }else if($_SESSION["noffice"]=='1'){
                                echo "ลูกจ้างชั่วคราวเงินบำรุง";
                            }else if ($_SESSION["noffice"]=='2'){
                                echo "พนักงานกระทรวงสาธารณสุข";
                            }else{
                                exit();
                            } ?></span>
                            </li><br>

                            <li
                                style=" font-size: 20px; font-weight: 600;  width: 100%; height: auto; text-align: center;">
                                <span>กำหนดรหัสผ่าน
                                    (Password)
                                    เฉพาะตัวคุณ
                                    เเละเข้าสู่ระบบอีกครั้ง</span>
                            </li>
                            <li><?php if(isset($message)) { echo $message; } ?></li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                กรอกรหัสผ่านเดิม : <span style="padding-left: 33px;"><input class="txtidcard"
                                        type="password" name="old_password" pattern="^[a-zA-Z0-9\s]+$" maxlength="13"
                                        required /></span>
                            </li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                กำหนดรหัสผ่านใหม่ : <span style="padding-left: 19px;"><input class="txtidcard"
                                        type="password" name="currentPassword" maxlength="16" pattern="^[a-zA-Z0-9\s]+$"
                                        title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" /></span>
                            </li><br>
                            <li
                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 20%; padding-right: 14%;">
                                ยืนยันรหัสผ่านอีกครั้ง : <span style="padding-left: 10px;"><input class="txtpass "
                                        type="password" name="confirm_password" maxlength="16" required
                                        pattern="^[a-zA-Z0-9\s]+$"
                                        title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" /></span><br><b
                                    style="color: red; padding-left: 28%">*ใส่รหัสเหมือนช่องบน*</b></li><br>

                            <li style="text-align: center;"><input class="btnaddata" type="submit"
                                    name="change_password" value="เเก้ไขรหัสผ่าน"
                                    style="cursor: pointer; border: 1px solid #000; background-color: #68DD00; border-radius: 5px; width: 120px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                <span style="margin-left: 2%;"><input class="btnaddata" type="button" name=""
                                        id="butcancel" value="ยกเลิก" onclick="funClear()"
                                        style="cursor: pointer; border: 1px solid #000; background-color: #DD3600; border-radius: 5px; width: 120px; height: 30px; margin: auto;  align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                </span>
                            </li><br>
                            <!--
                                        <li style="color: red; font-size: 20px;"><i class="em em-x"
                                                aria-role="presentation" aria-label="CROSS MARK"></i>
                                            <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');"><b
                                                    style="text-decoration: underline;">ออกจากระบบ</b></a><i
                                                class="em em-x" aria-role="presentation" aria-label="CROSS MARK"></i>
                                        </li>
                            -->

                        </form>
                    </div>
                    <li>
                        <div style="display: grid; justify-items: center;">
                            <button class="btn btn--radius-2 btn--orange" type="button"><a href="logout.php"
                                    style="color: #fff;"
                                    onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></button>
                        </div>
                    </li>
                </div>
                <!--END card body-->
            </div>
        </div>
    </div>
</div>

</html>