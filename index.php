<?php

session_start();

include "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(60, "login.php", null, $_SESSION['idno'], true);

error_reporting(E_ALL ^ E_WARNING);
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ระบบ E-PaySlip Lerdsin</title>
    <!--stylesheet-->
    <script type="text/javascript" src="scripts.js"></script>
    <link rel="stylesheet" href="style1.css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/icon.ico">
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
    <script>
        function funClear() {
            document.getElementById("form1").reset();
        }
    </script>
    <script src="ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            //ถ้าต้องการใช้งาน auto logout ด้วย ajax  ให้เอา comment ส่วนนี้ออก    
            setInterval(function() { // กำหนดการทำงานทุกกี่วินาที
                $.post("check_session.php", function(data) { // เรียกไฟล์ตรวจสอบ session
                    if (data == 1) { // เมื่อ session ถูกทำลายแล้ว
                        window.location = "login.php"; // ส่งไปหน้า login.php  
                    }
                });
            }, 60000); // กำหนดวินาที ที่ต้องการ ทุก 1 นาทีหรือ 60000 ก็ได้ ตัวอย่างกำหนดแค่ทุกๆ 5 วินาที
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
</head>

<div class="background">
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body">
                    <!--card body-->
                    <header>
                        <div class="top" style="margin-bottom: 1%;">
                            <div class="logo"><img src="./images/logoheader.jpg" />
                            </div>
                        </div>
                    </header>
                    <div style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">
                        <form method="post" action="" enctype="multipart/form-data">

                            <li style="font-size: 20px; font-weight: 600; text-align: center; color: #FFA200;"><i class="em em-page_facing_up" aria-role="presentation" aria-label="PAGE FACING UP"></i>
                                ตารางเเสดงข้อมูลสลิปเงินเดือนของเเต่ละเดือน<i class="em em-page_facing_up" aria-role="presentation" aria-label="PAGE FACING UP"></i></li><br>

                            <li style="padding-left: 24%; text-align: center; font-size: 16px; display: flex; width: 100%; ">
                                <span style="font-weight: 600; width: 18%; ">ชื่อ - นามสกุล :
                                </span>
                                <span style="width: 70%; text-align: left; padding-right: 3%; "><?php echo '' . $_SESSION["nname"] . ' '; ?>
                                </span>
                            </li>
                            <li style="margin-left: 25%; font-size: 16px; display: flex; width: 70%; height: auto;">
                                <span style="font-weight: 600; width: 12%;">ตำเเหน่ง : </span>
                                <span style="width: 40%; text-align: left; padding-left: 2px; padding-right: 3%;">
                                    <?php echo '' . $_SESSION["noffice"] . ' '; ?>
                                </span>
                                <span style="font-weight: 600;">หน่วยงาน : </span> <span style="width: 30%; text-align: left; padding-left: 1%; padding-right: 3%;">โรงพยาบาลเลิดสิน</span>
                            </li>
                            <!--------------------LINKZONE---------------------->
                            <div style="display: flex; justify-items: center; justify-content: center;">
                                <button class="btn btn--radius-2 btn--orange" type="button"><a href="firstlogin.php" style="color: #fff;" onclick="return confirm('กดยืนยันเพื่อไปยังหน้าเปลี่ยนรหัสผ่าน');">เปลี่ยนรหัสผ่าน</a></button>

                                <button class="btn btn--radius-2 btn--red" type="button"><a href="logout.php" style="color: #fff;" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></button>
                            </div>
                        </form>
                    </div><br>
                    <!-------------------------------------------------->

                    <li style="text-align: center; font-size: 17px; font-weight: 600; color: red; padding-bottom: 1%;">
                        <i class="em em-exclamation" aria-role="presentation" aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                        คลิกชื่อเดือนเพื่อเเสดงรายละเอียดใบเเจ้งเงินเดือน <i class="em em-exclamation" aria-role="presentation" aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                        <span style="font-size: 16; font-weight: 600;"></span>
                    </li>
                    <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse; style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
                        <thead style="width: 90%; height: auto; border: 1px solid #000;">
                            <th style="width: 30%; border: 1px solid;">เดือน</th>
                            <th style="width: 40%; border: 1px solid;">วันที่โอนเงินเข้าบัญชี</th>
                            <th style="width: 30%; border: 1px solid; ">หมายเหตุ</th>
                        </thead>
                        <tbody id="myTable">

                            <?php

                            $idno = mysqli_real_escape_string($connect, $_GET['idno']);

                            $sql = "SELECT * FROM tbdetail WHERE idno = '" . $_SESSION['idno'] . "' ORDER BY mm DESC ";
                            $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));


                            while ($row = mysqli_fetch_assoc($result)) {
                                //var_dump($row);
                                //print_r($row);

                            ?>

                                <?php

                                $monthNames = [
                                    '1' => "มกราคม", '2' => "กุมภาพันธ์", '3' => "มีนาคม",
                                    '4' => "เมษายน", '5' => "พฤษภาคม", '6' => "มิถุนายน",
                                    '7' => "กรกฎาคม", '8' => "สิงหาคม", '9' => "กันยายน",
                                    '10' => "ตุลาคม", '11' => "พฤศจิกายน", '12' => "ธันวาคม"
                                ];

                                echo "<tr>";
                                echo "<td style='text-decoration: underline;'><a href='print_payslip.php?mm=" . $row['mm'] . " ' target='_blank'>" . $monthNames[$row['mm']] . " พ.ศ. " . $row['yy'] . "</a></td>";
                                echo "<td>" . $row['daypay'] . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "</tr>";

                                ?>
                            <?php } ?>

                        </tbody>
                    </table><br>

                    <li style=" text-align: center; color: #bdc3c7;">** ข้อมูลเริ่มต้นเดือน พฤษภาคม 2566 **</li>


                </div>
            </div>
        </div>
    </div>
</div>

</html>