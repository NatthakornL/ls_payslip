<?php
/*
//Delete all previous PHPSESSID cookies
$past = 60 * 60 * 24 * 365 * 10;
setcookie('PHPSESSID', false, time() - $past);
//Delete all the data in the $_SESSION
$_SESSION = array();
//Delete the old session file (true) and create a new session id
session_regenerate_id(true);
if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    setcookie("username", '', time() - 300, '/');
    setcookie("password", '', time() - 300, '/');
}
*/

// Start the session
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Unset cookies for 'username' and 'password' if they exist
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    setcookie("username", '', time() - 3600, '/'); // Expire in the past
    setcookie("password", '', time() - 3600, '/'); // Expire in the past
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบ E-PaySlip Lerdsin</title>
    <link rel="icon" type="image/x-icon" href="./images/icon.ico">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'ออกจากระบบเรียบร้อยแล้ว!!!',
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
            }).then(function() {
                window.location = "./login.php";
            })

        });
    </script>
</body>

</html>