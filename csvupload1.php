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

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (isset($_POST['importdetail'])) {
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether the selected file is a CSV file
    if (!empty($_FILES['csv_file']['name']) && in_array($_FILES['csv_file']['type'], $fileMimes)) {
        // Open the uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from the CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
            // Get row data (adjust column indexes as needed)
            $nauto = $getData[0];
            $nno = $getData[1];
            $yy = $getData[2];
            $mm = $getData[3];
            $idno = $getData[4];
            $nobank = $getData[5];
            $money1 = $getData[6];
            $money2 = $getData[7];
            $money3 = $getData[8];
            $money4 = $getData[9];
            $money5 = $getData[10];
            $money6 = $getData[11];
            $money7 = $getData[12];
            $money8 = $getData[13];
            $money9 = $getData[14];
            $money10 = $getData[15];
            $sumget = $getData[16];
            $exp1 = $getData[17];
            $exp2 = $getData[18];
            $exp3 = $getData[19];
            $exp4 = $getData[20];
            $exp5 = $getData[21];
            $exp6 = $getData[22];
            $exp7 = $getData[23];
            $exp8 = $getData[24];
            $exp9 = $getData[25];
            $exp10 = $getData[26];
            $sumpay = $getData[27];
            $sumnet = $getData[28];
            $daykey = $getData[29];
            $money4txt = $getData[30];
            $money5txt = $getData[31];
            $money6txt = $getData[32];
            $money10txt = $getData[33];
            $exp9txt = $getData[34];
            $daypay = $getData[35];
            $notes = $getData[36];
            $remarks = $getData[37];
            $chk = $getData[38];
            $last_update = $getData[39];

            // Check if the user already exists in the database with the same idno
            $query = "SELECT nauto FROM tbdetail WHERE idno = '" . $getData[4] . "'";
            $check = mysqli_query($connect, $query);

            if ($check->num_rows > 0) {
                mysqli_query($connect, "UPDATE tbdetail SET  nno = '" . $nno . "', yy = '" . $yy . "', mm = '" . $mm . "', idno = '" . $idno . "', nobank = '" . $nobank . "', money1 = '" . $money1 . "', money2 = '" . $money2 . "', money3 = '" . $money3 . "', money4 = '" . $money4 . "', money5 = '" . $money5 . "', money6 = '" . $money6 . "', money7 = '" . $money7 . "', money8 = '" . $money8 . "', money9 = '" . $money9 . "', money10 = '" . $money10 . "', sumget = '" . $sumget . "', exp1 = '" . $exp1 . "', exp2 = '" . $exp2 . "', exp3 = '" . $exp3 . "', exp4 = '" . $exp4 . "', exp5 = '" . $exp5 . "', exp6 = '" . $exp6 . "', exp7 = '" . $exp7 . "', exp8 = '" . $exp8 . "', exp9 = '" . $exp9 . "', exp10 = '" . $exp10 . "', sumpay = '" . $sumpay . "', sumnet = '" . $sumnet . "', daykey = '" . $daykey . "', money4txt = '" . $money4txt . "', money5txt = '" . $money5txt . "', money6txt = '" . $money6txt . "', money10txt = '" . $money10txt . "', exp9txt = '" . $exp9txt . "', daypay = '" . $daypay . "', notes = '" . $notes . "', remarks = '" . $remarks . "', chk = '" . $chk . "', last_update = NOW() WHERE idno = '" . $idno . "'");
            } else {
                mysqli_query($connect, "REPLACE INTO tbdetail (nauto, nno, yy, mm, idno, nobank, money1, money2, money3, money4, money5, money6, money7, money8, money9, money10, sumget, exp1, exp2, exp3, exp4, exp5, exp6, exp7, exp8, exp9, exp10, sumpay, sumnet, daykey, money4txt, money5txt, money6txt, money10txt, exp9txt, daypay, notes, remarks, chk, last_update) VALUES ('" . $nauto . "', '" . $nno . "', '" . $yy . "', '" . $mm . "', '" . $idno . "', '" . $nobank . "', '" . $money1 . "', '" . $money2 . "', '" . $money3 . "', '" . $money4 . "', '" . $money5 . "', '" . $money6 . "', '" . $money7 . "', '" . $money8 . "', '" . $money9 . "', '" . $money10 . "', '" . $sumget . "', '" . $exp1 . "', '" . $exp2 . "', '" . $exp3 . "', '" . $exp4 . "', '" . $exp5 . "', '" . $exp6 . "', '" . $exp7 . "', '" . $exp8 . "', '" . $exp9 . "', '" . $exp10 . "', '" . $sumpay . "', '" . $sumnet . "', '" . $daykey . "', '" . $money4txt . "', '" . $money5txt . "', '" . $money6txt . "', '" . $money10txt . "', '" . $exp9txt . "', '" . $daypay . "', '" . $notes . "', '" . $remarks . "', '" . $chk . "', NOW())");
            }
        }

        // Close the opened CSV file
        fclose($csvFile);

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
					window.location = 'admin.php';
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
mysqli_close($connect);
?>


</body>

</html>