<?Php
/*
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
$dbhost_name = "localhost";
$database = "ls_payslip"; // Change your database name
$username = "root";          // Your database user id
$password = "";          // Your password

try {
$dbo=new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
*/

/*
$sname= "localhost";

$unmae= "root";

$password = "";

$db_name = "ls_payslip";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo "Connection failed!";
}
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

date_default_timezone_set("Asia/Bangkok");
$connect= mysqli_connect("localhost","root","","ls_payslip"); 
// Check connection
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connect -> connect_error;
  exit();
} 

?>