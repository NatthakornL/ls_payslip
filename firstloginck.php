<?Php
/*
include "include/session.php";

include "connect.php";
?>
<!doctype html>

<html>

<body>
    <?Php
// check the login details of the user and stop execution if not logged in

///////Collect the form data /////

$currentPassword=$_POST['currentPassword'];
$confirm_password=$_POST['confirm_password'];
$old_password=$_POST['old_password'];
/////////////////////////

if(isset($todo) and $todo=="change-password"){
$status = "OK";
$msg="";

			
$count=$dbo->prepare("select passc from tbmain where noman=:noman");
$count->bindParam(":noman",$_SESSION['noman'],PDO::PARAM_STR, 15);
$count->execute();
$row = $count->fetch(PDO::FETCH_OBJ);


if($row->password<>$old_password){
$msg=$msg."Your old password  is not matching as per our record.<BR>";
$status= "NOTOK";
}					

if ( strlen($currentPassword) < 8 or strlen($currentPassword) > 20 ){
$msg=$msg."Password must be more than 8 char legth and maximum 20 char lenght<BR>";
$status= "NOTOK";}					

if ( $currentPassword <> $confirm_password ){
$msg=$msg."Both passwords are not matching<BR>";
$status= "NOTOK";}					



if($status<>"OK"){ 
echo "<font size=4 color=red>$msg</font><br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
}else{ // if all validations are passed.
$currentPassword=$currentPassword; // Encrypt the password before storing
//if(mysql_query("update plus_signup set password='$password' where userid='$_SESSION[userid]'")){
$sql=$dbo->prepare("update tbmain set passc=:password where noman='$_SESSION[noman]'");
$sql->bindParam(':password',$currentPassword,PDO::PARAM_STR, 32);
if($sql->execute()){
echo "<font face='Verdana' size='4' ><center>Thanks <br> Your password changed successfully. Please keep changing your password for better security</font></center>";
}else{echo "<font face='Verdana' size='2' color=red><center>Sorry <br> Failed to change password Contact Site Admin</font></center>";
} // end of if else if updation of password is successful
} // end of if else if status <>OK
} // end of if else todo

?>


</body>

</html>
*/

session_start();
include 'connect.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ E_WARNING);

/*
$options = [
'cost' => 10,
];
*/

if(isset($_POST["change_password"])){

$old_password = $_GET["old_password"];
$currentPassword = $_POST["currentPassword"];
$confirm_password = $_POST["confirm_password"];



if($currentPassword == $confirm_password){

$store_password = $currentPassword;

$sql = "UPDATE tbmain SET passc = '" .$store_password."' , chn='1', dayup=now() WHERE
noman = '"
.$_SESSION["noman"]. "'
";
mysqli_query($connect, $sql);

echo "
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

";

/*echo "<script>
alert('เปลี่ยนรหัสผ่านเรียบร้อยเเล้ว!!!');
window.location = 'login.php'
</script>";*/
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

//window.location = 'firstlogin.php'
?>