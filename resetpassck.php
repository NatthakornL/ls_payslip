<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
    <title>Document</title>
</head>

<body>

    <!--<button type="button" id="alert">Alert</button>-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>


    <?php
session_id();
session_start();
include 'connect.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$noman = $_GET['noman'];

/*
if(isset($_GET['noman'])){
    $sql = "SELECT * FROM tbmain WHERE noman = {$_GET['noman']} ";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
}
*/
//UPDATE 
$status = "";
if(isset($_POST['reset_password'])){

    $noman = $_SESSION['noman'];
    $resetPassword = $_POST['resetPassword'];
    $confirm_reset = $_POST['confirm_reset'];

    
    $select = "SELECT * FROM tbmain WHERE noman='$noman' ";
    $sql = mysqli_query($connect, $select) or die(mysqli_error($connect));
    $row = mysqli_fetch_assoc($sql);

    if($resetPassword == $confirm_reset){
    $store_password = $resetPassword;

    $update = "UPDATE tbmain SET passc = '$store_password' , chn='0', dayup=now() WHERE
    noman = {$_GET['noman']} ";
    $up = mysqli_query($connect, $update) or die(mysqli_error($connect));
    if($up)
    {
        echo "<script>
        $(function() {
    
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'รีเซ็ตรหัสผ่านเรียบร้อยเเล้ว!!!',
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
                window.location = 'admin.php';
            })
        });
        </script>";
    }
    else
    {
        echo "<script>
        $(function() {
    
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ไม่สามารถรีเซ็ตรหัสผ่านได้สำเร็จ!!!',
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
                window.location = 'resetpass.php';
            })
        });
        </script>";
    }
}/*else{
    echo "<script>
        alert('เกิดปัญหาในการรีเซ็ตรหัสผ่าน!!!');
        window.location = 'resetpass.php'
</script>";
}*/
}
?>
</body>

</html>


<!--===================== COMMENT ZONE =============================-->

<!--
    echo "<script>
        alert('ทำการรีเซ็ตรหัสผ่านเรียบร้อยเเล้ว!!!');
        window.location = 'admin.php'
</script>";

    /*
$noman = $_REQUEST['noman'];

include ("connect.php");

if($noman !== ""){
    $query = mysqli_query($connect, "SELECT passc FROM tbmain WHERE noman = '$noman' ");
    $row = mysqli_fetch_array($query);

    $passc = $row["passc"];
}
$result = array("$passc");
$myJSON = json_encode($result);
echo $myJSON;
*/
-->

<!--========================================================
    session_start();
include "connect.php";

/*
$noman = $_REQUEST['noman'];
$query = "SELECT * FROM 'tbmain' WHERE noman='".$noman."' ";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));
$row = mysqli_fetch_assoc($result);
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/*
$options = [
'cost' => 10,
];
*/

error_reporting(~E_NOTICE);
//error_reporting(0);


if(isset($_POST["reset_password"])){

$noman = $_GET["noman"];
$sql = "SELECT passc FROM tbmain WHERE noman = '$noman' ";
$result = $connect->query($sql);
if($result->num_rows == 1){
    if($row = $result->fetch_assoc()){
        
    }
}

$resetPassword = $_POST["resetPassword"];
$confirm_reset = $_POST["confirm_reset"];
/*
$query = "SELECT * FROM tbmain WHERE noman = $noman";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));
$row = mysqli_fetch_assoc($result);
*/
if($resetPassword == $confirm_reset){

$store_password = $resetPassword;


$sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='0', dayup=now() WHERE
noman = '$noman' ";

$objQuery = $connect->query($sql);
$objResult = $objQuery->fetch_assoc();

mysqli_close($connect);

if($result){
echo "<script>
alert('ทำการเเก้ไขรหัสผ่านเรียบร้อยเเล้ว!!!');
window.location = 'admin.php'
</script>";
}else{
echo "<script>
alert('รหัสผ่านไม่ตรงกัน!!!กรุณาลองใหม่อีกครั้ง');
window.location = 'resetpass.php'
</script>";
}
}
}
=======================================================-->

<!-- 
/*
session_start();
include 'connect.php'; // 1) connect to db 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST["reset_password"])){

if(isset($_POST['resetPassword']) && isset($_POST['confirm_reset'])){
    //if(!$noman = $_SESSION['noman']) return die('No User Session Found!!'); // 2) make sure you are logged in
    //$sql = "SELECT idno, passc FROM tbmain WHERE noman = $noman";
    //$result = mysqli_query($connect, $sql) or die (mysqli_error($connect)); // 3) to check whether users exist or not

    //$row = mysqli_fetch_array($result, MYSQLI_BOTH);

    if(['resetPassword'] == $_POST['confirm_reset']){ // 4) checks previous password
        $sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='0', dayup=now() WHERE
noman = '"
.$_SESSION["noman"]. "'
";
        $result = mysqli_query($connect, $update) or die(mysqli_error($connect));

        if($result){
            echo "<script>
            alert('รหัสผ่านได้ทำการรีเซ็ตเรียบร้อยเเล้ว!!!');
            window.location = 'admin.php'
            </script>";
        }else{
            echo "<script>
            alert('รหัสผ่านไม่ตรงกัน!!!');
            window.location = 'resetpass.php'
            </script>";
        }
    }

}
}
*/
-->


<!--
if($resetPassword == $confirm_reset){

$store_password = $resetPassword;

$sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='0', dayup=now() WHERE
noman = '"
.$_SESSION["noman"]. "'
";
mysqli_query($connect, $sql);

echo "<script>
alert('รหัสผ่านได้ทำการรีเซ็ตเรียบร้อยเเล้ว!!!');
window.location = 'admin.php'
</script>";
}else{
echo "<script>
alert('รหัสผ่านไม่ตรงกัน!!!');
window.location = 'resetpass.php'
</script>";
}
}else{
echo "<script>
alert('รหัสผ่านไม่ถูกต้อง!!!กรุณาลองใหม่อีกครั้ง');
window.location = 'resetpass.php'
</script>";
}

//window.location = 'firstlogin.php'
-->