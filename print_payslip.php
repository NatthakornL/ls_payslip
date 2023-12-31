<html lang="en">

<style>
@page {
    size: A5 landscape
}
</style>

<?php

session_id();
session_start();
include "connect.php";
include "check.php";
include "session_expire.php";
error_reporting(E_ALL ^ E_WARNING);
date_default_timezone_set("Asia/Bangkok");

?>

<title>ระบบ E-PaySlip Lerdsin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="./images/icon.ico">
<link rel="stylesheet" href="card.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A5 landscape">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-5mm" onclick="window.print()" style="cursor: pointer;">

        <!-- Write HTML just like a web page -->
        <!--<article>This is an A5 document.</article>-->
        <div class="top">
            <div class="logo">
                <img src="./images/logo.jpg" style="max-width: 90%; height: auto;" />
                <h2 style="padding-left: 5px; padding-top: 5px; padding-right: 400px; font-size: 16px;  width: 90%;">
                    โรงพยาบาลเลิดสิน <br> ใบรับรองการจ่ายเงินเดือนเเละเงินอื่นๆ
                </h2>
            </div>
        </div>
        <div style="padding: 1%; padding-top: 3%;">
            <table align="center" width="100%" border-collapse: collapse; style="margin: auto; overflow-x: hidden; ">

                <tbody>
                    <tr style="width: 100%;">
                        <!-------trhead------->
                        <?php
                        if (isset($_GET['mm']) && !empty($_GET['mm']) && isset($_GET['idno']) && !empty($_GET['idno'])) {
                            // Sanitize inputs to prevent SQL injection
                            $mm = mysqli_real_escape_string($connect, $_GET['mm']);
                            $idno = mysqli_real_escape_string($connect, $_GET['idno']);

                            $sql = "SELECT * FROM tbdetail WHERE mm = '$mm' AND idno = '$idno' ORDER BY idno";
                            $result = mysqli_query($connect, $sql);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <td style="width: 50%;">
                            <li style="font-size: 14px; display: flex; width: 100%;">ประจำเดือน : <span
                                    style="padding-left: 1%;">
                                    <span id="">
                                        <?php $monthNames = [
                                                        '1' => "มกราคม", '2' => "กุมภาพันธ์", '3' => "มีนาคม",
                                                        '4' => "เมษายน", '5' => "พฤษภาคม", '6' => "มิถุนายน",
                                                        '7' => "กรกฎาคม", '8' => "สิงหาคม", '9' => "กันยายน",
                                                        '10' => "ตุลาคม", '11' => "พฤศจิกายน", '12' => "ธันวาคม"
                                                    ];

                                                    $month = $monthNames[$row['mm']];
                                                    echo $monthNames[$row['mm']] . " พ.ศ. " . $row['yy']; ?></span>

                                </span></li>
                            <li style="font-size: 14px; display: flex; width: 100%;">ชื่อ-สกุล : <span
                                    style="padding-left: 1%;"></span> <?php echo '' . $_SESSION["nname"] . ' '; ?></li>
                            <li style="font-size: 14px; display: flex; width: 100%;">หน่วยงาน :
                                <span>โรงพยาบาลเลิดสิน</span>
                            </li>
                        </td>
                        <td style="width: 50%;">
                            <li style="font-size: 14px; display: flex; width: 100%;">โอนเงินเข้าวันที่ :
                                <span style="padding-left: 1%;"><?php echo '' . $row["daypay"] . ' '; ?></span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;">ชื่อธนาคาร :
                                <span style="padding-left: 1%;"><?php echo '' . $_SESSION["nposit"] . ' '; ?></span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;">เลขที่บัญชี :
                                <span style="padding-left: 1%;"><?php echo '' . $row["nobank"] . ' '; ?></span>
                            </li>
                        </td>

                    </tr>
                    <!-------END trhead------->
                    <tr>
                        <td style="text-align: center; text-decoration: underline; font-size: 16px; font-weight: 600;">
                            รายการรับ</td>
                        <td style="text-align: center; text-decoration: underline; font-size: 16px; font-weight: 600;">
                            รายการหัก</td>
                    </tr>
                    <tr style="width: 100%;">
                        <td style="margin: auto; width: 50%;">
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">1. เงินเดือน
                                </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%;"><?php echo number_format($row["money1"], 2)  ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">2.
                                    เงินเดือน(ตกเบิก)</span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["money2"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">3. ค่าครองชีพ
                                </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["money3"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left; ">4.
                                    ค่าครองชีพ(ตกเบิก)</span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["money4"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">5. อื่นๆ</span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["money5"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <!---------------SPACE----------------->
                            <li style="color: transparent;"></li>
                            <li style="color: transparent;"></li>
                            <li style="color: transparent;"></li>
                            <li style="color: transparent;"></li>
                            <li style="color: transparent;"></li>
                            <!------------------------------------->
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">รวมรับทั้งหมด
                                </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%;"><?php echo number_format($row["sumget"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>

                        </td>
                        <!------------------------------------------------------------------->
                        <td style="margin: auto; width: 50%;">
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">1. ปกส. </span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp1"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">2. ปกส.(ตกเบิก)
                                </span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp2"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">3. กสล.พกส. </span>
                                <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp3"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">4. กยศ./กรอ. </span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp4"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  "> 5. ฌกส. / ฌกส.(พิเศษ)
                                </span>
                                <span style="width: 42%; text-align: right; padding-right: 3%; ">
                                    <?php echo number_format($row["exp5"], 2) ?>
                                    +
                                    <?php echo number_format($row["exp5_1"], 2) ?>
                                </span>
                                <span style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  "> 6. สหกรณ์ </span>
                                <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp6"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left; "> 7. สินเชื่อ ธ.กรุงไทย
                                </span> <span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp7"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left; ">8.
                                    สินเชื่อ ธ.ไทยพาณิชย์ </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp8"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">9. สินเชื่อ ธ.ออมสิน
                                </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp9"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left;  ">10. อื่นๆ </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["exp10"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%;"><span
                                    style="width: 40%; text-align: left; ">รวมหักทั้งหมด
                                </span><span
                                    style="width: 42%; text-align: right; padding-right: 3%; "><?php echo number_format($row["sumpay"], 2) ?></span><span
                                    style="width: 12%; text-align: right; ">บาท</span>
                            </li>
                        </td>
                        <!------------------------------------------------------------------->

                    </tr>


                </tbody>

            </table>

            <table align="center" width="100%" border-collapse: collapse; style="margin: auto; overflow-x: hidden; ">
                <tbody>
                    <tr>
                        <td style="text-align: left; font-size: 16px; font-weight: 600;">
                            <li style="font-size: 14px; display: flex; width: 100%; "><span
                                    style="width: 16%; text-align: left;  ">รวมสุทธิ</span>
                                <span
                                    style="width: 25%; text-align: right; padding-right: 3.9%; "><?php echo number_format($row["sumnet"], 2) ?></span><span
                                    style="width: 2%; text-align: right; padding-right: 3%;">บาท</span>(
                                <span style="text-align: center; width: 48%; padding-left: 2px;">
                                    <?php echo '' . $row["money4txt"] . ' '; ?><?php echo '' . $row["money5txt"] . ' '; ?><?php echo '' . $row["money6txt"] . ' '; ?>
                                </span>)
                            </li>

                        </td>
                    </tr>
                </tbody>
            </table>
            <table align="center" width="100%" border-collapse: collapse;
                style="margin: auto; overflow-x: hidden; padding-top: 3.7%; padding-bottom: 3.7%;">
                <tbody>
                    <tr>
                        <td style="text-align: left; font-size: 16px; font-weight: 600;">
                            <li style="font-size: 14px; display: flex; width: 100%; color: red;">หมายเหตุ :
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%; color: red;">1.
                                กรุณาตรวจสอบข้อมูลหากไม่ถูกต้องโปรดทักท้วงทันที
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%; color: red;">2. เอกสารฉบับนี้เป็น
                                "สำเนา" ต้องใช้ประกอบกับเอกสารที่ทางราชการออกให้เท่านั้น
                            </li>
                            <li style="font-size: 14px; display: flex; width: 100%; color: red;">3.
                                หากต้องการฉบับจริงหรือพบข้อมูลไม่ถูกต้อง กรุณาติดต่องานการเงิน ชั้น 9 อาคาร 33 ปี โทร
                                02-353-9763
                            </li>
                        </td>
                    </tr>
                </tbody>

            </table>
            <?php
                                }
                            }
                        } else {
                            echo "NOT FOUND DATA!!!";
                        }
                        mysqli_close($connect);

?>

        </div>

    </section>

</body>

</html>