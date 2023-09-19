<?Php
if(!isset($_SESSION['loginAdmin'])){
  echo "<script>
  alert('เข้าสู่ระบบไม่ถูกต้อง!!!');
  window.location = 'login_admin.php'
  </script>";
   exit;
}else{
  
}
?>