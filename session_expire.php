<?php
function setSessionTime(
            $_timeSecond,
            $url=null,
            $return=null,
            $check_access=null,
            $renewTime=null
        ){
 
    if($check_access==null && $url!=""){
       header("location:".$url);            
        exit;
    }
     
    $data_back=0; // 0 คือ ยังไม่ล้างตัวแปร 1 คือ ล้างค่าตัวแปรแล้ว
    if(!isset($_SESSION['ses_time_life'])){
        $_SESSION['ses_time_life']=time();
    }
    if(isset($_SESSION['ses_time_life']) && time()-$_SESSION['ses_time_life']>$_timeSecond){
        if(count($_SESSION)>0){
 
            // วนลูป unset ตัวแปร session ทั้งหมด      
               foreach($_SESSION as $key=>$value){
                unset($$key);
                unset($_SESSION[$key]);
               }
 
            //    หรือเฉพาะตัวแปรที่ต้องการ
//            unset($_SESSION['user']); // กำหนดตัวแปร session อื่นๆ ที่ต้องการ unset ต่อจากนี้ได้
 //           unset($_SESSION['ses_time_life']);  // กรณีกำหนดเฉพาะ ต้องมี บรรทัดนี้ด้วยเสมอ
             
            if($return){
                $data_back=1;
                return $data_back;
                exit;
            }            
 
            // ถ้ามีการกำหนด url หลังจาก unset ก็ให้ ลิ้งค์ไปหน้านั้นๆ
            if($url){
                header("location:".$url);
                exit;
            }
        }
    }else{
        // อัพเดทเป็นเวลาล่าสุด
        if($renewTime==true){
            $_SESSION['ses_time_life']=time();
        }
        if($return){
            $data_back=0;
            return $data_back;
            exit;
        }        
    }
}
?>