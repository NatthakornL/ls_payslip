<?php 
session_id();
session_start();
include "connect.php";
include "check.php";
include("session_expire.php");
setSessionTime(300,"login.php",null,$_SESSION['idno'],true);
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
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!--======================= jQuery library ===========================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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

    <script>
    $(document).ready(function() {
        $('.view-data').on('click', '.links', function() {
            var noman = $(this).prop('noman');

            $.ajax({
                url: 'resetpass.php',
                type: 'get',
                data: {
                    'passc': noman
                }
            }).then(function(response) {
                if (response) {
                    $('#RePass').html(response);
                }
            });
        });
    })
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
        }, 300000); // กำหนดวินาที ที่ต้องการ ทุก 1 นาทีหรือ 60000 ก็ได้ ตัวอย่างกำหนดแค่ทุกๆ 5 นาที

    });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    th {
        text-align: center;
        font-size: 14px;
        background-color: #A1DD00;
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
        width: 40%;
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
        width: 40%;
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

    /*==============================================*/
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

</head>

<body>
    <div class="background">
        <!-- BackToTop Button -->
        <a href="javascript:void(0);" id="backToTop" class="back-to-top">
            <i class="arrow"></i><i class="arrow"></i>
        </a>
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
                        <div
                            style="margin-top: 10px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">
                            <form method="post" action="" enctype="multipart/form-data">

                                <li style="font-size: 20px; font-weight: 600; text-align: center; color: #FFA200;"><i
                                        class="em em-page_facing_up" aria-role="presentation"
                                        aria-label="PAGE FACING UP"></i>
                                    ตารางเเสดงข้อมูลผู้ใช้ในระบบเเจ้งเงินเดือน<i class="em em-page_facing_up"
                                        aria-role="presentation" aria-label="PAGE FACING UP"></i></li><br>

                                <li
                                    style="padding-left: 29.5%; text-align: center; font-size: 16px; display: flex; width: 100%; ">
                                    <span style="font-weight: 600; width: 16%; ">ชื่อ - นามสกุล :
                                    </span>
                                    <span
                                        style="width: 50%; text-align: left; padding-right: 3%; "><?php echo ''.$_SESSION["nname"]. ' '; ?>
                                    </span>
                                </li>
                                <li
                                    style="margin-left: 30%; font-size: 16px; display: flex; width: 55%; height: auto; ">
                                    <span style="font-weight: 600;">ตำเเหน่ง : </span>
                                    <span style="width: 40%; text-align: left; padding-left: 2px; padding-right: 3%;">
                                        <?php /*if($_SESSION["noffice"]=='0'){
                                echo "พนักงานราชการ";
                            }else if($_SESSION["noffice"]=='1'){
                                echo "ลูกจ้างชั่วคราวเงินบำรุง";
                            }else if ($_SESSION["noffice"]=='2'){
                                echo "พนักงานกระทรวงสาธารณสุข";
                            }else{
                                exit();
                            }*/ ?>ADMIN ผู้ดูเเลระบบ
                                    </span>
                                    <span style="font-weight: 600;">หน่วยงาน : </span> <span
                                        style="width: 30%; text-align: left; padding-left: 1%; padding-right: 3%;">โรงพยาบาลเลิดสิน</span>
                                </li>
                                <!--------------------LINKZONE---------------------->
                                <div style="display: flex; justify-items: center; justify-content: center;">
                                    <button class="btn btn--radius-2 btn--orange" type="button"><a href="imupcsv.php"
                                            style="color: #fff;"
                                            onclick="return confirm('กดยืนยันเพื่อไปยังหน้าเพิ่มข้อมูล');">เพิ่มข้อมูล</a></button>

                                    <button class="btn btn--radius-2 btn--red" type="button"><a href="logout.php"
                                            style="color: #fff;"
                                            onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a></button>

                                </div>
                            </form>
                        </div><br>
                        <div
                            style="margin-top: 2px; padding: 1%; width: 100%; height: auto; border: 1px solid #FF6100; border-radius: 10px;">
                            <form method="post" action="" enctype="multipart/form-data">
                                <!------------------SEARCHZONE------------------->
                                <h3 style="text-align: center; font-weight: 600;">ค้นหาข้อมูล</h3>
                                <span style="text-align: center; "><input type="text" id="myInput"
                                        onkeyup="searchTable()" class="Input-text" placeholder="ค้นหา"
                                        style="margin-left: 30%; border: 1px solid;">
                                </span><br>
                                <!------------------END SEARCHZONE--------------->
                                <table border="1" bordercolor="#000" align="center" width="100%" border-collapse:
                                    collapse; style="margin: auto; overflow-x: hidden; padding-top: 30px; ">
                                    <li
                                        style="text-align: center; font-size: 17px; font-weight: 600; color: red; padding-bottom: 1%;">
                                        <i class="em em-exclamation" aria-role="presentation"
                                            aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                                        เเสดงข้อมูลของผู้ใช้ทั้งหมด <i class="em em-exclamation"
                                            aria-role="presentation" aria-label="HEAVY EXCLAMATION MARK SYMBOL"></i>
                                        <span style="font-size: 16; font-weight: 600;"></span>
                                    </li>
                                    <thead style="width: 100%; height: auto; border: 1px solid #000; ">
                                        <th style="width: 5%; border: 1px solid;">ลำดับ</th>
                                        <th style="width: 10%; border: 1px solid;">รหัสบัตรประชาชน</th>
                                        <th style="width: 25%; border: 1px solid;">ชื่อ-นามสกุล</th>
                                        <th style="width: 15%; border: 1px solid;">รหัสผ่าน</th>

                                        <th style="width: 20%; border: 1px solid;">ตำเเหน่ง</th>
                                        <th style="width: 10%; border: 1px solid; font-size: 15px;">ลำดับผู้ใช้ <br>(0
                                            New , 1 Old)</th>
                                        <th style="width: 3%; border: 1px solid; font-size: 15px;"></th>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php 
                        $sql = "SELECT * FROM tbmain ORDER BY noman ";
                        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                        $rsjobinfo = mysqli_fetch_assoc($result);

                        mysqli_close($connect);

                        do {
                            /*
                        $count=1;
                        $sel_query="Select * from tbmain ORDER BY noman ;";
                        $result = mysqli_query($connect,$sel_query);
                        while($row = mysqli_fetch_assoc($result)) {
                            */
?>
                                        <tr>
                                            <td><?php echo $rsjobinfo['noman']; ?></td>
                                            <td><?php echo $rsjobinfo['idno']; ?></td>
                                            <td><?php echo $rsjobinfo['nname']; ?></td>
                                            <td><?php echo $rsjobinfo["passc"] ?></td>
                                            <!-- . $rsjobinfo["noman"] . ">" . $rsjobinfo["passc"]. -->

                                            <td><?php if($rsjobinfo["noffice"]=='0'){
                            echo "พนักงานราชการ";
                        }else if($rsjobinfo["noffice"]=='1'){
                            echo "ลูกจ้างชั่วคราวเงินบำรุง";
                        }else if ($rsjobinfo["noffice"]=='2'){
                            echo "พนักงานกระทรวงสาธารณสุข";
                        }else{
                            exit();
                        } ?></td>
                                            <td><?php echo $rsjobinfo['chn']; ?></td>
                                            <td><a href="resetpass.php?noman=<?php echo $rsjobinfo["noman"];?>"
                                                    data-toggle="
                                                    tab" id="<?php echo $rsjobinfo['noman']; ?>">edit</a>
                                            </td>
                                        </tr>
                                        <?php 
                        } while ($rsjobinfo = mysqli_fetch_assoc($result))  
                        
                       //$count++; } 
                       ?>
                                    </tbody>
                                </table> <br>
                            </form>
                        </div><br>
                    </div>
                    <!--END card body-->
                </div>
            </div>
        </div>
    </div>
</body>

</html>