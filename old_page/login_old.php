<?php
include "connect.php";
include "include/session.php";
include ("session_expire.php");
?>

<?php
if(isset($_POST['idno'])){
    $_SESSION['idno']=$_POST['idno'];
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ระบบ E-PaySlip Lerdsin</title>
    <!--stylesheet-->
    <script type="text/javascript" src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
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
<header>
    <div class="top">
        <div class="logo">
            <img src="./images/logoheader.jpg" />
        </div>
    </div>
</header>

<body id="bg">
    <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
        style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
        <thead style="width: 90%; height: auto; ">
        <tbody>
            <tr style="padding: 5%;">
                <td style="width: 25%; padding-bottom: 10px;"><span
                        style="font-size: 20px; font-weight: 600;">วัตถุประสงค์</span><br><br>
                    <li style="text-align: left; padding-left: 20px; padding-right: 20px;">1.
                        เพื่อเเจ้งรายละเอียดการโอนเงินเดือน ค่าจ้าง
                        ค่าตอบเเทน เข้าบัญชีของข้าราชการ ลูกจ้างประจำ เเละพนักงานราชการของโรงพยาบาลเลิดสิน</li>
                    <li style="text-align: left; padding-left: 20px; padding-right: 20px;">2.
                        เพื่อลดการใช้กระดาษทดเเทนการเเจกกระดาษสลิปเงินเดือน (INTRANET)</li>
                </td>
                <!------------------------------------------------------>
                <form method="post" action="checklogin.php">
                    <td style="width: 40%; padding-bottom: 1%; padding-top: 1%;"><span
                            style="font-size: 20px; font-weight: 600;">เข้าสู่ระบบการเเจ้งเงินเดือนออนไลน์</span><br><br>
                        <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%;">
                            รหัสบัตรประชาชน : <span style="padding-left: 5px;"><input class="txtidcard" type="text"
                                    name="idno" maxlength="13" required="" /></span>
                        </li><br>
                        <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%;">
                            รหัสผ่านเข้าสู่ระบบ : <span
                                style="background-color: #bdc3c7; width: 100%; height: auto;"><input class="txtpass"
                                    type="password" name="passc" maxlength="20" required="" /></span></li>
                        <li style="color: red;">(*ถ้าเข้าสู่ระบบครั้งเเรกให้ใส่รหัสผ่านเดียวกับเลขบัตรประชาชน)</li>
                        <li><input class="btnaddata" type="submit" name="submit" value="เข้าสู่ระบบ"
                                style="cursor: pointer; border: 1px solid #000; background-color: #FFC400; border-radius: 5px; width: 100px; height: 30px; margin: auto; display: flex; align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                        </li>
                        <li style="color: #FFAA00;">(**ผู้ใช้งานถ้าลืมรหัสผ่าน โปรดติดต่อ 9833
                            **ในวันเเละเวลาราชการเท่านั้น** )
                        </li>
                        <!--ไปหน้าสร้างรหัสผ่าน <a href="createPwd.php" target="_blank"> คลิก </a>-->
                    </td>
                </form>
                <!------------------------------------------------------>
                <td style="width: 25%;"><span style="font-size: 20px; font-weight: 600;">หมายเหตุ</span><br><br>
                    <li
                        style="word-break: break-all; color: red; font-size: 16px; text-align: left; padding-left: 10px; padding-right: 10px; word-wrap: break-word;">
                        ผู้ใดเข้าถึงโดยมิชอบซึ่งข้อมูลคอมพิวเตอร์ที่มีมาตรการ
                        ป้องกันการเข้าถึงโดยเฉพาะเเละมาตรการนั้นมิได้มีไว้สำหรับตน
                        ต้องระวางโทษจำคุกไม่เกินสองปี
                        หรือปรับไม่เกินสี่หมื่นบาท หรือทั้งจำทั้งปรับ(มาตรา 7
                        พระราชบัญญัติว่าด้วยการกระทำผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ.2550)</li>
                </td>
            </tr>
        </tbody>
        </thead>

    </table>
</body>
<?php
/*
  //print_r($_POST); //ตรวจสอบมี input อะไรบ้าง และส่งอะไรมาบ้าง 
 //ถ้ามีค่าส่งมาจากฟอร์ม
    if(isset($_POST['username']) && isset($_POST['password']) ){
    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password']; //เก็บรหัสผ่านในรูปแบบ sha1 

    //check username  & password
      $stmt = $conn->prepare("SELECT noman, idno, passc FROM tbmain WHERE nname = :username AND passc = :password");
      $stmt->bindParam(':username', $username , PDO::PARAM_STR);
      $stmt->bindParam(':password', $password , PDO::PARAM_STR);
      $stmt->execute();

      //กรอก username & password ถูกต้อง
      if ($stmt->rowCount() > 0) {
        // Get the user data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set the session variables
        $_SESSION['noman'] = $row['noman'];
        $_SESSION['idno'] = $row['idno'];
        // Check if the user is new
        if ($row['chn'] == 1) {
            // Redirect to the change password page
            header('Location: index.php');
        } else {
            // Redirect to the index page
            header('Location: firstlogin.php');
        }
    } else { //ถ้า username or password ไม่ถูกต้อง

         echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                             text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                  </script>';
              $conn = null; //close connect db
            } //else
    } //isset 
    */
    ?>

</html>