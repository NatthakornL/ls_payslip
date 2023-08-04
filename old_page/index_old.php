<?php 
/*
//create database 
$connect = mysqli_connect('localhost', 'root', '' , 'ls_payslip');

$noman = $_GET['noman'];
$sql = "SELECT * FROM tbmain WHERE noman = $noman LIMIT 1";
$result = mysqli_query($connect, $sql);

error_reporting(E_ALL ^ E_WARNING); 
*/

session_id();
session_start();
include "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(300,"login.php",null,$_SESSION['idno'],true);
error_reporting(E_ALL ^ E_WARNING); 



/*
setSessionTime(
    เวลาวินาทีของอายุ,
    ไฟล์ที่ต้องการลิ้งค์ไปเมื่อ session ถูกทำลาย,
    การส่งค่ากลับกรณีใช้กับ ajax,
    ตัวแปร session ที่ต้องการกำหนดสิทธิ์เข้าเพจ,
    อัพเดทเวลาล่าสุดอัตโนมัติ
    );

    ค่าที่ 2 -5 สามารถกำหนดเป็น null ถ้าไม่ต้องการใช้งาน ขึ้นกับแล้วแต่เงื่อนไข
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
    <link rel="stylesheet" href="style.css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <!--======================= jQuery library ===========================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
    function searchTable() {
        var input, filter, found, table, tr, td, i, j;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
            if (found) {
                tr[i].style.display = "";
                found = false;
            } else {
                tr[i].style.display = "none";
            }
        }
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
        }, 60000); // กำหนดวินาที ที่ตอ้งการ ทุก 1 นาทีหรือ 60000 ก็ได้ ตัวอย่างกำหนดแค่ทุกๆ 5 วินาที
    });
    </script>

    <!--================================================================-->
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
    font-size: 16px;
    height: auto;
    border: 1px solid #000;
}

th {
    text-align: center;
    font-size: 17px;
    background-color: #A1DD00;
    border: 1px solid #000;
    color: #fff;
}

@import url("https://fonts.googleapis.com/css?family=Dosis");

:root {
    /* generic */
    --gutterSm: 0.4rem;
    --gutterMd: 0.8rem;
    --gutterLg: 1.6rem;
    --gutterXl: 2.4rem;
    --gutterXx: 7.2rem;
    --colorPrimary400: #baff95;
    --colorPrimary600: #baff95;
    --colorPrimary800: #00B127;
    --fontFamily: "Dosis", sans-serif;
    --fontSizeSm: 1.2rem;
    --fontSizeMd: 1.6rem;
    --fontSizeLg: 1.0rem;
    --fontSizeXl: 2.8rem;
    --fontSizeXx: 3.6rem;
    --lineHeightSm: 1.1;
    --lineHeightMd: 1.5;
    --transitionDuration: 300ms;
    --transitionTF: cubic-bezier(0.645, 0.045, 0.355, 1);

    /* floated labels */
    --inputPaddingV: var(--gutterMd);
    --inputPaddingH: var(--gutterLg);
    --inputFontSize: var(--fontSizeLg);
    --inputLineHeight: var(--lineHeightMd);
    --labelScaleFactor: 0.8;
    --labelDefaultPosY: 50%;
    --labelTransformedPosY: calc((var(--labelDefaultPosY)) - (var(--inputPaddingV) * var(--labelScaleFactor)) - (var(--inputFontSize) * var(--inputLineHeight)));
    --inputTransitionDuration: var(--transitionDuration);
    --inputTransitionTF: var(--transitionTF);
}


.Title {
    margin: 0 0 var(--gutterXx) 0;
    padding: 0;
    color: #fff;
    font-size: var(--fontSizeXx);
    font-weight: 400;
    line-height: var(--lineHeightSm);
    text-align: center;
    text-shadow: -0.1rem 0.1rem 0.2rem var(--colorPrimary800);
}


.inputSearch[type=text] {
    width: 30%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 6px;
    font-size: 25px;
    background-color: white;
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    transition: width 0.4s ease-in-out;
}

.Input {
    position: relative;
    margin: auto;
    width: 100%;
    min-width: 600px;
}

.Input-text {
    display: block;
    margin: 0;
    padding: var(--inputPaddingV) var(--inputPaddingH);
    color: inherit;
    width: 25%;
    margin-top: 1%;
    font-family: inherit;
    font-size: var(--inputFontSize);
    font-weight: inherit;
    line-height: var(--inputLineHeight);
    border: none;
    border-radius: 0.4rem;
    transition: box-shadow var(--transitionDuration);
}

.Input-text::placeholder {
    color: #b0bec5;
}

.Input-text:focus {
    outline: none;
    box-shadow: 0.2rem 0.8rem 1.6rem var(--colorPrimary600);
}

.Input-label {
    display: block;
    position: absolute;
    bottom: 50%;
    left: 1rem;
    color: #000;
    font-family: inherit;
    font-size: var(--inputFontSize);
    font-weight: inherit;
    line-height: var(--inputLineHeight);
    opacity: 0;
    transform: translate3d(0, var(--labelDefaultPosY), 0) scale(1);
    transform-origin: 0 0;
    transition: opacity var(--inputTransitionDuration) var(--inputTransitionTF),
        transform var(--inputTransitionDuration) var(--inputTransitionTF),
        visibility 0ms var(--inputTransitionDuration) var(--inputTransitionTF),
        z-index 0ms var(--inputTransitionDuration) var(--inputTransitionTF);
}

.Input-text:placeholder-shown+.Input-label {
    visibility: hidden;
    z-index: -1;
}

.Input-text:not(:placeholder-shown)+.Input-label,
.Input-text:focus:not(:placeholder-shown)+.Input-label {
    visibility: visible;
    z-index: 1;
    opacity: 1;
    transform: translate3d(0, var(--labelTransformedPosY), 0) scale(var(--labelScaleFactor));
    transition: transform var(--inputTransitionDuration), visibility 0ms,
        z-index 0ms;
}

/*===================================================*/

a:link {
    color: rgb(12, 0, 146);
    background-color: transparent;
    text-decoration: none;
}

a:visited {
    color: rgb(12, 0, 146);
    background-color: transparent;
    text-decoration: none;
}

a:hover {
    color: rgb(70, 142, 249);
    background-color: transparent;
    text-decoration: none;
}

a:active {
    color: rgb(154, 200, 254);
    background-color: transparent;
    text-decoration: none;
}
</style>

<header>
    <div class="top">
        <div class="logo"><img src="./images/logoheader.jpg" /></div>
    </div>
</header>

<body>
    <?php
    //print_r($_SESSION);
    require "check.php";
    ?>
    <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
        style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
        <thead style="width: 90%; height: auto; ">
        <tbody>
            <tr style="padding: 5%;">

                <!------------------------------------------------------>
                <form method="post" action="" enctype="multipart/form-data">

                    <td style="width: 75%;  padding-top: 1%; padding-bottom: 1%;"><span
                            style="font-size: 20px; font-weight: 600;">ตารางเเสดงข้อมูลสลิปเงินเดือนของเเต่ละเดือน</span><br>
                        <li style="font-size: 18px; font-weight: 600;">ยินดีต้อนรับ</li>

                        <li style="margin-left: 35%; text-align: left; font-size: 16px; display: flex; width: 55%; ">
                            <span style="font-weight: 600; width: 16%; ">ชื่อ - นามสกุล :
                            </span>
                            <span
                                style="width: 40%; text-align: left; padding-right: 3%; "><?php echo ''.$_SESSION["nname"]. ' '; ?>
                            </span>
                        </li>
                        <li style="margin-left: 35%; font-size: 16px; display: flex; width: 55%; height: auto; ">
                            <span style="font-weight: 600;">ตำเเหน่ง : </span>
                            <span style="width: 30%; text-align: left; padding-left: 1%; padding-right: 3%;">
                                <?php if($_SESSION["noffice"]=='0'){
                                echo "พนักงานราชการ";
                            }else if($_SESSION["noffice"]=='1'){
                                echo "ลูกจ้างชั่วคราวเงินบำรุง";
                            }else if ($_SESSION["noffice"]=='2'){
                                echo "พนักงานกระทรวงสาธารณสุข";
                            }else{
                                exit();
                            } ?>
                            </span>
                            <span style="font-weight: 600;">หน่วยงาน : </span> <span
                                style="width: 30%; text-align: left; padding-left: 1%; padding-right: 3%;">โรงพยาบาลเลิดสิน</span>
                        </li>
                        <!--------------------LINKZONE---------------------->
                        <li style="margin-top: 1%;"><b style="color: red; ">
                                << </b><a href="firstlogin.php"
                                        style="text-decoration: underline;">เปลี่ยนรหัสผ่าน</a><b style="color: red;">
                                        >> </b> || <span><b style="color: red;">
                                            << </b><a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');"
                                                    style="text-decoration: underline;">ออกจากระบบ</a><b
                                                    style="color: red;">
                                                    >> </b></span>
                        </li>
                </form>
                <!-------------------------------------------------->
                <!--------------------SEARCHBOX--------------------->
                <span style="text-align: center; "><input type="text" id="myInput" onkeyup="searchTable()"
                        class="Input-text" placeholder="ค้นหา" style="margin-left: 37%; border: 1px solid;">
                </span><br>
                <!-------------------------------------------------->
                <table border="1" bordercolor="#000" align="center" width="100%" border-collapse: collapse;
                    style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
                    <li style="text-align: center; font-size: 17px; font-weight: 600; color: red; padding-bottom: 1%;">
                        <i class="em em-exclamation" aria-role="presentation"
                            aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                        คลิกชื่อเดือนเพื่อเเสดงรายละเอียดใบเเจ้งเงินเดือน <i class="em em-exclamation"
                            aria-role="presentation" aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                        <span style="font-size: 16; font-weight: 600;"></span>
                    </li>
                    <thead style="width: 90%; height: auto; border: 1px solid #000;">
                        <th style="width: 22%;">เดือน</th>
                        <th style="width: 46%;">วันที่โอนเงินเข้าบัญชี</th>
                        <th style="width: 22%;">หมายเหตุ</th>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <td style="text-decoration: underline; "><a href="print_payslip.php" target="_blank">
                                    <span id="">มิถุนายน</span>
                                    <span>พ.ศ.</span>
                                    <span>2566</span>
                                </a></td>
                            <td> <?php echo ''.$_SESSION["daypay"]. ' '; ?> </td>
                            <td> <?php echo ''.$_SESSION["remarks"]. ' '; ?></td>
                        </tr>
                    </tbody>
                </table> <br>
                <?php
                /*
                 } 
                    mysqli_close($connect);
                } 
                */
                ?>
                <li>** ข้อมูลเริ่มต้นเดือน มิถุนายน 2566 **</li>
                </td>
                <!------------------------------------------------------>
            </tr>
        </tbody>
        </thead>
        <script>
        const month = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ",
            "กันยายน ", "ตุลาคม ",
            "พฤศจิกายน ", "ธันวาคม "
        ];


        const d = new Date();
        let name = month[d.getMonth()];
        document.getElementById("demo").innerHTML = name;
        </script>

    </table>

</body>

</html>