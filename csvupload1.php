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

    if (isset($_POST['importdetail'])) {
        // Allowed mime types
        $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // Validate whether the selected file is a CSV file
        if (!empty($_FILES['xlsx_file']['name']) && in_array($_FILES['xlsx_file']['type'], $excelMimes)) {
            //if the file is uploaded
            if (is_uploaded_file($_FILES['xlsx_file']['tmp_name'])) {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($_FILES['xlsx_file']['tmp_name']);
                $worksheet = $spreadsheet->getActiveSheet();
                $row = $worksheet->getHighestRow() + 1;
                $worksheet->insertNewRowBefore($row);
                $worksheet->setCellValue('A' . $row, 'Updated');
                $worksheet_arr = $worksheet->toArray();

                //Remove header row
                unset($worksheet_arr[0]);

                // Parse data from CSV file line by line
                // Loop through each row and insert data into the MySQL table
                foreach ($worksheet_arr as $getData) {
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


                    $detailins = "INSERT INTO tbdetail (nauto, nno, yy, mm, idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp5_1, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, daypay, notes, remarks, chk, last_update) 
                VALUES (NULL, '" . $nno . "', '" . $yy . "', '" . $mm . "', '" . $idno . "', '" . $nobank . "', '" . $money1 . "', '" . $money2 . "', '" . $money3 . "', '" . $money4 . "', '" . $money5 . "', '" . $money6 . "', '" . $money7 . "', '" . $money8 . "', '" . $money9 . "', '" . $money10 . "', '" . $sumget . "', '" . $exp1 . "', '" . $exp2 . "', '" . $exp3 . "', '" . $exp4 . "', '" . $exp5 . "', '" . $exp5_1 . "', '" . $exp6 . "', '" . $exp7 . "', '" . $exp8 . "', '" . $exp9 . "', '" . $exp10 . "', '" . $sumpay . "', '" . $sumnet . "', '" . $daykey . "', '" . $money4txt . "', '" . $money5txt . "', '" . $money6txt . "', '" . $money10txt . "', '" . $exp9txt . "', '" . $daypay . "', '" . $notes . "', '" . $remarks . "', '" . $chk . "', NOW() ) ";
                    //$detailins = "ON DUPLICATE KEY UPDATE 'mm'=VALUES('mm'), 'daypay'=VALUES('daypay') ";                


                    if (mysqli_query($connect, $detailins)) {
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
                }
            }
        } else {
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