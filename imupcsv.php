<?php 
session_id();
session_start();
include "connect.php";
error_reporting(E_ALL ^ E_WARNING);

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'อัพเดทข้อมูลเรียบร้อยเเล้ว!!!';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'เกิดปัญหาในการอัพเดทข้อมูล กรุณาลองใหม่อีกครั้ง!!!';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'กรุณาเลือกไฟล์ CSV เพื่อทำการอัพเดทข้อมูล!!!';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
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
    <link rel="stylesheet" href="style1.css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./images/icon.ico">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!--======================= jQuery library ===========================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
        }, 300000); // กำหนดวินาที ที่ต้องการ ทุก 1 นาทีหรือ 60000 ก็ได้ ตัวอย่างกำหนดแค่ทุกๆ 5 วินาที

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

    /*===========================================*/
    input[type=submit] {
        width: 20%;
        padding: 4px 4px;
        margin: 4px 2px;
        background-color: #baff95;
        border: 1px solid #000;
        color: #00B127;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type=file] {
        width: 50%;
        padding: 4px 4px;
        margin: 4px 2px;
        background-color: #EDEDED;
        border: 1px solid #000;
        color: #BABABA;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>

</head>

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
                        <form method="post" action="csvupload.php" enctype="multipart/form-data" name="form1"><br>
                            <!-- Display status message -->
                            <?php if(!empty($statusMsg)){ ?>
                            <div class="col-xs-12">
                                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                            </div>
                            <?php } ?>

                            <li style="font-size: 20px; font-weight: 600; text-align: center; color: #FFA200;"><i
                                    class="em em-page_facing_up" aria-role="presentation"
                                    aria-label="PAGE FACING UP"></i>
                                อัพโหลดไฟล์เพื่อเพิ่มข้อมูลลง Database<i class="em em-page_facing_up"
                                    aria-role="presentation" aria-label="PAGE FACING UP"></i></li>
                            <li style="font-size: 16px; font-weight: 600; text-align: center; color: #D80000;">
                                [ ก่อนการอัพโหลดให้ตรวจสอบความถูกต้องของข้อมูล เช่น ชื่อ Column ให้ถูกต้องครับ
                                อัพเป็นไฟล์ .xlsx ]</li><br>
                            <div style="width: 100%; display: flex;">
                                <li
                                    style="font-size: 20px; font-weight: 600; text-align: left; width: 100%; margin: 1%;">
                                    Upload
                                    ผู้ใช้งาน :
                                    <span style="margin: 0.4%;"><input type="file" name="file" accept=".xlsx">
                                        <input id="" name="importmain1" type="submit" data-loading-text="Loading..."
                                            value="submit"></span>

                                </li>

                            </div>
                        </form>
                        <form method="post" action="csvupload1.php" enctype="multipart/form-data" name="form1"><br>
                            <!-- Display status message -->
                            <?php if(!empty($statusMsg)){ ?>
                            <div class="col-xs-12">
                                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                            </div>
                            <?php } ?>
                            <div style="width: 100%; display: flex;">
                                <li
                                    style="font-size: 20px; font-weight: 600; text-align: left; width: 100%; margin: 1%;">
                                    Upload
                                    เงินเดือน :
                                    <span><input id="" type="file" name="xlsx_file" accept=".xlsx">
                                        <input class="form-control" name="importdetail" type="submit"
                                            data-loading-text="Loading..." value="submit"></span>

                                </li>

                            </div>
                            <div style="display: flex; justify-items: center; justify-content: center;">

                                <button class="btn btn--radius-2 btn--orange" type="button"><a href="admin.php"
                                        style="color: #fff;" onclick="//history.back();">ย้อนกลับ</a></button>
                            </div>
                        </form>
                    </div><br>
                </div>
            </div>
        </div>
    </div>
</div>

</html>