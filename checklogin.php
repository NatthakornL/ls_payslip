<?php 
session_start();
        if(isset($_POST['submit'])){
            include("connect.php");
            $username = $_POST['idno'];
            $password = $_POST['passc'];

            $sql="SELECT * FROM tbmain WHERE  idno='".$username."' AND  passc='".$password."' ";
            $result = mysqli_query($connect,$sql);
				
            if(mysqli_num_rows($result)==1){
                $rowM = mysqli_fetch_array($result);

                $_SESSION["noman"] = $rowM["noman"];
                $_SESSION["nname"] = $rowM["nname"];
                $_SESSION["nobank"] = $rowM["nobank"];
                $_SESSION["nposit"] = $rowM["nposit"];
                $_SESSION["noffice"] = $rowM["noffice"];
                $_SESSION["dayup"] = $rowM["dayup"];
                $_SESSION["chn"] = $rowM["chn"];

            $sql = "SELECT * FROM tbdetail WHERE idno='$username' ";
            $result = mysqli_query($connect, $sql);
            $rowM = mysqli_fetch_array($result);

                //สร้างตัวแปร session
                $_SESSION["nauto"] = $rowM["nauto"];
                $_SESSION["nno"] = $rowM["nno"];
                $_SESSION["yy"] = $rowM["yy"];
                $_SESSION["mm"] = $rowM["mm"];
                $_SESSION["idno"] = $rowM["idno"];
                $_SESSION["nobank"] = $rowM["nobank"];
                $_SESSION["money1"] = $rowM["money1"];
                $_SESSION["money2"] = $rowM["money2"];
                $_SESSION["money3"] = $rowM["money3"];
                $_SESSION["money4"] = $rowM["money4"];
                $_SESSION["money5"] = $rowM["money5"];
                $_SESSION["money6"] = $rowM["money6"];
                $_SESSION["money7"] = $rowM["money7"];
                $_SESSION["money8"] = $rowM["money8"];
                $_SESSION["money9"] = $rowM["money9"];
                $_SESSION["money10"] = $rowM["money10"];
                $_SESSION["sumget"] = $rowM["sumget"];
                $_SESSION["exp1"] = $rowM["exp1"];
                $_SESSION["exp2"] = $rowM["exp2"];
                $_SESSION["exp3"] = $rowM["exp3"];
                $_SESSION["exp4"] = $rowM["exp4"];
                $_SESSION["exp5"] = $rowM["exp5"];
                $_SESSION["exp6"] = $rowM["exp6"];
                $_SESSION["exp7"] = $rowM["exp7"];
                $_SESSION["exp8"] = $rowM["exp8"];
                $_SESSION["exp9"] = $rowM["exp9"];
                $_SESSION["exp10"] = $rowM["exp10"];
                $_SESSION["sumpay"] = $rowM["sumpay"];
                $_SESSION["sumnet"] = $rowM["sumnet"];
                $_SESSION["daykey"] = $rowM["daykey"];
                $_SESSION["money4txt"] = $rowM["money4txt"];
                $_SESSION["money5txt"] = $rowM["money5txt"];
                $_SESSION["money6txt"] = $rowM["money6txt"];
                $_SESSION["money10txt"] = $rowM["money10txt"];
                $_SESSION["exp9txt"] = $rowM["money4txt"];
                $_SESSION["daypay"] = $rowM["daypay"];
                $_SESSION["note"] = $rowM["note"];
                $_SESSION["remark"] = $rowM["remark"];
                $_SESSION["chk"] = $rowM["chk"];
                $_SESSION["last_update"] = $rowM["last_update"];

                      
                //สร้างเงื่อนไขตรวจสอบระดับหรือสิทธิการใช้งาน
                if($_SESSION["chn"]=='1'){
                //กระโดดไปหน้าผู้ใช้
                    Header("Location: index.php"); //ทำต่อเองนะครับ
                    echo ''.$_SESSION["nname"]. ' level = '. $_SESSION["chn"];
                    echo '<br> <a href="logout.php"> Logout </a>';
                }else if($_SESSION["chn"]=='0'){
                //กระโดดไปหน้าสมาชิก
                    Header("Location: firstlogin.php"); //ทำต่อเองนะครับ
                    echo ''.$_SESSION["nname"]. ' level = '. $_SESSION["chn"];
                    echo '<br> <a href="logout.php"> Logout </a>';
                }else if($_SESSION["chn"]=='2'){
                //กระโดดไปหน้าเเอดมิน
                    Header("Location: admin.php"); //ทำต่อเองนะครับ
                    echo ''.$_SESSION["nname"]. ' level = '. $_SESSION["chn"];
                    echo '<br> <a href="logout.php"> Logout </a>';
                }else{
                    session_destroy();
                    echo "<script>
                    alert('รหัสผ่านไม่ถูกต้อง!!!');
                    window.location = 'login.php'
                    </script>";
                }
                }else{

                    session_destroy();
                    echo "<script>
                    alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!!');
                    window.location = 'login.php'
                    </script>";
                    //user & password incorrect back to login again
        }
    }
?>