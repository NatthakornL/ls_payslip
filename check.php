<?Php
if(!isset($_SESSION['noman'])){
  echo "<script>
  alert('เข้าสู่ระบบไม่ถูกต้อง!!!');
  window.location = 'login.php'
  </script>";
   exit;
}else{
  
}
?>