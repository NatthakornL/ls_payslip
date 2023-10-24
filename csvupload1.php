<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
    <title>Lerdsin E-Payslip</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <?php
include_once 'connect.php';

require_once 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (isset($_POST['importdetail'])) 
{
    // Allowed mime types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 

    // Validate whether the selected file is a CSV file
    if(!empty($_FILES['xlsx_file']['name']) && in_array($_FILES['xlsx_file']['type'], $excelMimes))
    {
        //if the file is uploaded
        if(is_uploaded_file($_FILES['xlsx_file']['tmp_name'])){
            $reader = new Xlsx(); 
            $spreadsheet = $reader->load($_FILES['xlsx_file']['tmp_name']); 
            $worksheet = $spreadsheet->getActiveSheet();  
            $worksheet_arr = $worksheet->toArray(); 

            //Remove header row
            unset($worksheet_arr[0]);

        // Parse data from CSV file line by line
        foreach ($worksheet_arr as $getData) 
        {
            // Get row data (adjust column indexes as needed)
            $nauto = $getData[13];
            $nno = $getData[14];
            $yy = $getData[15];
            $mm = $getData[16];
            $idno = $getData[17];
            $nobank = $getData[18];
            $money1 = $getData[19];
            $money2 = $getData[20];
            $money3 = $getData[21];
            $money4 = $getData[22];
            $money5 = $getData[23];
            $money6 = $getData[24];
            $money7 = $getData[25];
            $money8 = $getData[26];
            $money9 = $getData[27];
            $money10 = $getData[28];
            $sumget = $getData[29];
            $exp1 = $getData[30];
            $exp2 = $getData[31];
            $exp3 = $getData[32];
            $exp4 = $getData[33];
            $exp5 = $getData[34];
            $exp5_1 = $getData[35];
            $exp6 = $getData[36];
            $exp7 = $getData[37];
            $exp8 = $getData[38];
            $exp9 = $getData[39];
            $exp10 = $getData[40];
            $sumpay = $getData[41];
            $sumnet = $getData[42];
            $daykey = $getData[43];
            $money4txt = $getData[44];
            $money5txt = $getData[45];
            $money6txt = $getData[46];
            $money10txt = $getData[47];
            $exp9txt = $getData[48];
            $daypay = $getData[49];
            $notes = $getData[50];
            $remarks = $getData[51];
            $chk = $getData[52];
            $last_update = $getData[53];

            // Check if the user already exists in the database with the same idno
            $query = "SELECT nauto FROM tbdetail WHERE idno = '" . $getData[17] . "'";
            $check = mysqli_query($connect, $query);

            if ($check->num_rows > 0) {
                //Update detail data in the database
                $detailup = "UPDATE tbdetail SET  nno = '" . $nno . "', yy = '" . $yy . "',mm = '".$mm."', idno = '" . $idno . "', nobank = '" . $nobank . "', money1 = '" . $money1 . "', money2 = '" . $money2 . "', money3 = '" . $money3 . "', money4 = '" . $money4 . "', money5 = '" . $money5 . "', money6 = '" . $money6 . "', money7 = '" . $money7 . "', money8 = '" . $money8 . "', money9 = '" . $money9 . "', money10 = '" . $money10 . "', sumget = '" . $sumget . "', exp1 = '" . $exp1 . "', exp2 = '" . $exp2 . "', exp3 = '" . $exp3 . "', exp4 = '" . $exp4 . "', exp5 = '" . $exp5 . "', exp5_1 = '" . $exp5_1 . "', exp6 = '" . $exp6 . "', exp7 = '" . $exp7 . "', exp8 = '" . $exp8 . "', exp9 = '" . $exp9 . "', exp10 = '" . $exp10 . "', sumpay = '" . $sumpay . "', sumnet = '" . $sumnet . "', daykey = '" . $daykey . "', money4txt = '" . $money4txt . "', money5txt = '" . $money5txt . "', money6txt = '" . $money6txt . "', money10txt = '" . $money10txt . "', exp9txt = '" . $exp9txt . "', daypay = '" . $daypay . "', notes = '" . $notes . "', remarks = '" . $remarks . "', chk = '" . $chk . "', last_update = NOW() WHERE idno = '" . $idno . "'" ;
                mysqli_query($connect, $detailup);
                unset($detailup);
            } else {
                $detailins = "INSERT INTO tbdetail (nauto, nno, yy, 'mm', idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp5_1, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, 'daypay', notes, remarks, chk, last_update) 
                VALUES ('" . $nauto . "', '" . $nno . "', '" . $yy . "', '" . $mm . "', '" . $idno . "', '" . $nobank . "', '" . $money1 . "', '" . $money2 . "', '" . $money3 . "', '" . $money4 . "', '" . $money5 . "', '" . $money6 . "', '" . $money7 . "', '" . $money8 . "', '" . $money9 . "', '" . $money10 . "', '" . $sumget . "', '" . $exp1 . "', '" . $exp2 . "', '" . $exp3 . "', '" . $exp4 . "', '" . $exp5 . "', '". $exp5_1 ."', '" . $exp6 . "', '" . $exp7 . "', '" . $exp8 . "', '" . $exp9 . "', '" . $exp10 . "', '" . $sumpay . "', '" . $sumnet . "', '" . $daykey . "', '" . $money4txt . "', '" . $money5txt . "', '" . $money6txt . "', '" . $money10txt . "', '" . $exp9txt . "', '" . $daypay . "', '" . $notes . "', '" . $remarks . "', '" . $chk . "', NOW() ) ";
                $detailins = "ON DUPLICATE KEY UPDATE 'mm'=VALUES('mm'), 'daypay'=VALUES('daypay') ";                
                mysqli_query($connect, $detailins);
                unset($detailins);
            }
        }

       

        echo "<script>
			$(function() {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'อัพเดทข้อมูลของเงินเดือนเรียบร้อยแล้ว!!!',
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
					window.location = 'imupcsv.php';
				})
			});
		</script>";
    } else {
        echo "<script>
			$(function() {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'อัพเดทข้อมูลของเงินเดือนไม่สำเร็จ!!!',
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
					window.location = 'imupcsv.php';
				})
			});
		</script>";
        
    }
}else{
    echo "<script>
        $(function() {
    
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ไม่พบไฟล์ข้อมูลของเงินเดือน!!!',
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
                window.location = 'imupcsv.php';
            })
        });
        </script>";
}
}
mysqli_close($connect);
?>


</body>

</html>

<!-- 
$detailins = "INSERT INTO tbdetail (nauto, nno, yy, mm, idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp5_1, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, daypay, notes, remarks, chk, last_update) 
                VALUES ('" . $nauto . "', '" . $nno . "', '" . $yy . "', '" . $mm . "', '" . $idno . "', '" . $nobank . "', '" . $money1 . "', '" . $money2 . "', '" . $money3 . "', '" . $money4 . "', '" . $money5 . "', '" . $money6 . "', '" . $money7 . "', '" . $money8 . "', '" . $money9 . "', '" . $money10 . "', '" . $sumget . "', '" . $exp1 . "', '" . $exp2 . "', '" . $exp3 . "', '" . $exp4 . "', '" . $exp5 . "', '". $exp5_1 ."', '" . $exp6 . "', '" . $exp7 . "', '" . $exp8 . "', '" . $exp9 . "', '" . $exp10 . "', '" . $sumpay . "', '" . $sumnet . "', '" . $daykey . "', '" . $money4txt . "', '" . $money5txt . "', '" . $money6txt . "', '" . $money10txt . "', '" . $exp9txt . "', '" . $daypay . "', '" . $notes . "', '" . $remarks . "', '" . $chk . "', NOW()) 
                ON DUPLICATE KEY UPDATE mm = VALUES($mm) ";

                $detailins = "REPLACE INTO tbdetail (nauto, nno, yy, mm, idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp5_1, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, daypay, notes, remarks, chk, last_update) 
                VALUES ('$_POST[nauto]','$_POST[nno]','$_POST[yy]','$_POST[mm]','$_POST[idno]','$_POST[nobank]','$_POST[money1]','$_POST[money2]','$_POST[money3]','$_POST[money4]','$_POST[money5]','$_POST[money6]','$_POST[money7]','$_POST[money8]','$_POST[money9]','$_POST[money10]','$_POST[sumget]','$_POST[exp1]','$_POST[exp2]','$_POST[exp3]','$_POST[exp4]','$_POST[exp5]','$_POST[exp6]','$_POST[exp7]','$_POST[exp8]','$_POST[exp9]','$_POST[exp10]','$_POST[sumpay]','$_POST[sumnet]','$_POST[daykey]','$_POST[money4txt]','$_POST[money5txt]','$_POST[money6txt]','$_POST[money10txt]','$_POST[exp9txt]','$_POST[daypay]','$_POST[notes]','$_POST[remarks]','$_POST[chk]','$_POST[last_update]',)";

                $detailins = "INSERT INTO tbdetail (nauto, nno, yy, mm, idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp5_1, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, daypay, notes, remarks, chk, last_update) 
                VALUES ('" . $nauto . "', '" . $nno . "', '" . $yy . "', '" . $mm . "', '" . $idno . "', '" . $nobank . "', '" . $money1 . "', '" . $money2 . "', '" . $money3 . "', '" . $money4 . "', '" . $money5 . "', '" . $money6 . "', '" . $money7 . "', '" . $money8 . "', '" . $money9 . "', '" . $money10 . "', '" . $sumget . "', '" . $exp1 . "', '" . $exp2 . "', '" . $exp3 . "', '" . $exp4 . "', '" . $exp5 . "', '". $exp5_1 ."', '" . $exp6 . "', '" . $exp7 . "', '" . $exp8 . "', '" . $exp9 . "', '" . $exp10 . "', '" . $sumpay . "', '" . $sumnet . "', '" . $daykey . "', '" . $money4txt . "', '" . $money5txt . "', '" . $money6txt . "', '" . $money10txt . "', '" . $exp9txt . "', '" . $daypay . "', '" . $notes . "', '" . $remarks . "', '" . $chk . "', NOW() ) ";
                $detailins = "ON DUPLICATE KEY UPDATE nauto=values(nauto), nno=values(nno), yy=values(yy), mm=values(mm), idno=values(idno), nobank=values(nobank), money1=values(money1), money2=values(money2), money3=values(money3), money4=values(money4), money5=values(money5), money6=values(money6), money7=values(money7), money8=values(money8), money9=values(money9), money10=values(money10), sumget=values(sumget), exp1=values(exp1), exp2=values(exp2), exp3=values(exp3), exp4=values(exp4), exp5=values(exp5), exp6=values(exp6), exp7=values(exp7), exp8=values(exp8), exp9=values(exp9), exp10=values(exp10), sumpay=values(sumpay), sumnet=values(sumnet), daykey=values(daykey), money4txt=values(money4txt), money5txt=values(money5txt), money6txt=values(money6txt), money10txt=values(money10txt), exp9txt=values(exp9txt), daypay=values(daypay), notes=values(notes), remarks=values(remarks), chk=values(chk), last_update=values(now()) ";                


-->