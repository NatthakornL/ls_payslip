<?Php

if (!isset($_SESSION['idno'])) {
  echo "<script>
  alert('เข้าสู่ระบบไม่ถูกต้อง!!!');
  window.location = 'login.php'
  </script>";
  exit;
} else {
  $now = time();

  if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>
  alert('หมดอายุการเข้าสู่การใช้งาน!!');
  window.location = 'login.php'
  </script>";
  } else {

?>

<?php
  }
}
?>