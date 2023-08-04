<?php
session_start();
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
*/
?>