<?php
/*
session_start();
include("session_expire.php");
setSessionTime(300, "login.php", null, $_SESSION['idno'], true);
if (!isset($_SESSION)) {
    session_start();
} else {
    session_unset();
    session_destroy();
    session_start();
}
/*
setSessionTime(
    เวลาวินาทีของอายุ,
    ไฟล์ที่ต้องการลิ้งค์ไปเมื่อ session ถูกทำลาย,
    การส่งค่ากลับกรณีใช้กับ ajax,
    ตัวแปร session ที่ต้องการกำหนดสิทธิ์เข้าเพจ,
    อัพเดทเวลาล่าสุดอัตโนมัติ
    );
*/

// Start the session
session_start();

// Include the session_expire.php file if it contains necessary functions
include("session_expire.php");

// Check if the session ID is set and the session exists
if (isset($_SESSION['idno']) && session_status() === PHP_SESSION_ACTIVE) {
    // Set session expiration time (300 seconds in this case)
    setSessionTime(600, "login.php", null, $_SESSION['idno'], true);
} else {
    // Redirect or handle the situation when the session ID is not set
    header("Location: login.php");
    exit(); // Ensure no further code execution after redirection
}

// Clear previous session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Start a new session
session_start();

/*
setSessionTime(
    เวลาวินาทีของอายุ,
    ไฟล์ที่ต้องการลิ้งค์ไปเมื่อ session ถูกทำลาย,
    การส่งค่ากลับกรณีใช้กับ ajax,
    ตัวแปร session ที่ต้องการกำหนดสิทธิ์เข้าเพจ,
    อัพเดทเวลาล่าสุดอัตโนมัติ
    );
*/