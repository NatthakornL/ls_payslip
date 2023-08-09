<?php
// Load the database configuration file
include_once 'connect1.php';

if(isset($_POST['importmain'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $noman   = $line[0];
                $prename  = $line[1];
                $nname  = $line[2];
                $lname = $line[3];
                $nobank = $line[4];
                $idno = $line[5];
                $nposit = $line[6];
                $noffice = $line[7];
                $passc = $line[8];
                $cbank = $line[9];
                $mbphone = $line[10];
                $dayup = $line[11];
                $chn = $line[12];
                
                // Check whether tbmain already exists in the database with the same idno
                $prevQuery = "SELECT noman FROM tbmain WHERE idno = '".$line[5]."'";
                $prevResult = $connect->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $connect->query("UPDATE tbmain SET noman = '".$noman."', prename = '".$prename."', nname = '".$nname."', lname = '".$lname."', nobank = '".$nobank."', idno = '".$idno."', nposit = '".$nposit."', noffice = '".$noffice."', passc = '".$passc."', cbank = '".$cbank."', mbphone = '".$mbphone."', dayup = NOW() WHERE noman = '".$noman."'");
                }else{
                    // Insert member data in the database
                    $connect->query("INSERT INTO tbmain (noman, prename, nname, lname, nobank, idno, nposit, noffice, passc, cbank, mbphone, dayup, chn) VALUES ('".$line[0]."', '".$line[1]."', '".$line[2]."', '".$line[3]."', '".$line[4]."', '".$line[5]."', '".$line[6]."', '".$line[7]."', '".$line[8]."', '".$line[9]."', '".$line[10]."', '".$line[11]."', '".$line[12]."',)");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: admin.php".$qstring);