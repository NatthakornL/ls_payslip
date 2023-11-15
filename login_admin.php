<?php

session_start();
 $password = $userError = $passError = '';
if(isset($_POST['submit'])){
  $password = $_POST['password'];
  if($password === '1234'){
    $_SESSION['loginAdmin'] = true; 
    header('LOCATION:admin.php'); 
    die();
  }
  
  if($password !== '1234'){
    echo "<script>
  alert('รหัสผ่านไม่ถูกต้อง!!!');
  window.location = 'login_admin.php'
  </script>";
  }
}



/*

$password = '1234';

if(isset($_POST['submit'])){
    if($_POST['passwod'] == $password){
        $_SESSION['adminLogged'] = true;
        header('location: admin.php');
        echo 'Pass';
    }else {
        header('location: login_admin.php');
        echo 'not pass';
    }
}else {
    $self = $_SERVER['PHP_SELF'];
    $self = substr($self, strrpos($self, '/'));
    if(!(isset($_SESSION['adminLogged']) && $_SESSION['adminLogged'] == true)){
        if($self != '/login_admin.php'){
            header('location: login_admin.php');
        }
    }
}
*/
?>



<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ระบบ E-PaySlip Lerdsin</title>
    <!--stylesheet-->
    <script type="text/javascript" src="scripts.js"></script>
    <link rel="stylesheet" href="style1.css" media="all" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/icon.ico">
    <!---------- Sweetalert --------->
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <!---------- END Sweetalert --------->
    <!--======================= jQuery library ===========================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <div class="logo"><img src="./images/logoheader.jpg" width="800" height="120" />
                                </div>
                            </div>
                        </header>

                        <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
                            style="margin: auto; overflow-x: hidden;">
                            <tbody>
                                <tr>
                                    <!--
                                    <td style="width: 30%;">
                                        <div style="display: grid;">
                                            <button class="btn btn--radius-2 btn--blue" type="button"
                                                disabled>เข้าสู่ระบบ</button>
                                            <button class="btn btn--radius-2 btn--orange"
                                                type="button">ออกจากหน้าเว็บ</button>
                                        </div>
                                    </td>
-->

                                    <form name='input' action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
                                        <td style="width: 70%; padding-bottom: 1%; padding-top: 1%;"><span
                                                style="font-size: 20px; font-weight: 600;">เข้าสู่ระบบ
                                                Admin</span><br><br>
                                            <li
                                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%; margin-bottom: 1%;">
                                                <label>User :</label><span style="padding: 1%;">Admin</span>
                                            </li>

                                            <li
                                                style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%;">
                                                รหัสผ่านเข้าสู่ระบบ : <span
                                                    style="background-color: #bdc3c7; width: 100%; height: auto;"><input
                                                        class="txtpass" type="password" id="password" name="password"
                                                        maxlength="16" required="" pattern="^[a-zA-Z0-9\s]+$"
                                                        title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" /></span></li><br>
                                            <!--<div class='error'><?php //echo $passError;?></div>-->

                                            <li style="margin-top: 1%; margin-bottom: 1%;"><input class="btnaddata"
                                                    type="submit" name="submit" onclick="getShowLoad()"
                                                    value="เข้าสู่ระบบ"
                                                    style="cursor: pointer; border: 1px solid #000; background-color: #FFC400; border-radius: 5px; width: 150px; height: 35px; margin: auto; display: flex; align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                            </li>

                                            <!--ไปหน้าสร้างรหัสผ่าน <a href="createPwd.php" target="_blank"> คลิก </a>-->
                                        </td>
                                    </form>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!--END card body-->
                </div>

            </div>
        </div>
</head>