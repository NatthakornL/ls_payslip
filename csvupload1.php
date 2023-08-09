<?php
// include mysql database configuration file
include_once 'connect1.php';
 
if (isset($_POST['importmain']))
{
 
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
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
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
 
                // If user already exists in the database with the same email
                $query = "SELECT noman FROM tbmain WHERE idno = '" . $getData[5] . "'";
 
                $check = mysqli_query($connect, $query);
 
                if ($check->num_rows > 0)
                {
                    mysqli_query($connect, "UPDATE tbmain SET noman = '" . $noman . "', prename = '" . $prename . "', nname = '" . $nname . "', lname = '" . $lname . "', nobank = '" . $nobank . "', idno = '" . $idno . "', nposit = '" . $nposit . "', passc = '" . $passc . "', cbank = '" . $cbank . "', mbphone = '" . $mbphone . "', dayup = NOW(), chn='".$chn."' WHERE idno = '" . $idno . "'");
                }
                else
                {
                     mysqli_query($connect, "INSERT INTO tbmain (noman, prename, nname, lname, nobank, idno, nposit, noffice, passc, cbank, mbphone, dayup, chn) VALUES ('" . $noman . "', '" . $prename . "', '" . $nname . "', '" . $lname . "', '" . $nobank . "', '" . $idno . "', '" . $nposit . "', '" . $noffice . "', '" . $passc . "', '" . $cbank . "', '" . $mbphone . "', NOW(), '" . $chn . "')");
 
                }
            }
 
            // Close opened CSV file
            fclose($csvFile);
 
            header("Location: admin.php");
         
    }
    else
    {
        echo "Please select valid file";
    }
}