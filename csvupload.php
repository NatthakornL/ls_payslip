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
// include mysql database configuration file
include_once 'connect.php';

require_once 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
 
if (isset($_POST['importmain1']))
{
 
    // Allowed mime types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes))
    {
        //if the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $reader = new Xlsx(); 
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
            $worksheet = $spreadsheet->getActiveSheet();  
            $worksheet_arr = $worksheet->toArray(); 

            //Remove header row
            unset($worksheet_arr[0]);

        // Parse data from CSV file line by line
        foreach ($worksheet_arr as $getData)
        {
            // Get row data
            $noman = $getData[0];
            $prename = $getData[1];
            $nname = $getData[2];
            $lname = $getData[3];
            $nobank = $getData[4];
            $idno = $getData[5];
            $nposit = $getData[6];
            $noffice = $getData[7];
            $passc = $getData[8];
            $cbank = $getData[9];
            $mbphone = $getData[10];
            $dayup = $getData[11];
            $chn = $getData[12]; 

            //ถ้าผู้ใช้มีข้อมูลใน database เเล้ว เทียบข้อมูลที่เหมือนกัน
            //เเละทำการอัพเดทข้อมูลใหม่
            //ข้อมูลไหนที่ไม่เหมือนเดิมจะทำการอัพอันใหม่เข้าไป
            $query = "SELECT noman FROM tbmain WHERE idno = '" . $getData[5] . "'";
            $check = mysqli_query($connect, $query);

            if ($check->num_rows > 0)
            {
                // Update member data in the database
                $mainup = "UPDATE tbmain SET noman = '" . $noman . "', prename = '" . $prename . "', nname = '" . $nname . "', lname = '" . $lname . "', nobank = '" . $nobank . "', idno = '" . $idno . "', nposit = '" . $nposit . "', noffice = '" . $noffice . "', passc = '".$passc."', cbank = '" . $cbank . "', mbphone = '" . $mbphone . "', dayup = NOW(), chn = CONCAT(chn, ',$chn') WHERE idno = '".$idno."' ";
                
                mysqli_query($connect, $mainup);
                unset($mainup);
            }
            else
            {
                // Insert member data in the database
                $mainins = "INSERT INTO tbmain (noman, prename, nname, lname, nobank, idno, nposit, noffice, passc, cbank, mbphone, dayup, chn) VALUES ('" . $noman . "', '" . $prename . "', '" . $nname . "', '" . $lname . "', '" . $nobank . "', '" . $idno . "', '" . $nposit . "', '" . $noffice . "', '" . $passc . "', '" . $cbank . "', '" . $mbphone . "', NOW(), '" . $chn . "') ";                
                $mainins = "ON DUPLICATE KEY UPDATE  ";

                mysqli_query($connect, $mainins);
                unset($mainins);
            }
        }

        

        echo "<script>
        $(function() {
    
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'อัพเดทข้อมูลของหนักงานเรียบร้อยเเล้ว!!!',
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
else
{
    echo "<script>
        $(function() {
    
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'อัพเดทข้อมูลของพนักงานไม่สำเร็จ!!!',
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
                title: 'ไม่พบไฟล์ข้อมูลของพนักงาน!!!',
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
$mainins = "INSERT INTO tbmain (noman, prename, nname, lname, nobank, idno, nposit, noffice, passc, cbank, mbphone, dayup, chn) VALUES ('" . $noman . "', '" . $prename . "', '" . $nname . "', '" . $lname . "', '" . $nobank . "', '" . $idno . "', '" . $nposit . "', '" . $noffice . "', '" . $passc . "', '" . $cbank . "', '" . $mbphone . "', NOW(), '" . $chn . "') ";

-->