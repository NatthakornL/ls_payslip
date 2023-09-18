<?php

include "include/session.php";
include "connect.php";

session_unset();
session_destroy();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
    <title>ระบบ E-PaySlip Lerdsin</title>

</head>

<body>
    <?php
    /*
    echo "<script>
    alert('ออกสู่ระบบเรียบร้อยเเล้ว!!!');
    window.location = 'login.php'
    </script>";
*/
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script>
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'เข้าสู่ระบบไม่ถูกต้อง!!!',
        showConfirmButton: false,
        timer: 2000,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        if (result.value) {
            location.href = "login.php";
        }
    });
    </script>
</body>

</html>