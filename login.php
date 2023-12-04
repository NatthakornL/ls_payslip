<?php
include "connect.php";
include "include/session.php";
include "session_expire.php";

?>

<?php
if (isset($_POST['idno'])) {
    $_SESSION['idno'] = $_POST['idno'];
    header("Location:index.php");
    exit;
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            width: 51%;
            height: 30px;
            border: 1px solid;
            border-radius: 5px;
            font-size: 16px;
            vertical-align: top;
        }

        #toggle_pwd {
            padding: 5px;
            width: 5%;
            height: 30px;
            border: 1px solid;
            border-radius: 5px;
            cursor: pointer;
            background-color: #e8e8e8;
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

                        <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse; style="margin: auto; overflow-x: hidden;">
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
                                    <form method="post" action="checklogin.php">
                                        <td style="width: 70%; padding-bottom: 1%; padding-top: 1%;"><span style="font-size: 20px; font-weight: 600;">เข้าสู่ระบบการเเจ้งเงินเดือนออนไลน์</span><br><br>
                                            <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%;">
                                                รหัสบัตรประชาชน :
                                                <span style="padding-left: 5px;">
                                                    <input class="txtidcard" type="text" name="idno" maxlength="13" title="กรุณาใส่รหัสบัตรประชาชน" required="" value="<?php if (isset($_COOKIE["username"])) {
                                                                                                                                                                            echo $_COOKIE["username"];
                                                                                                                                                                        } ?>" />
                                                </span>
                                            </li><br>

                                            <li style="font-size: 16px; font-weight: 600; text-align: left; padding-left: 14%;">
                                                รหัสผ่านเข้าสู่ระบบ :
                                                <span style="background-color: #bdc3c7; width: 100%; height: auto;">
                                                    <input class="txtpass" type="password" name="passc" id="Passc" maxlength="16" required="" pattern="^[a-zA-Z0-9\s]+$" title="กรุณากรอกตัวเลขเเละภาษาอังกฤษเท่านั้น" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                                                                                                                                    echo $_COOKIE["password"];
                                                                                                                                                                                                                                } ?>" /><span id="toggle_pwd" class="fa fa-fw fa-eye-slash field_icon"></span>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            $("#toggle_pwd").click(function() {
                                                                $(this).toggleClass("fa-eye fa-eye-slash");
                                                                var type = $(this).hasClass(
                                                                        "fa-eye") ? "text" :
                                                                    "password";
                                                                $("#Passc").attr("type", type);
                                                            });
                                                        });
                                                    </script>
                                                </span>
                                            </li>


                                            <li style="margin-top: 1%; margin-bottom: 1%;"><input class="btnaddata" type="submit" name="submit" onclick="getShowLoad()" value="เข้าสู่ระบบ" style="cursor: pointer; border: 1px solid #000; background-color: #FFC400; border-radius: 5px; width: 150px; height: 35px; margin: auto; display: flex; align-items: center; justify-content: center; overflow-x: hidden; color: #fff; font-size: 16px;">
                                            </li>
                                            <li style="color: red;">
                                                (*ถ้าเข้าสู่ระบบครั้งเเรกให้ใส่รหัสผ่านเดียวกับเลขบัตรประชาชน)</li>
                                            <li style="color: #FFAA00;">(**ผู้ใช้งานถ้าลืมรหัสผ่าน โปรดติดต่อ 9833
                                                **ในวันเเละเวลาราชการเท่านั้น** )
                                            </li>
                                            <!--ไปหน้าสร้างรหัสผ่าน <a href="createPwd.php" target="_blank"> คลิก </a>-->
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        <div style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">
                            <span style="font-size: 20px; font-weight: 600;">หมายเหตุ</span><br>
                            <li style="width: 90%; color: red; font-size: 16px; text-align: left; padding-left: 10px; padding-right: 10px; word-wrap: break-word;">
                                ผู้ใดเข้าถึงโดยมิชอบซึ่งข้อมูลคอมพิวเตอร์ที่มีมาตรการ
                                ป้องกันการเข้าถึงโดยเฉพาะเเละมาตรการนั้นมิได้มีไว้สำหรับตน
                                ต้องระวางโทษจำคุกไม่เกินสองปี
                                หรือปรับไม่เกินสี่หมื่นบาท หรือทั้งจำทั้งปรับ(มาตรา 7
                                พระราชบัญญัติว่าด้วยการกระทำผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ.2550)</li>
                        </div>
                    </div>
                    <!--END card body-->
                </div>

            </div>
        </div>
</head>