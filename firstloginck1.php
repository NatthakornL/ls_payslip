<!doctype html>
<html>

<head>
    <!-- SweetAlert2 -->
    <script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบ E-PaySlip Lerdsin</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    error_reporting(E_ALL ^ E_WARNING);

    if (isset($_SESSION['noman']) && isset($_SESSION['idno'])) {
        include 'connect.php';

        if (isset($_POST['currentPassword']) && isset($_POST['confirm_password'])) {
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $currentPassword = validate($_POST['currentPassword']);
            $confirm_password = validate($_POST['confirm_password']);

            if (empty($currentPassword)) {
                echo "<script>
        alert('กรุณาใส่รหัสผ่านใหม่ด้วย!!!');
        window.location = 'firstlogin1.php'
        </script>";
                exit();
            } else if ($currentPassword !== $confirm_password) {
                echo "<script>
            alert('รหัสผ่านใหม่เเละยืนยันรหัสผ่านไม่ตรงกัน!!!');
            window.location = 'firstlogin1.php'
            </script>";
                exit();
            } else {

                $idno = $_SESSION['idno'];

                $sql = "SELECT passc FROM tbmain WHERE idno='$idno'  ";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) === 1) {

                    $sql1 = "UPDATE tbmain SET passc='$confirm_password', chn='1', dayup=now() WHERE idno='$idno' ";
                    mysqli_query($connect, $sql1);
                    echo "<script>
            $(function() {
        
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนรหัสผ่านเรียบร้อยเเล้ว!!!',
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
                    window.location = 'login.php';
                })
            });
            </script>";
                    exit();
                } else {
                    echo "<script>
            $(function() {
        
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'รหัสผ่านไม่ถูกต้อง!!!',
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
                    window.location = 'firstlogin1.php';
                })
            });
            </script>";
                    exit();
                }
            }
        }
    }


    ?>
</body>

</html>