<?php
     session_start();
     function register() { 
         if(!empty($_POST)){
            $username =$_POST['username'];
            $password =$_POST['password'];
            $password=md5($password);
            $email =$_POST['email'];
           // $status=1;
            $quyen=3;
            include("../db/MySQLConnect.php");

        //thuc hien truy van du lieu - chen du lieu vao database 2 bang taikhoan va khachhang
        $checkemail="SELECT * from taikhoan WHERE EMAIL='".$email."'  ";
        //echo $checkemail
        $query="INSERT INTO taikhoan (TEN_DANG_NHAP,MAT_KHAU,EMAIL,MA_GROUP_QUYEN,STATUS)
                VALUE('".$username."','".$password."','".$email."','".$quyen."','1')";
        $getMaTK="SELECT MA_TK FROM `taikhoan` WHERE TEN_DANG_NHAP ='$username'";       

        $data=array();
        $data= mysqli_fetch_array(mysqli_query($connect,$checkemail));
         if($data == null){          
            mysqli_query($connect,$query);
            $MA_TK = mysqli_fetch_assoc(mysqli_query($connect,$getMaTK)); 
            $query1= "INSERT INTO khachhang (TEN_KH,EMAIL,MA_TK) VALUE('".$username."','".$email."','".$MA_TK['MA_TK']."')";      
            $result=mysqli_query($connect,$query1);       
             echo 1;
             exit() ;
         }
         else { 
             echo 0;
             exit() ;
         }

        //dong kêt nối
         $connect->close();        
        }
    }
    register();
   
?>