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

        if (isset($_POST['old_password']) && isset($_POST['currentPassword']) && isset($_POST['confirm_password'])) {
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $old_password = validate($_POST['old_password']);
            $currentPassword = validate($_POST['currentPassword']);
            $confirm_password = validate($_POST['confirm_password']);

            if (empty($old_password)) {
                echo "<script>
        alert('กรุณาใส่รหัสผ่านเก่าด้วย!!!');
        window.location = 'firstlogin.php'
        </script>";
                exit();
            } else if (empty($currentPassword)) {
                echo "<script>
        alert('กรุณาใส่รหัสผ่านใหม่ด้วย!!!');
        window.location = 'firstlogin.php'
        </script>";
                exit();
            } else if ($currentPassword !== $confirm_password) {
                echo "<script>
            alert('รหัสผ่านใหม่เเละยืนยันรหัสผ่านไม่ตรงกัน!!!');
            window.location = 'firstlogin.php'
            </script>";
                exit();
            } else {
                $idno = $_SESSION['idno'];

                $sql = "SELECT passc FROM tbmain WHERE idno='$idno' AND passc='$old_password' ";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) === 1) {

                    $sql1 = "UPDATE tbmain SET passc='$currentPassword', chn='1', dayup=now() WHERE idno='$idno' ";
                    mysqli_query($connect, $sql1);
                    echo "<script>
            $(function() {
        
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เเก้ไขรหัสผ่านเรียบร้อยเเล้ว!!!',
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
                    window.location = 'firstlogin.php';
                })
            });
            </script>";
                    exit();
                }
            }
        } else {
            header("Location: firstlogin.php");
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }

    ?>
</body>

</html>
<!--
session_start();
include 'connect.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ E_WARNING);

$noman = isset($_GET['noman']);
$old_password = $_POST["old_password"];
$currentPassword = $_POST["currentPassword"];
$confirm_password = $_POST["confirm_password"];

if(isset($_POST["change_password"])){

$sql1 = "SELECT idno,passc FROM tbmain WHERE idno='$idno' AND passc='$passc'";
$result = mysqli_query($connect,$sql1);
$num = mysqli_num_rows($result);

if($num == 0){
echo "<script>
alert('Incorrect Old Password');
</script>";
die("<script>
alert('Old password incorrect');
history.back();
</script>");
}else if($currentPassword == $confirm_password){

$store_password = $currentPassword;

$sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='1', dayup=now() WHERE
noman = '"
.$_SESSION["noman"]. "' AND passc='$passc'
";
mysqli_query($connect, $sql);

echo "<script>
alert('เเก้ไขรหัสผ่านเรียบร้อยเเล้ว!!!');
window.location = 'login.php'
</script>";


}else{
echo "<script>
alert('รหัสผ่านไม่ตรงกัน!!!');
window.location = 'firstlogin.php'
</script>";
}
}else{
echo "<script>
alert('รหัสผ่านไม่ถูกต้อง!!!กรุณาลองใหม่อีกครั้ง');
window.location = 'firstlogin.php'
</script>";
}
*/

/*
session_start();
include 'connect.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ E_WARNING);

$noman = isset($_GET['noman']);
$old_password = $_POST["old_password"];
$currentPassword = $_POST["currentPassword"];
$confirm_password = $_POST["confirm_password"];

if(isset($_POST["change_password"])){
if($old_password!="" && $currentPassword!=""){// กรอกทั้งสองมาแล้ว

$sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='1', dayup=now() WHERE
noman = '"
.$_SESSION["noman"]. "' AND passc='$passc'
";
if($mysqli->query($sql_update)){ // มีการคิวรี่อัพเพทข้อมูล
if($mysqli->affected_rows>0){ // การคิวรี่มีการเปลี่ยนแปลงค่า
echo "<script>
alert('เเก้ไขรหัสผ่านเรียบร้อยเเล้ว!!!');
window.location = 'login.php'
</script>";// แจ้งแก้ไขรหัสผ่านเรียบร้อยแล้ว
}else{ // การคิวรี่ไม่มีการเปลี่ยนแปลงค่า เช่น กรณีเราอัพเดทค่าเดิม
echo "<script>
alert('กรุณาใส่รหัสผ่านที่ไม่ซ้ำกับรหัสผ่านเดิม!!!');
window.location = 'firstlogin.php'
</script>";// แจ้งให้เปลี่ยนรหัสผ่านใหม่ ไม่ซ้ำรหัสผ่านเดิม
}
}else{
echo "<script>
alert('รหัสผ่านเดิมไม่ถูกต้อง!!!');
window.location = 'firstlogin.php'
</script>";// แจ้งรหัสผ่านเก่าไม่ถูกต้อง
}


}else{
echo "<script>
alert('กรุณาใส่รหัสผ่านเดิม เเละรหัสผ่านใหม่ด้วย!!!');
window.location = 'firstlogin.php'
</script>";// เตือนให้กรอกทั้ง pw เก่า และใหม่ ที่จะแก้ไข
}
}

-->